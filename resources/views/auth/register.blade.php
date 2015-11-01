@extends('layouts.master_welcome')

@section('title', 'Page Title')
@section('page_specific_jquery')
@endsection

@section('content')

<!-- resources/views/auth/register.blade.php -->

<!-- ><form method="POST" action="/auth/login">
-->
	{!! Form::open() !!}
    {!! csrf_field() !!}
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
   {!! Form::label('first_name', 'First name'); !!}            
    </div>
<div class="col-sm-7"> 
   {!! Form::text('first_name', Input::old('first_name')); !!}
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
     
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('last_name', 'Last name'); !!}            
    </div>
<div class="col-sm-7"> 
   {!! Form::text('last_name', Input::old('last_name')); !!}
</div>
    
<div class="col-sm-1"> </div>
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
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('password', 'Password'); !!}           
    </div>
<div class="col-sm-7"> 
   {!! Form::password('password'); !!}
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
   
   
  
   
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('password_confirmation', 'Confirm password'); !!}           
    </div>
<div class="col-sm-7"> 
   {!! Form::password('password_confirmation'); !!}
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->


    
<div class="row">
<div class="col-sm-3"> </div>
<div class="col-sm-6"> 
    {!! Form::submit('Register'); !!}          
    </div>  
<div class="col-sm-3"> </div>
</div><!-- end row -->
    

	{!! Form::close() !!}
@endsection	