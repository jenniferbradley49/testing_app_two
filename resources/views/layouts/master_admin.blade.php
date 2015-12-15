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
<div class="col-sm-5"> 
        &nbsp; Logged in as 
         {{ $data['arr_logged_in_user']['email'] }} &nbsp
         {{ $data['arr_logged_in_user']['last_name'] }},
         {{ $data['arr_logged_in_user']['first_name'] }}
         </div>
 <div class="col-sm-2">
<a href="/three_step/logout">three step log out</a>
</div>         
         <div class="col-sm-1">
<a href="/auth/logout">Log out</a>
</div>         
         <div class="col-sm-2">
<div class="text-right"> 
   <a href='/'>site start</a>
</div>
</div>	
 
<div class="col-sm-2">

 <a href='/admin/home'>admin dashboard</a>
&nbsp;	
</div>
    

</div><!-- end row -->
   
        @yield('content')
        </div>
    </body>
</html>