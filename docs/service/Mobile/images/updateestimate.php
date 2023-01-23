<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$comid = $_REQUEST['comid'];
$csql ="select * from Complaints where compid='$comid'";
$cresult = $con->query($csql);
$crow = $cresult->fetch_assoc();
$cid = $crow["cid"];

$ad = $_REQUEST['search'];
if ($ad){
$re = $_REQUEST['rec'];
		if ($re == "db") {
		$rate = $_REQUEST['rate'];
		$qty = $_REQUEST['qty'];
		$srn = $_REQUEST['srno'];
		$total = ($rate * $qty);
		$upsql = "update estimates set rate='$rate', total='$total' where srno='$srn'";
		
		if(mysqli_query($con, $upsql)){
   // echo "Records added successfully.";
		} else{
  // echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
		}
		}
		
		if ($re == "new") {
		$item = $_REQUEST['item'];
			$sql1 = "select * from estimates where item='$item' and compid='$comid'";
			$result211 = $con->query($sql1);
			if ($result211->num_rows > 0) {
			}
			else
			{
			$qt = $_REQUEST['qty'];
			$rat = $_REQUEST['rate'];
			$total = ($rat * $qt);
			$isql = "INSERT INTO estimates(compid, cid, item, qty, rate, total, crdate, user, status) VALUES ('$comid', '$cid', '$item', '$qt', '$rat', '$total', '$cdate', '$user', '$st')";
			if(mysqli_query($con, $isql)){
   // echo "Records added successfully.";
			} else{
  // echo "ERROR: Could not able to execute $ipsql. " . mysqli_error($con);
			}
			}
		}
}

$cmid = "select * from Customers where cid='$cid'";
$cmidresult = $con->query($cmid);
$csrow = $cmidresult->fetch_assoc();

$cmid = $cmidrow["compid"];

include 'Insert/estimate.inc';
?>
  
  <form method="get" action="">
  <div class="w3-container">

	<?php
	if ($msg) {
	?>
	<p align="center"><font color="red"><?php echo $msg ?></font></p>
	<?php
	}
	?>
	    <h4><strong><u>Update estimate</u></strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
		 
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
<caption><strong><u>Update Estimate</u></strong></caption>
<table width="95%" border="0">
<tr>
<td width="5%"></td>
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
<td><a href="erate.php?srno=<?php echo $prrow["srno"]?>&rec=db&comid=<?php echo $comid ?>"><img src="images/edit21.png"></a></td>
<td><?php echo $prrow["item"] ?></a></td>
<td align="center"><?php echo $prrow["qty"] ?></td>
<td align="right">
<?php
$rt = $prrow["rate"] ;
if ($rt == "0"){
?>
<a href="erate.php?srno=<?php echo $prrow["srno"]?>&rec=db&comid=<?php echo $comid ?>">Click to Add Rate</a>
<?php
}
else
{
echo $prrow["rate"];
?>
</td>
<?php
}
?>

<td align="right"><?php echo $prrow["total"] ?></td>

</tr>
<?php
}
?>
<tr>
<td></td>
<td>Any Other Charges</td>
<td align="center"></td>
<td align="right"><a href="erate.php?rec=new&it=Other Charges&comid=<?php echo $comid ?>">Click to Add Rate</td>
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
<td></td>
<td>Service Charges</td>
<td align="center"></td>
<td align="right"><a href="erate.php?rec=new&it=Service Charge&comid=<?php echo $comid ?>">Click to Add Rate</td>
<td align="right">0.00</td>
</tr>
<?php
}
?>

<tr>
<td></td>
<td>Total</td>
<td></td>
<td align="center"></td>
<td align="right"><?php echo $tot ?></td>
</tr>
<form method="get" action="upestimate.php">
<tr>
<td colspan="5" align="center"><input type="hidden" name="comid" value="<?php echo $comid ?>"></input><input type="submit" name="uestimate" value="Send Revised Estimate to the Customer"></input></td>
</tr>
</form>
</table>
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