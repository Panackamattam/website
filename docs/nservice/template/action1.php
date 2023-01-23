<?php
	
	// include database connection file

	include_once "dbConfig.php";

	// autocomplete textbox jquery ajax in PHP
	
	if (isset($_POST['city1'])) {

  		$output = "";
  		$city1 = $_POST['city1'];
  		$query1 = "SELECT * FROM gstinventory WHERE item LIKE '$city1%'";
  		$result1 = $con->query($query1);

  		$output1 = '<ul class="list-unstyled">';		

  		if ($result1->num_rows > 0) {
  			while ($row1 = $result1->fetch_array()) {
  				$output1 .= '<li>'.ucwords($row1['item']).'</li>';
  			}
  		}else{
  			  $output1 .= '<li> Item not found.</li>';
  		}
  		
	  	$output1 .= '</ul>';
	  	echo $output1;
	}

?>