@extends('layouts.app')
@section('content')<div class='glass card'><h2>{{ $therapySession->patient->full_name }}</h2><p>{{ $therapySession->notes }}</p></div>@endsection
