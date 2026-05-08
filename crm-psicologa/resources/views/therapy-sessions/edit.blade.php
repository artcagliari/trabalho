@extends('layouts.app')

@section('content')
<div class="section-title">
    <h1>Editar Sessão</h1>
    <p class="section-subtitle">Atualize informações do atendimento</p>
</div>

<form method="POST" class="glass card js-validate" action="{{ route('therapy-sessions.update', $therapySession) }}">
    @method('PUT')
    @include('therapy-sessions.form', ['therapySession' => $therapySession])
</form>
@endsection
