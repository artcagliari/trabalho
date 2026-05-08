@extends('layouts.app')

@section('content')
<div class="section-title">
    <h1>Nova Sessão</h1>
    <p class="section-subtitle">Agende e classifique o atendimento</p>
</div>

<form method="POST" class="glass card js-validate" action="{{ route('therapy-sessions.store') }}">
    @include('therapy-sessions.form', ['therapySession' => null])
</form>
@endsection
