@extends('layouts.master_admin')

@section('title', 'Edit user results - admin')
@section('page_specific_jquery')
@endsection

@section('content')

<div class="row">
	<div class="col-sm-2"><br><br><br><br><br><br> </div>
	<div class="col-sm-8"> 
		The user was successfully updated with the following info:
		<ul>
		@foreach ($data['arr_user_info'] as $key => $val)
			<li>{!!$key!!}&nbsp;&nbsp;{!!$val!!}</li>
		@endforeach
		</ul>
    </div>
	<div class="col-sm-2"> </div>
</div><!-- end row -->
    
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
   <a href="/admin/add_role/{{$data['user_id']}}">Add role for this user</a>         
    </div>
<div class="col-sm-5"> 
   <a href='/admin/home'>Return to admin dashboard</a>
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
@endsection	