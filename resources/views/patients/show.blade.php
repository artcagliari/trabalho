@extends('layouts.app')
@section('content')<div class='glass card'><h2>{{ $patient->full_name }}</h2><p>{{ $patient->email }}</p><p>{{ $patient->main_complaint }}</p></div>@endsection
