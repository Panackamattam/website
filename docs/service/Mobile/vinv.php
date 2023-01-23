<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php

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
//include 'invoice.inc';
?>
<?php
include 'Insert/invoice.inc';
?>
<div class="w3-container">
    <h4><strong>Invoice Details are as follows</strong></h4>
	    <div class="w3-row w3-large">
      <div class="w3-col s6">
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
<td width="8%"><strong>Sr. No</td>
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
<td><?php echo $srno ?></td>
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
</table>
<hr>
<?php
}
?>

  </div>
  </div>
  <hr>
   <?php
 include 'footer.inc';
 ?>
