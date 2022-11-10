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
.row-offcanvas-left{position: relative;}
</style>
 <section class="content">

            <!-- /menu footer buttons -->
         <div class="col-md-10 no-pad  below-four">
		 
			<div class="content-header">Transaction</div>
			<button onclick="window.history.back()">Back</button>
			<div class="trans-info">
				<h3>Customer</h3>
				
						<div class="payment-info ">
						@foreach($results as $userr=>$worke)
								 <ul>
									<li>Name</li>
									<li><strong>{{ $worke->first_name }}</strong></li>
									<li>Date</li>
									<li><strong>{{ $worke->order_date }}</strong></li>
									<li>Email</li>
									<li><strong>{{ $worke->email }}</strong></li>
									<li>Time</li>
									<li><strong>xx.xx.xx</strong></li>
									<li>Phone</li>
									<li><strong>{{ $worke->mobile }}</strong></li>
									<li>Lot Size</li>
									<li><strong>{{ $worke->first_name }}</strong></li>
									<li>Payment</li>
									<li><strong>{{ $worke->total_price }}</strong></li>
									<li>Corner</li>
									<li><strong>@if ($worke->corner==0)
							{{ $no }}
							
						@endif
						@if ($worke->corner==1)
							{{ $yes}}
							
						@endif</strong></li>
									<li>Address</li>
									<li><strong>{{ $worke->location_address }}</strong></li>
									<li>Drive Way</li>
									<li><strong>{{ $worke->car_fit }}</strong></li>
									<li>City</li>
									<li><strong>{{ $worke->city }}</strong></li>
									<li>incline</li>
									<li><strong>@if ($worke->inclined==0)
							{{ $no }}
							
						@endif
						@if ($worke->inclined==1)
							{{ $yes}}
							
						@endif</strong></li>
									<li>Zip</li>
									<li><strong>{{ $worke->zip }}</strong></li>
									<li>Worker Rating</li>
									<li><strong>{{ $worke->worker_rating }}</strong></li>
									<li>ST</li>
									<li><strong>{{ $worke->state }}</strong></li>
								 </ul>
				 @endforeach
						</div>
			
			</div>
			
			
			<div class="trans-info">
				<h3>Worker</h3>
				
						<div class="payment-info">
						@foreach($res as $userr=>$worke)
								 <ul>
									<li>Name</li>
									<li><strong>{{ $worke->first_name }}</strong></li>
									<li>Job Total</li>
									<li><strong>{{$ress[0]->jobs}}</strong></li>
									<li>Email</li>
									<li><strong>{{ $worke->email }}</strong></li>
									<li>Customer Rating</li>
									<li><strong>{{ $worke->customer_rate }}</strong></li>
									<li>Started</li>
									<li><strong>{{ $worke->start_time }}</strong></li>
									<li>Finished</li>
									<li><strong>{{ $worke->end_time }}</strong></li>
									<li>before</li>
									<li><img src="{{ $worke->before_image }}" alt=""></li>
									<li>After</li>
									<li><img src="{{ $worke->after_image }}" alt=""></li>
								</ul>
								 @endforeach
						</div>
			
			</div>
			
			<div class="trans-info">
				<h3>Company</h3>
				
						<div class="payment-info tans-ober">
						@foreach($rest as $userr=>$worke)
								 <ul>
									<li>Name</li>
									<li><strong>{{ $worke->company_name }}</strong></li>
									<li>Earned</li>
									<li><strong>{{ $worke->total_price }}</strong></li>
									<li>Address</li>
									<li><strong>{{ $worke->address }}</strong></li>
									<li>Phone</li>
									<li><strong>{{ $worke->mobile }}</strong></li>
									<li>City</li>
									<li><strong>{{ $worke->cityuser }}</strong></li>
									<li>State</li>
									<li><strong>{{ $worke->state }}</strong></li>
									<li>Zip</li>
									<li><strong>{{ $worke->postal }}</i></strong></li>
									
								</ul>
								@endforeach
						</div>
			
			</div>

			
			
		 </div> 

        </section>

        <!-- top navigation -->
        <!-- /top navigation -->
		
        <!-- page content -->
        


         
    
	 <!-- jQuery -->
  </section>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script type="text/javascript">
  $( function(){
	$('.pro').click( function(){
		
	
		$('.pro-content').css({'display':'block'});
		$('.payment-cont').css({'display':'none'});
		$('.ins-content').css({'display':'none'});
		$('.service-content').css({'display':'none'});
		$('.transtab-cont').css({'display':'none'});
		$('.work-cont').css({'display':'none'});
	});
	
	$('.pay').click( function(){
	
		$('.pro-content').css({'display':'none'});
		$('.payment-cont').css({'display':'block'});
		$('.ins-content').css({'display':'none'});
		$('.service-content').css({'display':'none'});
		$('.transtab-cont').css({'display':'none'});
		$('.work-cont').css({'display':'none'});
	
	});
	
	$('.ins').click( function(){
	
		$('.pro-content').css({'display':'none'});
		$('.payment-cont').css({'display':'none'});
		$('.ins-content').css({'display':'block'});
		$('.service-content').css({'display':'none'});
		$('.transtab-cont').css({'display':'none'});
		$('.work-cont').css({'display':'none'});
		
	
	});
	
	$('.service').click( function(){
	
		$('.pro-content').css({'display':'none'});
		$('.payment-cont').css({'display':'none'});
		$('.ins-content').css({'display':'none'});
		$('.service-content').css({'display':'block'});
		$('.transtab-cont').css({'display':'none'});
		$('.work-cont').css({'display':'none'});
		
		
	
	});
		$('.trans-tab').click( function(){
	
		$('.pro-content').css({'display':'none'});
		$('.payment-cont').css({'display':'none'});
		$('.ins-content').css({'display':'none'});
		$('.service-content').css({'display':'none'});
		$('.transtab-cont').css({'display':'block'});
		$('.work-cont').css({'display':'none'});
		
		
		
	
	});
	
	$('.worker-tab').click( function(){
	
		$('.pro-content').css({'display':'none'});
		$('.payment-cont').css({'display':'none'});
		$('.ins-content').css({'display':'none'});
		$('.service-content').css({'display':'none'});
		$('.transtab-cont').css({'display':'none'});
		$('.work-cont').css({'display':'block'});
		
		
		
	
	});
		$('.comp-det .tab ul li').click(function(){
			$('.comp-det .tab ul li').removeClass('tab-active');
			$(this).addClass('tab-active')
	
		});
  
  });
  
  
  
	</script>
	
	

 <script>
 function goBack() {
    window.history.back()
}
</script>
 </script>
   <script>
   $('.overlay-div').click( function(){
	 $('.over-lay ').css({'display':'none'}) ;
	$('.overlay-div').css({'display':'none'}) ;
	   
   });
      $('#cross-worker').click( function(){
		$('.over-lay ').css({'display':'none'}) ;
		$('.overlay-div').css({'display':'none'}) ;
	   
   });

   $('#pop-worker').click(function(){

		$('.over-lay ').css({'display':'block'})
		$('.overlay-div').css({'display':'block'})
   });
   
   
   
   </script>
  

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

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop
