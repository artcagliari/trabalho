@extends('layouts.app')

@section('content')
<div class="section-title">
    <h1>Editar Paciente</h1>
    <p class="section-subtitle">Atualize os dados de {{ $patient->full_name }}</p>
</div>

<form method="POST" class="glass card js-validate" action="{{ route('patients.update', $patient) }}">
    @method('PUT')
    @include('patients.form', ['patient' => $patient])
</form>
@endsection
