<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php

$comid = $_REQUEST['comid'];
$csql ="select * from Complaints where compid='$comid'";
$cresult = $con->query($csql);
$crow = $cresult->fetch_assoc();
$cid = $crow["cid"];

$cmid = "select * from Customers where cid='$cid'";
$cmidresult = $con->query($cmid);
$csrow = $cmidresult->fetch_assoc();

$cmid = $cmidrow["compid"];

$submit = $_REQUEST['Submit'];
if ($submit) {
$z = "0";
$est = $_REQUEST['ap'];
$comid = $_REQUEST['comid'];
$apest = "update estimates set estatus='$est' where compid='$comid' and rate>'$z'";
if(mysqli_query($con, $apest )){
   // echo "Records added successfully.";
		} else{
  // echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
		}
$msg = "Estimate Approved Successfully !";
}

include 'Insert/estimate.inc';
?>
 
  <div class="w3-container">

	<?php
	if ($msg) {
	?>
	<p align="center"><font color="red"><?php echo $msg ?></font></p>
	<?php
	}
	?>
	    <h4><strong><u>Approve/Reject Estimate</u></strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
	  
	<form method="get" action="">
	<p>Select Ticket: 
<select name="comid" style="width: 170px;">
<?php
$st = "Resolved";
$sql = "SELECT * FROM Complaints where cstatus!='$st' order by compid";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
$cname = $row["cname"];
?>
<option value="<?php echo $row["compid"] ?>"><?php echo $row["compid"] ?> - <?php echo $cname ?></option>
<?php
}
?>
</select>
<button type="submit" name="search" value="Search" class="w3-button w3-green w3-third">Search</button></p>
	</form>
<hr>
<br /><br />
<hr>
<?php
$sub = $_REQUEST['search'];
if ($sub) {
?>
<p><i class="fa fa-fw fa-male"></i> First Name: <input type="text" name="fname" size="25" value="<?php echo $csrow["fname"] ?>" disabled></p>
        <p><i class="fa fa-fw fa-male"></i> Last Name: <input type="text" name="lname" size="25" value="<?php echo $csrow["lname"] ?>" disabled></p>
        <p><i class="fa fa-fw fa-building"></i> Business Name: <input type="text" name="bname" size="25"  value="<?php echo $csrow["bname"] ?>" disabled></input></p>
		<p><i class="fa fa-fw fa-address-book"></i> Address1: <input type="text" name="add1" size="25"  value="<?php echo $csrow["add1"] ?>" disabled></input></p>
		<p><i class="fa fa-fw fa-address-book"></i>Address2: <input type="text" name="add2" size="25"  value="<?php echo $csrow["add2"] ?>" disabled></input></p>
        <p><i class="fa fa-fw fa-address-book"></i>City: <input type="text" name="city" size="25"  value="<?php echo $csrow["city"] ?>" disabled></input></p>
        <p><i class="fa fa-fw fa-address-book"></i>State: <input type="text" name="state" size="25"  value="<?php echo $csrow["state"] ?>" disabled></input></p>
		<p><i class="fa fa-fw fa-address-book"></i>Pincode: <input type="text" name="pin" size="25"  value="<?php echo $csrow["pincode"] ?>" disabled></input></p>
		<p><i class="fa fa-fw fa fa-phone"></i>Phone: <input type="text" name="phone" size="25"  value="<?php echo $csrow["phone"] ?>" disabled></input></p>
		<p><i class="fa fa-fw fa fa-mobile-phone"></i>Mobile: <input type="text" name="mobile" size="25"  value="<?php echo $csrow["mobile"] ?>" disabled></input></p>
        <p><i class="fa fa-fw fa-envelope"></i>Email: <input type="text" name="email" size="25"  value="<?php echo $csrow["email"] ?>" disabled></input></p>
        <p><i class="fa fa-fw fa-male"></i>Reffered By: <input type="text" name="reff" size="25"  value="<?php echo $csrow["reff"] ?>" disabled></input></p>

<h4><strong>Complaint Details</strong></h4>
				<p>
<i class="fa fa-fw fa-shower"></i> Type of Complaint:  <input type="text" name="brand" size="20" value="<?php echo $crow["type"] ?>" disabled></p>
<p> <i class="fa fa-fw fa-wifi"></i> Catagory of Product: <input type="text" name="brand" size="20" value="<?php echo $crow["cat"] ?>" disabled></p>
        <p><i class="fa fa-fw fa-tv"></i>Brand: <input type="text" name="brand" size="20" value="<?php echo $crow["brand"] ?>" disabled></input></p>
		<p><i class="fa fa-fw fa-tv"></i>Model Number:  <input type="text" name="model" size="20" value="<?php echo $crow["model"] ?>" disabled></input></p>
		<p><i class="fa fa-fw fa-tv"></i>Complaint in Breif:  <textarea name="complaint" rows="5" cols="30" disabled><?php echo $crow["complaint"] ?></textarea></p>
		</div>
		</div>

<?php
$prsql = "select * from estimates where compid='$comid'";
$prresult = $con->query($prsql);
if ($prresult->num_rows > 0) {
?>

<br /><hr>
<caption><strong><u>Create Estimate</u></strong></caption>
<table width="95%" border="0">
<tr>
<td align="left"><strong>Item</strong></td>
<td align="center"><strong>Qty</strong></td>
<td align="right"><strong>Rate</strong></td>
<td align="right"><strong>Total</strong></td>
</tr>
<?php
$tot = "0.00";
while($prrow = $prresult->fetch_assoc()) {
$tot = ($tot + $prrow["total"]);
?>
<tr>
<td><?php echo $prrow["item"] ?></a></td>
<td align="center"><?php echo $prrow["qty"] ?></td>
<td align="right"><?php echo $prrow["rate"] ?></td>
<td align="right"><?php echo $prrow["total"] ?></td>

</tr>
<?php
}
?>
<tr>
<td>Any Other Charges</td>
<td align="center"></td>
<td align="right">0.00</td>
<td align="right">0.00</td>
</tr>
<?php
$se = "Service Charge";
$sql = "select * from estimates where item='$se' and compid='$comid'";
$result21 = $con->query($sql);
if ($result21->num_rows > 0) {
}
else
{
?>
<tr>
<td>Service Charges</td>
<td align="center"></td>
<td align="right"></td>
<td align="right">0.00</td>
</tr>
<?php
}
?>

<tr>
<td>Total</td>
<td></td>
<td align="center"></td>
<td align="right"><?php echo $tot ?></td>
</tr>
</table>
<form method="get" action="">

<p>Approve/Reject: <input type="hidden" name="comid" value="<?php echo $comid ?>"></p>
<p><input type="hidden" name="search" value="search"><select name="ap" style="width: 170px;">
<option value="Approved">Approved</option>
<option value="Rejcted">Rejected</option>
</select></p>
<p><input type="submit" name="Submit" Value="Submit" class="w3-button w3-green w3-third"></input></p>
</form>
<?php
}
?>
<br />
<?php
}
?>
</form>
    </div>
  </div>
   <hr>
   <?php
 include 'footer.inc';
 ?>