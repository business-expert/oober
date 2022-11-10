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
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

@stop

{{-- Page content --}}
@section('content')
<style>
body{background:#eef4f9;}
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
         <div class=" no-pad  below-four greybg map-prov">
			<div class="content-header">Payment</div>
			<div class="clear"></div>
			
			<div class="company_profile_data">
				<div class="row">
					<div class="label1">Bank Name</div>
									@foreach($provider as $user=>$userr)
					<div class="data">{{$userr->bank_name}}</div> @endforeach
				</div>
				<div class="row">
					<div class="label1">Account Number</div>
					@foreach($provider as $user=>$userr)
					<div class="data">{{$userr->account_number}}</div>@endforeach
				</div>
				<div class="row">
					<div class="label1">Rounting Number</div>
					@foreach($provider as $user=>$userr)
					<div class="data">{{$userr->rounting_number}}</div>@endforeach
				</div>
<!--				<div class="row">
					<div class="label1">Billing Address</div>
					<div class="label2"><input type="checkbox" /> Same as the Company Address</div>
				</div>
				-->
				<div class="row">
					<div class="label1">Billing Address</div>
					@foreach($provider as $user=>$userr)
					<div class="data">{{$userr->billing_address}}</div>@endforeach
					 <!--<label class="same-address"><input type="checkbox" checked="checked" /> Same as the Company Address</label>-->
				</div>
				<div class="row">
				<a href="{{ URL::to('admin/editpayment') }}" class="edit"><div class="edit-btn"> Edit</div></a>
				</div>
			</div>
			
		<!--<section class="map-width">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.3914300599045!2d77.38169111454955!3d28.618028382423446!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ceff49c2f3dbd%3A0x400dd89c2e13f329!2s64%2C+C+Block%2C+Sector+63%2C+Noida%2C+Uttar+Pradesh+201301!5e0!3m2!1sen!2sin!4v1491486075502" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
		
		</section>-->
			
			
		 </div> 
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
		$(document).ready(function(){
			$("#Payment").addClass("active"); 
		});
	
	</script>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop
