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

include 'estimate.inc';
?>
<font color="red"><?php echo $msg ?></font>
  
  </div>
  <div class="left">
    <h3><strong>Ticket details are as follows;</strong></h3>
    <div class="left_box"> 
	
	<form method="get" action="">
	<table width="100%" border="0" align="left">
<tr>
<td align="left" width="25%">Select Ticket</td><td width="30%">
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
</td>
<td><input type="submit" name="search" Value="Search"></input></td>
</tr>
</table>
<br />
<hr>
	</form>


<?php
$sub = $_REQUEST['search'];
if ($sub) {
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
<table>
<tr>
<td>Approve/Reject<input type="hidden" name="comid" value="<?php echo $comid ?>"</td>
<td><input type="hidden" name="search" value="search"><select name="ap" style="width: 170px;">
<option value="Approved">Approved</option>
<option value="Rejcted">Rejected</option>
</select></td>
<td><input type="submit" name="Submit" Value="Submit"></input></td>
</table>
</form>
<?php
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
}
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
