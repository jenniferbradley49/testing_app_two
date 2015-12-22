@extends('layouts.master_admin')

@section('title', 'Configure three step security options')
@section('page_specific_jquery')

<script>
$(document).ready(function(){

	arrange_password_inputs();
	arrange_email_input();

	$("#include_password").change(function(){
		arrange_password_inputs();
	});

	$("#include_email").change(function(){
		arrange_email_input();
	});
	

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
            url: "/ajax/get_user_info_admin",
            type: "POST",
            data: {   
                "user_id":user_id,
            },
            dataType : "json",
            beforeSend: function () {
            },               
            success: function( data ) {
             	$("#first_name").val(data.first_name);
             	$("#last_name").val(data.last_name);
             	$("#email").val(data.email);
			},
            error: function( xhr, status, errorThrown ) {
                console.log("Ajax error");
            }
        });  // end jquery ajax
    }); // end on dropdown change


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
<div class="col-sm-6 text-center"> 
Configure three step security options
    </div>
<div class="col-sm-3"> </div>
</div><!-- end row -->

	{!! Form::open() !!}
  
<div class="row">
<div class="col-sm-2"><br><br><br> </div>
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
   {!! Form::label('ts_implement', 'Implement / enforce three step security'); !!}            
    </div>
<div class="col-sm-5">
<select name="ts_implement" id="ts_implement">
@foreach($data['arrConfigDropDownOptions']['arrTSImplementOpts'] as $key => $option)
<option value="{{ $key }}" 
{{ (Input::old('ts_implement', $data['arrConfigInfo']['ts_implement']) == $key ? ' selected="selected"' : '') }}>{{ $option }}</option>
@endforeach
</select>
</div>
    <div class="col-sm-2"><span id="status"></span></span> </div>
<div class="col-sm-1"> </div>
</div><!-- end row -->
  
       
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('ts_bypass', 'Bypass three step security - clicking submit on the first steo will result in successful completion of this security'); !!}            
    </div>
<div class="col-sm-5">
<select name="ts_bypass" id="ts_bypass">
@foreach($data['arrConfigDropDownOptions']['arrTSBypassOpts'] as $key => $option)
<option value="{{ $key }}" 
{{ (Input::old('ts_bypass', $data['arrConfigInfo']['ts_bypass']) == $key ? ' selected="selected"' : '') }}>{{ $option }}</option>
@endforeach
</select>
</div>
    <div class="col-sm-2"><span id="status"></span></span> </div>
<div class="col-sm-1"> </div>
</div><!-- end row -->
  
      
      
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('permitDelay', 'Delay in minutes that is permitted without activity befroe three step login is required'); !!}            
    </div>
<div class="col-sm-5">
<select name="permit_delay" id="permit_delay">
@foreach($data['arrConfigDropDownOptions']['arrPermitDelayOpts'] as $key => $option)
<option value="{{ $key }}" 
{{ (Input::old('permit_dalay', $data['arrConfigInfo']['permit_delay']) == $key ? ' selected="selected"' : '') }}>{{ $option }}</option>
@endforeach
</select>
</div>
    <div class="col-sm-2"><span id="status"></span></span> </div>
<div class="col-sm-1"> </div>
</div><!-- end row -->
  
      

    
<div class="row">
<div class="col-sm-3"> <br><br><br></div>
<div class="col-sm-6"> 
    {!! Form::submit('Configure options'); !!}          
    </div>  
<div class="col-sm-3"> </div>
</div><!-- end row -->
    

	{!! Form::close() !!}
@endsection	