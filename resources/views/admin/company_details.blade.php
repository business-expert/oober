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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

{{-- Page content --}}
@section('content')
<style>
.uploade_insurance{
	display: block;
	margin: 50px 0 20px 80px;
	height: auto;
	width: auto;
	overflow:hidden;
	width:300px;position:relative;
}
.uploade_insurance:hover .fa{display:block;}
.uploade_insurance .fa {
    font-size: 20px;
    position: absolute;
    right: 20px;
    top: 10px; display:none;
}
._insurance label
{
font-size: 20px;
font-weight: 400;
text-decoration: underline;	
margin-left: 50px;
color:#888;
} 
.uploade_insurance img{width:400px;}
#upload_insurance
{
	display:none;
}
.submit_insurance
{
background: #ff5966;
border: 0px;
outline: 0px;
border-radius: 4px;
width: 100px;
text-align: center;
margin: 20px auto 20px 350px;
padding: 3px 12px;
display: block;
color: #fff;
cursor: pointer;
}
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
.amcharts-export-menu li:last-child>a{display:none !important;}
#chartdiv {
	width	: 100%;
height	: 500px;}

	#secondchartdiv {
	width	: 100%;
	height	: 500px;
}
.row-offcanvas-left{position: relative;}
form .part1, form .part2
{
	height: 330px;
}
.over-lay
{ 
	top: 50% !important;
	transform:translate(-50%, -50%) !important;
	position:fixed !important;
}
.add-new .services label {
    margin-top: 0px;
    margin-right: 10px;
    display: inline-block;
    font-size: 14px;
}
.comp-det .transaction_show label
{
     font-size: 14px; 
     text-transform: capitalize; 
     margin: 3px 0px 0px 0px !important; 
     float: none; 
}
.comp-det .services label
{
	    margin: 0px 0px 0px 0px !important;
}
.part2 .services
{
	margin: 0px 0px 25px 0px !important;
}
.reset-btn
{
	background: #ff5966;
    border: 0px;
    outline: 0px;
    border-radius: 4px;
    width: 164px;
    text-align: center;
    margin: 20px auto;
    padding: 7px 0px !important;
    padding: 12px;
    display: block;
    color: #fff;
    cursor: pointer;
    transform: translateX(-50%);
	clear:both;
}
.reset-btn1
{
	background: #ff5966;
    border: 0px;
    outline: 0px;
    border-radius: 4px;
    width: 164px;
    text-align: center;
    margin: 20px auto 20px 250px;
    padding: 7px 0px !important;
    padding: 12px;
    display: block;
    color: #fff;
    cursor: pointer;
    transform: translateX(-50%);
}
.uploader label
{
	padding-top: 25%;
	margin:0px !important;
	height:100%;
}
.transaction_show .dataTables_length label
{
	width:95px;
}
.transaction_show .clone
{
	width:100px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover
{
	color:#000 !important;
}

/* Base for label styling */
[type="checkbox"]:not(:checked),
[type="checkbox"]:checked {
  position: absolute;
  left: -9999px;
}
[type="checkbox"]:not(:checked) + label,
[type="checkbox"]:checked + label {
  position: relative;
  padding-left: 1.95em;
  cursor: pointer;
}

/* checkbox aspect */
[type="checkbox"]:not(:checked) + label:before,
[type="checkbox"]:checked + label:before {
  content: '';
  position: absolute;
  left: 0; top: 0;
  width: 1.25em; height: 1.25em;
  border: 1px solid #ccc;
  background: #fff;
  border-radius: 0px;
  box-shadow: inset 0 1px 3px rgba(0,0,0,.1);
}
/* checked mark aspect */
[type="checkbox"]:not(:checked) + label:after,
[type="checkbox"]:checked + label:after {
  content: '✔';
  position: absolute;
  top: .1em; left: 0.1em;
  font-size: 1.3em;
  line-height: 0.8;
  color: #ff5966;
  transition: all .2s;
}
/* checked mark aspect changes */
[type="checkbox"]:not(:checked) + label:after {
  opacity: 0;
  transform: scale(0);
}
[type="checkbox"]:checked + label:after {
  opacity: 1;
  transform: scale(1);
}
.panel-body{padding:15px 0px;}
	.go-btn{    background: #5ee83b;
    width: 50px;
    padding: 2px;}
</style>
<section class="content comp-det">
            <!-- /menu footer buttons -->
        <div class=" no-pad  below-four">
			<div class="content-header">Company Details</div>
			<div class="tab">
			<ul>
			
				<li class="pro tab-active">Profile</li>
				<li class="pay">Payment</li>
				<li class="ins">Insurance</li>
				<li class="service">Services</li>
				<li class="trans-tab">Transactions</li>
				<li class="worker-tab">Workers</li>
			</ul>
			</div>
			<div class="pro-content">
				<button onclick="goBack()">Back</button>
				<div class="ssedit">
				
				<a href="#" id="comp-click">Edit</a>
				</div>
				
				<div class="no-pad  below-four add-new over-lay new-overlay">
		 <div class="cross-btn" id="cross-worker"><span>x</span></div>
			<div class="content-header">Edit</div>

				 <!--{{  Form::open(array('id'=>'addcompa','files' => 'true')) }} -->
<div class="part3">
 @foreach($result as $workes=>$worke)
				<input placeholder="Company Name" type="text" name='name' value='{{ $companyname }}' id='name'>
				<input placeholder="Provider Name" type="text" name='firstname' value='{{ $companyname }}' id='firstname'>
				<input placeholder="Email" type="text" name='email' value='{{ $worke->email }}' id='email'>
				<input placeholder="Mobile" type="text" name='mobile' value='{{ $worke->mobile }}' id='mobile'>
				
				<input placeholder="Address" type="text" name='address' value='{{ $worke->address }}' id='address'>
				<input placeholder="State" type="text" name='state' value='{{ $worke->state }}' id='state'>
				<input placeholder="City" type="text" name='city' value='{{ $worke->cityuser }}' id='city'>

				<div class="text-center"><p id="nextforms" class="ssedit " style="margin:auto; float:none; margin-bottom:10px;">Next</p></div>
</div>
<div class="part4" style="display:none;">
				
				<input placeholder="Zip" type="text" name='zip' value='{{ $worke->postal }}' id='zip'>
				<input placeholder="EIN" type="text" name='ein' value='{{ $worke->ein }}' id='ein'>
				<input placeholder="Bank Name" type="text" name='bank' value='{{ $worke->bank_name}}' id='bank'>
				<input placeholder="Account No." type="text" name='acno' value='{{ $worke->account_number}}' id='acno'>
				<input placeholder="Rounting No." type="text" name='rount' value='{{ $worke->rounting_number}}' id='rount'>
				<input placeholder="Billing Address" type="text" name='billadd' value='{{$worke->billing_address}}' id='billadd'>
				
				<input placeholder="Bussiness Type" type="text" value='{{$worke->buisness_type}}' name='btype' id='btype'>
@endforeach
<a href="#" class='send-btn' id='subt'>Edit</a>
				<!-- {!! Form::submit('Edit', array('class'=>'send-btn','id'=>'subt','name'=>'Edit')) !!}-->
</div>
		 </div>
				
			
			
			<label>@if(!empty($companyname)){{ $companyname}} @endif</label>
			<div class="clearfix"></div>
			 @foreach($result as $workes=>$worke)
		 <div class="payment-info">
		 <ul><li class="clr-left">Status</li>
		 <li class="clr-right">
		 	 <select name="cars" id="cars">
  <option name="status" value="pending">pending</option>
  <option name="status"  value="active">active</option>
  </li>
</select> 
			<li class="clr-left">Company address</li>
		
			<li class="clr-right"><strong>{{ $worke->address }}</strong></li>
			<!--<li class="clr-left">Business Type</li>
			<li class="clr-right"><strong>{{ $worke->buisness_type }}</strong></li>
			<li class="clr-left">Name</li>
			<li class="clr-right"><strong>{{ $worke->first_name }}</strong></li>-->
			<li class="clr-left">Email</li>
			<li class="clr-right"><strong>{{ $worke->email }}</strong></li>
			<li class="clr-left">Phone</li>
			<li class="clr-right"><strong>{{ $worke->mobile }}</strong></li>
			<li class="clr-left">Ein/ssn</li>
			<li class="clr-right"><strong>{{ $worke->ein }}</strong></li>
			 {{  Form::open(array('action'=>'JoshController@reset_password', 'method' => 'post')) }}
			<li class="clr-left">New password</li>
			<li class="clr-right"><input type="password" name="password" id="pwd"><input type="hidden" name="id" value="{{$worke->id}}"></li>
			<li class="clr-left">Re type Password</li>
			<li class="clr-right"><input type="password" name="newpassword" id="newpwd"></li>
		 </ul>
		{!! Form::submit('RESET PASSWORD', array('class'=>'send-btn reset-btn','id'=>'submt','name'=>'RESET PASSWORD')) !!}
{{ Form::close() }}
		 </div>
		 
			</div>
<!--<div style="width:70%"><input type="submit" value="Change Status" class="send-btn reset-btn" onclick="changestatus()"></div>-->
			<div class="payment-cont">
				<p><button onclick="goBack()">Back</button>
			<div class="clearfix"></div>
			<label>@if(!empty($companyname)){{ $companyname}} @endif</label>
			<div class="clearfix"></div>
			
		 <div class="payment-info ontarget"> 
		 <ul>
			<li class="clr-left">Bank Name</li>
			<li class="clr-right"><strong>{{ $worke->bank_name }}</strong></li>
			<li class="clr-left">Account Number</li>
			<li  class="clr-right"><strong>{{ $worke->account_number }}</strong></li>
			<li class="clr-left">Rounting Number</li>
			<li  class="clr-right"><strong>{{ $worke->rounting_number }}</strong></li>
			<li class="clr-left">Billing Address</li>
			<li  class="clr-right"><strong>{{ $worke->billing_address }} {{ $worke->city }} {{ $worke->state }}</strong></li>
		 </ul>
		 
		 </div><p>
			
			</div>
			 
			
			
			<div class="ins-content"> 
			<button onclick="goBack()">Back</button>
			<label>@if(!empty($companyname)){{ $companyname}} @endif</label>
		{{  Form::open(array('action'=>'JoshController@insuranceadmin_upload','id'=>'insur', 'method' => 'post','files' => 'true')) }}
		
		
		
				<div class="uploade_insurance" style="width: auto;">
				<?php if(empty($result[0]->insurance)) { ?>
					
					<div class="uploader" style="
    background: #4a4a4a;
	color:#ffffff;
    width: 400px;
    height: 400px;
    display: inline-block;
    margin-top: 40px;
    margin-left: 80px;
    position: relative;
	text-align:center;
	font-size: 28px !important;
">
					<label style="margin: 0; color:#fff; padding-top: 145px; display: block; height: 100%;">Click to Add Proof of Insurance
						<input type='file' name="upload_insurance" onchange="readURL1()" id="upload_insurance" />
						<input type="hidden" name="id" value="{{$ids}}">
					</label>
					<!--<img src="{{ asset('/images/User_man_male_profile_account_person_people.png') }}" alt="">-->
					</div>
					
					<?php } else { ?>
					<img src="{{ $result[0]->insurance }}" id="old_ins" alt="">
					<?php } ?>
				
				
					<?php if(!empty($result[0]->insurance)) { ?>
						<label style="margin: 0;
							color: transparent;
							padding-top: 80px;
							display: block;
							height: 100%;
							background: rgba(0,0,0,0);
							position: absolute;
							top: 0;
							left: 0px;
							width: 400px;
							text-align:center;
							font-size: 28px !important;
						">
							Click to Update Proof of Insurance
								<!--<input type="file" name="upload_insurance" id="upload_insurance" />-->
								<input type='file' name="upload_insurance" onchange="readURL1()" id="upload_insurance" />
		<input type="hidden" name="id" value="{{$ids}}">


						</label>
					<?php } ?>
					<!--<label>Click to Upload<br/> Your Proof of <br/>Experience
						<input type="file" name="upload_insurance" id="upload_insurance" />
					</label>-->
					
{{ Form::close() }}

		
		 </div>
		 
		 <div class="service-content serv-tab"><button onclick="goBack()">Back</button>
			<div class="clearfix"></div>
			<label>@if(!empty($companyname)){{ $companyname}} @endif</label>
			<div class="clearfix"></div>
		 <div class="payment-info comp-service serv-tab">
		<p>please select the service(s) that you will provide to the Clients</p>
				 {{  Form::open(array('action'=>'JoshController@serviceupdate', 'method' => 'post','files' => 'true',"id"=>"addsubmit")) }}
			<ul>
			<input type="hidden" name="ids" value="{{$ids}}">
				<li>
				<?php if($worke->snow_service==0) { ?>
				<input type="checkbox" id="test2" name="snow" value="1" />
				<label for="test2">Snow Removal</label>
				</li>
				<?php } else{?>
				<input type="checkbox" id="test3" name="snow" value="1" checked="checked" />
				<label for="test3">Snow Removal<?php }?></label></li>
								<?php if($worke->lawn_service==0) { ?>
				<li><input type="checkbox" name="lawn" value="1" id="test4"><label for="test4">Yard Mowing</label></li>
				<?php } else{?>
				
				<li><input type="checkbox" name="lawn" value="1" checked="checked" id="test5"><label for="test5">Yard Mowing<?php }?></label></li>
			</ul>
			{!! Form::submit('Submit', array('class'=>'send-btn reset-btn','id'=>'submit','name'=>'submit')) !!}
{{ Form::close() }}
@endforeach

		</form>
		</div></div>
			<div class="transtab-cont">
			<div class="no-pad  below-four">
			<button onclick="goBack()">Back</button>
			<label>@if(!empty($companyname)){{ $companyname}} @endif</label>
			<div class="text-center">
			<div class="date static-pos">
			<p><input type="text" id="datepicker" class="fromdate" placeholder="Start Date"></p>
			<span>to</span>
			<p><input type="text" id="datepicker1" class="todate" placeholder="End Date"></p>
			<button onclick="getTransaction()">Go</button>
			</div>
			</div>
				<div class="table-cntnr transaction_show">

<a id='download' href="{{ URL::to('admin/all-transs-csv/'.$ids) }}"><i class="fa fa-download" aria-hidden="true"></i> &#160;Download</a>

				<table id="example" class="display" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]">
				
					<thead>
				<!--<div class="num-item edit-work"><button class="grey-btn">Show All</button><span class="pull-right"><i class="fa fa-arrow-down" aria-hidden="true"></i>Download</span><input type="text" class="pull-right"></div>-->
					<tr>
						<th>Date</th>
						<th>Customer Name</th>
						<th>Amount</th>
						<th>City</th>
						<th>State</th>
						<th>Type</th>
						
						<th>Worker</th>
					</tr>
					</thead>
					<tbody id="fill">
					@foreach($row as $worke)
					<tr>
						<td><a href="{{ URL::to('admin/transaction_detail/' .$worke['id']) }}">{{ $worke['order_date']  }}</a></td>
				
						
						<td>{{$worke['first_name'] }} </td>
						<td>${{$worke['total_price']}}</td>
						<td>{{$worke['city']}}</td>
						<td>{{$worke['state']}}</td>
						<td>{{$worke['service']}}</td>
						
					   <td>{{$worke['workername']}}</td>
					</tr>
					@endforeach
				</tbody>
				</table>
				<style>
	div.container {
        width: 80%;
    }
	</style>
				<!--<div class="pagination">
					<div class="pag-bdr">
						<div class="pull-left"><a href="#">FIRST</a></div>
						<div class="pull-left"><a href="#">PREV</a></div>
						<div class="pull-left count">1</div>
						<div class="pull-left"><a href="#">NEXT</a></div>
						<div class="pull-left"><a href="#">LAST</a></div>
						<div class="pull-right">
							<select>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>10</option>
							</select>
						
						</div>
						<div class="pull-right">SHOW</div>
						
					
				</div>
				</div>-->
			</div>

			
			
		 </div> 
			
			
			
			</div>
			<div class="work-cont"><div class="no-pad  below-four">
			<button onclick="goBack()">Back</button>
			<label>@if(!empty($companyname)){{ $companyname}} @endif</label>
			
			<div class="table-cntnr">
				<div class="add-new-comp">
				<div class="plus"><span>+</span></div>
				<a href="#" id="pop-worker">Add a new worker</a>
				  <div class="no-pad  below-four add-new over-lay">
		 <div class="cross-btn" id="cross-worker"><span>x</span></div>
			<div class="content-header">Add a new worker</div>
			
		 {{  Form::open(array('action'=>'JoshController@add_worker','id'=>'addwork', 'method' => 'post','files' => 'true',"id"=>"addsubmit")) }}
		 <div class="part1">
				<input type="text" name="first_name" id="first_name" placeholder="First Name">
				<input type="text" name="last_name" id="last_name" placeholder="Last Name">
				<input type="text" name="email" id="email" placeholder="Email">
				<input type="password" name="pass" id="pass" placeholder="Password">
				<input type="password" name ="confirmpass" id ="confirmpass" placeholder="Confirm password">
		        <input type="hidden" name="ids" value="{{$ids}}">
		<p id="nextform">Next</p>
