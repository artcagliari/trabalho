@csrf

<div class="form-grid">
    <div class="field full">
        <label for="patient_id">Paciente (opcional)</label>
        <select name="patient_id" id="patient_id">
            <option value="">Sem vínculo</option>
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}" @selected(old('patient_id', $agendaEntry->patient_id ?? '') == $patient->id)>
                    {{ $patient->full_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label for="consultation_date">Data da consulta</label>
        <input type="date" name="consultation_date" id="consultation_date" required value="{{ old('consultation_date', isset($agendaEntry) ? $agendaEntry->consultation_date->format('Y-m-d') : '') }}">
    </div>

    <div class="field">
        <label for="consultation_time">Horário (opcional)</label>
        <input type="time" name="consultation_time" id="consultation_time" value="{{ old('consultation_time', $agendaEntry->consultation_time ?? '') }}">
    </div>

    <div class="field full">
        <label for="title">Título</label>
        <input type="text" name="title" id="title" required maxlength="255" value="{{ old('title', $agendaEntry->title ?? '') }}">
    </div>

    <div class="field full">
        <label for="notes">Observações</label>
        <textarea name="notes" id="notes" rows="5" maxlength="3000">{{ old('notes', $agendaEntry->notes ?? '') }}</textarea>
    </div>
</div>

<div class="form-actions">
    <a class="link-btn ghost" href="{{ route('agenda-entries.index') }}">Cancelar</a>
    <button type="submit">Salvar</button>
</div>
