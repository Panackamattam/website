<?php
$db_name = "bmibedyu_service";
$mysql_username = "bmibedyu_bmi";
$mysql_password = "7xWf7hFxLXWR";
$server_name = "localhost:3306";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
	  if(!$conn){
		  die('Could not Connect MySql Server:' .mysql_error());
		}
?>