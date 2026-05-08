<?php
namespace App\Http\Controllers;
use App\Models\Patient;use App\Models\TherapySession;use Illuminate\Http\Request;
class TherapySessionController extends Controller
{
    public function index(){ $therapySessions = TherapySession::with('patient')->latest('session_date')->paginate(10); return view('therapy-sessions.index', compact('therapySessions')); }
    public function create(){ $patients = Patient::orderBy('full_name')->get(); return view('therapy-sessions.create', compact('patients')); }
    public function store(Request $request){ $data = $request->validate(['patient_id'=>'required|exists:patients,id','session_date'=>'required|date','session_time'=>'required|date_format:H:i','attendance_type'=>'required|in:online,presencial','session_status'=>'required|in:marcada,realizada,cancelada','notes'=>'nullable|string|max:2000']); TherapySession::create($data); return redirect()->route('therapy-sessions.index')->with('success','Sessão criada.'); }
    public function show(TherapySession $therapy_session){ return view('therapy-sessions.show',['therapySession'=>$therapy_session->load('patient')]); }
    public function edit(TherapySession $therapy_session){ $patients=Patient::orderBy('full_name')->get(); return view('therapy-sessions.edit',['therapySession'=>$therapy_session,'patients'=>$patients]); }
    public function update(Request $request, TherapySession $therapy_session){ $data = $request->validate(['patient_id'=>'required|exists:patients,id','session_date'=>'required|date','session_time'=>'required|date_format:H:i','attendance_type'=>'required|in:online,presencial','session_status'=>'required|in:marcada,realizada,cancelada','notes'=>'nullable|string|max:2000']); $therapy_session->update($data); return redirect()->route('therapy-sessions.index')->with('success','Sessão atualizada.'); }
    public function destroy(TherapySession $therapy_session){ $therapy_session->delete(); return back()->with('success','Sessão removida.'); }
}
