@extends('layouts.master_test_preparer')

@section('title', 'Add category results')
@section('page_specific_jquery')
@endsection

@section('content')

<div class="row">
	<div class="col-sm-2"><br><br><br><br><br><br> </div>
	<div class="col-sm-8"> 
		The category {!!$data['arr_category_info']['category']!!} 
		 was successfully added.
		
		
    </div>
	<div class="col-sm-2"> </div>
</div><!-- end row -->
    
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/test_preparer/add_category">Add another category</a>         
<br>
   <a href="/test_preparer/add_sub_category">Add a sub category</a>         
</div>
<div class="col-sm-5"> 
   <a href='/test_preparer/home'>Return to test preparer dashboard</a>
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
   
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/admin/delete_role_admin/">Remove a role for this user</a>         
    </div>
<div class="col-sm-5"> 
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
     
@endsection	