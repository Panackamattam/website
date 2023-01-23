<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php

if ($_REQUEST['submit']) {
$cname = $_REQUEST['catn'];

//if ($user == "") {
//$user = "Chris IT";
//} 
// Attempt insert query execution
$sql = "INSERT INTO catgaory(pcat, crby, crdate, status) VALUES ('$cname','$user','$cdate','$st')";
if(mysqli_query($con, $sql)){
    //echo "Records added successfully.";
   $msg = "Catagory added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
}
//include 'admin.inc';
?>
 <?php
include 'Insert/admin.inc';
?> 

	
<div class="w3-container">
    <p><font color="red"><?php echo $msg ?></font></p>
    <h3>Create Product Catagories</h3>
     <div class="w3-row w3-large">
      <div class="w3-col s6">	
	<form method="get" action="">
	
<p>Product Catagory Name</td><td><input type="text" name="catn" size="25" required><p>
<p><input type="submit" name="submit" value="Add Catagory" class="w3-button w3-green w3-third"></input></p>

<br />
    
<br />
</form>
    </div>
  </div>
  <hr >
     <?php
 include 'footer.inc';
 ?>
