@csrf

<div class="form-grid">
    <div class="field full">
        <label for="patient_id">Paciente</label>
        <select id="patient_id" name="patient_id" required>
            @foreach($patients as $patient)
                <option value="{{ $patient->id }}" @selected(old('patient_id', $therapySession->patient_id ?? '') == $patient->id)>{{ $patient->full_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label for="session_date">Data</label>
        <input id="session_date" type="date" name="session_date" required value="{{ old('session_date', isset($therapySession) ? optional($therapySession->session_date)->format('Y-m-d') : '') }}">
    </div>

    <div class="field">
        <label for="session_time">Horário</label>
        <input id="session_time" type="time" name="session_time" required value="{{ old('session_time', $therapySession->session_time ?? '') }}">
    </div>

    <div class="field">
        <label for="attendance_type">Tipo de atendimento</label>
        <select id="attendance_type" name="attendance_type" required>
            <option value="online" @selected(old('attendance_type', $therapySession->attendance_type ?? 'online') === 'online')>Online</option>
            <option value="presencial" @selected(old('attendance_type', $therapySession->attendance_type ?? '') === 'presencial')>Presencial</option>
        </select>
    </div>

    <div class="field">
        <label for="session_status">Status da sessão</label>
        <select id="session_status" name="session_status" required>
            <option value="marcada" @selected(old('session_status', $therapySession->session_status ?? 'marcada') === 'marcada')>Marcada</option>
            <option value="realizada" @selected(old('session_status', $therapySession->session_status ?? '') === 'realizada')>Realizada</option>
            <option value="cancelada" @selected(old('session_status', $therapySession->session_status ?? '') === 'cancelada')>Cancelada</option>
        </select>
    </div>

    <div class="field full">
        <label for="notes">Observações</label>
        <textarea id="notes" name="notes" rows="5">{{ old('notes', $therapySession->notes ?? '') }}</textarea>
    </div>
</div>

<div class="form-actions">
    <a class="link-btn ghost" href="{{ route('therapy-sessions.index') }}">Cancelar</a>
    <button type="submit">Salvar</button>
</div>
