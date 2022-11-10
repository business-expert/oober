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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>
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
         <div class=" no-pad  below-four">
			<div class="content-header">Worker Detail</div>
			<button onclick="window.history.back()">Back</button>
			<div class="cus-det worker-det">
				<ul>
				@foreach($result as $workes=>$worke)
					<li class="clr-left">Worker Name</li>
					<li class="clr-right"><strong>{{ $worke->name }}</strong></li>
					<li class="clr-left">Email Address</li>
					<li class="clr-right"><strong>{{ $worke->email }}</strong></li>
					<li class="clr-left">Password</li>
					<li class="clr-right"><a href="#" id="comp-click">< Reset Password ></a><div class="no-pad  below-four add-new over-lay new-overlay custompop">
		 <div class="cross-btn" id="cross-worker"><span>x</span></div>
			<div class="content-header">RESET PASSWORD</div>

				 {{  Form::open(array('action'=>'JoshController@resetpasswordworker', 'method' => 'post','files' => 'true')) }}
<div class="part1">
				
				
				<input type="hidden" name='id' value='{{$id}}'>
				<input placeholder="New Password" type="password" name='password' id='password'>
				<input placeholder="Retype Password" type="password" name='newpassword' id='newpassword'>
				

			

				 {!! Form::submit('RESET', array('class'=>'send-btn','id'=>'submit','name'=>'RESET')) !!}

		 </div></li>
					<li>Company Name</li>
					<li><strong>{{ $worke->company_name }}</strong></li>
					<li>Customer Rating</li>
					<li><strong><?php $rating= round($worke->rating, 2);
                        echo $rating;
						?></strong></li>
							 <ul><li class="clr-left">Status</li>
		 <li class="clr-right">
		 	 <select name="cars" id="cars">
  <option name="status" value="Approved">Approved</option>
  <option name="status"  value="Denied">Denied</option>
  </li>
</select> 
					@endforeach
				</ul>
			
			
			
			<div class="table-cntnr transaction_show">
				
			
				
				<table id="example" class="display" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]">
					<!--<div class="num-item trans"><span class="pull-left">Transactions</span> 
						<button class="pull-left">Show All </button>
						<input type="text" placeholder="search field" class="pull-right">
					
					
					</div>-->
					<thead><tr>
						<th>Date</th>
						<th>Customer Name</th>
						<th>Phone #</th>
						<th>Rating</th>
						<th>Address</th>
						<th>City</th>
						<th>State</th>
						<th>Type</th>
						<th>Amount</th>
				
						
					</tr>
					</thead>
					<tbody>
					@foreach($results as $userr=>$worke)
					<tr>
						<td>{{ $worke->order_date }}</td>
						<td>{{ $worke->first_name }}</td>
						
						
						<td class="text-center"><?php preg_match("/(\d{3})(\d{3})(\d{4})/",$worke->mobile,$matches);
                             echo "$matches[1]-$matches[2]-$matches[3]";  ?></td>
						<td class="text-center"><?php $rating= round($worke->rating, 2);
                        echo $rating;
						?></td>
						
						<td>{{ $worke->location_address }}</td>
						<td>{{ $worke->city }}</td>
						<td class="text-center">{{ $worke->location_state }}</td>
						<td class="text-center">{{ $worke->service }}</td>
						<td class="text-center">${{ $worke->total_price }}</td>
					
				</tr>
					@endforeach
					
				</tbody>
					
					<div class="clearfix"></div>
				
				</table>
				<style>
	div.container {
        width: 80%;
    }
	</style>
				
				</div>
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
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
		<script>
				$(document).ready(function() {
				$table = $('#example').DataTable( {
					"lengthMenu": [[25, 50, 75, 100], [25, 50, 75, 100]]
				});
				$("#example_wrapper").find(".dataTables_length").clone(true).appendTo("#example_wrapper").addClass("clone").removeClass("dataTables_length");
				$('#example_filter input').attr("placeholder","Search Field");

				$('.dataTables_info').remove();
					$("#example_length").find("label").get(0).lastChild.remove();
					$(".clone").find("label").get(0).lastChild.remove();

				$("#example_wrapper").find("label").first().find("select").remove().end().text("Show All").end().click(function(){
                    $table.search( '' ).columns().search( '' ).draw();
                });
				
			} );
	</script>
	</script>
	
		 <script type="text/javascript">
		$(function(){
			$('#comp-click').click( function(){
				$('.over-lay').css({'display':'block'})
			});
			$('#cross-worker').click(function(){
				$('.over-lay').css({'display':'none'})
				
			});
			
		});
	
	</script>
	<script>
$("#submit").on("click", function (event) {
			// $(".part1").hide();
			// $(".part2").show();
			//alert('sdsd'); return false;

    var shownext1=true;
     var password = $("#password").val(); 
     
     var confirmpass=$("#newpassword").val();
	 
	 // //var firstname=$("#firstname").val();
	 
	 
	 var nameRegex = /^[a-zA-Z]+$/;
	 var con=/^([0-9]+)$/;
	 var ema=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 
      
	  if(password==''){
	  
	   alert('Please enter your password.'); shownext1=false; return false;
	   }
	   if(password.trim() == ""){
	    alert('Please enter your password.'); shownext1=false; return false;
	   }
	    if(password==parseInt(password)){
	    alert('Password should be alphanumeric.'); shownext=false; return false;
	 }
	  if(password.match(nameRegex)){
	    alert('Password should be alphanumeric.'); shownext=false; return false;
	  }
	  if(confirmpass==''){
	  
	  alert('Please enter your confirm password.'); shownext1=false; return false;
	  }
	  if(confirmpass.trim() == ""){
	    alert('Please enter your confirm password.'); shownext1=false; return false;
	  }
	  
	 if(confirmpass!=password){
		 
		   alert('Both Passwords should be same.'); shownext1=false; return false;
	 }
  
	  
	 
		 // return false;
	// */
	});					

</script>	
<script>
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
$('#cars').on('change', function() { 
  var status=this.value;
  var ids='<?php echo $id; ?>';
  	var param = 'status='+status+'&ids='+ids;
  $.ajax({
               type:'GET',
               url:'/ober/public/admin/changestatusworker',
               data:param,
               success:function(data){
				    alert('Status has been changed.') 
                    
               }
            });

})
</script>  
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop