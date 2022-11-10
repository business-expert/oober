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
.uploade_insurance{
	display: block;
	margin: 50px 0 20px 50px;
	height: auto;
	width: auto;
	overflow:hidden;
	width:400px;position:relative;
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
.tk{color: green;
    padding-left: 13%;
    text-align: center;}
	.tc{color: green;
    padding-left: 13%;
    text-align: center;}
</style>


        <!-- /menu footer buttons -->
		<section class="content _insurance">
			<div class=" no-pad  below-four">
			
				<div class="content-header">Insurance</div>
				
				{{  Form::open(array('action'=>'JoshController@insurance_upload','id'=>'insur', 'name' => 'gggg','method' => 'post','files' => 'true')) }}
				<div class="uploade_insurance" style="width: auto;">
				<!--<i class="fa fa-trash-o" aria-hidden="true"></i>

					<!--<img src="{{ asset('images/User_man_male_profile_account_person_people.png') }}" alt="..." class="img-responsive">-->
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
					<label style="margin: 0; color:#fff; padding: 45% 30px 0px 30px; display: block; height: 100%;">Click to Add Proof of Insurance
						<input type='file' name="upload_insurance" onchange="readURL1()" id="upload_insurance" />
					</label>
					<!--<img src="{{ asset('/images/User_man_male_profile_account_person_people.png') }}" alt="">-->
					</div>
					
					<?php } else { ?>
					<img src="{{ $result[0]->insurance }}" id="old_ins" alt="">
					<?php } ?>
				
				
					<?php if(!empty($result[0]->insurance)) { ?>
						<label style="margin: 0;
							color: transparent;
							padding: 40px 30px;
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
		

						</label>
					<?php } ?>
					</div>
					{{ Form::close() }}
					
			</div>			
		</section>
        <!-- top navigation -->
        <!-- /top navigation -->
		
        <!-- page content -->
        
<script src="//code.jquery.com/jquery-1.10.2.js"></script>

    
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


$(document).ready(function(){
	$(".uploade_insurance > label:nth-child(2)").css({"paddingTop": $("#old_ins").height()/2 - 40});
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
function readURL(input) {
    var url = input.value;
	alert(url);
   /* var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }else{
         $('#img').attr('src', '/assets/no_preview.png');
    } */
	
	 var filen = input.files[0];
	 var file_data = $("#upload_insurance").prop("files")[0].name;  
	
 alert(filen);	alert(file_data);
    var formData = new FormData();
    formData.append('formData', filen);
alert(formData);
    $.ajax({
    type: "POST",
    url: "insuranceupload1",    
    contentType: false,
    processData: false,
    data: formData,
    success: function (data) {
		alert("hh");
      alert(data);
      }
  });
}



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
	 
	 // function readURL(input) {

    // if (input.files && input.files[0]) {
        // var reader = new FileReader();

        // reader.onload = function (e) {
            // $('#blah').attr('src', e.target.result);
        // }

        // reader.readAsDataURL(input.files[0]);
    // }
// }

// $("#upload_insurance").change(function(){
    // readURL(this);
	// alert('shd');
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
				// $("#subm").attr("disabled","disabled");
			// }
			// else if(this.width<300 && this.height<300){
				// alert('please upload image size more than 300px*300px');
				// $("#subm").attr("disabled","disabled");
			// }
			// else
			// {
				// $("#subm").removeAttr("disabled");
			// }
        // };
        // img.src = _URL.createObjectURL(file);       
//}


	 </script>
	 

    <!-- end of global js -->
    <!-- begining of page level js -->
     




	 
         <script type="text/javascript">		
	$("#subm").on("click", function (event) {
		
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
		$(document).ready(function(){
			$("#Insurance").addClass("active"); 
		});
	
	</script>
	
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop
