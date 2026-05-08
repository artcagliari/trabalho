@extends('layouts.app')

@section('content')
<div class="header-row">
    <div class="section-title">
        <h1>{{ $patient->full_name }}</h1>
        <p class="section-subtitle">Detalhes do paciente</p>
    </div>
    <a class="link-btn" href="{{ route('patients.edit', $patient) }}">Editar</a>
</div>

<div class="glass card">
    <div class="meta-grid">
        <div class="meta-item">
            <span class="meta-label">E-mail</span>
            <span class="meta-value">{{ $patient->email }}</span>
        </div>
        <div class="meta-item">
            <span class="meta-label">Telefone</span>
            <span class="meta-value">{{ $patient->phone }}</span>
        </div>
        <div class="meta-item">
            <span class="meta-label">Nascimento</span>
            <span class="meta-value">{{ optional($patient->birth_date)->format('d/m/Y') }}</span>
        </div>
        <div class="meta-item">
            <span class="meta-label">Status</span>
            <span class="meta-value">{{ $patient->care_status }}</span>
        </div>
    </div>

    <div class="content-box">{{ $patient->main_complaint }}</div>
</div>
@endsection
