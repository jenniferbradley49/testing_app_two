@extends('layouts.master_admin')

@section('title', 'Edit log event')
@section('page_specific_jquery')

<script>
$(document).ready(function(){

//	arrange_password_inputs();
//	arrange_email_input();

//	$("#include_password").change(function(){
//		arrange_password_inputs();
//	});

//	$("#include_email").change(function(){
//		arrange_email_input();
//	});
	

	$("#order_by_email").click(function(){
		resort_users(0);
	});
	

	$("#order_by_lname").click(function(){
		resort_users(1);
	});
	
	$("#log_event_id").change(function(){
console.log('log_event_id changed');
        var log_event_id = $("#log_event_id").val();

		propagate_csrf_code();
        jQuery.ajax({
            url: "/ajax/get_log_event",
            type: "POST",
            data: {   
                "log_event_id":log_event_id,
            },
            dataType : "json",
            beforeSend: function () {
                console.log('ajax sent');
            },               
            success: function( data ) {
             	$("#name").val(data.name);
 //            	$("#last_name").val(data.last_name);
 //            	$("#email").val(data.email);
			},
            error: function( xhr, status, errorThrown ) {
                console.log("Ajax error");
            }
        });  // end jquery ajax
    }); // end on dropdown change

/*
    function arrange_password_inputs()
    {        
    	if ($("#include_password").prop('checked'))
    	{        	
    		$("#password").prop('disabled', false);
    		$("#password_confirmation").prop('disabled', false);
    		$("#password_block").show(1500);
    	}
    	else
    	{		
    		$("#password").prop('disabled', true);
    		$("#password_confirmation").prop('disabled', true);
    		$("#password_block").hide(1500);
		}		
    }  // end function arrange password inputs       


    function arrange_email_input()
    {        
    	if ($("#include_email").prop('checked'))
    	{        	
    		$("#email").prop('disabled', false);
    		$("#email_block").show(1500);
    	}
    	else
    	{		
    		$("#email").prop('disabled', true);
    		$("#email_block").hide(1500);
		}		
    }  // end function arrange email input       
*/    

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
Edit log event
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
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('log_event_id', 'Please choose an event'); !!}            
    </div>
<div class="col-sm-5">
<select name="log_event_id" id="log_event_id">
@foreach($data['arr_log_events'] as $log_event)
<option value="{{ $log_event['id'] }}" {{ (Input::old('log_event_id', 0) == $log_event['id'] ? ' selected="selected"' : '') }}>Log event ID {{ $log_event['id'] }} - {{ $log_event['name'] }}</option>
@endforeach
</select>
   
</div>
    <div class="col-sm-2"><span id="status"></span></span> </div>
<div class="col-sm-1"> </div>
</div><!-- end row -->
  
      
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   <input type='button' value="Order by email" id="order_by_email">           
    </div>
<div class="col-sm-7"> 
   <input type='button' value="Order by last name" id="order_by_lname">           
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
    
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('name', 'name'); !!}            
    </div>
<div class="col-sm-7"> 
   {!! Form::text('name', Input::old('name')); !!}
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->


   
<div class="row">
<div class="col-sm-3"> <br><br><br></div>
<div class="col-sm-6"> 
    {!! Form::submit('Edit this event'); !!}          
    </div>  
<div class="col-sm-3"> </div>
</div><!-- end row -->
    

	{!! Form::close() !!}
@endsection	