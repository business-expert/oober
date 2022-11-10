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
         <div class="">
			<div class="content-header active-pad">Edit Profile</div>
			<!--<button onclick="window.history.back();">Back</button>-->
			<div class="table-cntnr editprof">
			<table>	
		 {{  Form::open(array('action'=>'JoshController@editprofile', 'method' => 'post','name'=>'form1','files' => 'true',"id"=>"addsubmit")) }}
		 @foreach($Record as $k=>$user)
		 <tr><tr>
<td><input type="hidden" name="id" value="{{$id}}"> </td></tr>
<tr><td><label>Company Name</label></td><td><input type="text" name="company_name" id="company_name" value="{{$user->company_name}}" placeholder=""></td></tr>
				 <tr><td><label>Address</label></td><td><input type="text" name="address" id="address" value="{{$user->address}}" placeholder=""></td></tr>
 <tr><td><label>City</label></td><td><input type="text" name="city" id="city" value="@if(isset($user->cityuser)){{$user->cityuser}}@endif"placeholder="City"></td></tr>
 <tr><td><label>Email</label></td><td><input type="text" name="email" id="email" value="{{$user->email}}" placeholder="Email"></td></tr>
				
 <tr><td><label>State</label></td><td><input type="text" name="state" id="state" value="@if(isset($user->state)){{$user->state}}@endif" placeholder="State"></td></tr>
		        
		
 <tr><td><label>Mobile</label></td><td><input type="text" name="phone" id="phone" value="@if(isset($user->mobile)){{$user->mobile}}@endif" placeholder="Mobile"></td></tr>
 <tr><td><label>EIN</label></td><td><input type="text" name="ein" id="ein" value="@if(isset($user->ein)){{$user->ein}}@endif" placeholder="EIN"></td></tr>
			

				
				@endforeach
<tr><td>
			<!--<input type="submit" class="send-btn" id="submit" name="Add" />-->
				{!! Form::submit('Edit', array('class'=>'send-btn','id'=>'submit','name'=>'Edit')) !!}</td></tr>
				</table>
		</div>

			
			
		
			
			
		 </div>
				
		
				<script src="http://code.jquery.com/jquery-1.12.4.js"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
				<script>
	$(document).ready(function() {
    $('#example').DataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
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
	$("#submit").on("click", function (event) {
			// $(".part1").hide();
			// $(".part2").show();
			
 
     var company_name = $("#company_name").val(); 
     var address=$("#address").val();
     var city=$("#city").val();
	 var email=$("#email").val();
	  var state=$("#state").val();
	 // //var firstname=$("#firstname").val();
	 var phone = $("#phone").val();
    var ein = $("#ein").val();
	 var nameRegex = /^[a-zA-Z ]+$/;
	 var con=/^([0-9]+)$/;
	 var ema=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 
      if(company_name==''){
	    alert('Please enter your company name.');  return false;
	  }
	  
      if(company_name.trim() == ""){
	    alert('Please enter your company name.');  return false;
	   }
	   if(company_name.length>30 ){
	  alert('Company Name should be in 30 characters .'); shownext=false; return false;
	  }
	   if(address==''){
	     alert('Please enter your address.');  return false;
	   }
    if(address.trim() == ""){
	    alert('Please enter your address.'); return false;
	   }
	   if(address.length>40 ){
	  alert('Address should be upto 40 characters .'); shownext=false; return false;
	  }
	  if(city==''){
	  
	   alert('Please enter your city.');  return false;
	   }
	   if(city.trim() == ""){
	    alert('Please enter your city.');  return false;
	   }
	    if(!city.match(nameRegex)){
	  alert('City should be alphabets only.'); shownext=false; return false;
	  }
	    if(city.length>30 ){
	  alert('City should be upto 30 characters .'); shownext=false;  return false;
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
	 if(phone==''){
	    alert('Please enter worker mobile number.');  return false;
	   } 
	   if(phone.trim() == ""){
	    alert('Please enter worker mobile number.');  return false;
	   }
		 
	    if(!phone.match(con)){
	     alert('Please provide valid mobile number.');  return false;
	   }
	   if(ein!=''){
	  	  if(ein!=parseInt(zip)){
	   alert('Ein should be numeric only.'); return false;
	 }
    if(ein.length>9 ){
	  alert('EIN number should be 9 digits only.');  return false;
	  }
    if(ein.length<9 ){
	  alert('EIN number should be 9 digits only.');  return false;
	  }
	  }
	
	   
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
     




 
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop
