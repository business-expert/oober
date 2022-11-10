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
<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>-->
@stop

{{-- Page content --}}
@section('content')

 
			<section class="content new-provider">		
            <!-- /menu footer buttons -->
       <div class=" no-pad  below-four">
			<div class="content-header reg-pad">New Provider Registrations</div>
			<button onclick="window.history.back();">Back</button>
			<div class="table-cntnr">
				<div class="add-new-comp">
				<div class="plus"><span>+</span></div>
				<a href="#" id="comp-click">Add a new company</a>
				</div>
				
				<div class="no-pad  below-four add-new over-lay new-overlay">
		 <div class="cross-btn" id="cross-worker"><span>x</span></div>
			<div class="content-header">Add a new company</div>

				 {{  Form::open(array('action'=>'JoshController@add_company', 'id'=>'addcompa', 'method' => 'post','files' => 'true')) }}
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

				 {!! Form::submit('Add', array('class'=>'send-btn','id'=>'submit','name'=>'Add')) !!}
</div>
		 </div>

    <script src="http://code.jquery.com/jquery-1.12.4.js"></script>

	<script>
	$(document).ready(function(){
		/*$("#nextform").click(function(){
			$(".part1").hide();
			$(".part2").show();
		});*/
		$("#cross-worker").click(function(){
			$(".part1").show();
			$(".part2").hide();
		});
		
	});
</script>

	
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>
				<div class="results">{{ $resultCount }} Items</div>
				<table id="example" class="display" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date Entered</th>
                <th>Provider Name</th>
                <th>City</th>
                <th>State</th>
            </tr>
        </thead>
       
        <tbody>
           		
					@foreach($user as $userr)
<tr>
<td><a href="{{ URL::to('admin/company_details/' .$userr['id']) }}">{{ $userr['first_name'] }}</a></td>
						
						<td>{{ $userr['email'] }}</td>
						<td><?php echo date_format($userr['created_at'],'Y-m-d') ?></td>
						<td>{{ $userr['company_name'] }}</td>
						<td>{{ $userr['cityuser'] }}</td>
                        <td>{{ $userr['state'] }}</td>
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
			      </section>			
        <!-- top navigation -->	
        <!-- /top navigation -->			 
        <!-- page content -->
    <!-- end of global js   -->
    <!-- begining of page level js -->
     
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
	  alert('Password should be in 30 characters .'); shownext=false; return false;
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
	  alert('City should be upto 30 characters .'); shownext=false;  return false;
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
	 var nameRegex = /^[a-zA-Z ]+$/;
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
	  // if(bank==''){
	    // alert('Please enter your Bank Name.');  return false;
	  // }
	  // if(bank.trim() == ""){
	   // alert('Please enter your Bank Name.');  return false;
	  // }
	     // if(acno==''){
	    // alert('Please enter account number.');  return false;
	  // }
	  // if(acno.trim() == ""){
	   // alert('Please enter account number.');  return false;
	  // }
	    // if(rount==''){
	    // alert('Please enter rounting number.');  return false;
	  // }
	  // if(rount.trim() == ""){
	   // alert('Please enter rounting number.');  return false;
	  // }
	   // if(billadd==''){
	    // alert('Please enter billing address.');  return false;
	  // }
	  // if(billadd.trim() == ""){
	   // alert('Please enter billing address.');  return false;
	  // }
	    // if(insurance==''){
	    // alert('Please upload insurance image.');  return false;
	  // }
	   // if(service==''){
	    // alert('Please select the service.');  return false;
	  // }
	});
	</script>
 <script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.js') }}"></script>
 <script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.stack.js') }}"></script>
 <script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.crosshair.js') }}"></script>
	<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.time.js') }}"></script>
<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.selection.js') }}"></script>
	
	<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.symbol.js') }}"></script>
				<script  src="{{ asset('assets/vendors/flotchart/js/jquery.flot.resize.js') }}"></script>
	<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.categories.js') }}"></script>
	<script src="{{ asset('assets/vendors/splinecharts/jquery.flot.spline.js') }}"></script>
	<style type="text/css">
.dataTables_length label {
    width: 130px !important;
}
.amcharts-export-menu li:last-child>a{display:none !important;}
#chartdiv {
	width	: 100%;
height	: 500px;}

	#secondchartdiv {
	width	: 100%;
	height	: 500px;
}


</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script>
	$(document).ready(function() {
    $('#example').DataTable( {
        "lengthMenu": [[25,50,75,100], ['25','50','75','100']]
    });
	
	$('.dataTables_filter').remove();
	$('.dataTables_info').remove();
	$("#example_length").find("label").get(0).lastChild.remove();
					$(".clone").find("label").get(0).lastChild.remove();
	var $hheight = $('.wrapper').height()+160;
	$('.left-side').height($hheight);
	
	
} );
	</script>

<script>
$(document).ready( function(){
	var $height = $('.wrapper').height();
	$('.sidebar').height($height);
//	alert(height);
})

</script>

<script type="text/javascript">
		$(function(){
			$('#comp-click').click( function(){
				
				$('.over-lay').css({'display':'block'});
			});
			$('#cross-worker').click(function(){
				$('.over-lay').css({'display':'none'});
				
			});
			
		});
	
	</script>	
