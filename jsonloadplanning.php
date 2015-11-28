<?php

mb_internal_encoding('UTF-8'); 
header('Content-type: text/html; charset=UTF-8; application/json');

if($_POST) {
	$user		= $_POST['user'];

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
		if ($stmt = $mysqli->prepare("SELECT start FROM appointment WHERE user = ?")) {
			$stmt->bind_param("s", $user);

			$resultArray = array();
			$tempArray = array();

			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_object()) {
				$tempArray = $row;
    			array_push($resultArray, $tempArray);
			}
			echo json_encode($resultArray);
			$stmt->free_result();
			$stmt->close();
		}
		mysqli_close($mysqli);
	}
}
?>
