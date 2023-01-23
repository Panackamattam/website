<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';

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

include 'parts.inc';
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
$prsql = "select * from parts where compid='$comid'";
$prresult = $con->query($prsql);
if ($prresult->num_rows > 0) {
?>

<br /><hr>
<p><font color="red" size="3"><?php echo $msg ?></font></p>
<caption><strong><u>Create Estimate</u></strong></caption>


<table width="95%" border="0">
<tr>
<td align="left"><strong>Item</strong></td>
<td align="center"><strong>Qty</strong></td>
<td align="center" >Issued Qty</td>
<td align="right">Selling Rate</td>
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
<font color="red">No any parts request received for this complaint</font>
<?
//echo "No any parts request received for this complaint.";
}
?>
<br /><br />
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
