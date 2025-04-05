@extends('layouts.app')

@section('title') Home @endsection

@section('content')
    @if(Auth::check())
        @include('pages._dashboard')
    @else
        @include('pages._logged_out')
    @endif
@endsection

<<<<<<< HEAD

@section('sidebar')
    @include('widgets._current_weather')
@endsection
=======
@section('sidebar')
    @include('pages._sidebar')
    @include('widgets._current_weather')
@endsection
>>>>>>> dee57d268a043afea026af883429bf0b18d090f8

@section('sidebar')
    @include('pages._sidebar')
@endsection
