@section('title', "{$tutor->user->full_name} | Private Lessons" )

@extends('layouts.app')

@section('content')

<h1>{{ $tutor->user->title }} {{ $tutor->user->full_name }}</h1>
<p>{{ $tutor->user->locality->name }}</p>

@endsection