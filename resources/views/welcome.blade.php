<!-- Stored in resources/views/welcome.blade.php -->

@extends('layouts.master_welcome')

@section('title', 'index page')
@section('page_specific_jquery')

@endsection

@section('sidebar')
    

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<br><br>
     <p><a href="/admin/home">Admin log in</a></p>
     <br><br>
     <p><a href="/password/email">Forgot password</a></p>
     @endsection