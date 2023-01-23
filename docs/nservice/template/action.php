<?php
	
	// include database connection file

	include_once "dbConfig.php";

	// autocomplete textbox jquery ajax in PHP
	
	if (isset($_POST['city'])) {

  		$output = "";
  		$city = $_POST['city'];
		$st = "Active";
  		$query = "SELECT * FROM gstvendor WHERE vname LIKE '$city%' and status='$st'";
  		$result = $con->query($query);

  		$output = '<ul class="list-unstyled">';		

  		if ($result->num_rows > 0) {
  			while ($row = $result->fetch_array()) {
  				$output .= '<li>'.ucwords($row['vname']).'</li>';
  			}
  		}else{
  			  $output .= '<li> Company not Found</li>';
  		}
  		
	  	$output .= '</ul>';
	  	echo $output;
	}

?>