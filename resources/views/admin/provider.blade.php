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
.company_profile_img{
	display: block;
	margin: 50px 0 20px 50px;
	height: auto;
	width: auto;
	overflow:hidden;
	width:400px;position:relative;
}
.uploade_insurance:hover .fa{display:block;}
.uploade_insurance .fa {
    font-size: 20px;
    position: absolute;
    right: 20px;
    top: 10px; display:none;
}
._insurance label
{
font-size: 20px;
font-weight: 400;
text-decoration: underline;	
margin-left: 50px;
color:#888;
} 
.uploade_insurance img{width:400px;}
#upload_insurance
{
	display:none;
}
.submit_insurance
{
background: #ff5966;
border: 0px;
outline: 0px;
border-radius: 4px;
width: 100px;
text-align: center;
margin: 20px auto 20px 350px;
padding: 3px 12px;
display: block;
color: #fff;
cursor: pointer;
}
.tk{color: green;
    padding-left: 13%;
    text-align: center;}
	.tc{color: green;
    padding-left: 13%;
    text-align: center;}
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
         <div class=" no-pad  below-four greybg map-prov company_profile">
			<div class="content-header">Profile</div>
			
				{{  Form::open(array('action'=>'JoshController@uploadlogo','id'=>'insur', 'method' => 'post','files' => 'true')) }}
				<div class="company_profile_img">
					<?php if(!empty($provider[0]->logo)) { ?>
					<img src="{{ $provider[0]->logo }}" alt="">
					<?php } else { ?>
					<img src="{{ asset('images/User_man_male_profile_account_person_people.png') }}" alt="...">

					<?php } ?>
					<!--<img src="{{ asset('images/User_man_male_profile_account_person_people.png') }}" alt="..." class="img-responsive">-->
					
				</div>
					<h1>@if(isset($provider[0]->company_name)){{$provider[0]->company_name}} @endif </h1>
					
					<label class="admin-clear-block"><span>Click to <?php if(empty($provider[0]->logo)) { ?>Add<?php } else { ?>Update<?php } ?> Logo </span>
							<input type="file" name="upload_logo" id="upload_logo" />

					</label>
					{!! Form::submit('Submit', array('class'=>'send-btn submit_insurance clear btn-margin','id'=>'subm','name'=>'submit')) !!}
					{{ Form::close() }}
					
			
			</div>
			
			
			<div class="clear"></div>
			
			<div class="company_profile_data">
				<div class="row">
				@foreach($provider as $user=>$userr)
					<div class="label1">Company Address</div>
					<div class="data">{{$userr->address}},{{$userr->cityuser}},{{$userr->state}}</div>
				</div>
				<div class="row">
					<div class="label1">Email</div>
					<div class="data">{{$userr->email}}</div>
				</div>
				<div class="row">
					<div class="label1">Phone</div>
					<div class="data">{{$userr->mobile}}</div>
				</div>
				<div class="row">
					<div class="label1">EIN</div>
					<div class="data">{{$userr->ein}}</div>
					@endforeach
				</div>
			</div>
			<a href="{{ URL::to('admin/editprofile') }}" class="edit"><div class="edit-btn"> Edit</div></a>
			
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
			$("#profile").addClass("active"); 
		});
	
	</script>
	 <script type="text/javascript">		
	$("#subm").on("click", function (event) {
		
		 var fname = $("#upload_logo").val();
var re = /(\.jpg|\.jpeg|\.bmp|\.gif|\.png)$/i;
	if(fname=='')
{
         alert("Please upload the image file."); return false;
}
	if(!re.exec(fname) && fname!='')
{
         alert("Choose valid image extension."); return false;
}
});		
	
	
	</script>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop
