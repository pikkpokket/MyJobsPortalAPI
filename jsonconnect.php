<?php
 
header('Content-type: application/json');

if($_POST) {
	$mail	= $_POST['mail'];
	$db		= $_POST['db'];

	if($_POST['mail']) {

		$db_name     = 'myjobs';
		$db_user     = 'louischeminant';
		$db_password = 'OustamineL040194';
		$server_url  = '127.0.0.1';

		$mysqli = new mysqli($server_url, $db_user, $db_password, $db_name);
 
		if (mysqli_connect_errno()) {
  			error_log("Connect failed: " . mysqli_connect_error());
			echo '{"success":0,"error_message":"' . mysqli_connect_error() . '"}';
		} else {
			if ($stmt = $mysqli->prepare("SELECT * FROM $db WHERE mail = ?")) {
				$stmt->bind_param("s", $mail);

				$resultArray = array();
				$tempArray = array();

				$stmt->execute();
				$result = $stmt->get_result();
				while ($row = $result->fetch_array(MYSQLI_NUM)) {
					$resultArray = $row;
				}
				echo json_encode($resultArray);
				$stmt->free_result();
				$stmt->close();
			}
			mysqli_close($mysqli);
		}
	}
}

?>