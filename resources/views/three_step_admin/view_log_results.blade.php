@extends('layouts.master_three_step')

@section('title', 'View log - results')
@section('page_specific_jquery')
@endsection

@section('content')

<!-- resources/views/three_step_admin/view_log_results.blade.php -->
  
<div class="row">
<div class="col-sm-2"> <br><br><br></div>
<div class="col-sm-8"> 
   The log has the following results         
</div>
<div class="col-sm-2"> </div>
</div><!-- end row -->
 
@foreach ($data['arr_three_step_log'] as $row) 
<div class="row">
<div class="col-sm-1"> </div>
<div class="col-sm-1">{!!$row['id']!!}</div>
<div class="col-sm-2">{!!$row['ip_address']!!}</div>
<div class="col-sm-4">{!!$row['step']!!}</div>
<div class="col-sm-2">{!!$row['date']!!}</div>
<div class="col-sm-2">{!!$row['time']!!}</div>
<div class="col-sm-1"> </div>
</div><!-- end row -->
@endforeach
 
@endsection	