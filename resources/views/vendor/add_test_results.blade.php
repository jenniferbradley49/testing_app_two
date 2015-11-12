@extends('layouts.master_test_preparer')

@section('title', 'Add test results')
@section('page_specific_jquery')
@endsection

@section('content')

<div class="row">
	<div class="col-sm-2"><br><br><br><br><br><br> </div>
	<div class="col-sm-8"> 
		The test {!!$data['arr_test_info']['title']!!} 
		 was successfully added.
		
		
    </div>
	<div class="col-sm-2"> </div>
</div><!-- end row -->
    
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/tests/add_question">Add a question</a>         
</div>
<div class="col-sm-5"> 
   <a href='/test_preparer/home'>Return to test preparer dashboard</a>
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
   
    
     
@endsection	