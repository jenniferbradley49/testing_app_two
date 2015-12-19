@extends('layouts.master_admin')

@section('title', 'Change password - three step admin')
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
Three step security - change first level password
    </div>
<div class="col-sm-2"> </div>
</div><!-- end row -->
  
	{!! Form::open() !!}
<div class="row">
<div class="col-sm-2"><br><br> </div>
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
    
 @if(isset($data['message']))
 <div class="row">
<div class="col-sm-2"><br><br> </div>
<div class="col-sm-8"> 
{{ $data['message'] }} here is where lessage would be   </div>
<div class="col-sm-2"> </div>
</div><!-- end row -->
 
 @endif 
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('curr_password', 'Current password'); !!}            
    </div>
<div class="col-sm-7"> 
   {!! Form::password('curr_password'); !!}
</div>   
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('password', 'New password'); !!}            
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
<div class="col-sm-6 text-center"> 
    {!! Form::submit('Change three step first level password'); !!}          
    </div>  
<div class="col-sm-3"> </div>
</div><!-- end row -->
    

	{!! Form::close() !!}
@endsection	