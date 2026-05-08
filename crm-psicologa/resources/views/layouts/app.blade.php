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
    <header class="glass app-header">
        <div class="brand-row">
            <div>
                <h1 class="brand-title">CRM Psicóloga</h1>
                <p class="brand-subtitle">Gestão clínica com foco em rotina e cuidado</p>
            </div>
        </div>

        <nav class="nav">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}" href="{{ route('patients.index') }}">Pacientes</a>
            <a class="nav-link {{ request()->routeIs('therapy-sessions.*') ? 'active' : '' }}" href="{{ route('therapy-sessions.index') }}">Sessões</a>
            <a class="nav-link {{ request()->routeIs('clinical-notes.*') ? 'active' : '' }}" href="{{ route('clinical-notes.index') }}">Anotações</a>
            <a class="nav-link {{ request()->routeIs('agenda-entries.*') ? 'active' : '' }}" href="{{ route('agenda-entries.index') }}">Agenda</a>
        </nav>
    </header>

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

    <main class="page-stack">
        @yield('content')
    </main>
</div>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
