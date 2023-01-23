<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

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

include 'invoice.inc';
?>
  
	<?php
	if ($msg) {
	?>
	<font color="red"><?php echo $msg ?></font>
	<?php	
	}
	?>
  </div>
  <div class="left">
    <h3><strong>Ticket details are as follows;</strong></h3>
    <div class="left_box"> 
<?php
//$sub = $_REQUEST['search'];
//if ($sub) {
?>
<table width="100%" border="0">
<tr>
<td align="left" width="20%"><strong>Your Complaint ID</td><td width="35%"><?php echo $comid ?></td>
<td align="right" width="20%">&nbsp;</td><td width="25%">&nbsp;</td>
</tr>
<tr>
<td><strong>First Name</td><td><?php echo $csrow["fname"] ?></td>
<td><strong>Last Name</td><td><?php echo $csrow["lname"] ?></td>
</tr>
<tr><td><strong>Business Name</td><td><?php echo $csrow["bname"] ?></td>
<td><strong>Address1</td><td><?php echo $csrow["add1"] ?></td>
</tr>
<tr><td><strong>Address2</td><td><?php echo $csrow["add2"] ?></td>
<td><strong>City</td><td><?php echo $csrow["city"] ?></td>
</tr>
<tr><td><strong>State</td><td><?php echo $csrow["state"] ?></td>
<td><strong>Pincode</td><td><?php echo $csrow["pincode"] ?></td>
</tr>
<tr><td><strong>Phone</td><td><?php echo $csrow["phone"] ?></td>
<td><strong>Mobile</td><td><?php echo $csrow["mobile"] ?></td>
</tr>
<tr><td><strong>Email</td><td><?php echo $csrow["email"] ?></td>
<td><strong>Reffered By</td><td><?php echo $csrow["reff"] ?></td></tr>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td><strong>Type of Complaint</td><td><?php echo $crow["type"] ?></td>
<td><strong>Catagory of Product</td><td><?php echo $crow["cat"] ?></td>
</tr>
<tr>
<td><strong>Brand</td><td align="left"><?php echo $crow["brand"] ?></td>
<td><strong>Model Number</td><td align="left"><?php echo $crow["model"] ?></td>
</tr>
<tr><td valign="top"><strong>Complaint in Breif</td><td colspan="3"><textarea name="w3review" rows="7" cols="70" disabled><?php echo $crow["complaint"] ?></textarea></td>
</tr>
</table>
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
    <h3><strong>Update Payment Details</strong></h3>
<table align="center" width="100%" border="0" cellpadding="8">
<tr>
<td><strong>Date<input type="hidden" name="invno" value="<?php echo $in ?>"></input></td><td><input type="date" name="pdate"></input></td>
<td><strong>Payment Mode<input type="hidden" name="comid" value="<?php echo $comid ?>"></input></td><td><select name="pmode" style="width: 170px;">
<option value="Cash">By Cash</option>
<option value="Cheque">By Cheque</option>
<option value="Online">By Online</option>
</td>
</tr>

<tr>
<td>Details</td><td><input type="text" name="pdetails"></input></td><td>Amount</td><td><input type="text" name="pamount"></input>
</tr>
<tr>
<td colspan="4" align="center"><input type="submit" name="paymentupdate" Value="Update Payment Details"></input></td>
</tr>

</table>
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
<?php
$urole = "Admin";
if ($urole == "Admin") {
?>

    <p><a href="customers.php" class="button6">Assian Ticket</a></button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="editcustomers.php" class="button6">Update Ticket</a></p>

<?php
}
//}
?>
</form>
    </div>
  </div>
  <div class="right">
   <?php
   include 'right.php';
   ?>
  </div>
  <div class="footer">
 <?php
   include 'footer.php';
   ?>
  </div>
</div>
</body>
</html>
