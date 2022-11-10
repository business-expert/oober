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
.transaction_show .clone
{
	width:110px !important;
}

</style>
<section class="content">
            <!-- /menu footer buttons -->
          <div class=" no-pad  below-four">
			<div class="content-header">Customer Detail</div>
			<button onclick="window.history.back()">Back</button>
			<div class="cus-det">
				<ul>
				@foreach($results as $workes=>$worke)
					<li>Name</li>
					<li><strong>{{ $worke->first_name }}</strong></li>
					<li>Customer Rating</li>
					<li><strong>{{ $worke->rating }}</strong></li>
					<li>Email</li>
					<li><strong>{{ $worke->email }}</strong></li>
					<li>Password</li>
					<li><a href="#" id="comp-click">< Reset ></a><div class="no-pad  below-four add-new over-lay new-overlay custompop">
		 <div class="cross-btn" id="cross-worker"><span>x</span></div>
			<div class="content-header">RESET PASSWORD</div>

				 {{  Form::open(array('action'=>'JoshController@resetpasswordcustomer', 'method' => 'post','files' => 'true')) }}
<div class="part1">
				
				
				<input type="hidden" name='id' value='{{$worke->id}}'>
				<input placeholder="New Password" type="password" name='password' id='password'>
				<input placeholder="Retype Password" type="password" name='newpassword' id='newpassword'>
				

			

				 {!! Form::submit('RESET', array('class'=>'send-btn','id'=>'submit','name'=>'RESET')) !!}

		 </div></li>
					<li>Phone</li>
					<li><strong>{{ $worke->mobile }}</strong></li>
					@endforeach
				</ul>
			
	
			
			<div class="table-cntnr transaction_show">
				<div class="col-md-12">
					<table>
				<div class="num-item">Addresses</div>
					<tr>
						<th>Name</th>
						<th>Address line 1</th>
						<th>City</th>
						<th>state</th>
						<th>Zip</th>
						<th>Size</th>
						<th>Corner</th>
						<th>side walk</th>
						<th>Drive way</th>
						
						
					</tr>
					@foreach($result as $workes=>$worke)
					<tr>
						<td>{{ $worke->location_name }}</td>
						<td>{{ $worke->location_address }}</td>
					
						<td>{{ $worke->city }}</td>
						<td>{{ $worke->state }}</td>
						<td>{{ $worke->zip }}</td>
						<td>{{ $worke->lot_size }}</td>

						

						<td>@if ($worke->cornor_lot==0)
							{{ $no }}
							
						@endif
						@if ($worke->cornor_lot==1)
							{{ $yes}}
							
						@endif
						
						
						</td>
						<td>@if ($worke->city_sidewalk==0)
							{{ $no }}
							
						@endif
						@if ($worke->city_sidewalk==1)
							{{ $yes}}
							
						@endif</td>
						<td>@if ($worke->drive_inclined==0)
							{{ $no }}
							
						@endif
						@if ($worke->drive_inclined==1)
							{{ $yes}}
							
						@endif</td>
						
					
					</tr>
					@endforeach

				
				</table>
				</div>
				
				<table id="example" class="display" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]">
					<!--<div class="num-item trans"><span class="pull-left">Transactions</span> 
						<button class="pull-left">Show All </button>
						<input type="text" placeholder="search field" class="pull-right">
					
					
					</div>-->
					<thead>
					<tr>
						<th>Date</th>
						<th>Company Name</th>
						<th>Worker Name</th>
						<th>Worker Rating</th>
						<th>Address</th>
						<th>City</th>
						<th>State</th>
						<th>Type</th>
						<th>Amount</th>
						
						
					</tr>
					</thead>
					<tbody>
					@foreach($res as $workes=>$worke)
					<tr>
						<td>{{$worke->order_date}}</td>
						<td>{{$worke->company_name}}</td>
						<td>{{$worke->first_name}}</td>
						<td>{{$worke->rating}}</td>
						<td>{{$worke->location_address}}</td>
						<td>{{$worke->city}}</td>
						<td>{{$worke->state}}</td>
						<td>{{$worke->service}}</td>
						<td>{{$worke->total_price}}</td>
				</tr>
@endforeach
			
		
		
				
				</tbody>
					
					<div class="clearfix"></div>
				
				</table>
				
				<!--<div class="pagination">
					<div class="pag-bdr">
						<div class="pull-left"><a href="#">FIRST</a></div>
						<div class="pull-left"><a href="#">PREV</a></div>
						<div class="pull-left count">1</div>
						<div class="pull-left"><a href="#">NEXT</a></div>
						<div class="pull-left"><a href="#">LAST</a></div>
						<div class="pull-right">
							<select>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>10</option>
							</select>
						
						</div>
						<div class="pull-right">SHOW</div>
						
					
				</div>
				</div>-->
			</div>
			</section>
		
<script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- end of global js -->
    <!-- begining of page level js -->
     

 <script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.js') }}"></script>
 <script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.stack.js') }}"></script>
 <script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.crosshair.js') }}"></script>
	<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.time.js') }}"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	 
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
				var $table =  $('#example').DataTable( {
					"lengthMenu": [[25, 50, 75, 100], [25, 50, 75, 100]]
				});
				$("#example_wrapper").find(".dataTables_length").clone(true).appendTo("#example_wrapper").addClass("clone").removeClass("dataTables_length");
				$('#example_filter input').attr("placeholder","Search");
				
				$('.dataTables_info').remove();
					$("#example_length").find("label").get(0).lastChild.remove();
				$(".clone").find("label").get(0).lastChild.remove();
$("#example_wrapper").find("label").first().find("select").remove().end().text("Show All").end().click(function(){
                    $table.search( '' ).columns().search( '' ).draw();
                });

				
			} );
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
	   
	  if(confirmpass==''){
	  
	  alert('Please enter your confirm password.'); shownext1=false; return false;
	  }
	  if(confirmpass.trim() == ""){
	    alert('Please enter your confirm password.'); shownext1=false; return false;
	  }
	  // if(confpassword==parseInt(confpassword)){
	   // alert('Confirm Password should be alphanumeric.'); shownext=false; return false;
	 // }
	 // if(confpassword.match(nameRegex)){
	   // alert('Confirm Password should be alphanumeric.'); shownext=false; return false;
	 // }
	 if(confirmpass!=password){
		 
		   alert('Both Passwords should be same.'); shownext1=false; return false;
	 }
  
	  
	 
		 // return false;
	// */
	});					

</script>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop
