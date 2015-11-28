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
		$array1 = explode(":", $start);
		$array2 = explode(":", $end);
		$hour = $array1[0];
		$minutes = $array1[1];
		$hourEnd = $array2[0];
		$minutesEnd = $array2[1];

		while($hour < $hourEnd || $minutes < $minutesEnd) {

			if ($minutes >= 60) {
				$hour = $hour + 1;
				$minutes = $minutes-60;
				if ($minutes == 0){
					$nbr = $hour.$minutes."0";
				} else {
					$nbr = $hour.$minutes;
				}
				$nbr2 = $hourEnd.$minutesEnd;
				if ($nbr == $nbr2) {
					break;
				}

				if ($minutes >= 0 && $minutes <= 9) {
					$schedule = $hour."h0".$minutes;
				} else {
					$schedule = $hour."h".$minutes;
				}
			} else {
				$schedule = $hour."h".$minutes;
			}
			$minutes = $minutes + $duration;

			$durate = $duration." minutes";
			$stmt = $mysqli->prepare("INSERT INTO appointments (date_offer, start, compagny, user, duration) VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param('sssss', $date, $schedule, $compagny, $user, $durate);
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