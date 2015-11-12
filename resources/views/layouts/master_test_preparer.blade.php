<html>
    <head>
        <title>App Name - @yield('title')</title>
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>        @yield('page_specific_jquery')
    </head>
    <body>
 
            

        <div class="container-fluid">
 
<div class="row">
<div class="col-sm-2"> <br><br><br></div>
<div class="col-sm-4"> 
         Logged in as 
         {{ $data['arr_logged_in_user']['email'] }} &nbsp
         {{ $data['arr_logged_in_user']['last_name'] }},
         {{ $data['arr_logged_in_user']['first_name'] }}
         </div>
 <div class="col-sm-1">
<div class="text-center"> 
<a href="/auth/logout">Log out</a>
</div>
</div>         
<div class="col-sm-2">
<div class="text-right"> 
   <a href='/'>Return to site start</a>
</div>
</div>	
 
<div class="col-sm-2">

 <div class="text-right"><a href='/test_preparer/home'>Return to test preparer dashboard</a>
	</div>
</div>
    
<div class="col-sm-1"> </div>
</div><!-- end row -->
   
        @yield('content')
        </div>
    </body>
</html>