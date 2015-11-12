<!-- Stored in resources/views/test/add_test.blade.php -->

@extends('layouts.master_test_preparer')

@section('title', 'Add sub category - test preparer')



@section('content')
     
<div class="row">
<div class="col-sm-3"> <br><br><br></div>
<div class="col-sm-6"> 
   Add sub category       
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
<div class="col-sm-3"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('category_id', 'Please choose a category'); !!}            
    </div>
<div class="col-sm-4">
<select name="category_id" id="category_id">
@foreach($data['arr_categories_processed'] as $key => $category)
<option value="{{ $key }}" {{ (Input::old('category_id', 0) == $key ? ' selected="selected"' : '') }}>{{ $category }}</option>
@endforeach
</select>
   
</div>
    <div class="col-sm-2"><div id="status"></div> </div>
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('sub_category', 'Test sub category - this should represent a more specific topic'); !!}            
    </div>
<div class="col-sm-7"> 
   {!! Form::text('sub_category', Input::old('sub_category')); !!}
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
     
      
     
<div class="row">
<div class="col-sm-3"> </div>
<div class="col-sm-6"> 
    {!! Form::submit('Add sub category'); !!}          
    </div>  
<div class="col-sm-3"> </div>
</div><!-- end row -->
    

	{!! Form::close() !!}
@endsection