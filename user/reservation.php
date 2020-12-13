<?php 
	include_once('../config.php');
	$db = new Database();
?>


<?php 

	if(isset($_POST['carid']))
		{

			$cid	= $_POST['carid'];
			$uid	= $_POST['uid'];
			$dt 	= $_POST['city'];
			$date 	= $_POST['rndate'];
			$date2	= $_POST['rtdate'];
			$hr 	= $_POST['hr'];
			$ampm 	= $_POST['ampm'];

			if(!$dt){
				echo '
					<div class="alert alert-danger">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>Pick up city is required</strong>
					</div>
				';
			}
			else if(!$date){
				echo '
					<div class="alert alert-danger">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>Date of picking up is required</strong>
					</div>
				';
			}
			else if(!$date2){
				echo '
					<div class="alert alert-danger">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>Return date is required</strong>
					</div>
				';
			}
				else
					{
						 $sql = "SELECT COUNT(rndate) as rdt FROM reservations WHERE car_id = ? AND rndate = ?";
						 $res  = $db->getRow($sql, [$cid, $date]);
					

						if($res['rdt'] > 2)
							{
								echo '
										<div class="alert alert-danger">
										  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										  <strong>Error!</strong> Car is already reserved for this time period.
										</div>
									';

							}
						else
							{
								$sql = 'SELECT * FROM reservations WHERE car_id = ? AND rndate = ? AND hr = ? AND ampm = ?';
								$res = $db->getRows($sql, [$cid, $date, $hr, $ampm]);
								if($res)
									{
										foreach ($res as $r)
											{
												$rcid = $r['car_id'];
												$rd = $r['rndate'];
												$rh = $r['hr'];
												$rampm = $r['ampm'];
												
												if(($rd == $date) AND ($rh == $hr) AND ($rampm == $ampm) AND ($rcid == $cid))
													{
														echo '
																<div class="alert alert-danger">
																  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																  <strong>Error!</strong> Car is already reserved for this time period.
																</div>
															';
													}
											}
									}
									else
										{
								
											$sql = " INSERT INTO reservations(city, hr, ampm, car_id, user_id, rndate, rtdate)
											VALUES (?,?,?,?,?,?,?) ";
											$res = $db->insertRow($sql, [$dt, $hr, $ampm, $cid, $uid, $date, $date2]);

											echo '
													<div class="alert alert-success">
													  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													  Car reserved successfully!
													</div>
												';
										}
							}
					}
		}

?>