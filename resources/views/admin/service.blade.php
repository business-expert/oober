@extends('admin/layouts/headerprovider')

{{-- Page title --}}
@section('title')
    Oober

@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" media="all" href="{{ asset('assets/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/only_dashboard.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/css/pages/flot.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

@stop

{{-- Page content --}}
@section('content')
<style>
body{background:#eef4f9;}
label{
	line-height: 2.0;
}
.submit_service
{
background: #ff5966;
border: 0px;
outline: 0px;
border-radius: 4px;
width: 200px;
text-align: center;
margin: 100px auto 20px 130px;
padding: 10px 30px;
display: block;
color: #fff;
cursor: pointer;
}
.tk{color: green;
    padding-left: 13%;
    text-align: center;}
</style>


        <!-- /menu footer buttons -->
		<section class="content _service">
			<div class=" no-pad  below-four">
				<div class="content-header">Services</div>
				 <div class="payment-info comp-service">
		<p>Please select the service(s) that you will provide to the Clients</p>
		@if(isset($msg))<h4 style="color:green;"class="tk">{{ $msg }} </h4>@endif
				 {{  Form::open(array('action'=>'JoshController@service', 'method' => 'post','files' => 'true',"id"=>"addsubmit")) }}
			<ul>
			
				<li> 	<?php if($result[0]->snow_service==0) { ?><input type="checkbox" name="snow" value="1"><label>Snow Removal</label>
				<?php } else{?>
				<input type="checkbox" name="snow" value="1" checked="checked"><label>Snow Removal </label><?php }?></li>
				<li><?php if($result[0]->lawn_service==0) { ?>
				<input type="checkbox" name="lawn" value="1"><label>Yard Mowing</label>
				<?php } else{?>
				
				<li><input type="checkbox" name="lawn" value="1" checked="checked"><label>Yard Mowing</label><?php }?></li>
			</ul>
			{!! Form::submit('Confirm', array('class'=>'submit_service','id'=>'submit','name'=>'submit')) !!}
{{ Form::close() }}

		</form>
		</div>
			</div>			
		</section>
        <!-- top navigation -->
        <!-- /top navigation -->
		
        <!-- page content -->
        


         
    
	
	 

    <!-- end of global js -->
    <!-- begining of page level js -->
     
<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script type="text/javascript">
		$(document).ready(function(){
			$("#service").addClass("active"); 
		});
	
	</script>

	 

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop
