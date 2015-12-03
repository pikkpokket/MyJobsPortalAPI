<?php

header('Content-type: application/json');

$db_name     = 'myjobs';
$db_user     = 'louischeminant';
$db_password = 'OustamineL040194';
$server_url  = '127.0.0.1';

$mysqli = new mysqli($server_url, $db_user, $db_password, $db_name);

if($_POST) {
	$mail	= $_POST['mail'];
	$code	= $_POST['code'];

	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		$sql = "SELECT * FROM emails";
		if ($result = mysqli_query($mysqli, $sql)) {
			$resultArray = array();
			$tempArray = array();
			$check = 0;

			while($row = $result->fetch_assoc()) {
				$email = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)".$row['mail']."/";
				if(preg_match($email, $mail)) {
					$check++;
				}
			}
			if($check > 0) {
				$to 		= $mail;
				$subject	= 'Email-Verification';
				$message 	= 'Voici le code : '.$code;
				$headers 	= 'From: louischeminant@me.com' . "\r\n" .
    							'Reply-To: louischeminant@me.com' . "\r\n" .
    							'X-Mailer: PHP/' . phpversion();

				if (mail($to, $subject, $message, $headers)) {
					echo '{"success":1}';
				} else {
					echo '{"success":0,"error_message":"Email de vérification non envoyé."}';
				}
			} else {
				echo '{"success":0,"error_message":"Email non valide."}';
			}
		} else {
			echo '{"success":0,"error_message":"Erreur de connection."}';
		}
		mysqli_close($mysqli);
	}
} else {
	echo '{"success":0,"error_message":"Une erreur est survenue."}';
}

?>
