<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function index(): View
    {
        $patients = Patient::latest()->paginate(10);

        return view('patients.index', compact('patients'));
    }

    public function create(): View
    {
        return view('patients.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());

        Patient::create($validated);

        return redirect()->route('patients.index')->with('success', 'Paciente cadastrado com sucesso.');
    }

    public function show(Patient $patient): View
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient): View
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient): RedirectResponse
    {
        $validated = $request->validate($this->rules($patient->id));

        $patient->update($validated);

        return redirect()->route('patients.index')->with('success', 'Paciente atualizado com sucesso.');
    }

    public function destroy(Patient $patient): RedirectResponse
    {
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Paciente removido com sucesso.');
    }

    private function rules(?int $patientId = null): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', 'unique:patients,email,' . $patientId],
            'birth_date' => ['required', 'date', 'before:today'],
            'main_complaint' => ['required', 'string', 'max:2000'],
            'care_status' => ['required', 'in:ativo,em pausa,encerrado'],
        ];
    }
}
