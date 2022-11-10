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
input
{
	width:60%;
	float:right;
	clear:both;
	height:35px;
}
.pasword-change
{
	margin:40px 40px 40px 0px;
	width:70%;
}

.tc{color: red;
    padding-left: 13%;
    text-align: center;}
	.tk{color: green;
    padding-left: 13%;
    text-align: center;}
</style>

        <!-- /menu footer buttons -->
		<section class="content _service">
			<div class=" no-pad  below-four">
				<div class="content-header">Reset Password</div>
				<p>You should create a strong password that uses uppercase and lowercase letters, numbers, symbols, and spaces. A password can be 8 to 256 characters long.
</p>
				 <div class="pasword-change">
		 {{  Form::open(array('action'=>'JoshController@resetpasswordcustomer', 'method' => 'post')) }}
		 <ul class="pass">
		@if(isset($msg)) <h4 style="color:red;" class="tc">{{ $msg }} </h4>@endif
		@if(isset($msgg))<h4 style="color:green;"class="tk">{{ $msgg }} </h4>@endif
			<li>Old password <input type="text" name="oldpassword"></li>
			<li>New password <input type="text" name="password"></li>
			<li>Re type Password <input type="text" name="newpassword"></li>
		 </ul>
		{!! Form::submit('RESET PASSWORD', array('class'=>'send-btn reset-btn','id'=>'submit','name'=>'RESET PASSWORD')) !!}
{{ Form::close() }}

		</form>
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
