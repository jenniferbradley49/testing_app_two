@extends('layouts.master_admin')

@section('title', 'Add role results - failure - admin')
@section('page_specific_jquery')
@endsection 

@section('content')

<div class="row">
	<div class="col-sm-2"><br><br><br><br><br><br> </div>
	<div class="col-sm-8"> 
		The user {!!$data['arr_request']['first_name']!!} 
		{!!$data['arr_request']['last_name']!!} was not 
		associated with the role {!!$data['arr_request']['role']!!} 
		because this role - user combination already exists.
    </div>
	<div class="col-sm-2"> </div>
</div><!-- end row -->
    
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/admin/add_role/">Add another role for this user</a>         
    </div>
<div class="col-sm-5"> 
   <a href='/admin/home'>Return to admin dashboard</a>
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
   
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/admin/delete_role/">Remove a role for this user</a>         
    </div>
<div class="col-sm-5"> 
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
     
@endsection	