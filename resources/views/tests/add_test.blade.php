<!-- Stored in resources/views/test/add_test.blade.php -->

@extends('layouts.master_test_provider_org')

@section('title', 'Dashboard page - test preparer')

@section('page_specific_jquery')

<script>
$(document).ready(function(){
	
	$("#category_id").change(function(){

        var category_id = $("#category_id").val();

		propagate_csrf_code();
        jQuery.ajax({
            url: "test_preparer/ajax/get_sub_categories",
            type: "POST",
            data: {   
                "category_id":category_id,
            },
            dataType : "json",
            beforeSend: function () {
            },               
            success: function( data ) {
				$("#sub_category_id").empty();
				$("#sub_category_id").append(new Option("Please choose a sub category", "0"));
				$.each(data.arr_roles_available, function(index, item) {
					$("#sub_category_id").append(new Option(item.name, item.id));
		        });
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
<div class="col-sm-3"> <br><br><br></div>
<div class="col-sm-6"> 
   Add test       
</div>  
<div class="col-sm-3"> </div>
</div><!-- end row -->  


<!-- resources/views/auth/register.blade.php -->

	{!! Form::open() !!}
    {!! csrf_field() !!}
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
   {!! Form::label('category', 'Test category'); !!}            
    </div>
<div class="col-sm-7"> 
   
<select name="category_id" id="category_id">
@foreach($data['arr_categories_processed'] as $key => $category)
<option value="{{ $key }}" {{ (Input::old('category_id', 0) == $key ? ' selected="selected"' : '') }}>{{ $category }}</option>
@endforeach
</select>
   
   
   </div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
     
 
<div class="row">
<div class="col-sm-1"> <br><br><br></div>
<div class="col-sm-3"> 
   {!! Form::label('sub_category', 'Test sub category'); !!}            
    </div>
<div class="col-sm-7"> 
   {!! Form::text('sub_category', Input::old('sub_category')); !!}
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
     
     
<div class="row">
<div class="col-sm-3"> </div>
<div class="col-sm-6"> 
    {!! Form::submit('Register'); !!}          
    </div>  
<div class="col-sm-3"> </div>
</div><!-- end row -->
    

	{!! Form::close() !!}
@endsection