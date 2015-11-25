<?php

header('Content-type: application/json');
if($_POST) {
	$lastname 		= $_POST['lastname'];
	$name 			= $_POST['name'];
	$class 			= $_POST['class'];
	$mail   		= $_POST['mail'];
	$password   	= $_POST['password'];
	$c_password 	= $_POST['c_password'];
	$phone			= $_POST['phone'];
	$db 			= $_POST['db'];
	$address		= $_POST['address'];
	$logo			= $_FILES['fic'];
	$description 	= $_POST['description'];

	if($_POST['mail']) {
		if ( $password == $c_password ) {

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
				if ($db == "users") {
					$stmt = $mysqli->prepare("INSERT INTO $db (lastname, name, class, mail, password, phone) VALUES (?, ?, ?, ?, ?, ?)");
					$password = md5($password);
					$stmt->bind_param('ssssss', $lastname, $name, $class, $mail, $password, $phone);
					$stmt->execute();
					if ($stmt->error) {error_log("Error: " . $stmt->error); }
					$success = $stmt->affected_rows;

					$stmt->close();

				/* close connection */
					$mysqli->close();
					error_log("Success: $success");

					if ($success > 0) {
					error_log("User '$mail' created.");
						echo '{"success":1}';
					} else {
						echo '{"success":0,"error_message":"Ce compte existe déjà."}';
					}
				} else {
					$stmt = $mysqli->prepare("INSERT INTO $db (name, mail, password, phone, address, description) VALUES (?, ?, ?, ?, ?, ?)");
					include ("./Images/transfert.php");
					if (isset($logo)) {
            			transfert();
      				}
      				$password = md5($password);
					$stmt->bind_param('ssssss', $name, $mail, $password, $phone, $address, $description);
					$stmt->execute();
					if ($stmt->error) {error_log("Error: " . $stmt->error); }
					$success = $stmt->affected_rows;

					$stmt->close();

				/* close connection */
					$mysqli->close();
					error_log("Success: $success");

					if ($success > 0) {
					error_log("User '$mail' created.");
						echo '{"success":1}';
					} else {
						echo '{"success":0,"error_message":"Ce compte existe déj."}';
					}
				} 
			}
		} else {
			echo '{"success":0,"error_message":"Passwords does not match."}';
		}
	} else {
		echo '{"success":0,"error_message":"Invalid Username."}';
	}
}else {
	echo '{"success":0,"error_message":"Invalid Data."}';
}
?>
