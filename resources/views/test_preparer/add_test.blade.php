<!-- Stored in resources/views/dashboard.blade.php -->

@extends('layouts.master_test_provider_org')

@section('title', 'Dashboard page - test preparer')



@section('content')
     
<div class="row">
<div class="col-sm-3"> <br><br><br></div>
<div class="col-sm-6"> 
   Test preparer dashboard page        
    </div>

    
<div class="col-sm-3"> </div>
</div><!-- end row -->  
     
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/test_preparer/add_test">Add test</a>         
    </div>
<div class="col-sm-5"> 
   <a href='/test_preparer/edit_test'>Edit test</a>
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