@extends('layouts.master_three_step')

@section('title', 'Step two - failure')
@section('page_specific_jquery')
@endsection

@section('content')

<!-- resources/views/three_step/step_one_fail.blade.php -->
  
<div class="row">
<div class="col-sm-2"> <br><br><br></div>
<div class="col-sm-8"> 
   The mail was sent.  Please review the email address to 
   which it was sentto continue the process.  Note that the email 
   received should contain the confidence message you just entered.          
</div>

<div class="col-sm-2"> </div>
</div><!-- end row -->
 
@endsection	