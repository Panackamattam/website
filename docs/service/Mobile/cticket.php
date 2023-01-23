<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>

<?php

$user = "Shine";
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$cid = $_REQUEST['cus'];
$tp = $_REQUEST['type'];
$pcat = $_REQUEST['pcat'];
$brand = $_REQUEST['brand'];
$model = $_REQUEST['model'];
$comp = $_REQUEST['complaint'];
$re = $_REQUEST['reff'];
$cst = "Registered";
$asd = "-";

$idsql ="select * from Customers where cid='$cid'";
$idresult = $con->query($idsql);
$idrow = $idresult->fetch_assoc();

$cname = $idrow["fname"]." ". $idrow["lname"];

$csql = "INSERT INTO Complaints(cid, cname, cat, type, brand, model, complaint, cstatus, reff, crby, crdate, asained, remark) VALUES ('$cid', '$cname ', '$pcat', '$tp', '$brand', '$model', '$comp', '$cst', '$re', '$user', '$cdate', '$asd', '$asd')";
if(mysqli_query($con, $csql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $csql. " . mysqli_error($con);
}

$cidsql = "select * from Complaints where cid='$cid' and cat='$pcat' and type='$tp' and brand='$brand' and model='$model' and complaint='$comp' and crdate='$cdate'";
$cidresult = $con->query($cidsql);
$cidrow = $cidresult->fetch_assoc();
$comid = $cidrow["compid"];
//include 'tickets.inc';
?>
<?php
include 'Insert/tickets.inc';
?>
 <form method="get" action="">
  <div class="w3-container">
    <h4><strong>Ticket Created !</strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
	  
<p>Your Complaint ID: <input type="text" name="fname" size="25" value="<?php echo $comid ?>" disabled></p>
<p>First Name: <input type="text" name="fname" size="25" value="<?php echo $idrow["fname"] ?>" disabled></p>
<p>Last Name: <input type="text" name="fname" size="25" value="<?php echo $idrow["lname"] ?>" disabled></p>
<p>Business Name: <input type="text" name="fname" size="25" value="<?php echo $idrow["bname"] ?>" disabled></p>
<p>Address1: <input type="text" name="fname" size="25" value="<?php echo $idrow["add1"] ?>" disabled></p>
<p>Address2: <input type="text" name="fname" size="25" value="<?php echo $idrow["add2"] ?>" disabled></p>
<p>City: <input type="text" name="fname" size="25" value="<?php echo $idrow["city"] ?>" disabled><p>
<p>State: <input type="text" name="fname" size="25" value="<?php echo $idrow["state"] ?>" disabled></p>
<p>Pincode: <input type="text" name="fname" size="25" value="<?php echo $idrow["pincode"] ?>" disabled></p>
<p>Phone: <input type="text" name="fname" size="25" value="<?php echo $idrow["phone"] ?>" disabled></p>
<p>Mobile: <input type="text" name="fname" size="25" value="<?php echo $idrow["mobile"] ?>" disabled></p>
<p>Email: <input type="text" name="fname" size="25" value="<?php echo $idrow["email"] ?>" disabled></p>
<p>Reffered By: <input type="text" name="fname" size="25" value="<?php echo $idrow["reff"] ?>" disabled></p>
<p><strong>Complaint Details</strong></p>
<p>Type of Complaint: <input type="text" name="fname" size="25" value="<?php echo $cidrow["type"] ?>" disabled></p>
<p>Product Catagory: <input type="text" name="fname" size="25" value="<?php echo $cidrow["cat"] ?>" disabled></p>
<p>Brand: <input type="text" name="fname" size="25" value="<?php echo $cidrow["brand"] ?>" disabled></p>
<p>Model Number: <input type="text" name="fname" size="25" value="<?php echo $cidrow["model"] ?>" disabled></p>
<p>Complaint in Breif: <textarea name="w3review" rows="7" cols="30"  disabled><?php echo $cidrow["complaint"] ?></textarea></p>
<br />

</form>
    </div>
  </div>
  <hr>
  <?php
 include 'footer.inc';
 ?>
