@extends('layouts.master_admin')

@section('title', 'Delete role results - admin')
@section('page_specific_jquery')
@endsection

@section('content')

<div class="row">
	<div class="col-sm-2"><br><br><br><br><br><br> </div>
	<div class="col-sm-8"> 
		The role {!!$data['arr_user_role_info']['role']!!} was successfully 
		removed from the user {!!$data['arr_user_role_info']['first_name']!!} 
		{!!$data['arr_user_role_info']['last_name']!!} 
		
    </div>
	<div class="col-sm-2"> </div>
</div><!-- end row -->
    
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/admin/add_role_admin/">Add another role for this user</a>         
    </div>
<div class="col-sm-5"> 
   <a href='/admin/home'>Return to admin dashboard</a>
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