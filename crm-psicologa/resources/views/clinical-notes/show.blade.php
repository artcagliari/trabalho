@extends('layouts.app')

@section('content')
<div class="header-row">
    <div class="section-title">
        <h1>{{ $clinicalNote->title }}</h1>
        <p class="section-subtitle">Anotação clínica de {{ $clinicalNote->patient->full_name }}</p>
    </div>
    <a class="link-btn" href="{{ route('clinical-notes.edit', $clinicalNote) }}">Editar</a>
</div>

<div class="glass card">
    <div class="meta-grid">
        <div class="meta-item">
            <span class="meta-label">Paciente</span>
            <span class="meta-value">{{ $clinicalNote->patient->full_name }}</span>
        </div>
        <div class="meta-item">
            <span class="meta-label">Data da anotação</span>
            <span class="meta-value">{{ optional($clinicalNote->created_on)->format('d/m/Y') }}</span>
        </div>
        <div class="meta-item">
            <span class="meta-label">Sessão vinculada</span>
            <span class="meta-value">
                @if($clinicalNote->therapySession)
                    {{ optional($clinicalNote->therapySession->session_date)->format('d/m/Y') }} às {{ substr($clinicalNote->therapySession->session_time, 0, 5) }}
                @else
                    Sem sessão vinculada
                @endif
            </span>
        </div>
        <div class="meta-item">
            <span class="meta-label">Status da sessão</span>
            <span class="meta-value">{{ $clinicalNote->therapySession->session_status ?? 'N/A' }}</span>
        </div>
    </div>

    <div class="content-box">{{ $clinicalNote->content }}</div>
</div>
@endsection
