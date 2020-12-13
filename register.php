<?php 
include_once('config.php');
$db = new Database();


 ?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Account Registration</title>

		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/jquery.dataTables.css">
	</head>

	<body>
<br />
 		<div class="row">
 			<div class="col-md-4"></div>
 			<div class="col-md-4">
 				<?php 
						if(isset($_POST['submit'])){
							
							$fN = $_POST['fN']; //firstname
							$lN = $_POST['lN']; //lastname
							$em = $_POST['em']; //email
							$pN = $_POST['pN']; //phonenumber
							$add = $_POST['add']; //address
							$uN =  $_POST['uN']; //username
							$pass1 = $_POST['pass1']; //password
							$pass2 = $_POST['pass2']; //for confirming password

							//First we make sure the passwords are the same
							if($pass1 != $pass2){
								echo '
									<div class="alert alert-danger">
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									  <strong>Password does not match!</strong>
									</div>
								';
							}else
							{
							    //And once the passwords are confirm the same we insert the given data into the database thus creating the user
								$pass = md5($pass1);
								$sql = '
									INSERT INTO users(fname, lname, email, pnumber, address, uname, pword, usertype)
									VALUES(?,?,?,?,?,?,?, 2);
								';

								$result = $db->insertRow($sql, [$fN, $lN, $em, $pN, $add, $uN, $pass]);
								if($result){
									header('location: login.php'); //this will redirect us to the login page
								}

							}

						

						}
					 ?>
 				<div class="panel panel-info">
				  <div class="panel-heading">Account Registration</div>
					  <div class="panel-body">
						 <form action="" method="post">
						 	<div class="form-group">
							 	 <label for="fN">First Name:</label>
							 	 <input type="text" class="form-control" name="fN" id="fN" 
							 	 value="<?php if(isset($fN)){echo $fN;} ?>"
							 	 required autofocus> <!-- autofocus will automatically put the cursor on this panel, so in other words the first name panel, when page is refreshed.
								 And required won't let us submit the information(so create the account) without at least typing something on the required panel -->
							</div>


							<div class="form-group">
							 	 <label for="lN">Last Name:</label>
							 	 <input type="text" class="form-control" name="lN" id="lN" 
							 	 value="<?php if(isset($lN)){echo $lN;} ?>"
							 	 required>
							</div>	

								<div class="form-group">
							 	 <label for="em">Email address:</label>
							 	 <input type="text" class="form-control" name="em" id="em" 
							 	  value="<?php if(isset($em)){echo $em;} ?>"
							 	 required>
							</div>

							<div class="form-group">
							 	 <label for="pN">Phone Number:</label>
							 	 <input type="text" class="form-control" name="pN" id="pN" 
							 	 value="<?php if(isset($pN)){echo $pN;} ?>"
							 	 >
							</div>

							<div class="form-group">
							 	 <label for="add">Home Address:</label>
							 	 <input type="text" class="form-control" name="add" id="add" 
							 	 value="<?php if(isset($add)){echo $add;} ?>"
							 	 required>
							</div>	


							<div class="form-group">
							 	 <label for="uN">Username:</label>
							 	 <input type="text" class="form-control" name="uN" id="uN" 
							 	  value="<?php if(isset($uN)){echo $uN;} ?>"
							 	 required>
							</div>	

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									 	 <label for="pass1">Password:</label>
									 	 <input type="password" class="form-control" name="pass1" id="pass1" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									 	 <label for="pass2">Confirm password:</label>
									 	 <input type="password" class="form-control" name="pass2" id="pass2" required>
									</div>
								</div>
							</div>	

							<button type="submit" name="submit" class="btn btn-info">
								Submit
								<span class="glyphicon glyphicon-check"></span>
							</button>					 
						 </form> 	
					  </div>
				</div>
 			</div>
 			<div class="col-md-4"></div>
 		</div>

		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="bootstrap/js/dataTables.js"></script>
 		<script src="bootstrap/js/dataTables2.js"></script>
 		<script src="bootstrap/js/bootstrap.js"></script>

	</body>
</html>