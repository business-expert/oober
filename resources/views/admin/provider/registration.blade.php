<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Serene Dashboard</title>
	<link href="../build/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="../build/css/custom.css" rel="stylesheet">
	<link href="../build/css/responsive-calendar.css" rel="stylesheet">
 
    
	 
	
	
	
	
	
  </head>

  <body class="nav-md new-provider">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-2 no-pad">
          <div class="left_col scroll-view">
            

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
              @include('admin/layouts/header')
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
			  @include('admin/layouts/sidebar')
            <!-- /sidebar menu -->
        </div> 
</div>		

            <!-- /menu footer buttons -->
         <div class="col-md-10 no-pad  below-four">
			<div class="content-header">Active Customers Below 4 Stars</div>
			<button>Back</button>
			<div class="table-cntnr">
				<div class="add-new-comp">
				<div class="plus"><span>+</span></div>
				<a href="#">Add a new company</a>
				</div>
				<table>
				<div class="num-item">20</div>
					<tr>
						<th><select><option>Name</option></select></th>
						<th>Email</th>
						<th>Date Entered</th>
						<th>Provider Name</th>
						<th>City</th>
						<th>State</th>
						
					</tr>
					
					<tr>
						<td>alexender strokes</td>
						<td>alexender strokes@yahoo.com</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
					
					</tr>
					
					<tr>
						<td>alexender strokes</td>
						<td>alexender strokes@yahoo.com</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
					
					</tr>
					
					<tr>
						<td>alexender strokes</td>
						<td>alexender strokes@yahoo.com</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
					
					</tr>
					
					<tr>
						<td>alexender strokes</td>
						<td>alexender strokes@yahoo.com</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
					
					</tr>
					<tr>
						<td>alexender strokes</td>
						<td>alexender strokes@yahoo.com</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
					
					</tr>
					
					<tr>
						<td>alexender strokes</td>
						<td>alexender strokes@yahoo.com</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
					
					</tr>
					
				<tr>
						<td>alexender strokes</td>
						<td>alexender strokes@yahoo.com</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
					
					</tr>
					
					<tr>
						<td>alexender strokes</td>
						<td>alexender strokes@yahoo.com</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
					
					</tr>
					
				<tr>
						<td>alexender strokes</td>
						<td>alexender strokes@yahoo.com</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
					
					</tr>
					
					<tr>
						<td>alexender strokes</td>
						<td>alexender strokes@yahoo.com</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
					
					</tr>
				
				</table>
				
				<div class="pagination">
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
				</div>
			</div>

			
			
		 </div>   
        </div>

        <!-- top navigation -->
        <!-- /top navigation -->
		
        <!-- page content -->
        


         
    
	
	 

    <!-- jQuery -->
    <script src="../build/js/jquery.min.js"></script>
	<script src="../build/js/bootstrap.min.js"></script>
	<script src="../build/js/canvasjs.min.js"></script>
	
	
	
	
	
	<script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {

      title:{
      text: ""
      },
       data: [
      {
        type: "line",

        dataPoints: [
        { x: new Date(2012, 00, 1), y: 450 },
        { x: new Date(2012, 01, 1), y: 414 },
        { x: new Date(2012, 02, 1), y: 520 },
        { x: new Date(2012, 03, 1), y: 460 },
        { x: new Date(2012, 04, 1), y: 450 },
        { x: new Date(2012, 05, 1), y: 500 },
        { x: new Date(2012, 06, 1), y: 480 },
        { x: new Date(2012, 07, 1), y: 480 },
        { x: new Date(2012, 08, 1), y: 410 },
        { x: new Date(2012, 09, 1), y: 500 },
        { x: new Date(2012, 10, 1), y: 480 },
        { x: new Date(2012, 11, 1), y: 510 }
        ]
      }
      ]
    });

    chart.render();
  }
	</script>

 
   </body>
</html>
