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
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/css/bootstrap-datepicker.css">

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
.dataTables_length label{width:93px;}
.transaction_show .clone{width:93px;}
body{position:relative;}
.over-lay {
    padding-left: 20px !important;
    position: fixed !important;
    z-index: 999999999;
    background: #fff;
    left: 50%;
    top: 50% !important;
    transform: translate(-50%, -50%);
    box-shadow: -1px 1px 5px #000;
    display: none;
    width: 30%;
}
	.panel-body{padding:15px 0px;}
	.go-btn{    background: #5ee83b;
    width: 50px;
    padding: 2px;}
</style>
<section class="content">
            <!-- /menu footer buttons -->
         <div class=" no-pad below-four compan">
			<div class="content-header">All Companies</div>
		
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
							 {{  Form::open(array('action'=>'JoshController@companies', 'id'=>'addcompa','method' => 'post','files' => 'true')) }}
			<p><input type="text" name="fromdate" id="datepicker" value="{{$date1}}" class="fromdate" placeholder="Start Date"></p>
			<span>to</span>
			<p><input type="text" name="todate" id="datepicker1" value="{{$date2}}" class="todate" placeholder="End Date"></p>
			{!! Form::submit('Go', array('class'=>'send-btn go-btn','id'=>'submi','name'=>'Go')) !!}
			<input type="hidden" id="inputDate" value="0" />
			</div>
                        <!-- Stack charts strats here-->
                       <div style="width:100%">
                        <!-- Stack charts strats here-->
                        <div class="panel panel-primary">
                            
                          <div class="">
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
				<div class="add-new-comp">
				<div class="plus"><span>+</span></div>
				<a href="#" id="comp-click">Add a new company</a>
				</div>
				
				<div class="no-pad  below-four add-new over-lay new-overlay">
		 <div class="cross-btn" id="cross-worker"><span>x</span></div>
			<div class="content-header">Add a new company</div>

				 {{  Form::open(array('id'=>'addcompa','files' => 'true')) }}
<div class="part1">
				<input placeholder="Company Name" type="text" name='name' id='name'>
				<input placeholder="Provider Name" type="text" name='firstname' id='firstname'>
				<input placeholder="Email" type="text" name='email' id='email'>
				<input placeholder="Mobile" type="text" name='mobile' id='mobile'>
				<input placeholder="Password" type="password" name='password' id='password'>
				<input placeholder="Confirm Password" type="password" name='confpassword' id='confpassword'>
				<input placeholder="Address" type="text" name='address' id='address'>
				<input placeholder="City" type="text" name='city' id='city'>
				<input placeholder="State" type="text" name='state' id='state' >

				<p id="nextform">Next</p>
</div>
<div class="part2" style="display:none;">
				<input placeholder="ZIP" type="text" name='zip' id='zip'>
				<input placeholder="EIN" type="text" name='ein' id='ein'>
				<input placeholder="Bank Name" type="text" name='bank' id='bank'>
				<input placeholder="Account No." type="text" name='acno' id='acno'>
				<input placeholder="Rounting No." type="text" name='rount' id='rount'>
				<input placeholder="Billing Address" type="text" name='billadd' id='billadd'>
				<label for="insurance">Upload Insurance: 
					<input placeholder="Insurance" type="file" name='insurance' id='insurance'>
					</label>
				<div class="services">
					Service: &#160; <label>Lawn <input type="checkbox" name='service[]' id='service' value="Lawn" ></label>
					<label>Snow <input type="checkbox" name='service[]' id='service' value="Snow" ></label>
				</div>
				<input placeholder="Bussiness Type" type="text" name='btype' id='btype'>

				 {!! Form::submit('Add', array('class'=>'send-btn','id'=>'submit','name'=>'Add','onclick'=>'addcompanies()')) !!}
</div>
		 </div>
				<!--<div class="num-item trans"> 
						{{ Form::open(array('method' => 'GET','url' => 'admin/compnies')) }}
						<button class="pull-left">Show All </button>
						<input type="hidden" name="showall" value="1">
						{{ Form::close() }}
						<input type="text" placeholder="search field" class="pull-right">
					
					
					</div>-->
				
				
				<table id="example" class="display compinies-table" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]">
				
					<thead><tr>
						<th>Name</th>
						<th>City</th>
						<th>State</th>
						<th>Worker</th>
						<th>Money</th>
						<th>Avg</th>
						<th>Email</th>
						<th>Phone#</th>
						
				</tr>
					</thead>
					<tbody>
					 
					@foreach($companies as $userrs=>$userr)
<tr>
						<td><a href="{{ URL::to('admin/company_details/' .$userr['id']) }}">{{ $userr['company_name'] }}</a></td>
						
						<td>{{ $userr['cityuser'] }}</td>
						<td>{{ $userr['state'] }}</td>
						<td>{{ $userr['workers'] }}</td>
                        <td>@if(isset($userr['money']))${{ $userr['money'] }} @endif</td>
						 <td><?php $rating= round($userr['rating'], 2);
                        echo $rating;
						?></td>
						
						 <td>{{ $userr['email'] }}</td>
						 <td><?php preg_match("/(\d{3})(\d{3})(\d{4})/",$userr['mobile'],$matches);
                             echo "$matches[1]-$matches[2]-$matches[3]";  ?></td>
						 
						
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="{{ asset('assets/js/pages/accountscharts.js') }}"></script>
	<script language="javascript" type="text/javascript" src="{{ asset('assets/js/newchartjs/Chart.js') }}"></script>

	 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/js/bootstrap-datepicker.js"></script>

	 
	 <script>
		$(document).ready(function() {
				$(document).ready(function() {
				$table = $('#example').DataTable( {
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


			} );
	</script>

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
	<script type="text/javascript">		
	$("#nextform").on("click", function (event) {
//			$(".part1").hide();
//			$(".part2").show();
 var shownext=true;
   var name = $("#name").val(); 
    var password=$("#password").val();
	var confpassword=$("#confpassword").val();
	 var mobile=$("#mobile").val();
	 var firstname=$("#firstname").val();
	var email = $("#email").val();
	var city=$("#city").val();
	var state=$("#state").val();
	var address=$("#address").val();

	 var nameRegex = /^[a-zA-Z ]+$/;
	 var con=/^([0-9]+)$/;
	 var ema=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 
      if(name==''){
	    alert('Please enter your company name'); shownext=false; return false;
	  }
	  if(name.trim() == ""){
	   alert('Please enter your company name.'); shownext=false; return false;
	  }
	  // if(!name.match(nameRegex)){
	  // alert('Company Name should be alphabets only.'); shownext=false ;return false;
	  // }
	  if(name.length>30 ){
	  alert('Company Name should be in 30 characters .'); shownext=false; return false;
	  }
	  
	  
	    if(firstname==''){
	    alert('Please enter your provider name'); shownext=false; return false;
	  }
	  if(firstname.trim() == ""){
	   alert('Please enter your provider name.'); shownext=false; return false;
	  }
	  if(!firstname.match(nameRegex)){
	  alert('Provider name should be alphabets only.'); shownext=false; return false;
	  }
	  if(firstname.length>30 ){
	  alert('Provider name should be in 30 characters .'); shownext=false; return false;
	  }

	  if(email==''){
	    alert('Please enter your email.'); shownext=false; return false;
	  }
	  if(email.trim() == ""){
	   alert('Please enter your email.'); shownext=false; return false;
	  }
	  if(!email.match(ema)){
	    alert('Please provide valid email.'); shownext=false; return false;
	  }
	   if(mobile==''){
	    alert('Please enter your mobile number.'); shownext=false; return false;
	  } 
		 
	   if(!mobile.match(con)){
	    alert('Please provide valid phone number.'); shownext=false; return false;
	  }
	   if(mobile.length>10 ){
	  alert('Mobile number should be 10 digits only.'); shownext=false; return false;
	  }
    if(mobile.length<10){
	  alert('Mobile number should be 10 digits only.'); shownext=false; return false;
	  }
	  if(password==''){
	  
	  alert('Please enter your password.'); shownext=false; return false;
	  }
	  if(password.trim() == ""){
	   alert('Please enter your password.'); shownext=false; return false;
	  }
	  if(password==parseInt(password)){
	   alert('Password should be alphanumeric.'); shownext=false; return false;
	 }
	 if(password.match(nameRegex)){
	   alert('Password should be alphanumeric.'); shownext=false; return false;
	 }
	 if(password.length<6 ){
	  alert('Password should be atleast 6 characters.'); shownext=false; return false;
	  }
	  if(password.length>30 ){
	  alert('Password should be in 30 characters .'); shownext=false;  return false;
	  }
	 if(confpassword==''){
	  
	  alert('Please enter your confirm password.'); shownext=false; return false;
	  }
	  if(confpassword.trim() == ""){
	   alert('Please enter your confirm password.'); shownext=false; return false;
	  }
	  if(confpassword==parseInt(confpassword)){
	   alert('Confirm Password should be alphanumeric.'); shownext=false; return false;
	 }
	 if(confpassword.match(nameRegex)){
	   alert('Confirm Password should be alphanumeric.'); shownext=false; return false;
	 }
	 if(confpassword!=password){
		 
		  alert('Both Passwords should be same.'); shownext=false; return false;
	 }
        if(address==''){
	    alert('Please enter your address.'); shownext=false; return false;
	  }
	  if(address.trim() == ""){
	   alert('Please enter your address.'); shownext=false; return false;
	  }
	  if(address.length>40 ){
	  alert('Address should be upto 40 characters .'); shownext=false; return false;
	  }
	  if(city==''){
	    alert('Please enter your city.'); shownext=false; return false;
	  }
	  if(city.trim() == ""){
	   alert('Please enter your city.'); shownext=false;return false;
	  }
	   if(!city.match(nameRegex)){
	  alert('City should be alphabets only.'); shownext=false; return false;
	  }
	     if(city.length>30 ){
	  alert('City should be upto 30 characters .'); shownext=false; return false;
	  }
      if(state==''){
	    alert('Please enter your state.'); shownext=false; return false;
	  }
	  if(state.trim() == ""){
	   alert('Please enter your state.'); shownext=false; return false;
	  }
	   if(!state.match(nameRegex)){
	  alert('State should be alphabets only.'); shownext=false; return false;
	  }
	  if(state.length>30 ){
	  alert('State should be upto 30 characters .'); shownext=false; return false;
	  }
	  if(shownext==true){
		  $(".part1").hide();
		$(".part2").show();
		  
	  }
	  
		 return false;
	});					

</script>
<script type="text/javascript">		
	$("#submit").on("click", function (event) {
    var zip = $("#zip").val(); 
	 var ein=$("#ein").val();
      var bank=$("#bank").val();
	   var acno=$("#acno").val();
	    var rount=$("#rount").val();
		 var billadd=$("#billadd").val();
		  var insurance=$("#insurance").val();
		   var service=$("#service").val();
	 var nameRegex = /^[a-zA-Z0-9]+$/;
	 var con=/^([0-9]+)$/;
	 var ema=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 
      // if(zip==''){
	    // alert('Please enter your zip.');  return false;
	  // }
	  // if(zip.trim() == ""){
	   // alert('Please enter your zip.');  return false;
	  // }
	  if(zip!=''){
	  if(zip.length>6 ){
	  alert('zip should be 6 characters only.');  return false;
	  }
    if(zip.length<6 ){
	  alert('zip should be 6 characters only.');  return false;
	  }
	  
	  // if(zip!=parseInt(zip)){
	   // alert('zip should be numeric only.'); return false;
	 // }
	 // if(!zip.match(nameRegex)){
	  // alert('ZIP code should be alphnumeric only.');  return false;
	  // }
	  }
	  // if(ein==''){
	    // alert('Please enter your EIN Number.');  return false;
	  // }
	  // if(ein.trim() == ""){
	   // alert('Please enter your EIN Number.');  return false;
	  // }
	  if(ein!=''){
	  if(!ein.match(con)){
	  alert('EIN number should be numeric.');  return false;
	  }
    if(ein.length>9 ){
	  alert('EIN number should be 9 digits only.');  return false;
	  }
    if(ein.length<9 ){
	  alert('EIN number should be 9 digits only.');  return false;
	  }
	  }
	  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
//function addcompanies(){
	 var name = $("#name").val(); 
    var password=$("#password").val();
	//var confpassword=$("#confpassword").val();
	 var mobile=$("#mobile").val();
	 var firstname=$("#firstname").val();
	var email = $("#email").val();
	var city=$("#city").val();
	var state=$("#state").val();
	var address=$("#address").val();
  var zip = $("#zip").val(); 
	 var ein=$("#ein").val();
      var bank=$("#bank").val();
	   var acno=$("#acno").val();
	    var rount=$("#rount").val();
		 var billadd=$("#billadd").val();
		  var insurance=$("#insurance").val();
		   var service=$("#service").val();
		   var btype=$("#btype").val();
  	var param = 'name='+name+'&firstname='+firstname+'&email='+email+'&mobile='+mobile+'&password='+password+'&address='+address+'&city='+city+'&state='+state+'&zip='+zip+'&ein='+ein+'&bank='+bank+'&acno='+acno+'&rount='+rount+'&billadd='+billadd+'&insurance='+insurance+'&service='+service+'&btype='+btype;
  $.ajax({
               type:'GET',
               url:'/ober/public/admin/addcompanies',
               data:param,
               success:function(data){
				    
                    
               }
            });

         //}
	
	 
	});
	</script>
    
	<script>
$("#addcompa").keydown(function (e) {
    if (e.which == 13) {
        var $targ = $(e.target);

        if (!$targ.is("textarea") && !$targ.is(":button,:submit")) {
            var focusNext = false;
            $(this).find(":input:visible:not([disabled],[readonly]), a").each(function(){
                if (this === e.target) {
                    focusNext = true;
                }
                else if (focusNext){
                    $(this).focus();
                    return false;
                }
            });

            return false;
        }
    }
});
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
                pointBorderColor:"#44b6af",
                borderJoinStyle: 'miter',
				 pointBorderColor:"#3aca60",
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
	$("#comp").addClass("active"); 
	$( "#datepicker" ).datepicker({format: 'yyyy-mm-dd'});
    $( "#datepicker1" ).datepicker({format: 'yyyy-mm-dd'});
	$(".dataTables_length").find("label").get(0).lastChild.remove();
	$(".clone").find("label").get(0).lastChild.remove();
});
$(window).resize(function(){
	$(".sidebar").height($(document).height());
});
$(".sidebar").height($(document).height()/1.5);
    </script>
	
	<script>



</script> 
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop