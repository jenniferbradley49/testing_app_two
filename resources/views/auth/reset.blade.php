<!-- resources/views/auth/reset.blade.php -->
@extends('layouts.master_welcome')

@section('title', 'Login page')
@section('page_specific_jquery')
@endsection

@section('content')
<form method="POST" action="/password/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password">
    </div>

    <div>
        Confirm Password
        <input type="password" name="password_confirmation">
    </div>

    
    <div>
        <button type="submit">
            Reset Password
        </button>
    </div>
</form>

@endsection	