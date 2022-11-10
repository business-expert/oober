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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
	 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>

@stop

{{-- Page content --}}
@section('content')
<style>
body{background:#eef4f9;}
label{
	line-height: 2.0;
}
.reset-btn
{
	background: #ff5966;
    border: 0px;
    outline: 0px;
    border-radius: 4px;
    width: 164px;
    text-align: center;
    margin: 20px auto 20px auto;
    padding: 7px 0px !important;
	float:none !important;
    display: block;
    color: #fff;
    cursor: pointer;
    transform: translateX(-50%);
}
.pass
{
	margin-left:40px;
	padding:0px !important;
	list-style-type:none;
	line-height: 2.5em;
}
.pass li
{
	margin-bottom:30px;
	clear:both;
	vertical-align:middle;
	color:#999;
	}
.pass li:first-child
{
	margin-bottom:5em;
}

.content-header + p
{
	margin-left:40px;
}

.pasword-change
{
	margin:40px 40px 40px 0px;
	width:70%;
}
</style>

        <!-- /menu footer buttons -->
		<section class="content _service">

            <!-- /menu footer buttons -->
         <div class="no-pad  below-four">
			<div class="content-header active-pad">Edit Worker</div>
			<!--<button onclick="window.history.back();">Back</button>-->
			<div class="table-cntnr">
				<table id="example" class="display" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]">
				<div class="num-item">{{$count}}<a href="{{ URL::to('admin/all-tweets-csv') }}" style="float:right">Download</a></div>
				
				<thead>
					<tr>
						<th><a href="#">Name</a></th>
						<th>Email </th>
						
						<th>Status</th>
						<th>Rating</th>
						
						<th># of Jobs</th>
						<th>Edit</th>
					</tr>
					 </thead>
					 <tbody>
					
					@foreach($result as $userr)
					<tr>
						<td>@if(isset($userr['first_name'])){{ $userr['first_name']}}@endif</td>
						<td>@if(isset($userr['email'])){{ $userr['email'] }}@endif</td>
						
						<td>@if(isset($userr['status'])){{ $userr['status'] }}@endif</td>
						<td>@if(isset($userr['rating'])){{ $userr['rating'] }}@endif</td>
						<td>@if(isset($userr['jobs'])) {{ $userr['jobs'] }} @endif</td>
						<td>@if(isset($userr['id']))<a href="{{ URL::to('admin/editworker/'.$userr['id']) }}" class="edit"> Edit</a>@endif</td>
					
				</tr>
				
@endforeach
			</tbody>
					
				</table>
				<div class="">
				<div class="add-new-comp">
				<div class="plus"><span>+</span></div>
				<a href="#" id="pop-worker">Add a new worker</a>
				  <div class="no-pad  below-four add-new over-lay add-worker">
		 <div class="cross-btn" id="cross-worker"><span>x</span></div>
			<div class="content-header">Add a new worker</div>
			
		 {{  Form::open(array('action'=>'JoshController@add_worker_provider', 'method' => 'post','name'=>'form1','files' => 'true',"id"=>"addsubmit")) }}
		 <div class="part1">
				<input type="text" name="first_name" id="first_name" placeholder="First Name">
				<input type="text" name="last_name" id="last_name" placeholder="Last Name">
				<input type="text" name="email" id="email" placeholder="Email">
				<input type="password" name="pass" id="pass" placeholder="Password">
				<input type="password" name ="confirmpass" id ="confirmpass" placeholder="Confirm password">
		        
		<p id="nextform">Next</p>
