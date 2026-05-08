@csrf

<div class="form-grid">
    <div class="field full">
        <label for="full_name">Nome completo</label>
        <input id="full_name" name="full_name" required value="{{ old('full_name', $patient->full_name ?? '') }}">
    </div>

    <div class="field">
        <label for="phone">Telefone</label>
        <input id="phone" name="phone" required value="{{ old('phone', $patient->phone ?? '') }}">
    </div>

    <div class="field">
        <label for="email">E-mail</label>
        <input id="email" name="email" type="email" required value="{{ old('email', $patient->email ?? '') }}">
    </div>

    <div class="field">
        <label for="birth_date">Data de nascimento</label>
        <input id="birth_date" name="birth_date" type="date" required value="{{ old('birth_date', isset($patient) ? optional($patient->birth_date)->format('Y-m-d') : '') }}">
    </div>

    <div class="field">
        <label for="care_status">Status do cuidado</label>
        <select id="care_status" name="care_status" required>
            <option value="ativo" @selected(old('care_status', $patient->care_status ?? 'ativo') === 'ativo')>Ativo</option>
            <option value="em pausa" @selected(old('care_status', $patient->care_status ?? '') === 'em pausa')>Em pausa</option>
            <option value="encerrado" @selected(old('care_status', $patient->care_status ?? '') === 'encerrado')>Encerrado</option>
        </select>
    </div>

    <div class="field full">
        <label for="main_complaint">Queixa principal</label>
        <textarea id="main_complaint" name="main_complaint" rows="5" required>{{ old('main_complaint', $patient->main_complaint ?? '') }}</textarea>
    </div>
</div>

<div class="form-actions">
    <a class="link-btn ghost" href="{{ route('patients.index') }}">Cancelar</a>
    <button type="submit">Salvar</button>
</div>
