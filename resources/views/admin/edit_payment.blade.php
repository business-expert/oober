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
		 {{  Form::open(array('action'=>'JoshController@editpayment', 'method' => 'post','name'=>'form1','files' => 'true',"id"=>"addsubmit")) }}
		 @foreach($Record as $k=>$user)
		 <tr><tr>
<td><input type="hidden" name="id" value="{{$id}}"> </td></tr>
				 <tr><td><label>Bank Name</label></td><td><input type="text" name="bankname" id="bankname" value="{{$user->bank_name}}" placeholder=""></td></tr>
 <tr><td><label>Account number</label></td><td><input type="text" name="account_number" id="account_number" value="@if(isset($user->account_number)){{$user->account_number}} @endif "placeholder=""></td></tr>
 <tr><td><label>Rounting Number</label></td><td><input type="text" name="rounting_number" id="rounting_number" value="{{$user->rounting_number}}" placeholder=""></td></tr>
				
 <tr><td><label>Billing Address</label></td><td><input type="text" name="billing_address" id="billing_address" value="@if(isset($user->billing_address)){{$user->billing_address}} @endif " placeholder=""></td></tr>
		        

			

				
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
			alert('sdsd'); return false;
 
     var address = $("#address").val(); 
     var password=$("#pass").val();
     var confirmpass=$("#confirmpass").val();
	 var last_name=$("#last_name").val();
	 // //var firstname=$("#firstname").val();
	 var email = $("#email").val();
	 
	 var nameRegex = /^[a-zA-Z]+$/;
	 var con=/^([0-9]+)$/;
	 var ema=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 
      if(address==''){
	    alert('Please enter your first name');  return false;
	  }
	  

	   if(email==''){
	     alert('Please enter your email.'); shownext=false; return false;
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
	  
	   alert('Please enter your password.'); shownext=false; return false;
	   }
	   if(password.trim() == ""){
	    alert('Please enter your password.'); shownext=false; return false;
	   }
	   //if(password==parseInt(password)){
	   // alert('Password should be alphanumeric.'); shownext=false; return false;
	 // }
	 // if(password.match(nameRegex)){
	   // alert('Password should be alphanumeric.'); shownext=false; return false;
	 // }
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
<script>
$("#nextform1").on("click", function (event) {
			// $(".part1").hide();
			// $(".part2").show();
			//alert('sdsd'); return false;

    
     var bankname = $("#bankname").val(); 
     var account_number=$("#account_number").val();
     var rounting_number=$("#rounting_number").val();
	 var billing_address=$("#billing_address").val();
	 
	 
	 var nameRegex = /^[a-zA-Z]+$/;
	 var con=/^([0-9]+)$/;
	 var ema=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 
      if(bankname==''){
	    alert('Please enter your bank name');  return false;
	  }
	  if(bankname.trim() == ""){
	    alert('Please enter your bank name.');  return false;
	  }
	 

	   if(account_number==''){
	     alert('Please enter your account number.');  return false;
	   }
	   if(account_number.trim() == ""){
	    alert('Please enter your account number.');  return false;
	  }
	   
	  if(rounting_number==''){
	  
	   alert('Please enter your rounting number.'); return false;
	   }
	   if(rounting_number.trim() == ""){
	    alert('Please enter your rounting number.');  return false;
	   }
	  
	  if(billing_address==''){
	  
	  alert('Please enter your billing address.');  return false;
	  }
	  if(billing_address.trim() == ""){
	    alert('Please enter your billing address.');  return false;
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
