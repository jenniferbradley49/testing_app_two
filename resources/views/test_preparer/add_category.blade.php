<!-- Stored in resources/views/test/add_test.blade.php -->

@extends('layouts.master_test_preparer')

@section('title', 'Add category - test preparer')



@section('content')
     
<div class="row">
<div class="col-sm-3"> <br><br><br></div>
<div class="col-sm-6"> 
   Add category       
</div>  
<div class="col-sm-3"> </div>
</div><!-- end row -->  


<!-- resources/views/auth/register.blade.php -->

	{!! Form::open() !!}
    {!! csrf_field() !!}
<div class="row">
<div class="col-sm-2"><br><br><br> </div>
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
   {!! Form::label('category', 'Test category - this should represent a more general topic'); !!}            
    </div>
<div class="col-sm-7"> 
   {!! Form::text('category', Input::old('category')); !!}
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
     
      
     
<div class="row">
<div class="col-sm-3"> </div>
<div class="col-sm-6"> 
    {!! Form::submit('Add category'); !!}          
    </div>  
<div class="col-sm-3"> </div>
</div><!-- end row -->
    

	{!! Form::close() !!}
@endsection