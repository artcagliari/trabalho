@extends('layouts.app')

@section('content')
<div class="section-title">
    <h1>Editar Anotação</h1>
    <p class="section-subtitle">Revise e atualize o registro pós-consulta</p>
</div>

<form method="POST" class="glass card js-validate" action="{{ route('clinical-notes.update', $clinicalNote) }}">
    @method('PUT')
    @include('clinical-notes.form', ['clinicalNote' => $clinicalNote])
</form>
@endsection
