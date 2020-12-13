<?php 

	include_once('../config.php');
	$db = new Database();

?>

<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Car Reservation</title>

		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/jquery.dataTables.css">

	    <link rel="stylesheet" href="../bootstrap/css/jquery.dataTables.css">
	    <script src="../bootstrap/	js/jquery.dataTables2.js"></script>


	</head>

	<style type="text/css">
		.navbar { margin-bottom:0px !important; }
		.carousel-caption { margin-top:0px !important }

		td.align-img {
			line-height: 3 !important;
		}
	</style>

	<body>

			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<img src="../images/carlogo.png" height="50" width="50"> &nbsp;
					</div>
			
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							<li><a href="#" style="font-family: Arial; font-size: 30px;">Car Reservation</a></li>
						</ul>

						<ul class="nav navbar-nav" style="font-family: Arial;">
							<li class="active">
								<a href="index.php">Cars</a>
							</li>
							<li>
								<a href="editreservations.php">Reservations</a>
							</li>
						</ul>
						
						<ul class="nav navbar-nav navbar-right" style="font-family: Arial;">
							<li>
								<?php include_once('../logout/logout.php'); ?>
							</li>
						
						</ul>
					</div>
				</div>
			</nav>

		<br />
		<br />
		<br />
		<br />
		
		<?php 
		//With this an admin can delete a car from the database
				if(isset($_GET['delid']))
					{
						$cid = $_GET['delid'];
						$sql = "DELETE FROM cars WHERE car_id = ? ";
						$res = $db->deleteRow($sql,[$cid]);

						$cimg = $_GET['cimg'];
						if($cimg != '../carpics/'.'noimg.png'){
							unlink($cimg);
						}
					}
			?>


		 <div class="container">
			<a href="addcar.php" class="btn btn-success">
				New
				<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
			</a>
			<br />
			<br />

		 	 <table id="myTable" class="table table-striped" >  
				<thead>
					<th>BRAND</th>
					<th>MODEL</th>
					<th>SEATS</th>
					<th><center>PICTURE</center></th>
					<th>PRICE</th>
					<th><center>EDIT/DELETE</center></th>
				</thead>
				<tbody>
					<?php 

						$sql = "SELECT * FROM cars ORDER BY carbrand";
						$res = $db->getRows($sql);
						foreach ($res as $row) {
							$cid   = $row['car_id'];
							$brand = $row['carbrand'];
							$model = $row['carmodel'];
							$seats = $row['carseats'];
							$cimg  = $row['carimg'];
							$price = $row['carprice'];
						

					?>
					<tr>
						<td class="align-img"><?php echo $brand; ?></td>
						<td class="align-img"><?php echo $model; ?></td>
						<td class="align-img"><?php echo $seats; ?></td>
						<td class="align-img"><center><img src="<?php echo $cimg; ?>" width="50" height="50"></center></td>
						<td class="align-img"><?php echo number_format($price, 2), 'eur/h'; ?></td>
						<td class="align-img">
							<a class = "btn btn-success btn-xs" href="carupdate.php?editid=<?php echo $cid; ?>">
								Edit
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>
							<a class = "btn btn-danger  btn-xs" href="index.php?delid=<?php echo $cid; ?>&cimg=<?php echo $cimg; ?>">
								Delete
								<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</a>
						</td>
					</tr>
					<?php } ?>

				</tbody>
			</table>

		 </div>


	</body>
 		<script src="../bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="../bootstrap/js/dataTables.js"></script>
 		<script src="../bootstrap/js/dataTables2.js"></script>
 		<script src="../bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/jquery.dataTables.css">
    <script src="../bootstrap/js/jquery.dataTables2.js"></script>


    <script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
    </script>


</html>



<?php 
$db->Disconnect();
?>