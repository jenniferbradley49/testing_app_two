@extends('layouts.master_admin')

@section('title', 'Delete role results - admin')
@section('page_specific_jquery')
@endsection

@section('content')

<div class="row">
	<div class="col-sm-2"><br><br><br><br><br><br> </div>
	<div class="col-sm-8"> 
		The role {!!$data['arr_request']['role']!!} was successfully 
		removed from the user {!!$data['arr_request']['first_name']!!} 
		{!!$data['arr_request']['last_name']!!} 
		
    </div>
	<div class="col-sm-2"> </div>
</div><!-- end row -->
    
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/admin/add_role">Add another role for this user</a>         
    </div>
<div class="col-sm-5"> 
   <a href='/admin/home'>Return to admin dashboard</a>
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
   
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/admin/delete_role">Remove a role for this user</a>         
    </div>
<div class="col-sm-5"> 
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
     
@endsection	