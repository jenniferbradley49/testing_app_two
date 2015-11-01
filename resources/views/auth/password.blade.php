@extends('layouts.master_welcome')

@section('title', 'Send password reset')
@section('page_specific_jquery')
@endsection

@section('content')
<!-- resources/views/auth/password.blade.php -->
{!! Form::open() !!}
<!--  <form method="POST" action="/password/email">
-->    {!! csrf_field() !!}
<div class="row">
<div class="col-sm-2"><br><br><br><br><br><br> </div>
<div class="col-sm-8"> 
@if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    </div>
<div class="col-sm-2"> </div>
</div><!-- end row -->

<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('email', 'Email'); !!}            
    </div>
<div class="col-sm-7"> 
   {!! Form::email('email', Input::old('email')); !!}
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->

<div class="row">
<div class="col-sm-3"> </div>
<div class="col-sm-6"> 
    {!! Form::submit('Send Password Reset Link'); !!}          
    </div>  
<div class="col-sm-3"> </div>
</div><!-- end row -->
    
{!! Form::close() !!}
@endsection