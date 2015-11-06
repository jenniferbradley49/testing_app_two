@extends('layouts.master_admin')

@section('title', 'Delete role - admin')
@section('page_specific_jquery')

<script>
$(document).ready(function(){

	$("#order_by_email").click(function(){
		resort_users(0);
	});
	

	$("#order_by_lname").click(function(){
		resort_users(1);
	});
	
	$("#user_id").change(function(){

        var user_id = $("#user_id").val();

		propagate_csrf_code();
        jQuery.ajax({
            url: "/ajax/get_role_info_admin",
            type: "POST",
            data: {   
                "user_id":user_id,
            },
            dataType : "json",
            beforeSend: function () {
            },               
            success: function( data ) {
 // populate roles available
//				$("#role_id").empty();
//				$("#role_id").append(new Option("Please choose a role", "0"));
//				$.each(data.arr_roles_available, function(index, item) {
//					$("#role_id").append(new Option(item.name, item.id));
//		        });
// populate roles already possessed		        
				$("#role_id").empty();
				$("#role_id").append(new Option("Please choose a role", "0"));
				$.each(data.arr_roles_possessed, function(index, item) {
					$("#role_id").append(new Option(item.name, item.id));
		        });
				

//				$("#roles_possessed").append("<ul>");
//				$.each(data.arr_roles_possessed, function(index, item) {
//					$("#roles_possessed").append("<li>"+item.name+"</li>");					
//		        });
//				$("#roles_possessed").append("</ul>");
			},
            error: function( xhr, status, errorThrown ) {
                console.log("Ajax error");
            }
        });  // end jquery ajax
    }); // end on dropdown change

    

    function resort_users(bool_order_by_lname)
    {
		propagate_csrf_code();
        jQuery.ajax({
            url: "/ajax/resort_users_admin",
            type: "POST",
            data: {   
                "bool_order_by_lname":bool_order_by_lname,
            },
            dataType : "json",
            beforeSend: function () {
            },               
            success: function( data ) {
				$("#user_id").empty();
				$.each(data, function(index, item) {
		        	$("#user_id").append(new Option(item.content, item.id));
		        });
			},
            error: function( xhr, status, errorThrown ) {
                console.log("Ajax error");
            }
        });  // end jquery ajax
        
    }  // end function resort users

    function propagate_csrf_code()
    {
        var csrf_token = $("input[name=_token]").val();

// laravel imposes csrf protection - the ajax setup 
// sends the csrf token in the header to remove the 
// 500 internal service error 
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': csrf_token
			}
		});
    }     // end function propagate_csrf_code  
});
</script>
@endsection

@section('content')

<div class="row">
<div class="col-sm-3"><br><br><br><br><br><br> </div>
<div class="col-sm-6"> 
Delete role - admin
    </div>
<div class="col-sm-3"> </div>
</div><!-- end row -->

	{!! Form::open() !!}
  
<div class="row">
<div class="col-sm-2"><br><br><br><br><br><br> </div>
<div class="col-sm-8"> 
@if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    </div>
<div class="col-sm-2"> </div>
</div><!-- end row -->
    
     
<div class="row">
<div class="col-sm-3"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('user_id', 'Please choose a user'); !!}            
    </div>
<div class="col-sm-4">
<select name="user_id" id="user_id">
@foreach($data['arr_users'] as $key => $user_info)
<option value="{{ $key }}" {{ (Input::old('user_id', 0) == $key ? ' selected="selected"' : '') }}>{{ $user_info }}</option>
@endforeach
</select>
   
</div>
    <div class="col-sm-2"><div id="status"></div> </div>
<div class="col-sm-1"> </div>
</div><!-- end row -->
  
      
<div class="row">
<div class="col-sm-5"> <br><br><br></div>
<div class="col-sm-2"> 
	<div class="text-right"> 
		<input type='button' value="Order by email" id="order_by_email">           
	</div>
</div>
<div class="col-sm-2"> 
   <input type='button' value="Order by last name" id="order_by_lname">           
</div>
    
<div class="col-sm-3"> </div>
</div><!-- end row -->
    
     
<div class="row">
<div class="col-sm-3"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('role_id', 'Please choose a role to add'); !!}            
    </div>
<div class="col-sm-4">
<select name="role_id" id="role_id">

</select>
   
</div>
    <div class="col-sm-2"><span id="status"></span></div>
<div class="col-sm-2"> </div>
</div><!-- end row -->

    
<div class="row">
<div class="col-sm-4"> <br><br><br></div>
<div class="col-sm-4"> 
	<div class="text-center"> 
    {!! Form::submit('Delete role for this user'); !!}
    </div>          
</div>  
<div class="col-sm-4"> </div>
</div><!-- end row -->
    

	{!! Form::close() !!}
@endsection	