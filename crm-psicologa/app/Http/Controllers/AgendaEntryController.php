<?php

namespace App\Http\Controllers;

use App\Models\AgendaEntry;
use App\Models\Patient;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgendaEntryController extends Controller
{
    public function index(Request $request): View
    {
        $monthParam = $request->query('month');
        $baseDate = $monthParam ? Carbon::createFromFormat('Y-m', $monthParam)->startOfMonth() : now()->startOfMonth();

        $start = $baseDate->copy()->startOfMonth();
        $end = $baseDate->copy()->endOfMonth();

        $entries = AgendaEntry::with('patient')
            ->whereBetween('consultation_date', [$start->toDateString(), $end->toDateString()])
            ->orderBy('consultation_date')
            ->orderBy('consultation_time')
            ->get()
            ->groupBy(fn (AgendaEntry $entry) => $entry->consultation_date->toDateString());

        $days = CarbonPeriod::create($start, $end);

        return view('agenda.index', [
            'month' => $baseDate,
            'days' => $days,
            'entriesByDay' => $entries,
            'previousMonth' => $baseDate->copy()->subMonth()->format('Y-m'),
            'nextMonth' => $baseDate->copy()->addMonth()->format('Y-m'),
        ]);
    }

    public function create(): View
    {
        $patients = Patient::orderBy('full_name')->get();

        return view('agenda.create', compact('patients'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());
        AgendaEntry::create($data);

        return redirect()->route('agenda-entries.index')->with('success', 'Consulta adicionada na agenda.');
    }

    public function edit(AgendaEntry $agenda_entry): View
    {
        $patients = Patient::orderBy('full_name')->get();

        return view('agenda.edit', [
            'agendaEntry' => $agenda_entry,
            'patients' => $patients,
        ]);
    }

    public function update(Request $request, AgendaEntry $agenda_entry): RedirectResponse
    {
        $data = $request->validate($this->rules());
        $agenda_entry->update($data);

        return redirect()->route('agenda-entries.index')->with('success', 'Consulta atualizada na agenda.');
    }

    public function destroy(AgendaEntry $agenda_entry): RedirectResponse
    {
        $agenda_entry->delete();

        return back()->with('success', 'Consulta removida da agenda.');
    }

    private function rules(): array
    {
        return [
            'patient_id' => ['nullable', 'exists:patients,id'],
            'consultation_date' => ['required', 'date'],
            'consultation_time' => ['nullable', 'date_format:H:i'],
            'title' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:3000'],
        ];
    }
}
