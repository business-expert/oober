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
			<div class="content-header active-pad">Transactions</div>
			<!--<button onclick="window.history.back();">Back</button>-->
			<div class="table-cntnr">
				<table id="example" class="display" data-page-length="15" data-order="[[ 1, &quot;asc&quot; ]]">
				<div class="num-item">{{$count}}<a href="{{ URL::to('admin/all-tra-csv') }}" style="float:right">Download</a></div>
			
				<thead>
					<tr>
						<th><a href="#">Date</a></th>
						<th>Customer rate </th>
						
						<th>City</th>
						<th>State</th>
						
						<th>Type</th>
						<th>Amount</th>
						<th>Company</th>
						<th>Worker</th>
						<th>Avg rating</th>
					</tr>
					 </thead>
					 <tbody>
					
					@foreach($result as $user=>$userr)
					<tr>
					<td>@if(isset($userr->order_date)){{ $userr->order_date }}@endif</td>
					<td>@if(isset($userr->first_name)){{ $userr->first_name }}@endif</td>
					
					<td>@if(isset($userr->city)){{ $userr->city }}@endif</td>
					<td>@if(isset($userr->state)){{ $userr->state }}@endif</td>
						
						
						
						<td>@if(isset($userr->service)){{ $userr->service }}@endif</td>
						<td>@if(isset($userr->workername)){{ $userr->total_price }}@endif</td>
						<td>copa</td>
						<td>@if(isset($userr->workername)){{ $userr->workername }}@endif</td>
						
						<td>@if(isset($userr->customer_rate)){{ $userr->customer_rate }}@endif</td>
					
				</tr>
				
@endforeach
			</tbody>
					
				</table>
				<div class="">
			
				
				
				<div
				
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
   $('.overlay-div').click( function(){
	 $('.over-lay ').css({'display':'none'}) ;
	$('.overlay-div').css({'display':'none'}) ;
	   
   });
      $('#cross-worker').click( function(){
		$('.over-lay ').css({'display':'none'}) ;
		$('.overlay-div').css({'display':'none'}) ;
		$(".part1").show();
		$(".part2").hide();
	   
   });

   $('#pop-worker').click(function(){
	   

		$('.over-lay ').css({'display':'block'})
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
	  // if(!name.match(nameRegex)){
	  // alert('Company Name should be alphabets only.'); shownext=false ;return false;
	  // }
	    
	  // if(!firstname.match(nameRegex)){
	  // alert('Name should be alphabets only.'); shownext=false; return false;
	  // }

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
			$("#Transaction").addClass("active"); 
		});
	
	</script>

 
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop
