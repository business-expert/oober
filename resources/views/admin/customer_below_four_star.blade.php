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
	<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>-->
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





  
    <section class="content">

            <!-- /menu footer buttons -->
        <div class=" no-pad  below-four">
			<div class="content-header active-pad">Active Customers Below 4 Stars</div>
			<button onclick="window.history.back();">Back</button>
			<div class="table-cntnr table-cntnr-gap">
				
				<table id="example" class="display cust-four" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]">
				<div class="num-item">{{ $countResult }} items</div>
				<thead>
					<tr>
						<th><a href="#">Email</a></th>
						<th>Phone Number</th>
						<th>City</th>
						<th>State</th>
						<th>Date Started</th>
						<th>Avg Rating</th>
						<th># of Request</th>
						
					</tr>
					 </thead>
					 <tbody>
					
					<tr>
						@foreach($activecustomer as $userrs=>$userr)
                          <td><a href="{{ URL::to('admin/customer_details/' .$userr->id) }}">{{ $userr->email }}</td>
						
						<td><?php preg_match("/(\d{3})(\d{3})(\d{4})/",$userr->mobile,$matches);
                             echo "$matches[1]-$matches[2]-$matches[3]";  ?></td>
						<td>{{ $userr->cityuser }}</td>
						
						<td>{{ $userr->state }}</td>
						<td><?php echo date_format(date_create($userr->created_at),'Y-m-d') ?></td>
						
                        <td><?php $rating= round($userr->rating, 2);
                        echo $rating;
						?></td>
						<td>{{ $userr->request }}</td>
 </tr>
				
@endforeach
			</tbody>

				
				</table>
				<style>
	div.container {
        width: 80%;
    }
	</style>
				
			</div>

			
			
		 </div> 
            </section>

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
    $('#example').DataTable( {
        "lengthMenu": [[25, 50, 75, 100], [25, 50, 75, 100]]
    });
	
	$('.dataTables_filter').remove();
	$('.dataTables_info').remove();
	
	
} );
	</script>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop
