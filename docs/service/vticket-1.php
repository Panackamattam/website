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

$cmid = $cmidrow["compid"];
include 'tickets.inc';
?>
    
	
  </div>
  <div class="left">
    <h3><strong>Ticket details are as follows;</strong></h3>
    <div class="left_box"> <form method="get" action="customers.php">
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
<caption><strong>Visit History</strong></caption>
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
<td><strong>Request Date</strong></td>
<td><strong>Item</strong></td>
<td><strong>Qty</strong></td>
<td><strong>Item Status</strong></td>
</tr>
<?php
while($prrow = $prresult->fetch_assoc()) {
?>
<tr>
<td><?php echo $prrow["crdate"] ?></td>
<td><?php echo $prrow["parts"] ?></td>
<td><?php echo $prrow["qty"] ?></td>
<td><?php echo $prrow["pstatus"] ?></td>
</tr>

<?php
}
?>
</table>
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