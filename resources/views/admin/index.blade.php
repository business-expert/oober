@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Oober

@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link href="{{ asset('assets/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" media="all" href="{{ asset('assets/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/only_dashboard.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/css/pages/flot.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" type="text/css"
          href="{{ asset('assets/css/newchartcss/app.css') }}">
		   <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/css/newchartcss/jscharts.css') }}">
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
	<div class="content-header">Dashboard</div>
        <div class="row">
		<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="shadow-reg">
						<div class="registration"><span>{!! $users !!}</span></div>
						<div class="second-color"><a href="{{ URL::to('admin/new_provider_registration') }}">New Provider<br/> Registration</a></div>
					</div>
					</div>
					
            <div class="col-md-4 col-sm-12 col-xs-12">
					<div class="shadow-reg">
						<div class="registration red-color"><span>{!!  $count !!}</span></div>
						<div class="second-color red-bg"><a href="{{ URL::to('admin/worker_below_four_star') }}">Active Workers<br/> Below 4 stars</a></div>
					</div>
					</div>
            	<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="shadow-reg">
						<div class="registration blue-clr"><span>{!! $cou !!}</span></div>
						<div class="second-color blue-clr-bg "><a href="{{ URL::to('admin/customer_below_four_star') }}">Customers<br/> Below 4 stars</a></div>
					</div>
					</div>
			
			</div>
        <!--/row-->
       
        <div class="clearfix"></div>
        
		<div class="row">
			<section class="graph-cntnr">
				<h2>Customers</h2>
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
                    <div style="width:100%">
                        <!-- Stack charts strats here-->
                        <div class="panel panel-primary">
                           <div class="date">
							 {{  Form::open(array('action'=>'JoshController@getOrders', 'id'=>'addcompa','method' => 'post','files' => 'true')) }}
			<p><input type="text" name="customerfromdate" id="datepicker2" value="{{$date3}}" class="fromdate" placeholder="Start Date"></p>
			<span>to</span>
			<p><input type="text" name="customertodate" id="datepicker3" value="{{$date4}}" class="todate"  placeholder="End Date"></p>
			{!! Form::submit('Go', array('class'=>'send-btn go-btn','id'=>'submit','name'=>'Go')) !!}
			<input type="hidden" id="inputDate" value="0" />
			</div>
                             <div style="width:100%">
                        <!-- Stack charts strats here-->
                        <div class="panel panel-primary">
                            
                          <div class="row">
                    <div class="">
                        <!-- Basic charts strats here-->
                        <div class="panel panel-primary">
                            
                            <div class="panel-body">
                                <div>
                                    <canvas id="line-chart" width="1200" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
				
			</section>
			
			<section class="graph-cntnr">
				<h2>Income</h2>
				<div class="">
        <!-- Left side column. contains the logo and sidebar -->

        <!--right side column. Contains the navbar and content of the page -->
        <aside class="right-side" style="margin-left:-26px;">
            <!-- Content Header (Page header) -->
         
            <!-- Main content -->
            
                <div class="row">
                    <div class="" style="display:none">
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
                    <div class="col-lg-12" style="display:none;">
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
							 {{  Form::open(array('action'=>'JoshController@getOrders', 'id'=>'addcompa','method' => 'post','files' => 'true')) }}
			<p><input type="text" name="fromdate" id="datepicker" value="{{$date1}}"class="fromdate" placeholder="Start Date"></p>
			<span>to</span>
			<p><input type="text" name="todate" id="datepicker1" value="{{$date2}}" class="todate" placeholder="End Date"></p>
			{!! Form::submit('Go', array('class'=>'send-btn go-btn','id'=>'submi','name'=>'Go')) !!}
			<input type="hidden" id="inputDate" value="0" />
			</div>
                    <div style="width:100%">
                        <!-- Stack charts strats here-->
                        <div class="panel panel-primary">
                            
                          <div class="row">
                    <div class="col-md-12">
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
                <!-- row -->
              
              
                <!-- row -->
            </section>
            <!-- content -->
        </aside>
        <!-- right-side -->
    </div>
			</section>

		</div>
        </section>
		<?php //echo "<pre>";print_r($graphRecord); echo $graphRecord['jan'].'val'; ?>
	<script type="text/javascript">
	var janInput = "<?php echo $graphRecord['jan']; ?>";
	var febInput = "<?php echo $graphRecord['feb']; ?>";
	var MarchInput = <?php echo $graphRecord['mar']; ?>;
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
		<script type="text/javascript">
	var jan_Input = "<?php echo $graphRecords['jan']; ?>";
	var feb_Input = "<?php echo $graphRecords['feb']; ?>";
	var March_Input = "<?php echo $graphRecords['mar']; ?>";
	var april_Input = "<?php echo $graphRecords['april']; ?>";
	var may_Input = "<?php echo $graphRecords['may']; ?>";
	var june_Input = "<?php echo $graphRecords['june']; ?>";
	var july_Input = "<?php echo $graphRecords['july']; ?>";
	var aug_Input = "<?php echo $graphRecords['aug']; ?>";
	var sep_Input = "<?php echo $graphRecords['sep']; ?>";
	var oct_Input = "<?php echo $graphRecords['oct']; ?>";
	var nov_Input = "<?php echo $graphRecords['nov']; ?>";
	var dec_Input = "<?php echo $graphRecords['dec']; ?>";
	 </script>
	  <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script language="javascript" type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
    <!-- end of global js -->
    <!-- begining of page level js -->
     

 <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.js') }}"></script>
 <script  language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.stack.js') }}"></script>
 <script  language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.crosshair.js') }}"></script>
	<script  language="javascript" type="text/javascript"src="{{ asset('assets/vendors/flotchart/js/jquery.flot.time.js') }}"></script>



	 
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.selection.js') }}"></script>
	
	<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.symbol.js') }}"></script>
				<script  src="{{ asset('assets/vendors/flotchart/js/jquery.flot.resize.js') }}"></script>
	<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.categories.js') }}"></script>
	<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/splinecharts/jquery.flot.spline.js') }}"></script>
		
	<!--<script src="{{ asset('assets/js/pages/customercharts.js') }}"></script>-->
	<script>
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
    
	 <script>
  $(function() {
    $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
  <script>
  $(function() {
    $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
  <script>
  $(function() {
    $( "#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
  <script>

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
function getTransaction(){
	var fromdate = $('.fromdate').val();
	var todate = $('.todate').val();
	$('#inputDate').val("1");
	
	var param = 'fromdate='+fromdate+'&todate='+todate;
	//alert(param);
            $.ajax({
               type:'GET',
               url:'/ober/public/admin/ajaxCustomers',
               data:param,
               success:function(data){
				    //$("#fill").html(data); 
                   //alert(data); 
				   console.log(data);
               }
            });
         }

</script>
	<script>
	//start bar chart
var d1 = [["1", 100],["2", 80],["3", 66],["4", 48],["5", 68],["6", 48],["7",66],["8", 80],["9", 64],["10", 48],["11",64],["12",100]];
$.plot("#bar-chart", [{
    data: d1,
    label: "Project",
    color: "#F89A14"
}], {
    series: {
        bars: {
            align: "center",
            lineWidth: 0,
            show: !0,
            barWidth: .6,
            fill: .9
        }
    },
    grid: {
        borderColor: "#ddd",
        borderWidth: 1,
        hoverable: !0
    },
    tooltip: true,
    tooltipOpts: {
        content: '%s: %y'
    },

    xaxis: {
        tickColor: "#ddd",
        mode: "categories"
    },
    yaxis: {
        tickColor: "#ddd"
    },
    shadowSize: 0
});
//end bar chart

//start bar stack
var d11 = [["Jan", 130],["Feb",63],["Mar", 104],["Apr", 54],["May", 92],["Jun", 150],["Jul", 50],["Aug", 80],["Sep",120],["Oct", 91],["Nov", 79],["Dec", 112]];

var d12 = [["Jan", 58],["Feb", 30],["Mar", 46],["Apr", 35],["May", 55],["Jun", 46],["Jul", 20],["Aug", 50],["Sep", 50],["Oct", 40],["Nov", 35],["Dec", 57]];
$.plot("#bar-chart-stacked", [{
    data: d11,
    label: "Total visitors",
    color: "#EF6F6C"
},{
    data: d12,
    label: "Total Sales",
    color: "#01BC8C"
}], {
    series: {
        stack: !0,
        bars: {
            align: "center",
            lineWidth: 0,
            show: !0,
            barWidth: .5,
            fill: .9
        }
    },
    grid: {
        borderColor: "#ddd",
        borderWidth: 1,
        hoverable: !0
    },
    legend: {
        container: '#basicFlotLegend',
        show: true
    },
    tooltip: !0,
    tooltipOpts: {
        content: "%x : %y",
        defaultTheme: false
    },
    xaxis: {
        tickColor: "#ddd",
        mode: "categories"
    },
    yaxis: {
        tickColor: "#ddd"
    },
    shadowSize: 0
});
//end bar chart stack

//start line chart

var s2 = [["Jan", 50],["Feb", 80],["Mar", 60],["Apr", 90],["May", 60],["Jun", 80],["Jul", 60]];
var s1 = [["Jan", 70],["Feb", 100],["Mar", 80],["Apr", 100],["May", 80],["Jun", 90],["Jul", 80]];
var s3 = [["Jan", 32],["Feb", 41],["Mar", 36],["Apr", 39],["May", 30],["Jun", 44],["Jul", 26]];
$.plot("#spline-chart", [{
    data: s1,
    label: " Product 1",
    color: "#01bc8c"
},{
    data: s2,
    label: " Product 2",
    color: "#01BC8C"
},{
    data: s3,
    label: " Product 3",
    color: "#67C5DF"
}], {
    series: {
        lines: {
            show: !1
        },
        splines: {
            show: !0,
            tension: .4,
            lineWidth: 2,
            fill: 0
        },
        points: {
            show: !0,
            radius: 4
        }
    },
    grid: {
        borderColor: "#fafafa",
        borderWidth: 1,
        hoverable: !0
    },
    tooltip: !0,
    tooltipOpts: {
        content: "%x : %y",
        defaultTheme: false
    },
    xaxis: {
        tickColor: "#fafafa",
        mode: "categories"
    },
    yaxis: {
        tickColor: "#fafafa"
    },
    shadowSize: 0
});

//end spline chart


//line chart start
$(function () {
var months=["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    

    d1 = [
        [1262304000000, 100], [1264982400000,560], [1267401600000, 1605], [1270080000000, 1129],
        [1272672000000, 2163], [1275350400000, 1905], [1277942400000, 2002], [1280620800000, 2917],
        [1283299200000, 2700], [1285891200000, 2700], [1288569600000, 2100], [1291161600000, 2700]
    ];

    d2 = [
        [1262304000000,jan_Input], [1264982400000,feb_Input], [1267401600000, March_Input], [1270080000000, april_Input],
        [1272672000000, may_Input], [1275350400000, june_Input], [1277942400000, july_Input], [1280620800000, aug_Input],
        [1283299200000, sep_Input], [1285891200000, oct_Input], [1288569600000, nov_Input], [1291161600000, dec_Input]
    ];


    data = [ {
        label: "Total Sales",
        data: d2,
        color: "#01bc8c"
    }];

    Options = {
        xaxis: {
            min: (new Date(2009, 12, 1)).getTime(),
            max: (new Date(2010, 11, 2)).getTime(),
            mode: "time",
            tickSize: [1, "month"],
            monthNames: months,
            tickLength: 0
        },
        yaxis: {

        },
        series: {
            lines: {
                show: true,
                fill: false,
                lineWidth: 2
            },
            points: {
                show: true,
                radius: 4.5,
                fill: true,
                fillColor: "#ffffff",
                lineWidth: 2
            }
        },
        grid: {
            hoverable: true,
            clickable: false,
            borderWidth: 0
        },
        legend: {
            container: '#basicFlotLegend',
            show: true
        },

        tooltip: true,
        tooltipOpts: {
            content: '%s: %y'
        }

    };


    var holder = $('#line-chart2');

    if (holder.length) {
        $.plot(holder, data, Options );
    }


});
//line chart end

//start area chart
var da1 = [["Jan", 50],["Feb", 80],["Mar", 60],["Apr", 90],["May", 60],["Jun", 80],["Jul", 80]];
var da2 = [["Jan", 20],["Feb", 40],["Mar", 30],["Apr", 40],["May", 30],["Jun", 30],["Jul", 50]];
$.plot("#area-chart", [{
    data: da1,
    label: "Product 1",
    color: "#418BCA"
},{
    data: da2,
    label: "Product 2",
    color: "#fafafa"
}], {
    series: {
        lines: {
            show: !0,
            fill: .8
        },
        points: {
            show: !0,
            radius: 4
        }
    },
    grid: {
        borderColor: "#ddd",
        borderWidth: 1,
        hoverable: !0
    },
    tooltip: !0,
    tooltipOpts: {
        content: "%x : %y",
        defaultTheme: false
    },
    xaxis: {
        tickColor: "#ddd",
        mode: "categories"
    },
    yaxis: {
        tickColor: "#ddd"
    },
    shadowSize: 0
});
//end  area chart
//start spline area chart
var ds1 = [["Jan", 50],["Feb", 80],["Mar", 60],["Apr", 90],["May", 60],["Jun", 80],["Jul", 70]];
var ds2 = [["Jan", 20],["Feb", 40],["Mar", 30],["Apr", 40],["May", 30],["Jun", 30],["Jul", 50]];
$.plot("#chart-spline", [{
    data: ds1,
    label: "Product 1",
    color: "#EF6F6C"
},{
    data: ds2,
    label: "Product 2",
    color: "#fafafa"
}], {
    series: {
        lines: {
            show: !1
        },
        splines: {
            show: !0,
            tension: .4,
            lineWidth: 2,
            fill: .8
        },
        points: {
            show: !0,
            radius: 4
        }
    },
    grid: {
        borderColor: "#ddd",
        borderWidth: 1,
        hoverable: !0
    },
    tooltip: !0,
    tooltipOpts: {
        content: "%x : %y",
        defaultTheme: false
    },
    xaxis: {
        tickColor: "#ddd",
        mode: "categories"
    },
    yaxis: {
        tickColor: "#ddd"
    },
    shadowSize: 0
});
//end spline area chart
//real time
var data = [],
    totalPoints = 300;

function getRandomData() {
    if (data.length > 0)
        data = data.slice(1);

    // do a random walk
    while (data.length < totalPoints) {
        var prev = data.length > 0 ? data[data.length - 1] : 50;
        var y = prev + Math.random() * 10 - 5;
        if (y < 0)
            y = 0;
        if (y > 100)
            y = 100;
        data.push(y);
    }

    // zip the generated y values with the x values
    var res = [];
    for (var i = 0; i < data.length; ++i)
        res.push([i, data[i]])
    return res;
}

// setup control widget
var updateInterval = 50;

// setup plot
var options = {
    colors: ["#67C5DF"],
    series: {
        shadowSize: 0,
        lines: {
            show: true,
            fill: true,
            fillColor: {
                colors: [{
                    opacity: 0.5
                }, {
                    opacity: 0.5
                }]
            }
        }
    },
    yaxis: {
        min: 0,
        max: 90
    },
    xaxis: {
        show: false
    },
    grid: {
        backgroundColor: '#fff',
        borderWidth: 1,
        borderColor: '#fff'
    }
};


var plot4 = $.plot($("#realtime"), [getRandomData()], options);

function update() {
    plot4.setData([getRandomData()]);
    // since the axes don't change, we don't need to call plot.setupGrid()
    plot4.draw();
    setTimeout(update, updateInterval);
}
update();
	</script>
	
	
	
	<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flot.tooltip/js/jquery.flot.tooltip.js') }}"></script>
	<!--<script language="javascript" type="text/javascript" src="{{ asset('assets/js/pages/customcharts.js') }}">-->
	
	<!--<script language="javascript" type="text/javascript" src="{{ asset('assets/js/newchartjs/app.js') }}"></script>-->
	
	</script><script language="javascript" type="text/javascript" src="{{ asset('assets/js/pages/noconflict.js') }}"></script>
	<script language="javascript" type="text/javascript" src="{{ asset('assets/js/newchartjs/Chart.js') }}"></script>

	
	<script language="javascript" type="text/javascript" src="{{ asset('assets/js/newchartjs/Chart.js') }}"></script>
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
					  labelString: 'Dollers'
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
  
	
</script>	
	
	
<script>
    $(function () {

	Chart.defaults.global.legend.display = false;
    //start line chart
    var lineChartData1 = {
        labels: [<?php echo $customerxaxisdata; ?>],
        datasets: [
            {
                fill:true,
                tension:0,
                pointBackgroundColor:"transparent",
                pointBorderColor:"#3aca60",
                borderJoinStyle: 'miter',
                pointBorderWidth:"1",
                label:"",
                data : [<?php echo $cutsomeryaxisdate; ?>],
                backgroundColor:"transparent",
				borderColor:"#3aca60"
            },
            
        ]

    };

    function draw() {

        var selector = '#line-chart';

        $(selector).attr('width', $(selector).parent().width());
        var myLine1 = new Chart($("#line-chart"), {
            type: 'line',
            data: lineChartData1,
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
	$("#dash").addClass("active"); 
});
    </script>
	  </script>
	<script>
	$("#submit").on("click", function (event) {
		
	var from = $("#datepicker2").val();
var to = $("#datepicker3").val();

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
	
	<script>
	$("#submi").on("click", function (event) {
		
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