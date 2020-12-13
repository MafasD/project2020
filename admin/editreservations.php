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
							<li>
								<a href="index.php">Cars</a>
							</li>
							<li  class="active">
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
		
		
		
 <div class="container">
			
			<br />
			<br />

			<?php 
			//This is the function for reservation reject button, which lets an admin delete any reservation made by the users
				if(isset($_GET['delres']))
					{
						$del = $_GET['delres'];
						$sql = "DELETE FROM reservations WHERE res_id = ? ";
						$res = $db->deleteRow($sql,[$del]);
					}
			?>

			
		 <br />
		 	 <table id="myTable" class="table table-striped" >  
				<thead>
					<th>USER</th>
					<th>NAME</th>
					<th>EMAIL</th>
					<th>PHONE</th>
					<th><center>IMAGE</center></th>
					<th>BRAND</th>
					<th>MODEL</th>
					<th>CITY</th>
					<th>P-UP-DATE</th>
					<th>RETURN DATE</th>
					<th>TIME</th>
					<th>PRICE e/h</th>
					<th>DECLINE</th>
				</thead>
				<tbody>
					<?php 
			$sql = "SELECT * FROM reservations r INNER JOIN cars c ON c.car_id = r.car_id
			INNER JOIN users u ON u.user_id = r.user_id order by rndate
			";
			$res = $db->getRows($sql);


			foreach ($res as  $r) {

				$resid	= $r['res_id'];
				$uname	= $r['uname'];
				$fname	= $r['fname'];
				$lname	= $r['lname'];
				$email	= $r['email'];
				$phone	= $r['pnumber'];
				$img	= $r['carimg'];
				$brand	= $r['carbrand'];
				$model	= $r['carmodel'];
				$city	= $r['city'];
				$price	= $r['carprice'];
				$rndate = $r['rndate'];
				$rtdate	= $r['rtdate'];
				$hr		= $r['hr'];
				$ampm	= $r['ampm'];

				$time = $hr.' '.$ampm;
		?>
					<tr>
						<td class="align-img"><?php echo $uname; ?></td>
						<td class="align-img"><?php echo $fname.' '.$lname; ?></td>
						<td class="align-img"><?php echo $email; ?></td>
						<td class="align-img"><?php echo $phone; ?></td>
						<td class="align-img"><center><img src="<?php echo $img; ?>" width="50" height="50"></center></td>
						<td class="align-img"><?php echo $brand; ?></td>
						<td class="align-img"><?php echo $model; ?></td>
						<td class="align-img"><?php echo $city; ?></td>
						<td class="align-img"><?php echo $rndate; ?></td>
						<td class="align-img"><?php echo $rtdate; ?></td>
						<td class="align-img"><?php echo $time; ?></td>
						<td class="align-img"><?php echo number_format($price, 2); ?></td>
						<td>
						<a class = "btn btn-danger  btn-xs" href="editreservations.php?delres=<?php echo $resid; ?>">
								Delete
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</a>
            </td>
					</tr>
					<?php
			}
		?>

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