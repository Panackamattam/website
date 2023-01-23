<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';

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


include 'invoice.inc';
?>
    
	
  </div>
  <?php
$st = "Active";
$sql2 = "select * from invdetails where status='$st' order by invno desc";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
  <div class="left">
    <h3><strong>Edit Invoice</strong></h3>
	<br />
    <div class="left_box"> <form method="get" action="">
	<table width="100%" border="0" align="left">
<tr>
<td align="left" width="25%">Select Invoice</td><td width="30%">
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
</td>
<td><input type="submit" name="search" Value="Search"></input></td>
</tr>
</table>
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
<td align="center"><input type="hidden" name="invno" value="<?php echo $inv ?>"></input><input type="submit" name="minvoice" value="Make Revised Invoice"></input></td>
</tr>
</table>
</form>
<?php
}
}
?>
   
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
