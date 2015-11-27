<?php

mb_internal_encoding('UTF-8'); 
header('Content-type: text/html; charset=UTF-8; application/json');

if($_POST) {
	$compagny	= $_POST['compagny'];
	$lastname 	= $_POST['lastname'];
	$name 		= $_POST['name'];
	$position 	= $_POST['position'];
	$mail 		= $_POST['mail'];
	$phone		= $_POST['phone'];
	$selected	= $_POST['selected'];

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
		$stmt = $mysqli->prepare("INSERT INTO contacts (compagny, lastname, name, position, mail, phone, selected) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param('sssssss', $compagny, $lastname, $name, $position, $mail, $phone, $selected);
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
