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
$st = "Active";
$comid = $_REQUEST['comid'];

$csql ="select * from Complaints where compid='$comid'";
$cresult = $con->query($csql);
$crow = $cresult->fetch_assoc();
$cid = $crow["cid"];

$cmid = "select * from Customers where cid='$cid'";
$cmidresult = $con->query($cmid);
$csrow = $cmidresult->fetch_assoc();
$cname = $csrow["fname"]. " " .$csrow["lname"];
$mobile = $csrow["mobile"];
$email = $csrow["email"];

$cmid = $cmidrow["compid"];
$z = "0";
$pst1 = "Issued";

//------invoice insert started
$cer = $_REQUEST["cr"];
if ($cer == "CreateInvoice"){
$idsql = "select * from invdetails order by invno desc limit 1";
$idresult = $con->query($idsql);
$idrow = $idresult->fetch_assoc();

$invno = ($idrow["invno"] + 1);
$insql = "INSERT INTO invdetails(invno, invdate, compid, cid, cname, mobile, email, invamount, paystatus, crby, crdate) VALUES ('$invno', '$cdate', '$comid', '$cid', '$cname', '$mobile', '$email', '$z', '$z', '$user', '$cdate')";
if(mysqli_query($con, $insql)){
   // echo "Records added successfully.";
			} else{
  // echo "ERROR: Could not able to execute $ipsql. " . mysqli_error($con);
			}

$psql1 = "select * from parts where compid='$comid' and pstatus='$pst1'";
$presult1 = $con->query($psql1);
if ($presult1->num_rows > 0) {
while($prrow1 = $presult1->fetch_assoc()) {
$part = $prrow1["parts"];
$qt = $prrow1["issuedqty"];
$srate = $prrow1["sellingrate"];
$tot = ($qt * $srate);

$ipsql = "INSERT INTO invoice(invno, invdate, parts, qty, rate, total, compid, cid, status, crby, crdate, mdby, mddate) VALUES ('$invno', '$cdate', '$part', '$qt', '$srate', '$tot', '$comid', '$cid', '$st', '$user', '$cdate', '$z', '$cdate')";
//echo $ipsql;
if(mysqli_query($con, $ipsql)){
  //  echo "Records added successfully.";
			} else{
  // echo "ERROR: Could not able to execute $ipsql. " . mysqli_error($con);
			}
}
}
}
//invoice insert ended

//Other charges insert started
$ne = $_REQUEST["search"];
if ($ne) {

$se1 = $_REQUEST['item'];
$sql61 = "select * from invoice where parts='$se1' and compid='$comid'";
$result6 = $con->query($sql61);
if ($result6->num_rows > 0) {
}
else
{

$sql8 = "select * from invdetails where compid='$comid' order by invno desc limit 1";
$result8 = $con->query($sql8);
$row8 = $result8->fetch_assoc();
$invno = $row8["invno"];
$invdt = $row8["invdate"];
$part = $_REQUEST['item'];
$qt = $_REQUEST['qty'];
$srate = $_REQUEST['rate'];
$tot = ($qt * $srate);

$sql7 = "INSERT INTO invoice(invno, invdate, parts, qty, rate, total, compid, cid, status, crby, crdate, mdby, mddate) VALUES ('$invno', '$cdate', '$part', '$qt', '$srate', '$tot', '$comid', '$cid', '$st', '$user', '$cdate', '$z', '$cdate')";
if(mysqli_query($con, $sql7)){
  //  echo "Records added successfully.";
			} else{
  // echo "ERROR: Could not able to execute $ipsql. " . mysqli_error($con);
			}
}
}

//Other charges insert ended


include 'tickets.inc';
?>
    
	
  </div>
  <div class="left">
    <h3><strong>Ticket details are as follows;</strong></h3>
    <div class="left_box"> <form method="get" action="pinvoice.php">
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
$pst = "Issued";
$total = "0";
$prsql = "select * from invoice where compid='$comid' and status='$st'";
$prresult = $con->query($prsql);
if ($prresult->num_rows > 0) {
?>

<br /><hr>
<caption><strong><u>Parts Issued</u></strong></caption>
<table width="100%" border="0">
<tr>
<td></td>
<td><strong>Date</strong></td>
<td><strong>Item</strong></td>
<td align="center"><strong>Issued Qty</strong></td>
<td><strong>Item Status</strong></td>
<td align="right"><strong>Selling Rate</strong></td>
<td align="right">Total</td>
</tr>
<?php
$tot = "0";
$total = "0";
while($prrow = $prresult->fetch_assoc()) {
$tot = ($prrow["qty"] * $prrow["rate"]);
$total = ($total + $tot);
?>
<tr>
<td><a href="irate.php?srno=<?php echo $prrow["srno"]?>&rec=db&comid=<?php echo $comid ?>"><img src="images/edit21.png"></a></td>
<td><?php echo $prrow["crdate"] ?></td>
<td><?php echo $prrow["parts"] ?></td>
<td align="center"><?php echo $prrow["qty"] ?></td>
<td><?php echo $prrow["status"] ?></td>
<td align="right"><?php echo $prrow["rate"] ?></td>
<td align="right"><?php echo $tot ?></td>
</tr>

<?php
$tot = "0";
}
?>
<tr>
<td></td>
<td align="center"></td>
<td>Total</td>
<td align="center"></td>
<td align="center"></td>
<td align="right"></td>
<td align="right"><?php echo $total ?></td>
</tr>
<?php
$se = $_REQUEST['item'];
$sql6 = "select * from invoice where parts='$se' and compid='$comid'";
$result6 = $con->query($sql6);
if ($result6->num_rows > 0) {
$msg =  "item already added";
?>
<font color="red">&nbsp;&nbsp;<?php echo $msg ?></font>
<?
}
else
{
?>
<tr>
<td></td>
<td align="center"></td>
<td>Service Charges</td>
<td align="center"></td>
<td align="center"></td>
<td align="right"><a href="irate.php?rec=new&it=Service Charges&comid=<?php echo $comid ?>">Click to Add Rate</td>
<td align="center"></td>
</tr>
<?php
}
?>
<tr>
<td></td>
<td align="center"></td>
<td>Any Other Charges</td>
<td align="center"></td>
<td align="center"></td>
<td align="right"><a href="irate.php?rec=new&it=Other Charge&comid=<?php echo $comid ?>">Click to Add Rate</td>
<td align="center"></td>
</tr>
<tr>
<td colspan="7" align="center"><input type="hidden" name="comid" value="<?php echo $comid ?>"></input><input type="submit" name="minvoice" value="Make Invoice"></input></td>
</tr>
</table>
<hr>
<?php
}
?>

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