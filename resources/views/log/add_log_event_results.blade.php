@extends('layouts.master_admin')

@section('title', 'Add user - admin')
@section('page_specific_jquery')
@endsection

@section('content')

<div class="row">
	<div class="col-sm-2"><br><br><br><br><br><br> </div>
	<div class="col-sm-8"> 
		The log event was successfully added with the following info:
		<br>
		The log event name is {{ $data['arr_request']['name'] }}
		
    </div>
	<div class="col-sm-2"> </div>
</div><!-- end row -->
    
 
<div class="row">
	<div class="col-sm-2"><br><br><br><br><br><br> </div>

<div class="row">
	<div class="col-sm-2"><br>&nbsp; </div>
	<div class="col-sm-8"> 
	The log event ID is	{{$data['log_event_id'] }}
    </div>
	<div class="col-sm-2"> </div>
</div><!-- end row -->
    
	<div class="col-sm-2"> </div>
</div><!-- end row -->
    
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-5"> 
    </div>
<div class="col-sm-5"> 
	{!! Html::link('/admin/home', 'Admin dashboard') !!}
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
@endsection





