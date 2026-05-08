@extends('layouts.app')

@section('content')
<div class="section-title">
    <h1>Dashboard CRM</h1>
    <p class="section-subtitle">Visão rápida da operação clínica</p>
</div>

<div class="grid">
    <div class="glass card stat">
        <span class="label">Total pacientes</span>
        <span class="value">{{ $totalPatients }}</span>
    </div>
    <div class="glass card stat">
        <span class="label">Pacientes ativos</span>
        <span class="value">{{ $totalActivePatients }}</span>
    </div>
    <div class="glass card stat">
        <span class="label">Sessões marcadas</span>
        <span class="value">{{ $totalScheduledSessions }}</span>
    </div>
    <div class="glass card stat">
        <span class="label">Sessões realizadas</span>
        <span class="value">{{ $totalCompletedSessions }}</span>
    </div>
</div>

<div class="grid2">
    <div class="glass card">
        <h3>Próximas sessões</h3>
        <div class="list-compact">
            @forelse($upcomingSessions as $s)
                <div class="item">{{ $s->session_date->format('d/m/Y') }} às {{ substr($s->session_time, 0, 5) }} - {{ $s->patient->full_name }}</div>
            @empty
                <div class="item muted">Sem sessões futuras.</div>
            @endforelse
        </div>
    </div>

    <div class="glass card">
        <h3>Últimos pacientes</h3>
        <div class="list-compact">
            @forelse($latestPatients as $p)
                <div class="item">{{ $p->full_name }}</div>
            @empty
                <div class="item muted">Sem pacientes cadastrados.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
