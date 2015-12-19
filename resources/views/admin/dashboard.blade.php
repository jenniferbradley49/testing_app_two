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
   <a href="/admin/add_user">Add user</a>         
    </div>
<div class="col-sm-5"> 
   <a href='/admin/edit_user'>Edit user - admin</a>
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->

     
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/admin/add_role">Add role manually - admin</a>         
    </div>
<div class="col-sm-5"> 
   <a href='/admin/delete_role'>Delete role manually - admin</a>
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->

       
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/log/add_log_event">Add log event</a>         
    </div>
<div class="col-sm-5"> 
   <a href='/log/edit_log_event'>Edit log event</a>
</div>
<div class="col-sm-1"> </div>
</div><!-- end row -->
          
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/three_step_admin/view_log">View three step logs</a>         
    </div>
<div class="col-sm-5"> 
   <a href='/three_step_admin/configure'>Configure three step security</a>
</div>
<div class="col-sm-1"> </div>
</div><!-- end row -->
 
        
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/three_step_admin/change_password">Change three step security password</a>         
    </div>
<div class="col-sm-5"> 
   <a href='/three_step_admin/change_password_hint'>Change three step secuity password hint</a>
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