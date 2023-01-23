<?php
session_start();

if ($_SESSION["username"] == ""){
header("Location: http://www.bmibearings.com/service/login.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Internet Services</title>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<link rel="stylesheet" href="images/style.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
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

	$itcode= $_REQUEST['itcode'];
	if ($itcode) {
	$z = "0";
	$isql = "select * from Stock where itemcode='$itcode' and balqty>'$z' and status='$st1'";

	$result4 = $con->query($isql);
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
    <h3>Pending</h3>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <h3>Completed</h3>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
  </div>
  <div class="footer">
    <p><a href="#">Homepage</a> | <a href="#">Contact</a> | <a href="#">Accessibility</a> | <a href="#">Products</a> | <a href="#">Disclaimer</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a><br />
&copy; Copyright 2006 Internet Services, Design: Luka Cvrk - <a href="http://www.solucija.com/" title="What's your solution?">Solucija</a></p>
  </div>
</div>
</body>
</html>