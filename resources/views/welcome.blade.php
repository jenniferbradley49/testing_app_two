<!-- Stored in resources/views/welcome.blade.php -->

@extends('layouts.master_welcome')

@section('title', 'Page Title')
@section('page_specific_jquery')

@endsection

@section('sidebar')
    

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>This is my body content. and a change</p>
     <p><a href="/auth/login">Log in</a></p>
     <p><a href="/password/email">Forgot password</a></p>
     @endsection