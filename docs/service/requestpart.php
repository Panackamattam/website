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

$psub = $_REQUEST['add'];
if ($psub) {
$prt = $_REQUEST['part'];
$qty = $_REQUEST['qty'];
$comid = $_REQUEST['comid'];
$pst = "In process";
$rt = "0";

$psql = "INSERT INTO parts(compid, cid, parts, qty, user, crdate, status, pstatus) VALUES ('$comid', '$cid', '$prt', '$qty' ,'$user' ,'$cdate' ,'$st' ,'$pst')";
if(mysqli_query($con, $psql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

$esql = "INSERT INTO estimates(compid, cid, item, qty, rate, total, crdate, user, status) VALUES ('$comid', '$cid', '$prt', '$qty' ,'$rt', '$rt', '$cdate', '$user', '$st')";
if(mysqli_query($con, $esql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

//admin email started

$sqr1 = "select * from Company where status='$st' order by srno desc limit 1";
//echo $sqr;
$sqrresult1 = $con->query($sqr1);
$qryrow1 = $sqrresult1->fetch_assoc();

$to = $qryrow1["email"];
$subject = "Parts request received";

$body1 .= " \n "
."Dear ".$qryrow1['contact']." ,<br /><br />\n "." \n "
."Parts request received from .".$user ." Please check and process further <br /><br />\n "." \n "
."<table><tr><td>Complaint ID :</td><td> ".$crow['compid']." </td></tr>\r\n "
."<tr><td>Customer Name :</td><td> ".$crow['cname'] ." </td></tr>\r\n "
//."<tr><td>Email : </td><td>".$crow['type'] ." </td></tr>\r\n "
."<tr><td>Product Catagory :</td><td> ".$crow['type'] ." </td></tr>\r\n "
."<tr><td>Brand : </td><td>".$crow['brand'] ." </td></tr>\r\n "
."<tr><td>Model. : </td><td>".$crow['model'] ." </td></tr>\r\n "
."<tr><td>Complaint :</td><td> ".$crow['complaint'] ." </td></tr>\r\n "
."<tr><td>Visit Remark :</td><td> ".$vr ." </td></tr>\r\n "
//."Version : ".$cmidrow['Version'] ." \n "
//."Renwal Date : ".cmid$row['Renewal']. "\n"
."<tr><td>&nbsp;\n". "\n". " ". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Thanks". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Admin (ABC Service)". "</td></tr></table>\n";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <shinemon40@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$body1,$headers);

//admin email ended



}
include 'tickets.inc';
?>
  
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
  $user = $_SESSION["username"];
  $role = $_SESSION["role"];
$st = "Resolved";
	if ($role == "technician") {
$sql = "SELECT * FROM Complaints where cstatus!='$st' and asained='$user' order by compid desc";
}

	if ($role == "Admin") {
	$sql = "SELECT * FROM Complaints where cstatus!='$st' order by compid desc";
	}
	
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
$vsql = "select * from cvisits where compid='$comid'";
$vresult = $con->query($vsql);
if ($vresult->num_rows > 0) {
?>
<BR />
<hr>
<caption><strong><u>Visit History</u></strong></caption>
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
<form method="get" action="">
    <h3><strong>Parts Request</strong></h3>
<table align="center" width="100%" border="0" cellpadding="8">
<tr>
<td><strong>Parts Description<input type="hidden" name="comid" value="<?php echo $comid ?>"></input></td><td><input type="text" name="part"></input></td>
</tr>
<tr>
<td><strong>Quantity Required<input type="hidden" name="cid" value="<?php echo $cid ?>"></input></td><td><input type="text" name="qty"></input>
</td>
</tr>
<tr>
<td colspan="4" align="center"><input type="hidden" name="search" value="search"><input type="submit" name="add" Value="Request Parts"></input></td>
</tr>

</table>
</form>
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
