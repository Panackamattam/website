<?php

// Get the user id
$user_id = $_REQUEST['user_id'];

// Database connection
$db_name = "bmibedyu_service";
$mysql_username = "bmibedyu_bmi";
$mysql_password = "7xWf7hFxLXWR";
$server_name = "localhost:3306";
$con = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
$z = "0";
if ($user_id !== "") {
	
	// Get corresponding first name and
	// last name for that user id	
	$query = mysqli_query($con, "SELECT * from gststock WHERE item='$user_id' and balqty>'$z'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	$first_name = $row["srate"];

	// Get the first name
	$last_name = $row["balqty"];
}

// Store it in a array
$result = array("$first_name", "$last_name");

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>
