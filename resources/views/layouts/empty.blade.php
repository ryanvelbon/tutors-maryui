@extends('layouts.base')

@section('body')

    @isset($slot)
        {{ $slot }}
    @endisset

    <x-toast />
@endsection
