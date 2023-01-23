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
$st1 = "Active";

$comid = $_REQUEST['comid'];
$csql ="select * from Complaints where compid='$comid'";
$cresult = $con->query($csql);
$crow = $cresult->fetch_assoc();
$cid = $crow["cid"];

$cmid = "select * from Customers where cid='$cid'";
$cmidresult = $con->query($cmid);
$csrow = $cmidresult->fetch_assoc();

$cmid = $cmidrow["compid"];

include 'Insert/parts.inc';
?>
<font color="red"><?php echo $msg ?></font>
  
  <div class="w3-container">

	<?php
	if ($msg) {
	?>
	<p align="center"><font color="red"><?php echo $msg ?></font></p>
	<?php
	}
	?>
	    <h4><strong><u>Parts Issue</u></strong></h4>
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

	$itcode= $_REQUEST['itcode'];
	if ($itcode) {
	$z = "0";
	$it = $_REQUEST['item'];
	$isql = "select * from Stock where itemcode='$itcode' and balqty>'$z' and item='$it' and status='$st1'";

	$result4 = $con->query($isql);
	if ($result4->num_rows > 0) {
	$irow = $result4->fetch_assoc();
	
	$stqty = $irow["balqty"];
	$rqty = $_REQUEST['qty'];
	$srno = $_REQUEST['srno'];
	$srate = $irow["sellingrate"];
	$issued = "Issued";
	
		if ($stqty >= $rqty) {
		$bqty = ($stqty - $rqty);
		//echo $bqty;
		$issuedqty = $rqty;
		
		$upstck = "update Stock set balqty='$bqty' where itemcode='$itcode'";
			if(mysqli_query($con, $upstck )){
			// echo "Records added successfully.";
			} else{
		// echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
			}
			
		$upparts = "update parts set issuedqty='$rqty', sellingrate='$srate', issuedby='$user', issueddate='$cdate', pstatus='$issued', itemcode='$itcode' where srno='$srno'";
		//echo $upparts;
			if(mysqli_query($con, $upparts )){
			// echo "Records added successfully.";
			} else{
		// echo "ERROR: Could not able to execute $upparts. " . mysqli_error($con);
			}
			
			
		}
		
		else
		{
		$issuedqty = $stqty;
		$bqty = "0";
		$brqty = ($rqty - $stqty);
		
			$upstck = "update Stock set balqty='$bqty' where itemcode='$itcode'";
			if(mysqli_query($con, $upstck )){
			// echo "Records added successfully.";
			} else{
		// echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
			}
			
			$upparts = "update parts set issuedqty='$issuedqty', sellingrate='$srate', issuedby='$user', issueddate='$cdate', pstatus='$issued', itemcode='$itcode' where srno='$srno'";
			if(mysqli_query($con, $upparts )){
			// echo "Records added successfully.";
			} else{
		// echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
			}
			//echo "please sari akku";
			
			$psql = "select * from parts where srno='$srno' and status='$st1'";
			$resultp = $con->query($psql);
			$prow = $resultp->fetch_assoc();
			$comid = $prow["compid"];
			$cid = $prow["cid"];
			$prt = $prow["parts"];
			$cdt = $prow["crdate"];
			
			$pst = "In Process";
			$insrt = "INSERT INTO parts(compid, cid, parts, qty, user, crdate, status, pstatus) VALUES ('$comid', '$cid', '$prt', '$brqty' ,'$user' ,'$cdt' ,'$st1' ,'$pst')";
			//echo $insrt;
			if(mysqli_query($con, $insrt )){
			echo "Records added successfully.";
			} else{
			 echo "ERROR: Could not able to execute $insrt. " . mysqli_error($con);
			}
		
		}
		}
		else
		{
		$msg =  "Wrong itemcode entered !, please checked and enter corrent itemcode relevant to the item";
		}
		
	
}
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
$prsql = "select * from parts where compid='$comid'";
$prresult = $con->query($prsql);
if ($prresult->num_rows > 0) {
?>

<p><font color="red" size="3"><?php echo $msg ?></font></p>
<caption><strong><u>Parts Request</u></strong></caption>


<table width="100%" border="0">
<tr>
<td align="left"><strong>Item</strong></td>
<td align="center"><strong>Qty</strong></td>
<td align="center" ><strong>Issued Qty</strong></td>
<td align="right"><strong>Selling Rate</strong></td>
</tr>
<?php
$tot = "0.00";
while($prrow = $prresult->fetch_assoc()) {
$tot = ($tot + $prrow["total"]);
?>
<tr>
<td><a href="pissue.php?srno=<?php echo $prrow["srno"] ?>"><?php echo $prrow["parts"] ?></a></td>
<td align="center"><?php echo $prrow["qty"] ?></td>
<td align="center"><?php echo $prrow["issuedqty"] ?></td>
<td align="right"><?php echo $prrow["sellingrate"] ?></td>
</tr>

<?php
}
?>
</table>
<?php
}
else
{
?>
<br /><br />
<p><font color="red">No any parts request received for this complaint</font></p>
<?
//echo "No any parts request received for this complaint.";
}
?>
<br /><br />


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