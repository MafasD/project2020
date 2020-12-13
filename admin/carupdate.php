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

	</head>

	<style type="text/css">
		.navbar { margin-bottom:0px !important; }
		.carousel-caption { margin-top:0px !important }
	</style>

	<body>

		<br />
		<br />
		<br />
		
	
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


		<div class="container-fluid">

			<div class="col-md-3"></div>
			<div class="col-md-6">
				<a href="index.php" class="btn btn-success">
					Back
					<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
				</a>
			<br />
			<br />

			

				<form action = "" method = "POST" enctype="multipart/form-data">
						<?php 
							//we use GET method to get the id of the chosen car, so we can edit it
							if(isset($_GET['editid']))
								{
									$editid = $_GET['editid'];

									$sql = "SELECT * FROM cars WHERE car_id = ?";
									$res = $db->getRow($sql, [$editid]);
									$brand =  $res['carbrand'];
									$model =  $res['carmodel'];
									$seats =  $res['carseats'];
									$price = $res['carprice'];
									$getcarpic = $res['carimg'];
								
								 }

								 //then we use POST method to save the changes

								 if(isset($_POST['updatecar']))
								 	{
								 		$editid = $_POST['editid'];

								 		$brand = $_POST['bd'];
								 		$model = $_POST['ml'];
								 		$seats = $_POST['ss'];
										$price = $_POST['pe'];
								 		$carpic = $_POST['carpic'];



										$new_image_name = 'image_' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.jpg';
										//checking the added file
										move_uploaded_file($_FILES["cimg"]["tmp_name"], "../carpics/".$new_image_name);
										$new_image_name = '../carpics/'.$new_image_name;

										if(empty($_FILES["cimg"]["tmp_name"])){
											$sql = "UPDATE cars SET carbrand = ?, carmodel = ?, carseats = ?, carprice = ? WHERE car_id = ?";
								 			$res = $db->updateRow($sql, [$brand, $model,$seats, $price, $editid]);
										}else{
								 			$sql = "UPDATE cars SET carbrand = ?, carmodel = ?, carseats = ?, carimg = ?, carprice = ? WHERE car_id = ?";
								 			$res = $db->updateRow($sql, [$brand, $model,$seats, $new_image_name, $price, $editid]);
								 			if($carpic != '../carpics/noimg.jpg'){
								 				unlink($carpic);
								 			}
										}


							 			echo '
							 				<div class="alert alert-success">
											  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											  <strong>Changes were saved successfully!</strong>
											</div>
							 			';
								 	}
						?>

					   <div class="form-group">
					    <label for="inputdefault">Brand:</label>
					    <input class="form-control" id="inputdefault"  name="editid" type="hidden" value ="<?php echo $editid; ?>">
					    <input class="form-control" id="inputdefault"  name="bd" type="text" value ="<?php echo $brand; ?>">
					  </div>

					  <div class="form-group">
					    <label for="inputdefault">Model:</label>
					    <input class="form-control" id="inputdefault" name="ml" type="text" value ="<?php echo $model; ?>">
					  </div>

					  <div class="form-group">
					    <label for="inputdefault">Seats:</label><br />
					    <input class="form-control" id="inputdefault" name="ss" type="number" value ="<?php echo $seats; ?>">
					  </div>

					  <div class="form-group">
					    <label for="inputdefault">Price:</label><br />
					    <input class="form-control" id="inputdefault" name="pe" type="number" value ="<?php echo $price; ?>">
					  </div>

					  <input type="hidden" name="carpic" value="<?php echo $getcarpic; ?>">

					   <div class="form-group">
				    	  <label for="inputdefault">Picture:</label>
					      <input class="form-control" id="inputdefault" name="cimg" type="file">
					    </div>

					  <button class="btn btn-info" name = "updatecar">
					  		Save
					  		<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
					  </button>
				</form>	
			</div>
			<div class="col-md-3"></div>
		</div>

 		<script src="../bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="../bootstrap/js/dataTables.js"></script>
 		<script src="../bootstrap/js/dataTables2.js"></script>
 		<script src="../bootstrap/js/bootstrap.js"></script>

	</body>
</html>