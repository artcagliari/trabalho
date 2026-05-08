@csrf

<div class="form-grid">
    <div class="field full">
        <label for="therapy_session_id">Sessão realizada</label>
        <select id="therapy_session_id" name="therapy_session_id" required>
            <option value="">Selecione uma sessão</option>
            @foreach($therapySessions as $session)
                <option value="{{ $session->id }}" @selected(old('therapy_session_id', $clinicalNote->therapy_session_id ?? ($preselectedTherapySessionId ?? '')) == $session->id)>
                    {{ optional($session->session_date)->format('d/m/Y') }} às {{ substr($session->session_time, 0, 5) }} - {{ $session->patient->full_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="field full">
        <label for="title">Título</label>
        <input id="title" name="title" required value="{{ old('title', $clinicalNote->title ?? '') }}">
    </div>

    <div class="field">
        <label for="created_on">Data da anotação (pós-consulta)</label>
        <input id="created_on" type="date" name="created_on" required value="{{ old('created_on', isset($clinicalNote) ? optional($clinicalNote->created_on)->format('Y-m-d') : '') }}">
    </div>

    <div class="field full">
        <label for="content">Conteúdo</label>
        <textarea id="content" name="content" rows="7" required>{{ old('content', $clinicalNote->content ?? '') }}</textarea>
    </div>
</div>

<div class="form-actions">
    <a class="link-btn ghost" href="{{ route('clinical-notes.index') }}">Cancelar</a>
    <button type="submit">Salvar</button>
</div>
