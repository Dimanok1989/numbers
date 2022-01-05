@extends('app')

@section('title', $title ?? null)

@section('header')
    @yield('header')
@endsection

@section('content')
    @yield('content')
@endsection
