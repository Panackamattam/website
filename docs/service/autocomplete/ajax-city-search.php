
<?php
include 'head.inc';
include 'connection.inc';

?>

<?php
//require_once('connection.php');

function get_city($con , $term){	
	$query = "SELECT * FROM Complaints WHERE cname LIKE '%".$term."%' ORDER BY cname ASC";
	$result = mysqli_query($con, $query);	
	$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
	return $data;	
}

if (isset($_GET['term'])) {
	$getCity = get_city($con, $_GET['term']);
	$cityList = array();
	foreach($getCity as $Complaints){
		$cityList[] = $Complaints['cname'];
	}
	echo json_encode($cityList);
}
?>