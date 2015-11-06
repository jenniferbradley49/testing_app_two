<!-- Stored in resources/views/dashboard.blade.php -->

@extends('layouts.master_welcome')

@section('title', 'Page Title')

@section('sidebar')
    

  
@endsection

@section('content')
    <p>this is the dashboard page</p>
    <p><a href="/admin/add_user_admin">Add user - admin</a></p>
    <p><a href="/auth/add_role">Add role</a></p>
    <p><a href="/auth/delete_role">Remove role</a></p>
    <p><a href="/auth/logout">Logout</a></p>
@endsection