<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Psicóloga</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">
    <nav class="glass nav">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('patients.index') }}">Pacientes</a>
        <a href="{{ route('therapy-sessions.index') }}">Sessões</a>
        <a href="{{ route('clinical-notes.index') }}">Anotações</a>
    </nav>

    @if (session('success'))
        <div class="glass alert success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="glass alert error">
            <strong>Corrija os campos abaixo:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
