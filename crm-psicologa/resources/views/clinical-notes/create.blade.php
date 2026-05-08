@extends('layouts.app')

@section('content')
<div class="section-title">
    <h1>Nova Anotação</h1>
    <p class="section-subtitle">A anotação deve ser vinculada a uma sessão realizada</p>
</div>

<form method="POST" class="glass card js-validate" action="{{ route('clinical-notes.store') }}">
    @include('clinical-notes.form', ['clinicalNote' => null])
</form>
@endsection
