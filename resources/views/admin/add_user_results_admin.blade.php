@extends('layouts.master_admin')

@section('title', 'Add user - admin')
@section('page_specific_jquery')
@endsection

@section('content')

<div class="row">
	<div class="col-sm-2"><br><br><br><br><br><br> </div>
	<div class="col-sm-8"> 
		The user was successfully inserted with the following info:
		<ul>
		@foreach ($data['arr_request'] as $key => $val)
			<li>{!!$key!!}<br><br>{!!$val!!}</li>
		@endforeach
		</ul>
    </div>
	<div class="col-sm-2"> </div>
</div><!-- end row -->
    
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
	{!! Html::link('/admin/add_role', 'Add role') !!}
    </div>
<div class="col-sm-5"> 
	{!! Html::link('/admin/home', 'Admin dashboard') !!}
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
@endsection




