@extends('layouts.master_admin')

@section('title', 'Edit email - three step admin')
@section('page_specific_jquery')
@endsection

@section('content')

<!-- resources/views/auth/register.blade.php -->

<!-- ><form method="POST" action="/auth/login">
-->
<div class="row">
<div class="col-sm-2"><br><br><br></div>
<div class="col-sm-8 text-center"> 
<br>
Three step security - edit email
    </div>
<div class="col-sm-2"> </div>
</div><!-- end row -->
    
   
<div class="row">
<div class="col-sm-2"><br><br><br></div>
<div class="col-sm-8 text-center"> 
<br>
&nbsp;
    </div>
<div class="col-sm-2"> </div>
</div><!-- end row -->
 
	{!! Form::open() !!}
<div class="row">
<div class="col-sm-2"><br> </div>
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
<div class="col-sm-1"> <br><br><br><br><br>?</div>
<div class="col-sm-3"> 
   {!! Form::label('email', 'Update email address to which three step verification is sent') !!}            
    </div>
<div class="col-sm-7"> 
   {!! Form::text('email', Input::old('email', $data['email'])) !!}
</div>   
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
 

    
<div class="row">
<div class="col-sm-3"> </div>
<div class="col-sm-6 text-center"> 
    {!! Form::submit('Update email'); !!}          
    </div>  
<div class="col-sm-3"> </div>
</div><!-- end row -->
    

	{!! Form::close() !!}
@endsection	