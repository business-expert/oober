@extends('admin/layouts/header')

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
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

@stop

{{-- Page content --}}
@section('content')
<style>

.amcharts-export-menu li:last-child>a{display:none !important;}
#chartdiv {
	width	: 100%;
height	: 500px;}

	#secondchartdiv {
	width	: 100%;
	height	: 500px;
}
.amcharts-export-menu .export-main:hover, .amcharts-export-menu .export-drawing:hover, .amcharts-export-menu 
</style>


           <!-- /menu footer buttons -->
			<section class="content">
     <div class="content-header">Settings</div>
<div class="setting-form">
 <h4 style="color:green;">@if(isset($msg)){{ $msg }} @endif</h4>
{{  Form::open(array('action'=>'JoshController@settings', 'method' => 'post')) }}
<div class="inner-wrap">
 
	<label>Mile Radius</label>
	<input type="text" name="miles" id="miles">
	<span>miles</span>
</div>
<div class="inner-wrap">
	<label>Commission &nbsp; &nbsp; $</label>
	<input type="text" name="commision" id="commision">
	<span>.00</span>
</div>
{!! Form::submit('Update', array('class'=>'send-btn','id'=>'submit','name'=>'Update')) !!}

</div>

 </section>


        <!-- top navigation -->
        <!-- /top navigation -->
		
        <!-- page content -->
        
    
	
	 

   <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- end of global js -->
    <!-- begining of page level js -->
     

 <script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.js') }}"></script>
 <script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.stack.js') }}"></script>
 <script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.crosshair.js') }}"></script>
	<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.time.js') }}"></script>



	 
<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.selection.js') }}"></script>
	
	<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.symbol.js') }}"></script>
				<script  src="{{ asset('assets/vendors/flotchart/js/jquery.flot.resize.js') }}"></script>
	<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.categories.js') }}"></script>
	<script src="{{ asset('assets/vendors/splinecharts/jquery.flot.spline.js') }}"></script>
	<script src="{{ asset('assets/vendors/flot.tooltip/js/jquery.flot.tooltip.js') }}"></script>
	<script src="{{ asset('assets/js/pages/customcharts.js') }}"></script>
	<script type="text/javascript">		
	$("#submit").on("click", function (event) {
   var commision = $("#commision").val(); 
	
	var miles=$("#miles").val();
	
	  
	  if(miles==''){
	    alert('Please provide the radius.'); return false;
	  }
	  if(miles.trim() == ""){
	   alert('Please provide the radius.'); return false;
	  }
	    if(miles!=parseInt(miles)){
	   alert('Radius must be in digits only.'); return false;
	 }
if(commision==''){
	    alert('Please provide the commision.'); return false;
	  }
	  if(commision.trim() == ""){
	   alert('Please provide the commision.'); return false;
	  }
	  if(commision!=parseInt(commision)){
	   alert('Commision must be in digits only.'); return false;
	 }
		 return true;
	});					
$(document).ready(function(){
	$("#sett").addClass("active"); 
});
</script>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop
