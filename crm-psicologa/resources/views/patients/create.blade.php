@extends('layouts.app')

@section('content')
<div class="section-title">
    <h1>Novo Paciente</h1>
    <p class="section-subtitle">Preencha os dados para iniciar o acompanhamento</p>
</div>

<form method="POST" class="glass card js-validate" action="{{ route('patients.store') }}">
    @include('patients.form', ['patient' => null])
</form>
@endsection
