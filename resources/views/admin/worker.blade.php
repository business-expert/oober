@extends('admin/layouts/header')

{{-- Page title --}}
@section('title')
    Oober

@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" media="all" href="{{ asset('assets/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/only_dashboard.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/css/pages/flot.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link href="{{ asset('assets/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/css/bootstrap-datepicker.css">


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
 .transaction_show .clone{width:93px;}
 .dataTables_length label{width:93px;}
</style>
            <!-- /menu footer buttons -->
			<section class="content">		

            <!-- /menu footer buttons -->
         <div class=" no-pad below-four compan">
			<div class="content-header">All Workers</div>
		
	<div class="clearfix"></div>
			<section class="graph-cntnr">
				
				<div class="">
        <!-- Left side column. contains the logo and sidebar -->

        <!--right side column. Contains the navbar and content of the page -->
        <aside class="right-side" style="margin-left:-26px;">
            <!-- Content Header (Page header) -->
         
            <!-- Main content -->
            
                <div class="row">
                    <div class="col-md-12" style="display:none">
                        <!-- Stack charts strats here-->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Stacked Bar Chart
                                </h3>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div id="basicFlotLegend" class="flotLegend"></div>
                                <div id="bar-chart-stacked" class="flotChart1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" style="display:none;">
                        <!-- toggling series charts strats here-->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <i class="livicon" data-name="linechart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Bar Chart
                                </h3>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div id="bar-chart" class="flotChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-6" style="display:none;">
                        <!-- Tracking charts strats here-->
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <i class="livicon" data-name="linechart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Spline Chart
                                </h3>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div id="basicFlotLegend1" class="flotLegend"></div>
                                <div id="spline-chart" class="flotChart1"></div>
                            </div>
                        </div>
                    </div>
                     <div class="date">
							 {{  Form::open(array('action'=>'JoshController@allworkers', 'id'=>'addcompa','method' => 'post','files' => 'true')) }}
			<p><input type="text" name="fromdate" id="datepicker" value="{{$date1}}" class="fromdate" placeholder="Start Date"></p>
			<span>to</span>
			<p><input type="text" name="todate" id="datepicker1" value="{{$date2}}" class="todate" placeholder="End Date"></p>
			{!! Form::submit('Go', array('class'=>'send-btn go-btn','id'=>'submit','name'=>'Go')) !!}
			<input type="hidden" id="inputDate" value="0" />
			</div>
                        <!-- Stack charts strats here-->
                       <div style="width:100%">
                        <!-- Stack charts strats here-->
                        <div class="panel panel-primary">
                            
                          <div class="row">
                    <div class="">
                        <!-- Basic charts strats here-->
                        <div class="panel panel-primary">
                            
                            <div class="panel-body">
                                <div>
                                    <canvas id="line-chart4" width="1200" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                        </div>
                    </div>
                   
                </div>
				
			</section>
			
			<div class="table-cntnr transaction_show">
				
				<!--<div class="num-item trans">
				{{ Form::open(array('method' => 'GET','url' => 'admin/worker')) }}
			<button class="pull-left">Show All </button>
			<input type="hidden" name="showall" value="1">
			{{ Form::close() }}
						<input type="hidden" name="pagedata" value="1">
						<input type="text" placeholder="search field" class="pull-right">
					
					
					</div>-->
				
			<div class="table-responsive">
				<table id="example" class="display table" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]">
				
					<thead><tr>
						<th><a href="#">Company</a></th>
						<th>Name</th>
						<th>Avg Rating</th>
						<th>Money Made</th>
						<th>City</th>
						<th>State</th>
						<th>Email</th>
						<th>Phone #</th>
						
					</tr>
					</thead>
					<tbody>
					@foreach($worker as $worke)
					<tr>
					
					
					
					
						<td>{{ $worke['company_name'] }}</td>
						<td><a href="{{ URL::to('admin/worker_detail/' .$worke['id']) }}">{{ $worke['first_name'] }}</a></td>
						<td>@if(isset($worke['rating'])){{ $worke['rating']  }}@endif</td>
						<td>@if(isset($worke['money'])){{ $worke['money'] }}@endif</td>
						
						<td>{{ $worke['city'] }}</td>
						<td>{{ $worke['state'] }}</td>
						<td>{{ $worke['email'] }}</td>
						<td>{{ $worke['mobile'] }}</td>
						
                   
					
						
					
					</tr>
					@endforeach
					
				</tbody>
					
				
				</tbody></table>
			</div>
				<style>
	div.container {
        width: 80%;
    }
	</style>
				
						<!--<div class="pull-right">SHOW</div>-->
						
					
				</div>
				</div>
			</div>
			
		      </section>
        <!-- top navigation -->
        <!-- /top navigation -->
		
        <!-- page content -->
        
<script type="text/javascript">
	var janInput = "<?php echo $graphRecord['jan']; ?>";
	var febInput = "<?php echo $graphRecord['feb']; ?>";
	var MarchInput = "<?php echo $graphRecord['mar']; ?>";
	var aprilInput = "<?php echo $graphRecord['april']; ?>";
	var mayInput = "<?php echo $graphRecord['may']; ?>";
	var juneInput = "<?php echo $graphRecord['june']; ?>";
	var julyInput = "<?php echo $graphRecord['july']; ?>";
	var augInput = "<?php echo $graphRecord['aug']; ?>";
	var sepInput = "<?php echo $graphRecord['sep']; ?>";
	var octInput = "<?php echo $graphRecord['oct']; ?>";
	var novInput = "<?php echo $graphRecord['nov']; ?>";
	var decInput = "<?php echo $graphRecord['dec']; ?>";
	 </script>
         
    
	
	 

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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="{{ asset('assets/js/pages/customcharts.js') }}"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
		<script src="{{ asset('assets/js/pages/accountscharts.js') }}"></script>
		<script language="javascript" type="text/javascript" src="{{ asset('assets/js/newchartjs/Chart.js') }}"></script>

		<script>
				$(document).ready(function() {
				var $table = $('#example').DataTable( {
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
		<script language="javascript" type="text/javascript" src="{{ asset('assets/js/newchartjs/Chart.js') }}"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/js/bootstrap-datepicker.js"></script>
	<script>
    $(function () {
//var result='<?php echo $yaxisdate; ?>';
//var datearr='<?php echo $xaxisdata; ?>';
Chart.defaults.global.legend.display = false;
    //start line chart
    var lineChartData = {
        labels: [<?php echo $xaxisdata; ?>],
        datasets: [
            {
                fill:true,
                tension:0,
                pointBackgroundColor:"transparent",
                pointBorderColor:"#3aca60",
                borderJoinStyle: 'miter',
                pointBorderWidth:"1",
                label:"",
                data : [<?php echo $yaxisdate; ?>],
                backgroundColor:"transparent",
				borderColor:"#3aca60"
            },
        ]
    };

    function draw() {
//event.preventDefault();
        var selector = '#line-chart4';

        $(selector).attr('width', $(selector).parent().width());
        var myLine = new Chart($("#line-chart4"), {
            type: 'line',
            data: lineChartData,
            options: {
                title: {
                    display: false,
                    text: 'Line Chart'
                },
				scales: {
				  xAxes: [{
					display: true,
					gridLines: {
					  display: false
					},
					scaleLabel: {
					  display: true,
					  labelString: 'Month'
					}
				  }],
				  yAxes: [{
					display: true,
					gridLines: {
					  display: false
					},
					scaleLabel: {
					  display: true,
					  labelString: 'Value'
					}
				  }]
				}
            }
        });
    }

    $(window).resize(draw);
    draw();
    //endline chart

}); 

$(document).ready(function(){
	$("#worker").addClass("active"); 
});
  jQuery(document).ready(function(){
    $( "#datepicker" ).datepicker({format: 'yyyy-mm-dd'});
    $( "#datepicker1" ).datepicker({format: 'yyyy-mm-dd'});

  });
$(window).resize(function(){
	$(".sidebar").height($(document).height());
});
$(".sidebar").height($(document).height()/1.5);
    </script>
	
	<script>
	$("#submit").on("click", function (event) {
		
	var from = $("#datepicker").val();
var to = $("#datepicker1").val();

if(from==''){
	   alert("Please select start date"); return false;
	
}
if(to==''){
	   alert("Please select end date"); return false;
	
}
if(Date.parse(from) > Date.parse(to)){
	
	alert('invalid date'); return false;
}

});		
	</script>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	

@stop