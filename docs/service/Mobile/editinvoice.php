<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php

$upsearch = $_REQUEST['update'];
if ($upsearch) {
$inv = $_REQUEST['invno'];
$srno = $_REQUEST['srno'];
$rate = $_REQUEST['rate'];
$tot = ($_REQUEST['rate'] * $_REQUEST['qty']);
$itcod = $_REQUEST['itemcod'];

		$sq1 = "select * from Stock where itemcode='$itcod'";
		$re1 = $con->query($sq1);
		if ($re1->num_rows > 0) {
		$rw1 = $re1->fetch_assoc();
		$gst = $rw1["gst"];
		
			$sq2 = "select * from taxes where gst='$gst'";
			$re2 = $con->query($sq2);
			$rw2 = $re2->fetch_assoc();
			$cgst = $rw2["cgst"];
			$sgst = $rw2["sgst"];
			//echo $cgst;
		}
		else
		{
		$gst = $_REQUEST['tax'];
		$cgst = ($gst / 2);
		$sgst = ($gst / 2);
		}
		
		$percentage = 50;
		$totalWidth = 350;

		$new_width = ($percentage / 100) * $totalWidth;

		$cgst = ($cgst / 100) * $tot;
		$sgst = ($sgst / 100) * $tot;
		$gst = ($cgst + $sgst);

		$usq = "update invoice set rate='$rate', total='$tot', cgst='$cgst', sgst='$sgst', gst='$gst' where srno='$srno'";
		if(mysqli_query($con, $usq)){
   // echo "Records added successfully.";
		} else{
  // echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
		}
		
		$usq4 = "select * from invoice where invno='$inv'";
		$re4 = $con->query($usq4);
		$total = "0";
		$cgst1 = "0";
		$sgst1 = "0";
		$gst1 = "0";
		while($rw4 = $re4->fetch_assoc()) {
		$total = ($total + $rw4["total"]);
		$cgst1 = ($cgst1 + $rw4["cgst"]);
		$sgst1 = ($sgst1 + $rw4["sgst"]);
		$gst1 = ($gst1 + $rw4["gst"]);
		}
		
		$cess = "1";
		$cess1 = ($cess / 100) * $total;
		$grandtotal = ( $total + $cgst1 + $sgst1 + $cess1);
		
		$usq5 = "update invdetails set totalamt='$grandtotal', cess='$cess1', gst='$gst1', sgst='$sgst1', cgst='$cgst1' where invno='$inv'";
		if(mysqli_query($con, $usq5)){
   // echo "Records added successfully.";
		} else{
  // echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
		}
}


//include 'invoice.inc';
?>
   <?php
include 'Insert/invoice.inc';
?> 
<?php
$st = "Active";
$sql2 = "select * from invdetails where status='$st' order by invno desc";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
<div class="w3-container">
<h4><strong>Edit Invoice</strong></h4>
<form method="get" action="">

<p>Select Invoice
<select name="invno" style="width: 170px;">

<?php
$st = "Active";
$z = "0";
$sql = "SELECT * FROM invdetails where status='$st' and paystatus='$z' order by invno";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
$cname = $row["cname"];
?>
<option value="<?php echo $row["invno"] ?>"><?php echo $row["invno"] ?> - <?php echo $row["cname"] ?></option>
<?php
}
?>
<input type="submit" name="search" Value="Search"></input></p>
<br />
<hr>
	</form>
	<?php
	}
	?>
	
<?php
$sub = $_REQUEST["search"];
if ($sub) {
$inv = $_REQUEST['invno'];
$isq ="select * from invdetails where invno='$inv'";
$isqresult = $con->query($isq);
$isqrow = $isqresult->fetch_assoc();
$comid = $isqrow["compid"];
$cid = $isqrow["cid"];

$csql ="select * from Complaints where compid='$comid'";
$cresult = $con->query($csql);
$crow = $cresult->fetch_assoc();

$cmid = "select * from Customers where cid='$cid'";
$cmidresult = $con->query($cmid);
$csrow = $cmidresult->fetch_assoc();

$z = "0";
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
$prsql = "select * from invoice where invno='$inv'";
$prresult = $con->query($prsql);
if ($prresult->num_rows > 0) {
?>

<br /><hr>
<table width="100%" border="0">
<tr>
<td width="8%"><strong></td>
<td width="37%"><strong>Description</td>
<td align="center" width="10%"><strong>Quantity</td>
<td align="right" width="15%"><strong>Price <br />(INR)</td>
<td align="right" width="15%"><strong>Total Amount<br />(INR)</td>
</tr>
<?php
$subtot = "0";
$cgst = "0";
$sgst = "0";
$gst = "0";
$srno = "0";
while($prrow = $prresult->fetch_assoc()) {
$subtot = ($subtot + $prrow["total"]);
$cgst = ($cgst + $prrow["cgst"]);
$sgst = ($sgst + $prrow["sgst"]);
$gst = ($cgst + $sgst);
$srno = ($srno + 1) ;
?> 
	<tr>
<td><a href="einvoice.php?srno=<?php echo $prrow["srno"]?>&itemcod=<?php echo $prrow["itemcode"] ?>&comid=<?php echo $inv ?>"><img src="images/edit21.png"></a></td>
<td width="30%"><?php echo $prrow["parts"] ?></td>
<td align="center"><?php echo $prrow["qty"] ?></td>
<td align="right"><?php echo $prrow["rate"] ?></td>
<td align="right"><?php echo $prrow["total"] ?></td>
</tr>
<?php
}
$cess = 1;
$cess = ($cess / 100) * $subtot;
$gts = ($subtot + $cgst + $sgst + $cess);
?>
<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%"><strong>Sub Total</td>
<td align="right" width="15%"><strong><?php echo $subtot ?></strong></td>
</tr>
<?php
  $st = "Active";
  $sq3 = "select * from Company where status='$st' order by srno desc limit 1";
  $re3 = $con->query($sq3);
  $rw3 = $re3->fetch_assoc();
  if ($rw3["taxenable"] == "yes") {
  ?>
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%">CGST</td>
<td align="right" width="15%"><strong><?php echo $cgst ?></strong></td>
</tr>
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%">SGST</td>
<td align="right" width="15%"><strong><?php echo $sgst ?></strong></td>
</tr>
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%">CESS</td>
<td align="right" width="15%"><strong><?php echo $cess ?></strong></td>
</tr>
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%"><strong>GRAND TOTAL</td>
<td align="right" width="15%"><strong><?php echo $gts ?></strong></td>
</tr>
<?php
}
?>
</table>
<hr>
<form method="get" action="previsedinv.php">
<table width="100%">
<tr>
<td align="center"><input type="hidden" name="invno" value="<?php echo $inv ?>"></input><input type="submit" name="minvoice" value="Make Revised Invoice" class="w3-button w3-green w3-third"></input></td>
</tr>
</table>
</form>
<?php
}
}
?>
   
    </div>
  </div>
  <hr>
   <?php
 include 'footer.inc';
 ?>