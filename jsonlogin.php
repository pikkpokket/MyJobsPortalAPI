<?php

header('Content-type: application/json');

if($_POST) {
	$mail   	= $_POST['mail'];
	$password   = $_POST['password'];
	$db 		= $_POST['db'];

	if($mail && $password) {

			$db_name     = 'myjobs';
			$db_user     = 'root';
			$db_password = 'root';
			$server_url  = '127.0.0.1';

			$mysqli = new mysqli($server_url, $db_user, $db_password, $db_name);

			/* check connection */
			if (mysqli_connect_errno()) {
				error_log("Connect failed: " . mysqli_connect_error());
				echo '{"success":0,"error_message":"' . mysqli_connect_error() . '"}';
			} else {
				if ($stmt = $mysqli->prepare("SELECT mail FROM $db WHERE mail = ? and password = ?")) {

					// $password = md5($password);

					/* bind parameters for markers */
					$stmt->bind_param("ss", $mail, $password);
				
					/* execute query */
					$stmt->execute();

					/* bind result variables */
					$stmt->bind_result($id);

					/* fetch value */
					$stmt->fetch();

					/* close statement */
					$stmt->close();
				}

				/* close connection */
				$mysqli->close();
				
				if ($id) {
					error_log("User $username: password match.");
					echo '{"success":1}';
				} else {
					error_log("User $username: password doesn't match.");
					echo '{"success":0,"error_message":"Invalid Username/Password"}';
				}
			}
	} else {
		echo '{"success":0,"error_message":"Invalid Username/Password."}';
	}
}else {
	echo '{"success":0,"error_message":"Invalid Data."}';
}

?>
