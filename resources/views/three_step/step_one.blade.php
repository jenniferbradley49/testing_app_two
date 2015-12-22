@extends('layouts.master_three_step')

@section('title', 'Step one')
@section('page_specific_jquery')
@endsection

@section('content')

<!-- resources/views/auth/register.blade.php -->

<!-- ><form method="POST" action="/three_step/step_one">
-->
	{!! Form::open() !!}
    {!! csrf_field() !!}
@if ($data['ts_bypass'])
<div class="row">
<div class="col-sm-2"><br><br><br><br><br><br> </div>
<div class="col-sm-8"> 
{{ $data['bypass_warning'] }}
    </div>
<div class="col-sm-2"> </div>
</div><!-- end row -->
@endif	
	
@if (count($errors) > 0)
    

<div class="row">
<div class="col-sm-2"><br><br><br><br><br><br> </div>
<div class="col-sm-8"> 
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
<div class="col-sm-2"> </div>
</div><!-- end row -->
@endif

  
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   Password hint            
    </div>
<div class="col-sm-7"> 
   {!! $data['hint'] !!}
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('password', 'First password'); !!}            
    </div>
<div class="col-sm-7"> 
   {!! Form::password('password'); !!}
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
   
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-10"> 
The confidence message below is to increase your confidence 
that you are the sender when you view the communication generated.  
This input should be filled with information that is personal to you, 
and related to today, but not available to others - 
something you had for breakfast, someone with whom 
you spoke today.  Security does not depend on the content of this message
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
      
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('confidence_msg', 'Confidence message'); !!}            
    </div>
<div class="col-sm-7"> 
   {!! Form::text('confidence_msg', Input::old('confidence_msg')); !!}
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
   
<div class="row">
<div class="col-sm-3"> </div>
<div class="col-sm-6"> 
    {!! Form::submit('Continue to next step'); !!}          
    </div>  
<div class="col-sm-3"> </div>
</div><!-- end row -->
    

	{!! Form::close() !!}
@endsection	