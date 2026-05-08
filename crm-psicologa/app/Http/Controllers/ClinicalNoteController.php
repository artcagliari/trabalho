<?php

namespace App\Http\Controllers;

use App\Models\ClinicalNote;
use App\Models\TherapySession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ClinicalNoteController extends Controller
{
    public function index(): View
    {
        $clinicalNotes = ClinicalNote::with(['patient', 'therapySession'])
            ->latest('created_on')
            ->paginate(10);

        return view('clinical-notes.index', compact('clinicalNotes'));
    }

    public function create(Request $request): View
    {
        $selectedSessionId = $request->integer('therapy_session_id') ?: null;
        $therapySessions = $this->sessionsForNotes($selectedSessionId);

        return view('clinical-notes.create', [
            'therapySessions' => $therapySessions,
            'preselectedTherapySessionId' => $selectedSessionId,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatePayload($request);
        ClinicalNote::create($data);

        return redirect()->route('clinical-notes.index')->with('success', 'Anotação criada para sessão realizada.');
    }

    public function show(ClinicalNote $clinical_note): View
    {
        return view('clinical-notes.show', [
            'clinicalNote' => $clinical_note->load(['patient', 'therapySession']),
        ]);
    }

    public function edit(ClinicalNote $clinical_note): View
    {
        $therapySessions = $this->sessionsForNotes($clinical_note->therapy_session_id);

        return view('clinical-notes.edit', [
            'clinicalNote' => $clinical_note,
            'therapySessions' => $therapySessions,
        ]);
    }

    public function update(Request $request, ClinicalNote $clinical_note): RedirectResponse
    {
        $data = $this->validatePayload($request);
        $clinical_note->update($data);

        return redirect()->route('clinical-notes.index')->with('success', 'Anotação atualizada.');
    }

    public function destroy(ClinicalNote $clinical_note): RedirectResponse
    {
        $clinical_note->delete();

        return back()->with('success', 'Anotação removida.');
    }

    private function validatePayload(Request $request): array
    {
        $data = $request->validate([
            'therapy_session_id' => ['required', 'exists:therapy_sessions,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:3000'],
            'created_on' => ['required', 'date'],
        ]);

        $therapySession = TherapySession::findOrFail($data['therapy_session_id']);

        if ($therapySession->session_status !== 'realizada') {
            throw ValidationException::withMessages([
                'therapy_session_id' => 'A anotação clínica só pode ser vinculada a sessão realizada.',
            ]);
        }

        $sessionDate = $therapySession->session_date?->format('Y-m-d');
        if ($sessionDate !== null && $data['created_on'] < $sessionDate) {
            throw ValidationException::withMessages([
                'created_on' => 'A data da anotação deve ser no dia da sessão ou depois dela.',
            ]);
        }

        $data['patient_id'] = $therapySession->patient_id;

        return $data;
    }

    private function sessionsForNotes(?int $selectedId = null)
    {
        return TherapySession::with('patient')
            ->where(function ($query) use ($selectedId): void {
                $query->where('session_status', 'realizada');
                if ($selectedId !== null) {
                    $query->orWhere('id', $selectedId);
                }
            })
            ->orderByDesc('session_date')
            ->orderByDesc('session_time')
            ->get();
    }
}
