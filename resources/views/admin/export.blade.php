<html lang="en">
	<head>
		<title>Export to Excel and CSV in Laravel 5.3</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Export to Excel and CSV in Laravel 5.3</a>
				</div>
			</div>
		</nav>
		<div class="container">
			<a href="{{ url('exportTo/xls') }}"><button class="btn btn-primary"><span class="glyphicon glyphicon-export"></span> Export to xls</button></a>
			<a href="{{ url('exportTo/xlsx') }}"><button class="btn btn-info"><span class="glyphicon glyphicon-export"></span> Export to xlsx</button></a>
			<a href="{{ url('exportTo/csv') }}"><button class="btn btn-warning"><span class="glyphicon glyphicon-export"></span> Export to CSV</button></a>
		</div>
	</body>
</html>