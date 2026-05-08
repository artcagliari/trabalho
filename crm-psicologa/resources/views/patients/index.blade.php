@extends('layouts.app')

@section('content')
<div class="header-row">
    <div class="section-title">
        <h1>Pacientes</h1>
        <p class="section-subtitle">Cadastro e acompanhamento</p>
    </div>
    <a class="btn" href="{{ route('patients.create') }}">Novo Paciente</a>
</div>

<div class="glass card table-wrap">
    <table>
        <tr>
            <th>Nome</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        @forelse($patients as $patient)
            <tr>
                <td>{{ $patient->full_name }}</td>
                <td>
                    <span class="status-badge {{ $patient->care_status === 'ativo' ? 'success' : ($patient->care_status === 'em pausa' ? 'warning' : 'danger') }}">
                        {{ $patient->care_status }}
                    </span>
                </td>
                <td>
                    <div class="table-actions">
                        <a class="link-btn" href="{{ route('patients.show', $patient) }}">Ver</a>
                        <a class="link-btn" href="{{ route('patients.edit', $patient) }}">Editar</a>
                        <form method="POST" action="{{ route('patients.destroy', $patient) }}" class="inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="danger">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="muted">Nenhum paciente cadastrado.</td>
            </tr>
        @endforelse
    </table>
</div>

<div class="pagination-wrap">
    {{ $patients->links() }}
</div>
@endsection
