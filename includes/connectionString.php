<?php

/*
	Desc: Example connection string
	
	Author: Lynsay A. Shepherd
	
	Date: October 2023
	
*/

// PROD connection details
// $servername = "lochnagar.abertay.ac.uk";
// $dbusername = "sql2403695";
// $dbpassword = "bradley-accept-finnish-closing";
// $dbname = "sql2403695";

// DEV connection details
$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$dbname = "sql2403695";


$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

// mysqli_close($conn);
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>