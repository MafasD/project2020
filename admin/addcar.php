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
								<a href="reservation.php">Reservations</a>
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

				<?php 

					include_once('../config.php');
					$db = new Database();

					if(isset($_POST['addcar']))
						{
							$bd = $_POST['bd'];
							$ml = $_POST['ml'];
							$ss = $_POST['ss'];
							$price = $_POST['pe'];


							$sql = "INSERT INTO cars (carbrand, carmodel, carseats, carprice, carimg)
									VALUES(?,?,?,?,?);
								";
							

							if(!$bd){
								echo '
										<div class="alert alert-danger">
										  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										  <strong>Car Brand is required!</strong>
										</div>
									';
							}else if(!$ml){
								echo '
										<div class="alert alert-danger">
										  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										  <strong>Car Model is required!</strong>
										</div>
									';
							}else{

								$new_image_name = 'image_' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.jpg';
								//checking if the file is an image
								move_uploaded_file($_FILES["cp"]["tmp_name"], "../carpics/".$new_image_name);
								$new_image_name = '../carpics/'.$new_image_name;

								if(empty($_FILES["cp"]["tmp_name"])){
									$new_image_name = '../carpics/'.'noimg.jpg'; //If no image is added, the "no image available" picture will be shown
								}

								$res = $db->insertRow($sql, [$bd,$ml,$ss, $price, $new_image_name]);
								if($res)
								{
									echo '
										<div class="alert alert-success">
										  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										  Car added successfully!
										</div>
									';
								}
							}
						}
				?>



				<form action = "" method = "POST" enctype="multipart/form-data">

					   <div class="form-group">
					    <label for="inputdefault">Car Brand:</label>
					    <input class="form-control" id="inputdefault"  name="bd" type="text">
					  </div>

					  <div class="form-group">
					    <label for="inputdefault">Car Model:</label>
					    <input class="form-control" id="inputdefault" name="ml" type="text">
					  </div>

					  <div class="form-group">
					    <label for="inputdefault">Car Seats:</label><br />
						<input class="form-control" id="inputdefault" name="ss" type="number">
					  </div>

					  <div class="form-group">
					    <label for="inputdefault">Renting Price:</label><br />
						<input class="form-control" id="inputdefault" name="pe" type="number">
					  </div>

					  <div class="form-group">
				    	  <label for="inputdefault">Car Picture:</label>
					      <input class="form-control" id="inputdefault" name="cp" type="file">
					  </div>
					  

					  <button class="btn btn-info" name = "addcar">
					  		Add
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