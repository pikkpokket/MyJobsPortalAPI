<?php
 
header('Content-type: application/json');

$db_name     = 'myjobs';
$db_user     = 'louischeminant';
$db_password = 'OustamineL040194';
$server_url  = '127.0.0.1';

$mysqli = new mysqli($server_url, $db_user, $db_password, $db_name);

if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
	$sql = "SELECT announcements.compagny, type, offer, missions, level, announcements.address, latitude, longitude, compagnies.description, announcements.id  FROM announcements INNER JOIN compagnies ON compagnies.name=announcements.compagny";
	if ($result = mysqli_query($mysqli, $sql)) {
		$resultArray = array();
		$tempArray = array();

		while($row = $result->fetch_object()) {
			$tempArray = $row;
	    	array_push($resultArray, $tempArray);
		}
		echo json_encode($resultArray);
	}
	mysqli_close($mysqli);
}

?>