@extends('layouts.app')

@section('content')
<div class="section-title">
    <h1>Nova Consulta na Agenda</h1>
    <p class="section-subtitle">Organize datas e horários de atendimento</p>
</div>

<div class="glass card">
    <form method="POST" action="{{ route('agenda-entries.store') }}" class="js-validate">
        @include('agenda.form')
    </form>
</div>
@endsection
