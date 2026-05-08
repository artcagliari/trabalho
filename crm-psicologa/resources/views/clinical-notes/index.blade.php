@extends('layouts.app')

@section('content')
<div class="header-row">
    <div class="section-title">
        <h1>Anotações Clínicas</h1>
        <p class="section-subtitle">Registro de evolução e observações pós-consulta</p>
    </div>
    <a class="btn" href="{{ route('clinical-notes.create') }}">Nova Anotação</a>
</div>

<div class="glass card table-wrap">
    <table>
        <tr>
            <th>Paciente</th>
            <th>Sessão</th>
            <th>Título</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        @forelse($clinicalNotes as $note)
            <tr>
                <td>{{ $note->patient->full_name }}</td>
                <td>
                    @if($note->therapySession)
                        {{ optional($note->therapySession->session_date)->format('d/m/Y') }} às {{ substr($note->therapySession->session_time, 0, 5) }}
                    @else
                        <span class="muted">Sem sessão vinculada</span>
                    @endif
                </td>
                <td>{{ $note->title }}</td>
                <td>{{ $note->created_on->format('d/m/Y') }}</td>
                <td>
                    <div class="table-actions">
                        <a class="link-btn" href="{{ route('clinical-notes.show', $note) }}">Ver</a>
                        <a class="link-btn" href="{{ route('clinical-notes.edit', $note) }}">Editar</a>
                        <form method="POST" action="{{ route('clinical-notes.destroy', $note) }}" class="inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="danger">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="muted">Nenhuma anotação cadastrada.</td>
            </tr>
        @endforelse
    </table>
</div>

<div class="pagination-wrap">
    {{ $clinicalNotes->links() }}
</div>
@endsection
