<?php
	$hote = '127.0.0.1';
	$base = 'myjobs';
	$user = 'root';
	$pass = 'root';
	$cnx = mysql_connect ($hote, $user, $pass) or die (mysql_error ());
	$ret = mysql_select_db ($base) or die (mysql_error ());
?>