<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.jqueryui.min.css">
		<script type="text/javascript" src="http://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
		<script>
			$(document).ready( function () {
				$('#table1').DataTable();
			} );
		</script>
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a href="/qcresorts2023/ApprovedReservationsList" class="navbar-brand"  ><< Go Back to Reservation Details </a>
		</div>
		
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">Extended Reports</h3>
		<hr style="border-top:1px dotted #000;"/>

		<form class="form-inline" method="POST" action="">
			<label>Date of Event:  </label>
			<input type="date" class="form-control" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
			<label>To</label>
			<input type="date" class="form-control" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
			<button class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search"></span></button> <a href="index.php" type="button" class="btn btn-success"><span class = "glyphicon glyphicon-refresh"><span></a>
		</form>
		<br /><br />
		<div class="table-responsive">	
			<table id="table1" class="table table-bordered table-striped">
				<thead class="alert-info">
					<tr>
						<th>Reservation ID </th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Package Availed</th>
						<th>Package Price</th>
						<th>Extra Charges</th>
						<th>Total Paid</th>
						<th>Date of Event</th>
						<th>Date Uploaded</th>
					</tr>
				</thead>
				<tbody>
			<?php include "range.php"?>
			</table>
		</div>	
		<br/><br/><br/>
		<div class="table-responsive">	
			<table id="table1" class="table table-bordered table-striped">
				<thead class="alert-info">
					<tr>
						<th>Package Name </th>
						<th>Times Availed</th>
						<th>Total Earned</th>
					</tr>
				</thead>
				<tbody>
				<?php include "range2.php" ?>

			</table>
		</div>	
		<div class="" style="font-size:20px;;"> 
			<?php echo "Total Customer Count: ".$totalcustomer ++;?> <br>
			<?php echo "Total Earned From Packages: P".$totalpackage; ?>	<br>
			<?php echo "Total Earned From Extra Charges: P".$totalextcharges; ?><br>	
		</div>
			<div class="" style="font-size:30px;font-weight:bold;"> 
				<?php echo "<br/>Total Revenue: P".$totalincome; ?>	<br><br>
			</div>
		</div>
	</body>
</html>