</div>
<div class="part2" style="display:none;">
				<input type="text" name="mobile" id="mobile" placeholder="Mobile">
				<input type="text" name="city" id="city" placeholder="City">
				<input type="text" name="state" id="state"  placeholder="State">
				<input type="text" name="country" id="country" placeholder="Country">
				<div class="services">
					Status: &#160; <label><input type="radio" name='status' value="Approved" id="status"> Approved </label>
					<label> <input type="radio" name='status' value="Denied" id="status"> Denied </label>
				</div>
			<!--<input type="submit" class="send-btn" id="submit" name="Add" />-->
				{!! Form::submit('Add', array('class'=>'send-btn','id'=>'subbt','name'=>'Add')) !!}
		</div>

			
			
		 </div>
				</div>
				<div class="table-cntnr transaction_show">
				<!--<div class="num-item">{{ $workercount}}</div>-->
					<table id="example1" class="display" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]">
					
					<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>City</th>
						
						<th>State</th>
						<th>Status</th>
						<th>Rating</th>
						<th># of jobs</th>
						
					</tr>
					 </thead>
        <tbody>@foreach($rows as $worker)
					<tr>
					<td><a href="{{ URL::to('admin/worker_detail/' .$worker['id']) }}">{{ $worker['first_name'] }}</a></td>
						
						<td>{{$worker['email']}}</td>
						<td>{{$worker['city']}}</td>
						<td>{{$worker['state']}}</td>
						<td>{{$worker['status']}}</td>
						<td>{{$worker['rating']}}</td>
						<td>{{$worker['jobs']}}</td>
					
					</tr>
					@endforeach
					
				</tbody>
				</table>
				</div>
				<!--<div class="pagination">
					<div class="pag-bdr">
						<div class="pull-left">FIRST</div>
						<div class="pull-left">PREV</div>
						<div class="pull-left count">1</div>
						<div class="pull-left">NEXT</div>
						<div class="pull-left">LAST</div>
						<div class="pull-right">
							<select>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>10</option>
							</select>
						
						</div>
						<div class="pull-right">SHOW</div>
						
					
				</div>
				</div>-->
			</div>

			
			
		 </div>  </div>
			
			
			
		 </div>    
        </div>

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
$(document).ready(function(){
    $("button").click(function(){
		var host='http://88.198.133.25/ober/public';
		 var datepicker=$("#datepicker").val();
		 var datepicker1=$("#datepicker1").val();
		 var id=$("#id").val();
        $.ajax({
            type: "POST",
			data: {title: title, body: body, published_at: published_at},
            url: host + '/admin/datetransaction',
            
            success: function( msg ) {
                $("#ajaxResponse").append("<div>"+msg+"</div>");
            }
        });
    });

	$(".uploade_insurance > label:nth-child(2)").css({"paddingTop": $("#old_ins").height()/2 - 50});
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
		$(".part1").show();
		$(".part2").hide();
	   
   });

   $('#pop-worker').click(function(){

		$('.over-lay ').css({'display':'block'})
		$('.overlay-div').css({'display':'block'})
   });
   
   
   
   </script>
  

        <!-- top navigation -->
        <!-- /top navigation -->
		
        <!-- page content -->
        


           <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
    
	 <script>
  $(function() {
    $( "#datepicker1" ).datepicker();
  });
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
	<script src="{{ asset('assets/js/pages/customcharts.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
		<script>
				$(document).ready(function() {
		$(".uploade_insurance > label:nth-child(2)").css({"paddingTop": $("#old_ins").height()/2 - 50});
	
				$table = $('#example').DataTable( {
					"lengthMenu": [[25, 50, 75, 100], [25, 50, 75, 100]]
				});
				$("#example_wrapper").find(".dataTables_length").clone(true).appendTo("#example_wrapper").addClass("clone").attr("id","clone_show").removeClass("dataTables_length");
				$('#example_filter input').attr("placeholder","Search Field");
				$('.dataTables_info').remove();
				/* To remove larave back-to-top icon from page*/
				$("#back-to-top").remove();
				var $stext = $("#example_filter").find("label")[0],
					$stext1 = $("#example_length").find("label")[0],
					$stext2 = $("#clone_show").find("label")[0];
				$stext.firstChild.remove();
				$stext1.lastChild.remove();
				$stext2.lastChild.remove();

				//var $stext = $("#example_filter").find("label")[0];
				//$stext.firstChild.remove();
				
				var $download = $("#download");
				$("#example_filter label").append($download).css("display","inline");
				
				$table1 = $('#example1').DataTable( {
					"lengthMenu": [[25, 50, 75, 100], [25, 50, 75, 100]]
				});
				$("#example1_wrapper").find(".dataTables_length").clone(true).appendTo("#example1_wrapper").addClass("clone").attr("id","clone_show1").removeClass("dataTables_length");
				$('.dataTables_info').remove();
				$('#example1_filter input').attr("placeholder","Search Field");
				
				
				var $text = $("#example1_filter").find("label")[0],
					$text1 = $("#example1_length").find("label")[0],
					$text2 = $("#clone_show1").find("label")[0];
				$text.firstChild.remove();
				$text1.lastChild.remove();
				$text2.lastChild.remove();
				
				$("#example_wrapper").find("label").first().find("select").remove().end().text("Show All").end().click(function(){
                    $table.search( '' ).columns().search( '' ).draw();
                });
				$("#example1_wrapper").find("label").first().find("select").remove().end().text("Show All").end().click(function(){
                    $table1.search( '' ).columns().search( '' ).draw();
                });
				
			} );
			
	</script>
	<script type="text/javascript">		
	$("#nextform").on("click", function (event) {
			// $(".part1").hide();
			// $(".part2").show();
			//alert('sdsd'); return false;
 var shownext=true;
     var name = $("#first_name").val(); 
	  //var name = $("#first_name").val(); 
     var password=$("#pass").val();
     var confirmpass=$("#confirmpass").val();
	 var last_name=$("#last_name").val();
	 // //var firstname=$("#firstname").val();
	 var email = $("#email").val();
	 
	 var nameRegex = /^[a-zA-Z]+$/;
	 var con=/^([0-9]+)$/;
	 var ema=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 
      if(name==''){
	    alert('Please enter worker first name');  return false;
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
	  
	  alert('Please enter worker confirm password.'); shownext=false; return false;
	  }
	  if(confirmpass.trim() == ""){
	    alert('Please enter worker confirm password.'); shownext=false; return false;
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
	//
	});					

	</script>
	
	<script type="text/javascript">		
	$("#subbt").on("click", function (event) {

  
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
	<script type="text/javascript">		
	$("#sub").on("click", function (event) {
		 var fname = $("#upload_insurance").val();
var re = /(\.jpg|\.jpeg|\.bmp|\.gif|\.png)$/i;
	if(fname=='')
{
         alert("Please upload the image file."); return false;
}
	if(!re.exec(fname) && fname!='')
{
         alert("Choose valid image extension."); return false;
}
});		
	
	
	</script>
	
	<script type="text/javascript">		
	$("#submt").on("click", function (event) {
		 var nameRegex = /^[a-zA-Z]+$/;
		 var password=$("#pwd").val();
     var confirmpass=$("#newpwd").val();
	 
	  if(password==''){
	  
	  alert('Please enter the new password.');  return false;
	  }
	  if(password.trim() == ""){
	    alert('Please enter the new password.');  return false;
	  }
	 
	    if(password==parseInt(password)){
	    alert('New password should be alphanumeric.');  return false;
	  }
	  if(password.match(nameRegex)){
	    alert('New password should be alphanumeric.'); return false;
	 }
	 if(password.length<6 ){
	  alert('New password should be atleast 6 characters.');  return false;
	  }
	  if(password.length>30 ){
	  alert('New password should be in 30 characters .');  return false;
	  }
	    if(confirmpass==''){
	  
	  alert('Please Re type the Password.');  return false;
	  }
	if(confirmpass.trim() == ""){
	    alert('Please Re type the Password.');  return false;
	  }
	 
	if(confirmpass!=password){
		 
		   alert('Both Passwords should be same.');  return false;
	 }
	 // else{
		  // alert('Passwords changed successfully.');  return true;
	 // }
	 
	 });	
		</script>
	<!--<script type="text/javascript">		
	$("#addsubmit").on("submit", function (event) {
		event.preventDefault();
	var mobile=$("#mobile").val();
	 var city=$("#city").val();
	 var state=$("#state").val();
	 if(mobile == ""){
	    alert('Please enter your mobile.');  return false;
	   }
	  if(mobile.trim() == ""){
	    alert('Please enter your mobile.');  return false;
	   }
	   if(city==''){
	    alert('Please enter your city.');  return false;
	  }
	  if(city.trim() == ""){
	   alert('Please enter your city.'); return false;
	  }
	    
      if(state==''){
	    alert('Please enter your state.');  return false;
	  }
	  if(state.trim() == ""){
	   alert('Please enter your state.');  return false;
	  }
	  
	  
	  $.ajax({
		type: "POST",
		url: 'http://88.198.133.25/ober/public/admin/add_worker',
		data:{'mobile': mobile},
		success: function(response)
		{ 
		//alert ('s');
		console.log(response);
		 if(response=='sdsd'){
			 alert("Please enter otp to verify");
			// var obj = jQuery.parseJSON( response );
			// var encodeddata= base64_encode(obj.otp);
			// jQuery("#otp").attr("otp",encodeddata);
			// jQuery("#otpverification_field").attr("clickme","1");
			// jQuery("#otp").focus();
			// }else{
			// $("#ajaxResponseAuto").html(response);
			// }
		}
	  }
	});
	  
	});
	/*
	$("#submit").on("click", function (event) {
		event.preventDefault();
		alert('sadsa'); return false;
	 var mobile=$("#mobile").val();
	 var city=$("#city").val();
	 var state=$("#state").val();
	 if(mobile == ""){
	    alert('Please enter your mobile.');  return false;
	   }
	  if(mobile.trim() == ""){
	    alert('Please enter your mobile.');  return false;
	   }
	   if(city==''){
	    alert('Please enter your city.');  return false;
	  }
	  if(city.trim() == ""){
	   alert('Please enter your city.'); return false;
	  }
	    
      if(state==''){
	    alert('Please enter your state.');  return false;
	  }
	  if(state.trim() == ""){
	   alert('Please enter your state.');  return false;
	  }
	  //$("#addsubmit").submit();
	  
});*/
</script>-->
<script>
$("#addwork").keydown(function (e) {
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
// var _URL = window.URL || window.webkitURL;
// $("#upload_insurance").change(function (e) {
    // var file, img;
    // if ((file = this.files[0])) {
        // img = new Image();
        // img.onload = function () {
			
			// if(this.width>400 && this.height>400)
            // {
				// alert('please upload image size between 400px*400px');
				// $("#sub").attr("disabled","disabled");
			// }
			// else if(this.width<300 && this.height<300){
				// alert('please upload image size more than 300px*300px');
				// $("#sub").attr("disabled","disabled");
			// }
			// else
			// {
				// $("#sub").removeAttr("disabled");
			// }
        // };
        // img.src = _URL.createObjectURL(file);       
    // }
// });
	 </script>
	 <script>

// $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
// function getTransaction(){
	// var fromdate = $('.fromdate').val();
	// var todate = $('.todate').val();
	// var param = 'fromdate='+fromdate+'&todate='+todate;
	// //alert(param);
            // $.ajax({
               // type:'POST',
               // url:'/ober/public/admin/changestatus/'+<?php echo $ids; ?>,
               // data:param,
               // success:function(data){

                    // alert('Status has been changed successfully')
               // }
            // });
         // }

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

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
function getTransaction(){
	var fromdate = $('.fromdate').val();
	var todate = $('.todate').val();
	var param = 'fromdate='+fromdate+'&todate='+todate;
	//alert(param);
            $.ajax({
               type:'GET',
               url:'/ober/public/admin/ajaxCompanyDetail/'+<?php echo $ids; ?>,
               data:param,
               success:function(data){
				    $("#fill").html(data); 
                    
               }
            });
         }

</script>

<script type="text/javascript">		
	$("#nextforms").on("click", function (event) {
//			$(".part1").hide();
//			$(".part2").show();
 var shownext=true;
   var name = $("#name").val(); 
   
	
	 var mobile=$("#mobile").val();
	 var firstname=$("#firstname").val();
	var email = $("#email").val();
	// var city=$("#city").val();
	// var state=$("#state").val();
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
	  
        if(address==''){
	    alert('Please enter your address.'); shownext=false; return false;
	  }
	  if(address.trim() == ""){
	   alert('Please enter your address.'); shownext=false; return false;
	  }
	  if(address.length>40 ){
	  alert('Address should be upto 40 characters .'); shownext=false; return false;
	  }
	  // if(city==''){
	    // alert('Please enter your city.'); shownext=false; return false;
	  // }
	  // if(city.trim() == ""){
	   // alert('Please enter your city.'); shownext=false;return false;
	  // }
	   // if(!city.match(nameRegex)){
	  // alert('City should be alphabets only.'); shownext=false; return false;
	  // }
	     // if(city.length>30 ){
	  // alert('City should be upto 30 characters .'); shownext=false; return false;
	  // }
      // if(state==''){
	    // alert('Please enter your state.'); shownext=false; return false;
	  // }
	  // if(state.trim() == ""){
	   // alert('Please enter your state.'); shownext=false; return false;
	  // }
	   // if(!state.match(nameRegex)){
	  // alert('State should be alphabets only.'); shownext=false; return false;
	  // }
	  // if(state.length>30 ){
	  // alert('State should be upto 30 characters .'); shownext=false; return false;
	  // }
	  if(shownext==true){
		  $(".part3").hide();
		$(".part4").show();
		  
	  }
	  
		 return false;
	});					

</script>
<script type="text/javascript">		
	$("#subt").on("click", function (event) {
		
    // var zip = $("#zip").val(); 
	 var ein=$("#ein").val();
      var bank=$("#bank").val();
	   var acno=$("#acno").val();
	    var rount=$("#rount").val();
		 var billadd=$("#billadd").val();

	 var nameRegex = /^[a-zA-Z0-9]+$/;
	 var con=/^([0-9]+)$/;
	 var ema=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 
      // if(zip==''){
	    // alert('Please enter your zip.');  return false;
	  // }
	  // if(zip.trim() == ""){
	   // alert('Please enter your zip.');  return false;
	  // }
	  // if(zip!=''){
	  // if(zip.length>6 ){
	  // alert('zip should be 6 characters only.');  return false;
	  // }
    // if(zip.length<6 ){
	  // alert('zip should be 6 characters only.');  return false;
	  // }
	  
	  // if(zip!=parseInt(zip)){
	   // alert('zip should be numeric only.'); return false;
	 // }
	 // if(!zip.match(nameRegex)){
	  // alert('ZIP code should be alphnumeric only.');  return false;
	  // }
	  
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
 
	//var confpassword=$("#confpassword").val();
	 var mobile=$("#mobile").val();
	 var firstname=$("#firstname").val();
	var email = $("#email").val();
	 var city=$("#city").val();
	 var state=$("#state").val();
	 var zip=$("#zip").val();
	var address=$("#address").val();
  // var zip = $("#zip").val(); 
	 var ein=$("#ein").val();
      var bank=$("#bank").val();
	   var acno=$("#acno").val();
	   var ids='<?php echo $ids; ?>';
	    var rount=$("#rount").val();
		 var billadd=$("#billadd").val();
		 
		   var btype=$("#btype").val();
  	var param1 = 'name='+name+'&firstname='+firstname+'&email='+email+'&mobile='+mobile+'&address='+address+'&ein='+ein+'&bank='+bank+'&acno='+acno+'&rount='+rount+'&billadd='+billadd+'&ids='+ids+'&btype='+btype+'&city='+city+'&state='+state+'&zip='+zip;
	
 
			$.ajax({
    type: "GET",
    url: '/ober/public/admin/editcompany',    
    contentType: false,
    processData: false,
    data: param1,
    success: function (data) {
		 
      }
  });

  
        //}
	
	 
	});
	</script>
	<script>
$("#insur").keydown(function (e) {
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

$(".uploade_insurance").hover(
	function (e)
	{
		$(".uploade_insurance label").css({
			"backgroundColor":"rgba(0,0,0,0.6)",
			"color":"white"
		});
	},
	function (e)
	{
		$(".uploade_insurance label").css({
			"backgroundColor":"rgba(0,0,0,0)",
			"color":"transparent"
			
		});
	}
);



</script>

  <script>
function readURL1() {
	 document.getElementById("insur").submit();
	if(document.gggg.onsubmit())
 {//this check triggers the validations
    document.gggg.submit();
 }

}


	 //var _URL = window.URL || window.webkitURL;
// $("#upload_insurance").change(function (e) {
    // var file, img;
    // if ((file = this.files[0])) {
        // img = new Image();
        // img.onload = function () {
			// if(this.width>400 && this.height>400)
            // alert('please upload image size between 400px*400px'); return false;
        // };
        // img.src = _URL.createObjectURL(file);
    // }
// });
	 </script>
<script>
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
$('#cars').on('change', function() { 
  var status=this.value;
  var ids='<?php echo $ids; ?>';
  	var param = 'status='+status+'&ids='+ids;
  $.ajax({
               type:'GET',
               url:'/ober/public/admin/changestatus',
               data:param,
               success:function(data){
				    alert('Status has been changed.') 
                    
               }
            });

})
</script>  
<script>
$(".tab ul li").on("click touchdown", function(e){
$("input:password").val("");
});

jQuery(document).ready(function(){
	jQuery(".ins").click(function(){
		jQuery(".uploade_insurance > label:nth-child(2)").css({"paddingTop": $("#old_ins").height()/2 - 50});
	});
});


</script>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop
