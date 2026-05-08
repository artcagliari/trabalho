@extends('layouts.app')
@section('content')
<div class='header-row'><h1>Pacientes</h1><a class='btn' href='{{ route('patients.create') }}'>Novo</a></div>
<div class='glass card'><table><tr><th>Nome</th><th>Status</th><th>Ações</th></tr>@foreach($patients as $patient)<tr><td>{{ $patient->full_name }}</td><td>{{ $patient->care_status }}</td><td><a href='{{ route('patients.edit',$patient) }}'>Editar</a><form method='POST' action='{{ route('patients.destroy',$patient) }}' class='inline delete-form'>@csrf @method('DELETE')<button>Excluir</button></form></td></tr>@endforeach</table></div>{{ $patients->links() }}
@endsection
