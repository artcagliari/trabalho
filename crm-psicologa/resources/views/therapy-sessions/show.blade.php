@extends('layouts.app')

@section('content')
<div class="header-row">
    <div class="section-title">
        <h1>Sessão de {{ $therapySession->patient->full_name }}</h1>
        <p class="section-subtitle">Detalhes do atendimento</p>
    </div>
    <a class="link-btn" href="{{ route('therapy-sessions.edit', $therapySession) }}">Editar</a>
</div>

<div class="glass card">
    <div class="meta-grid">
        <div class="meta-item">
            <span class="meta-label">Data</span>
            <span class="meta-value">{{ optional($therapySession->session_date)->format('d/m/Y') }}</span>
        </div>
        <div class="meta-item">
            <span class="meta-label">Horário</span>
            <span class="meta-value">{{ substr($therapySession->session_time, 0, 5) }}</span>
        </div>
        <div class="meta-item">
            <span class="meta-label">Modalidade</span>
            <span class="meta-value">{{ $therapySession->attendance_type }}</span>
        </div>
        <div class="meta-item">
            <span class="meta-label">Status</span>
            <span class="meta-value">{{ $therapySession->session_status }}</span>
        </div>
    </div>

    <div class="content-box">{{ $therapySession->notes ?: 'Sem observações registradas.' }}</div>
</div>
@endsection
