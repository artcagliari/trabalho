@extends('layouts.app')

@section('content')
<div class="header-row">
    <div class="section-title">
        <h1>Sessões</h1>
        <p class="section-subtitle">Registro e controle das consultas</p>
    </div>
    <a class="btn" href="{{ route('therapy-sessions.create') }}">Nova Sessão</a>
</div>

<div class="glass card table-wrap">
    <table>
        <tr>
            <th>Paciente</th>
            <th>Data</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        @forelse($therapySessions as $session)
            <tr>
                <td>{{ $session->patient->full_name }}</td>
                <td>{{ $session->session_date->format('d/m/Y') }}</td>
                <td>
                    <span class="status-badge {{ $session->session_status === 'realizada' ? 'success' : ($session->session_status === 'marcada' ? 'warning' : 'danger') }}">
                        {{ $session->session_status }}
                    </span>
                </td>
                <td>
                    <div class="table-actions">
                        <a class="link-btn" href="{{ route('therapy-sessions.show', $session) }}">Ver</a>
                        <a class="link-btn" href="{{ route('therapy-sessions.edit', $session) }}">Editar</a>
                        @if($session->session_status !== 'realizada')
                            <form method="POST" action="{{ route('therapy-sessions.mark-realized', $session) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit">Marcar como realizada</button>
                            </form>
                        @endif
                        @if($session->session_status === 'realizada')
                            <a class="link-btn" href="{{ route('clinical-notes.create', ['therapy_session_id' => $session->id]) }}">Anotação</a>
                        @else
                            <span class="link-btn disabled">Anotação</span>
                        @endif
                        <form method="POST" action="{{ route('therapy-sessions.destroy', $session) }}" class="inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="danger">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="muted">Nenhuma sessão cadastrada.</td>
            </tr>
        @endforelse
    </table>
</div>

<div class="pagination-wrap">
    {{ $therapySessions->links() }}
</div>
@endsection
