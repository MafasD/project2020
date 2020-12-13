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
								<a href="index.php">Home</a>
							</li>
							<li>
								<a href="myreservation.php">My Reservation(s)</a>
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

		<div id ="info"  ></div>
	<div class="container-fluid">
			
		<div class="panel panel-info">
		  <div class="panel-heading">List of rentable cars</div>
		  <div class="panel-body">
		  		<?php 
		  			$sql = 'SELECT * FROM cars ORDER by carbrand';
		  		 	$res = $db->getRows($sql);
		  		 	if($res){
		  		 		foreach ($res as $r) {
		  		 			$car_id = $r['car_id'];
	  		 				$brand = $r['carbrand'];
	  		 				$model = $r['carmodel'];
	  		 				$seats = $r['carseats'];
	  		 				$cimg = $r['carimg'];
	  		 				$price = $r['carprice'];

	  		 	?>	
	  		 		<a href="#"  data-toggle="modal" data-target="#myModal<?php echo $car_id; ?>">
						<img class="img-rounded" src="<?php echo $cimg; ?>" height="200" width="300">
	  		 		</a>
						<div id="myModal<?php echo $car_id; ?>" class="modal fade" role="dialog">
						  <div class="modal-dialog">

						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						      </div>
						      <div class="modal-body">
						      		<div class="row">
						      			<div class="col-md-6">
						      				<img src="<?php echo $cimg; ?>" height="200" width="300">
						      			</div>
						      			<div class="col-md-6">
						      				<form>
						      					<strong>Brand: </strong><?php echo $brand; ?><br />
							      				<strong>Model: </strong><?php echo $model; ?><br />
							      				<strong>Seats available: </strong><?php echo $seats; ?> <br />
							      				<strong>City of pick up: </strong> <br />
							      				<input type = "text" id="city<?php echo $car_id; ?>" >
							      				<br />
										   		<strong>Pick up date: </strong>&nbsp;
							      				<br /> 
										    	<input class="btn-default" id="rndate<?php echo $car_id; ?>" size="30" name="rndate" type="date" autocomplete="off">
										    	<br />
												<strong>Return Date: </strong>&nbsp;
							      				<br /> 
										    	<input class="btn-default" id="rtdate<?php echo $car_id; ?>" size="30" name="rtdate" type="date" autocomplete="off">
										    	<br />
										    	<strong>Estimated time of picking up: </strong>
										    	<br />
										    	<select class="btn-default" id="hr">
										    		<?php 
										    			$x = 12;
										    			for($time = 1; $time <= $x; $time++){
										    		?>
										    			<option value="<?php echo $time; ?>"><?php echo $time; ?></option>
										    		<?php
										    			}
										    		 ?>
										    	</select>
										    	<select class="btn-default" id="ampm">
										    		<option value="AM">AM</option>
										    		<option value="PM">PM</option>
										    	</select> <br />
												<strong>Price: </strong><?php echo number_format($price, 2), 'eur/h'; ?><br />
						      				</form>
					      				
						      			</div>
						      		</div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">
						        	Close
						        	<span class="glyphicon glyphicon-remove-sign"></span>
						        </button>
						        <input type="submit" value="Reserve" onclick="send('<?php echo $car_id; ?>')" class="btn btn-success" data-dismiss="modal">
						      </div>
						    </div>

						  </div>
						</div>

	  		 	<?php
		  		 		}
		  		 	}
		  		 ?>
		  </div>
		</div>

	</div>
	<script type="text/javascript">
		function car(str){
		}
	</script>

 		<script src="../bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="../bootstrap/js/dataTables.js"></script>
 		<script src="../bootstrap/js/dataTables2.js"></script>
 		<script src="../bootstrap/js/bootstrap.js"></script>

	</body>
</html>


<script type="text/javascript">

function send(str){

	var city = $('#city'+str).val();

	var carid = str;
	var uid = '<?php echo $_SESSION['userID']; ?>';
	var city = $('#city'+str).val();
	var rndate = $('#rndate'+str).val();
	var rtdate = $('#rtdate'+str).val();
	var hr = $('#hr').val();
	var ampm = $('#ampm').val();


	var datas = "carid="+carid+"&uid="+uid+"&city="+city+"&rndate="+rndate+"&rtdate="+rtdate+"&hr="+hr+"&ampm="+ampm;

	$.ajax({
		   type: "POST",
		   url: "reservation.php",
		   data: datas
		}).done(function( data ) {
		  $('#info').html(data);
		});

}


</script>