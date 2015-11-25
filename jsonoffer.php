<?php

mb_internal_encoding('UTF-8'); 
header('Content-type: text/html; charset=UTF-8; application/json');

if($_POST) {
	$compagny 		= $_POST['compagny'];
	$type 			= $_POST['type'];
	$offer 			= $_POST['offer'];
	$missions 		= $_POST['missions'];
	$level			= $_POST['level'];
	$address		= $_POST['address'];
	$latitude		= $_POST['latitude'];
	$longitude		= $_POST['longitude'];

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
		$stmt = $mysqli->prepare("INSERT INTO announcements (compagny, type, offer, missions, level, address, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param('ssssssss', $compagny, $type, $offer, $missions, $level, $address, $latitude, $longitude);
		$stmt->execute();
		if ($stmt->error) {error_log("Error: " . $stmt->error); }
		$success = $stmt->affected_rows;
		$stmt->close();

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
