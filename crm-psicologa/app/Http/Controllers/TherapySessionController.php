<?php

namespace App\Http\Controllers;

use App\Models\AgendaEntry;
use App\Models\Patient;
use App\Models\TherapySession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TherapySessionController extends Controller
{
    public function index(): View
    {
        $therapySessions = TherapySession::with('patient')->latest('session_date')->paginate(10);

        return view('therapy-sessions.index', compact('therapySessions'));
    }

    public function create(): View
    {
        $patients = Patient::orderBy('full_name')->get();

        return view('therapy-sessions.create', compact('patients'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());
        $therapySession = TherapySession::create($data);

        $this->syncAgendaEntry($therapySession);

        return redirect()->route('therapy-sessions.index')->with('success', 'Sessão criada e adicionada à agenda.');
    }

    public function show(TherapySession $therapy_session): View
    {
        return view('therapy-sessions.show', ['therapySession' => $therapy_session->load('patient')]);
    }

    public function edit(TherapySession $therapy_session): View
    {
        $patients = Patient::orderBy('full_name')->get();

        return view('therapy-sessions.edit', ['therapySession' => $therapy_session, 'patients' => $patients]);
    }

    public function update(Request $request, TherapySession $therapy_session): RedirectResponse
    {
        $data = $request->validate($this->rules());
        $therapy_session->update($data);

        $this->syncAgendaEntry($therapy_session->fresh());

        return redirect()->route('therapy-sessions.index')->with('success', 'Sessão atualizada e agenda sincronizada.');
    }

    public function markAsCompleted(TherapySession $therapy_session): RedirectResponse
    {
        if ($therapy_session->session_status === 'realizada') {
            return back()->with('success', 'A sessão já estava marcada como realizada.');
        }

        $therapy_session->update(['session_status' => 'realizada']);
        $this->syncAgendaEntry($therapy_session->fresh());

        return back()->with('success', 'Sessão marcada como realizada.');
    }

    public function destroy(TherapySession $therapy_session): RedirectResponse
    {
        AgendaEntry::where('therapy_session_id', $therapy_session->id)->delete();
        $therapy_session->delete();

        return back()->with('success', 'Sessão removida da agenda e do sistema.');
    }

    private function rules(): array
    {
        return [
            'patient_id' => ['required', 'exists:patients,id'],
            'session_date' => ['required', 'date'],
            'session_time' => ['required', 'date_format:H:i'],
            'attendance_type' => ['required', 'in:online,presencial'],
            'session_status' => ['required', 'in:marcada,realizada,cancelada'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }

    private function syncAgendaEntry(TherapySession $therapySession): void
    {
        $statusLabel = match ($therapySession->session_status) {
            'marcada' => 'Marcada',
            'realizada' => 'Realizada',
            'cancelada' => 'Cancelada',
            default => 'Sessão',
        };

        $patientName = $therapySession->patient?->full_name ?? 'Paciente';

        AgendaEntry::updateOrCreate(
            ['therapy_session_id' => $therapySession->id],
            [
                'patient_id' => $therapySession->patient_id,
                'consultation_date' => $therapySession->session_date,
                'consultation_time' => $therapySession->session_time,
                'title' => "{$statusLabel}: {$patientName}",
                'notes' => $therapySession->notes,
            ]
        );
    }
}
