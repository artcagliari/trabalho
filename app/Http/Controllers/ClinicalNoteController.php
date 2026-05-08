<?php
namespace App\Http\Controllers;
use App\Models\ClinicalNote;use App\Models\Patient;use Illuminate\Http\Request;
class ClinicalNoteController extends Controller
{
    public function index(){ $clinicalNotes = ClinicalNote::with('patient')->latest('created_on')->paginate(10); return view('clinical-notes.index', compact('clinicalNotes')); }
    public function create(){ $patients = Patient::orderBy('full_name')->get(); return view('clinical-notes.create', compact('patients')); }
    public function store(Request $request){ $data=$request->validate(['patient_id'=>'required|exists:patients,id','title'=>'required|string|max:255','content'=>'required|string|max:3000','created_on'=>'required|date']); ClinicalNote::create($data); return redirect()->route('clinical-notes.index')->with('success','Anotação criada.'); }
    public function show(ClinicalNote $clinical_note){ return view('clinical-notes.show',['clinicalNote'=>$clinical_note->load('patient')]); }
    public function edit(ClinicalNote $clinical_note){ $patients=Patient::orderBy('full_name')->get(); return view('clinical-notes.edit',['clinicalNote'=>$clinical_note,'patients'=>$patients]); }
    public function update(Request $request, ClinicalNote $clinical_note){ $data=$request->validate(['patient_id'=>'required|exists:patients,id','title'=>'required|string|max:255','content'=>'required|string|max:3000','created_on'=>'required|date']); $clinical_note->update($data); return redirect()->route('clinical-notes.index')->with('success','Anotação atualizada.'); }
    public function destroy(ClinicalNote $clinical_note){ $clinical_note->delete(); return back()->with('success','Anotação removida.'); }
}
