@extends('layouts.app')

@section('content')
<div class="section-title">
    <h1>Editar Consulta na Agenda</h1>
    <p class="section-subtitle">Atualize as informações da consulta</p>
</div>

<div class="glass card">
    <form method="POST" action="{{ route('agenda-entries.update', $agendaEntry) }}" class="js-validate">
        @method('PUT')
        @include('agenda.form')
    </form>
</div>
@endsection
