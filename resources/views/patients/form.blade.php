<form method='POST' class='glass card js-validate' action='{{ $patient ? route('patients.update',$patient) : route('patients.store') }}'>@csrf @if($patient) @method('PUT') @endif
<input name='full_name' placeholder='Nome completo' value='{{ old('full_name',$patient->full_name ?? '') }}' required>
<input name='phone' placeholder='Telefone' value='{{ old('phone',$patient->phone ?? '') }}' required>
<input name='email' type='email' placeholder='E-mail' value='{{ old('email',$patient->email ?? '') }}' required>
<input name='birth_date' type='date' value='{{ old('birth_date',isset($patient)?optional($patient->birth_date)->format('Y-m-d'):'') }}' required>
<textarea name='main_complaint' placeholder='Queixa principal' required>{{ old('main_complaint',$patient->main_complaint ?? '') }}</textarea>
<select name='care_status' required><option value='ativo'>Ativo</option><option value='em pausa'>Em pausa</option><option value='encerrado'>Encerrado</option></select>
<button class='btn'>Salvar</button></form>
