@extends('layouts.app')

@section('content')
<div class="header-row">
    <div class="section-title">
        <h1>Agenda de Consultas</h1>
        <p class="section-subtitle">Planejamento mensal dos atendimentos</p>
    </div>
    <a class="btn" href="{{ route('agenda-entries.create') }}">Nova Consulta</a>
</div>

<div class="glass card agenda-toolbar">
    <a class="link-btn" href="{{ route('agenda-entries.index', ['month' => $previousMonth]) }}">Mês anterior</a>
    <strong>{{ $month->translatedFormat('F \d\e Y') }}</strong>
    <a class="link-btn" href="{{ route('agenda-entries.index', ['month' => $nextMonth]) }}">Próximo mês</a>
</div>

<div class="agenda-grid">
    @foreach($days as $day)
        @php
            $key = $day->toDateString();
            $entries = $entriesByDay[$key] ?? collect();
        @endphp
        <div class="glass agenda-day {{ $day->isToday() ? 'today' : '' }}">
            <div class="agenda-day-head">
                <span>{{ $day->format('d') }}</span>
                <small>{{ ucfirst($day->translatedFormat('D')) }}</small>
            </div>
            <div class="agenda-events">
                @forelse($entries as $entry)
                    <div class="agenda-event">
                        <div>
                            <strong>{{ $entry->title }}</strong>
                            @if($entry->consultation_time)
                                <small>{{ substr($entry->consultation_time, 0, 5) }}</small>
                            @endif
                        </div>
                        <small>{{ $entry->patient?->full_name ?? 'Sem paciente' }}</small>
                        <div class="table-actions">
                            <a class="link-btn" href="{{ route('agenda-entries.edit', $entry) }}">Editar</a>
                            <form method="POST" action="{{ route('agenda-entries.destroy', $entry) }}" class="inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="danger">Excluir</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <small class="muted">Sem consultas</small>
                @endforelse
            </div>
        </div>
    @endforeach
</div>
@endsection
