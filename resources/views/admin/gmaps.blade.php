@extends('admin/layouts/header')

{{-- Page title --}}
@section('title')
    Oober

@stop

{{-- page level styles --}}
@section('header_styles')

 
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2uVepdxQlfbM0uiZN1LjN9gAPXhlBYTI"></script>-->
@stop

{{-- Page content --}}
@section('content')
<style>
.wrapper
{
position: absolute;
top: 0;
left: 0;
}
#mymap {
border:1px solid transparent;
width: 100%;
height: 100%;
position: relative;
overflow: hidden;
}
.content
{
	margin-left: 250px !important;
	background-color:#eef4f9;
}
.map-container
{
margin: 40px 40px 0px 45px;
padding-bottom:40px;
height:558px;
}
.content-header + p
{
	font-size:18px;
}
</style>

        <!-- /menu footer buttons -->
		<section class="content">
			 <div class=" no-pad  below-four greybg map-prov">
				<div class="content-header">Provider Map</div>
				<p>Distrubution Network Graph</p>
				<div class="map-container">
				<div id="mymap"></div>
				</div>
			</div> 
		</section>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="http://maps.google.com/maps/api/js?key=AIzaSyA02WLCd_YPGalluqfrbNJ2-yTAimRPPcc"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
  <script type="text/javascript">
jQuery(document).ready(function(){
		var locations = <?php print_r(json_encode($locations)) ?>;

		var mymap = new GMaps({
		  el: '#mymap',
		  lat: 28.6075627,
		  lng: 77.3683319,
		  zoom:6
		});

	   jQuery.each( locations, function( index, value ){
		   mymap.addMarker({
			 lat: value.lat,
			 lng: value.lng,
			 title: value.city,
			 click: function(e) {
			   //alert('This is '+value.city+', gujarat from India.');
			 }
		   });//
	   });

	   //$("").remove();
   });
  </script>

</body>
</html>