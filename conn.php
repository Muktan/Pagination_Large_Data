<?php
try {
	$servername = "localhost";
	$username = "root";
	$password = "";



	$con = new PDO("mysql:host=$servername;dbname=fe_temp", $username, $password);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo 'connection success';
} catch (PDOException $e) {
	//echo 'Connection failed';
}
?>