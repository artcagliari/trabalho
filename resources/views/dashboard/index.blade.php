@extends('layouts.app')
@section('content')
<h1>Dashboard CRM</h1><div class='grid'>
<div class='glass card'>Total pacientes: {{ $totalPatients }}</div><div class='glass card'>Pacientes ativos: {{ $totalActivePatients }}</div><div class='glass card'>Sessões marcadas: {{ $totalScheduledSessions }}</div><div class='glass card'>Sessões realizadas: {{ $totalCompletedSessions }}</div></div>
<div class='grid2'><div class='glass card'><h3>Próximas sessões</h3>@foreach($upcomingSessions as $s)<p>{{ $s->session_date->format('d/m/Y') }} {{ $s->session_time }} - {{ $s->patient->full_name }}</p>@endforeach</div>
<div class='glass card'><h3>Últimos pacientes</h3>@foreach($latestPatients as $p)<p>{{ $p->full_name }}</p>@endforeach</div></div>
@endsection
