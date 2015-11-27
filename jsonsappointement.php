<?php

mb_internal_encoding('UTF-8'); 
header('Content-type: text/html; charset=UTF-8; application/json');

if($_POST) {
	$start		= $_POST['start'];
	$end		= $_POST['end'];
	$duration	= $_POST['duration'];
	$date		= $_POST['date'];
	$compagny	= $_POST['compagny'];
	$user 		= $_POST['user'];

	$db_name     = 'myjobs';
	$db_user     = 'louischeminant';
	$db_password = 'OustamineL040194';
	$server_url  = '127.0.0.1';

	$mysqli = new mysqli($server_url, $db_user, $db_password, $db_name);

	/* check connection */
	if (mysqli_connect_errno()) {
		error_log("Connect failed: " . mysqli_connect_error());
		echo '{"success":0,"error_message":"' . mysqli_connect_error() . '"}';
	} else {
		$minutes = 0;

		while($start < $end) {

			if ($minutes == 60) {
				$start = $start + 1;
				$minutes = 0;
				$hour = $start."h".$minutes."0\n";
				$minutes = $minutes + $duration;
			} else if ($minutes == 0) {
				$hour = $start."h".$minutes."0\n";
				$minutes = $minutes + $duration;
			}else {
				$hour = $start."h".$minutes."\n";
				$minutes = $minutes + $duration;
			}
			$durate = $duration." minutes";
			$stmt = $mysqli->prepare("INSERT INTO appointments (date_offer, start, compagny, user, duration) VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param('sssss', $date, $hour, $compagny, $user, $durate);
			$stmt->execute();
			if ($stmt->error) {error_log("Error: " . $stmt->error); }
			$success = $stmt->affected_rows;
			$stmt->close();
		}
		$mysqli->close();
		error_log("Success: $success");
		if ($success > 0) {
			error_log("User '$login' created.");
			echo '{"success":1}';
		} else {
			echo '{"success":0,"error_message":"Invalid Data."}';
		}
	}
}
?>