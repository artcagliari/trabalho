@extends('layouts.app')
@section('content')<div class='glass card'><h2>{{ $clinicalNote->title }}</h2><p>{{ $clinicalNote->content }}</p></div>@endsection
