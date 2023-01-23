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

$payupd = $_REQUEST["paymentupdate"];
if ($payupd){
$paystatus = "Received";
$inno = $_REQUEST['invno'];
$pmode = $_REQUEST['pmode'];
$pdate = $_REQUEST['pdate'];
$pdetails = $_REQUEST['pdetails'];
$pamount = $_REQUEST['pamount'];

$payentry = "update invdetails set paymode='$pmode', paydate='$pdate', details='$pdetails', recamt='$pamount', paystatus='$paystatus' where invno='$inno'";
if(mysqli_query($con, $payentry)){
   // echo "Records updated successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
}

//include 'invoice.inc';
?>
  
	<?php
	if ($msg) {
	?>
	<font color="red"><?php echo $msg ?></font>
	<?php	
	}
	?>
   <?php
include 'Insert/invoice.inc';
?> 
<div class="w3-container">
    <h4><strong>Payment receipt entry</strong></h4>
     <div class="w3-row w3-large">
      <div class="w3-col s6">
<?php
//$sub = $_REQUEST['search'];
//if ($sub) {
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
$vsql = "select * from cvisits where compid='$comid'";
$vresult = $con->query($vsql);
if ($vresult->num_rows > 0) {
?>
<BR />
<caption><strong><u>Visit History</u></strong></caption>
<table width="100%" border="0">
<tr>
<td><strong>Visit Date</strong></td>
<td><strong>Visit Remark</strong></td>
<td><strong>Status</strong></td>
<td><strong>Technician</strong></td>
</tr>
<?php
while($vrow = $vresult->fetch_assoc()) {
?>
<tr>
<td><?php echo $vrow["vdate"] ?></td>
<td><?php echo $vrow["remark"] ?></td>
<td><?php echo $crow["cstatus"] ?></td>
<td><?php echo $vrow["user"] ?></td>
</tr>

<?php
}
?>
</table>
<?php
}
?>
<?php
$prsql = "select * from parts where compid='$comid'";
$prresult = $con->query($prsql);
if ($prresult->num_rows > 0) {
?>

<br /><hr>
<caption><strong><u>Parts Request</u></strong></caption>
<table width="100%" border="0">
<tr>
<td width="25%"><strong>Request Date</strong></td>
<td width="35%"><strong>Item</strong></td>
<td width="15%" align="center"><strong>Qty</strong></td>
<td width="25%"><strong>Item Status</strong></td>
</tr>
<?php
while($prrow = $prresult->fetch_assoc()) {
?>
<tr>
<td><?php echo $prrow["crdate"] ?></td>
<td><?php echo $prrow["parts"] ?></td>
<td align="center"><?php echo $prrow["qty"] ?></td>
<td><?php echo $prrow["pstatus"] ?></td>
</tr>

<?php
}
?>
</table>
<?php
}
?>

<?php
$z = "0";
$prsql1 = "select * from estimates where compid='$comid' and rate>'$z'";
$prresult1 = $con->query($prsql1);
if ($prresult1->num_rows > 0) {
?>

<br /><hr>
<caption><strong><u>Estimate Given</u></strong></caption>
<table width="100%" border="0">
<tr>
<td width="25%"><strong>Date</strong></td>
<td width="35%"><strong>Item</strong></td>
<td width="15%" align="center"><strong>Qty</strong></td>
<td width="25%"><strong>Estimate Status</strong></td>
</tr>
<?php
while($prrow11 = $prresult1->fetch_assoc()) {
?>
<tr>
<td><?php echo $prrow11["crdate"] ?></td>
<td><?php echo $prrow11["item"] ?></td>
<td align="center"><?php echo $prrow11["qty"] ?></td>
<td><?php echo $prrow11["estatus"] ?></td>
</tr>

<?php
}
?>
</table>
<?php
}
?>

<?php
$z = "0";
$in = $_REQUEST['invno'];
$prsql2 = "select * from invdetails where invno='$in'";
$prresult2 = $con->query($prsql2);
if ($prresult2->num_rows > 0) {
?>

<br /><hr>
<caption><strong><u>Invoice Details</u></strong></caption>
<table width="100%" border="0">
<tr>
<td width="25%"><strong>Invoice #</strong></td>
<td width="35%"><strong>Date</strong></td>
<td width="15%"><strong>Totam Amount</strong></td>
<td width="25%"><strong>Payment Status</strong></td>
</tr>
<?php
while($prrow2 = $prresult2->fetch_assoc()) {
	if ($prrow2["paystatus"] == "0") {
	$paystatus = "Not Received";
	}
	else
	{
	$paystatus = $prrow2["paystatus"];
		}
?>
<tr>
<td><?php echo $prrow2["invno"] ?></td>
<td><?php echo $prrow2["invdate"] ?></td>
<td><?php echo $prrow2["totalamt"] ?></td>
<td><?php echo $paystatus ?></td>
</tr>

<?php
}
?>
</table>
<?php
if ($paystatus != "Received"){
?>
<form method="get" action="">
    <h4><strong>Update Payment Details</strong></h4>
<p>Date: <input type="hidden" name="invno" value="<?php echo $in ?>"></input><input type="date" name="pdate"></input><p>
<p>Payment Mode: <input type="hidden" name="comid" value="<?php echo $comid ?>"></input><select name="pmode" style="width: 170px;">
<option value="Cash">By Cash</option>
<option value="Cheque">By Cheque</option>
<option value="Online">By Debit Card / Credit Card / NEFT</option>
</select>
</p>
<p>Details: <input type="text" name="pdetails"></input></p>
<p>Amount: <input type="text" name="pamount"></input></p>
<p><input type="submit" name="paymentupdate" Value="Update Payment Details" class="w3-button w3-green w3-third"></input></p>
</form>
<?php
}
else
{
$msg1 = "Payment Received and Sucessfully Completed all process of this ticket !";
?>
<br />
<p align="center"><font color="red" size=3"><?php echo $msg1 ?></font></p>
<?php
}
}
?>
<br />
    </div>
  </div>
  <hr>
   <?php
 include 'footer.inc';
 ?>