<?php
include 'head.inc';
include 'connection.php';

//$con =mysqli_connect("localhost","attinqst","9zYs%#*Es6vG4!3~","attinqst_service");
if($con){
//echo "Connected Sucessfully";
}
else{
//echo "Not Connected";
}
//mysqli_close($con);

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
$mbl = $idrow["mobile"];

$csql = "INSERT INTO Complaints(cid, cname, cat, type, brand, model, complaint, cstatus, reff, crby, crdate, asained, remark, mobile) VALUES ('$cid', '$cname ', '$pcat', '$tp', '$brand', '$model', '$comp', '$cst', '$re', '$user', '$cdate', '$asd', '$asd', '$mbl')";
if(mysqli_query($con, $csql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $csql. " . mysqli_error($con);
}

$cidsql = "select * from Complaints where cid='$cid' and cat='$pcat' and type='$tp' and brand='$brand' and model='$model' and complaint='$comp' and crdate='$cdate'";
$cidresult = $con->query($cidsql);
$cidrow = $cidresult->fetch_assoc();
$comid = $cidrow["compid"];
?>
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
    <h4 class="card-title"><strong>Sucessfully Created Ticket. Your Ticket details are as follows;</strong></h4>
	
	<table class="table">
<tr>
<td align="left" width="20%"><strong>Your Complaint ID</td><td width="35%"><?php echo $comid ?></td>
<td align="right" width="12%">&nbsp;</td><td width="33%">&nbsp;</td>
</tr>
<tr>
<td><strong>First Name</td><td><?php echo $idrow["fname"] ?></td>
<td><strong>Last Name</td><td><?php echo $idrow["lname"] ?></td>
</tr>
<tr><td><strong>Business Name</td><td><?php echo $idrow["bname"] ?></td>
<td><strong>Address1</td><td><?php echo $idrow["add1"] ?></td>
</tr>
<tr><td><strong>Address2</td><td><?php echo $idrow["add2"] ?></td>
<td><strong>City</td><td><?php echo $idrow["city"] ?></td>
</tr>
<tr><td><strong>State</td><td><?php echo $idrow["state"] ?></td>
<td><strong>Pincode</td><td><?php echo $idrow["pincode"] ?></td>
</tr>
<tr><td><strong>Phone</td><td><?php echo $idrow["phone"] ?></td>
<td><strong>Mobile</td><td><?php echo $idrow["mobile"] ?></td>
</tr>
<tr><td><strong>Email</td><td><?php echo $idrow["email"] ?></td>
<td><strong>Reffered By</td><td><?php echo $idrow["reff"] ?></td></tr>
</table>
<br />
    <h4 ><strong>Complaint Details</strong></h4>
	<br />
<table class="table">
<tr>
<td width="22%"><strong>Complaint Raised By</td><td width="28%"><?php echo $cidrow["reff"] ?></td>
<td width="22%">&nbsp;</td><td width="28%">&nbsp;</td>
<tr>
<td><strong>Type of Complaint</td><td><?php echo $cidrow["type"] ?></td>
</td>
<td><strong>Catagory of Product</td><td><?php echo $cidrow["cat"] ?></td>
</tr>
<tr>
<td><strong>Brand</td><td align="left"><?php echo $cidrow["brand"] ?></td>
<td><strong>Model Number</td><td align="left"><?php echo $cidrow["model"] ?></td>
</tr>
<tr><td valign="top"><strong>Complaint in Breif</td><td colspan="3"><textarea name="w3review" rows="7" cols="70" readonly><?php echo $cidrow["complaint"] ?></textarea></td>
</tr>
</table>
<br />
</form>
</div>
</div>
</div>
</div>
</div>
  <?php
   include 'footer.inc';
   ?>
