<!-- Stored in resources/views/dashboard.blade.php -->

@extends('layouts.master_admin')

@section('title', 'Dashboard page - admin')

@section('sidebar')
    

  
@endsection

@section('content')
     
<div class="row">
<div class="col-sm-3"> <br><br><br></div>
<div class="col-sm-6"> 
   Administrator dashboard page        
    </div>

    
<div class="col-sm-3"> </div>
</div><!-- end row -->  
     
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/admin/add_user_admin">Add user</a>         
    </div>
<div class="col-sm-5"> 
   <a href='/admin/get_edit_user_admin'>Edit user - admin</a>
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->

     
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/admin/add_role_admin">Add role manually - admin</a>         
    </div>
<div class="col-sm-5"> 
   <a href='/admin/delete_role_admin'>Delete role manually - admin</a>
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->

     
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/auth/logout">Log out</a>         
    </div>
<div class="col-sm-5"> 
  <a href="/">Site start page</a>
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->


@endsection