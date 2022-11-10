@extends('admin/layouts/header')

{{-- Page title --}}
@section('title')
    Oober

@stop

{{-- page level styles --}}
@section('header_styles')

 
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2uVepdxQlfbM0uiZN1LjN9gAPXhlBYTI"></script>
@stop

{{-- Page content --}}
@section('content')
<style>
body{background:#eef4f9;}
.amcharts-export-menu li:last-child>a{display:none !important;}
#chartdiv {
	width	: 100%;
height	: 500px;}

	#secondchartdiv {
	width	: 100%;
	height	: 500px;
}
.amcharts-export-menu .export-main:hover, .amcharts-export-menu .export-drawing:hover, .amcharts-export-menu 
#mapCanvas {
    width: 100%;
    height: 100%;
}
</style>

            <!-- /menu footer buttons -->
			<section class="content">
         <div class=" no-pad  below-four greybg map-prov">
			<div class="content-header">Provider Map</div>
			<p>Distrubution Network Graph</p>
			
		<div id="mapCanvas"></div>
			
			
		 </div> 
        </div>
 </section>
        <!-- top navigation -->
        <!-- /top navigation -->
		
        <!-- page content -->
        


    <script>
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(50);
        
    // Multiple markers location, latitude, and longitude
    var markers = [
        ['Brooklyn Museum, NY', 40.671531, -73.963588],
        ['Brooklyn Public Library, NY', 40.672587, -73.968146],
        ['Prospect Park Zoo, NY', 40.665588, -73.965336]
    ];
                        
    // Info window content
    var infoWindowContent = [
        ['<div class="info_content">' +
        '<h3>Brooklyn Museum</h3>' +
        '<p>The Brooklyn Museum is an art museum located in the New York City borough of Brooklyn.</p>' + '</div>'],
        ['<div class="info_content">' +
        '<h3>Brooklyn Public Library</h3>' +
        '<p>The Brooklyn Public Library (BPL) is the public library system of the borough of Brooklyn, in New York City.</p>' +
        '</div>'],
        ['<div class="info_content">' +
        '<h3>Prospect Park Zoo</h3>' +
        '<p>The Prospect Park Zoo is a 12-acre (4.9 ha) zoo located off Flatbush Avenue on the eastern side of Prospect Park, Brooklyn, New York City.</p>' +
        '</div>']
    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
    
}
// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);

$(document).ready(function(){
	$("#map").addClass("active"); 
});
</script>     
    
	
	 

   <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- end of global js -->
    <!-- begining of page level js -->
     


@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
	


@stop