</div>
<div class="part2" style="display:none;">
				<input type="text" name="mobile" id="mobile" placeholder="Mobile">
				<input type="text" name="city" id="city" placeholder="City">
				<input type="text" name="state" id="state"  placeholder="State">
				<input type="text" name="country" id="country" placeholder="Country">
				<div class="services">
					Status: &#160; <label><input type="radio" name='status' value="Approved" > Approved </label>
					<label> <input type="radio" name='status' value="Denied" > Denied </label>
				</div>
			<!--<input type="submit" class="send-btn" id="submit" name="Add" />-->
				{!! Form::submit('Add', array('class'=>'send-btn','id'=>'submit','name'=>'Add')) !!}
		</div>

			
			
		 </div>
				</div>
				
				<!--<div class="add-new-comp" id="edit-worker">
				  <div class="no-pad below-four add-new over-lay edit-worker">
		 <div class="cross-btn" id="cross-worker"><span>x</span></div>
			<div class="content-header">Edit a new worker</div>
		
		  
		
		 <div class="part3">
		    
				<input type="text" name="firstname" id="firstname" value="" placeholder="First Name">
				<input type="text" name="lastname" id="lastname" value="" placeholder="Last Name">
				<input type="text" name="emaill" id="emaill" value="" placeholder="Email">
				<input type="password" name="password" id="password" value="" placeholder="Password">
				<input type="password" name ="confirmpassword" id ="confirmpassword" value="" placeholder="Confirm password">
		        
		<p id="nextform1">Next</p>
</div>
<div class="part4" style="display:none;">
				<input type="text" name="phone" id="phone" value=" " placeholder="Mobile">
				<input type="text" name="cityy" id="cityy" value="" placeholder="City">
				<input type="text" name="statee" id="statee" value="" placeholder="State">
				<input type="text" name="countryy" id="countryy" value="" placeholder="Country">
				<div class="services">
					Status: &#160; <label><input type="radio" name='statuss' value="Approved" > Approved </label>
					<label> <input type="radio" name='statuss' value="Denied" > Denied </label>
				</div>
			<input type="submit" class="send-btn" id="submit" name="Add" />
				
				<p id="submitt">Next</p>
				
				
		</div>

			
			
		 </div>
				</div>-->
				<div>
		
				<script src="http://code.jquery.com/jquery-1.12.4.js"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script>
$("#submit").keydown(function (e) {
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
				<script>
	$(document).ready(function() {
    $('#example').DataTable( {
        "lengthMenu": [[25, 50, 75, 100], [25, 50, 75, 100]]
    });
	
	$('.dataTables_filter').remove();
	$('.dataTables_info').remove();
	
} );
	</script>
			<script>
   $('.edit').click( function(){
	   
	
		$('.edit-worker').css({'display':'block'})
   });
   
   // $('#pop-worker').click( function(){
		// $('.over-lay ').css({'display':'none'}) ;
		// $('.overlay-div').css({'display':'none'}) ;
   // });
      $('#cross-worker').click( function(){
		$('.over-lay ').css({'display':'none'}) ;
		$('.overlay-div').css({'display':'none'}) ;
		$(".part1").show();
		$(".part2").hide();
		$('.edit-worker').css({'display':'none'}) ;
		$(".part3").show();
		$(".part4").hide();
	    
   });
   
   $('.cross-btn').click( function(){
		$('.edit-worker').css({'display':'none'}) ;
		$(".part3").show();
		$(".part4").hide();
	    
   });

   $('#pop-worker').click(function(){
		$('.add-worker').css({'display':'block'})
		$('.overlay-div').css({'display':'block'})
   });
   
   
   
   </script>
<script type="text/javascript">		
	$("#nextform").on("click", function (event) {
			// $(".part1").hide();
			// $(".part2").show();
			//alert('sdsd'); return false;
 var shownext=true;
     var name = $("#first_name").val(); 
     var password=$("#pass").val();
     var confirmpass=$("#confirmpass").val();
	 var last_name=$("#last_name").val();
	 // //var firstname=$("#firstname").val();
	 var email = $("#email").val();
	 
	 var nameRegex = /^[a-zA-Z]+$/;
	 var con=/^([0-9]+)$/;
	 var ema=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 
      if(name==''){
	    alert('Please enter your first name');  return false;
	  }
	   if(name.trim() == ""){
	    alert('Please enter worker first name.'); shownext=false; return false;
	   }
	   if(!name.match(nameRegex)){
	   alert('Worker first name should be alphabets only.'); shownext=false ;return false;
	   }
	   if(name.length>30 ){
	  alert('Worker first name should be upto 30 characters .');  return false;
	  }
	    
	  // if(!firstname.match(nameRegex)){
	  // alert('Name should be alphabets only.'); shownext=false; return false;
	  // }
	  if(last_name==''){
	    alert('Please enter worker last name');  return false;
	  }
	  if(last_name.trim() == ""){
	    alert('Please enter worker last name.'); shownext=false; return false;
	   }
	  if(!last_name.match(nameRegex)){
	   alert('Worker last name should be alphabets only.'); shownext=false ;return false;
	   }
	    if(last_name.length>30 ){
	  alert('Worker last name should be upto 30 characters .');  return false;
	  }

	  // if(!name.match(nameRegex)){
	  // alert('Company Name should be alphabets only.'); shownext=false ;return false;
	  // }
	    
	  // if(!firstname.match(nameRegex)){
	  // alert('Name should be alphabets only.'); shownext=false; return false;
	  // }

	   if(email==''){
	     alert('Please enter worker email.'); shownext=false; return false;
	   }
	    if(email.trim() == ""){
	    alert('Please enter worker email.'); shownext=false; return false;
	   }
	   if(!email.match(ema)){
	     alert('Please provide valid email.'); shownext=false; return false;
	   }
	   // if(mobile==''){
	    // alert('Please enter your mobile number.'); shownext=false; return false;
	  // } 
		 
	   // if(!mobile.match(con)){
	    // alert('Please provide valid phone number.'); shownext=false; return false;
	  // }
	  if(password==''){
	  
	   alert('Please enter worker password.'); shownext=false; return false;
	   }
	   if(password.trim() == ""){
	    alert('Please enter worker password.'); shownext=false; return false;
	   }
	   if(password==parseInt(password)){
	   alert('Password should be alphanumeric.'); shownext=false; return false;
	 }
	 if(password.match(nameRegex)){
	   alert('Password should be alphanumeric.'); shownext=false; return false;
	 }
	  if(password.length<6 ){
	  alert('Password should be atleast 6 characters.');  return false;
	  }
	  if(password.length>30 ){
	  alert('Password should be upto 30 characters.');  return false;
	  }
	  if(confirmpass==''){
	  
	  alert('Please enter your confirm password.'); shownext=false; return false;
	  }
	  if(confirmpass.trim() == ""){
	    alert('Please enter your confirm password.'); shownext=false; return false;
	  }
	  // if(confpassword==parseInt(confpassword)){
	   // alert('Confirm Password should be alphanumeric.'); shownext=false; return false;
	 // }
	 // if(confpassword.match(nameRegex)){
	   // alert('Confirm Password should be alphanumeric.'); shownext=false; return false;
	 // }
	 if(confirmpass!=password){
		 
		   alert('Both Passwords should be same.'); shownext=false; return false;
	 }
  
	  
	  if(shownext==true){
		   $(".part1").hide();
		$(".part2").show();
		  
	   }
	   
		 // return false;
	// */
	});					

	</script>  
		<script type="text/javascript">		
	$("#submit").on("click", function (event) {

  
     var mobile = $("#mobile").val(); 
     var city=$("#city").val();
     var state=$("#state").val();
	 var country=$("#country").val();
	 // //var firstname=$("#firstname").val();
	 var status = $("#status").val();
	 
	 var nameRegex = /^[a-zA-Z]+$/;
	 var con=/^([0-9]+)$/;
	 var ema=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 
      
	    if(mobile==''){
	    alert('Please enter worker mobile number.');  return false;
	   } 
	   if(mobile.trim() == ""){
	    alert('Please enter worker mobile number.');  return false;
	   }
		 
	    if(!mobile.match(con)){
	     alert('Please provide valid mobile number.');  return false;
	   }
	    if(mobile.length<10 ){
	  alert('Mobile no should be atleast 10 digits .');  return false;
	  }
	   
	     if(mobile.length>15 ){
	  alert('Mobile no should be upto 15 digits .');  return false;
	  }
	   
	  if(city==''){
	  
	   alert('Please enter worker city.');  return false;
	   }
	   if(city.trim() == ""){
	    alert('Please enter worker city.'); return false;
	   }
	    if(!city.match(nameRegex)){
	  alert('City should be alphabets only.');  return false;
	  }
	     if(city.length>30 ){
	  alert('City should be upto 30 characters .');  return false;
	  }
	   if(state==''){
	  
	   alert('Please enter worker state.'); return false;
	   }
	   if(state.trim() == ""){
	    alert('Please enter worker state.');  return false;
	   }
	     if(!state.match(nameRegex)){
	  alert('State should be alphabets only.');  return false;
	  }
	  if(state.length>30 ){
	  alert('State should be upto 30 characters .');  return false;
	  }
	   //if(password==parseInt(password)){
	   // alert('Password should be alphanumeric.'); shownext=false; return false;
	 // }
	 // if(password.match(nameRegex)){
	   // alert('Password should be alphanumeric.'); shownext=false; return false;
	 // }
	  if(country==''){
	  
	  alert('Please enter worker country.');  return false;
	  }
	  if(country.trim() == ""){
	    alert('Please enter worker country.');  return false;
	  }
	     // if(!state.match(nameRegex)){
	  // alert('State should be alphabets only.');  return false;
	  // }
	  if(country.length>30 ){
	  alert('Country should be upto 30 characters .');  return false;
	  }
	if(status==''){
	  
	  alert('Please choose worker status.');  return false;
	  }
	  if($('input:radio[name=status]:checked').val() != 'Approved' && $('input:radio[name=status]:checked').val() != 'Denied')
	  {
		  
		  alert('Please choose the status.');  return false;
	  } 
	   
		 // return false;
	// */
	});					

	</script>
<script>
$("#nextform1").on("click", function (event) {
			// $(".part1").hide();
			// $(".part2").show();
			//alert('sdsd'); return false;

    var shownext1=true;
     var name = $("#firstname").val(); 
     var password=$("#password").val();
     var confirmpass=$("#confirmpassword").val();
	 var last_name=$("#lastname").val();
	 // //var firstname=$("#firstname").val();
	 var email = $("#emaill").val();
	 
	 var nameRegex = /^[a-zA-Z]+$/;
	 var con=/^([0-9]+)$/;
	 var ema=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 
      if(name==''){
	    alert('Please worker enter your first name');  return false;
	  }
	  // if(!name.match(nameRegex)){
	  // alert('Company Name should be alphabets only.'); shownext=false ;return false;
	  // }
	    
	  // if(!firstname.match(nameRegex)){
	  // alert('Name should be alphabets only.'); shownext=false; return false;
	  // }
	  
	   if(email==''){
	     alert('Please enter your email.'); shownext1=false; return false;
	   }
	   if(!email.match(ema)){
	     alert('Please provide valid email.'); shownext1=false; return false;
	   }
	   // if(mobile==''){
	    // alert('Please enter your mobile number.'); shownext=false; return false;
	  // } 
		 
	   // if(!mobile.match(con)){
	    // alert('Please provide valid phone number.'); shownext=false; return false;
	  // }
	  if(password==''){
	  
	   alert('Please enter your password.'); shownext1=false; return false;
	   }
	   if(password.trim() == ""){
	    alert('Please enter your password.'); shownext1=false; return false;
	   }
	   //if(password==parseInt(password)){
	   // alert('Password should be alphanumeric.'); shownext=false; return false;
	 // }
	 // if(password.match(nameRegex)){
	   // alert('Password should be alphanumeric.'); shownext=false; return false;
	 // }
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
  
	  
	  if(shownext1==true){
		   $(".part3").hide();
		$(".part4").show();
		  
	   }
	    $("#submitt").on("click", function (event) {
			
			});
	   $("#submitt").on("click", function (event) {
		   var host='http://88.198.133.25/ober/public';
		   var idd = $("#idd").val(); 
		   alert(idd); return false;
	   $.ajax({
            type: "POST",
            url: host + '/admin/edit_workers',
            
            success: function( msg ) {
                $("#ajaxResponse").append("<div>"+msg+"</div>");
            }
        });
		});
		 // return false;
	// */
	});					

</script>	
	 
   </script>	
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
        


         
    
	
	 

    <!-- end of global js -->
    <!-- begining of page level js -->
     
<script type="text/javascript">
		$(document).ready(function(){
			$("#AppUsers").addClass("active"); 
		});
	
	</script>



 
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop
