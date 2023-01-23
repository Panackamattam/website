<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php
$comid = $_REQUEST['comid'];

$csql ="select * from Complaints where compid='$comid'";
$cresult = $con->query($csql);
$crow = $cresult->fetch_assoc();
$cid = $crow["cid"];

$cmid = "select * from Customers where cid='$cid'";
$cmidresult = $con->query($cmid);
$csrow = $cmidresult->fetch_assoc();

$cmid = $cmidrow["compid"];

$sub1 = $_REQUEST['update'];
if ($sub1) {
$vdt = $_REQUEST['vdate'];
$tst = $_REQUEST['tstatus'];
$vr = $_REQUEST['vremark'];

$comid = $_REQUEST['comid'];
$cidn = $_REQUEST['cid'];

$usql = "INSERT INTO cvisits(compid, cid, vdate, remark, user, crdate, status) VALUES ('$comid', '$cidn', '$vdt', '$vr', '$user', '$cdate', '$st')";
if(mysqli_query($con, $usql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

$upsql = "update Complaints set cstatus='$tst' where compid='$comid'";
if(mysqli_query($con, $upsql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
$msg = "Ticket updated successfully !";
}

//admin email started

$sqr1 = "select * from Company where status='$st' order by srno desc limit 1";
//echo $sqr;
$sqrresult1 = $con->query($sqr1);
$qryrow1 = $sqrresult1->fetch_assoc();

$to = $qryrow1["email"];
$subject = "Complaint Visit Details";

$body1 .= " \n "
."Dear ".$qryrow1['contact']." ,<br /><br />\n "." \n "
."Complaint Visit Details from.".$user ." <br /><br />\n "." \n "
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
?>
  

  <?php
include 'Insert/tickets.inc';
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
	    <h4><strong><u>Update ticket</u></strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
		 
<p>Select Ticket: 
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
</select>
<button type="submit" name="search" value="Search" class="w3-button w3-green w3-third">Search</button></p>
	</form>
<hr>
<br /><br />
<hr>

<?php
$sub = $_REQUEST['search'];
if ($msg) {
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
$vsql = "select * from cvisits where compid='$comid'";
$vresult = $con->query($vsql);
if ($vresult->num_rows > 0) {
?>
<BR />
<p>Visit History</u></strong></p>
<table class="names" width="100%" border="0">
<tr>
<td><strong>Visit Date</strong></td>
<td><strong>Visit Remark</strong></td>
<td><strong>Technician</strong></td>
</tr>
<?php
while($vrow = $vresult->fetch_assoc()) {
?>
<tr>
<td><?php echo $vrow["vdate"] ?></td>
<td><?php echo $vrow["remark"] ?></td>
<td><?php echo $vrow["user"] ?></td>
</tr>

<?php
}
?>
</table>
</font>
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
<td><strong>Date</strong></td>
<td><strong>Item</strong></td>
<td><strong>Qty</strong></td>
</tr>
<?php
while($prrow = $prresult->fetch_assoc()) {
?>
<tr>
<td><?php echo $prrow["crdate"] ?></td>
<td><?php echo $prrow["parts"] ?></td>
<td><?php echo $prrow["qty"] ?></td>
</tr>

<?php
}
?>
</table>
<?php
}
?>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
<form method="get" action="">
    <h3><strong>Update Ticket</strong></h3>
<p>Date: <input type="hidden" name="comid" value="<?php echo $comid ?>"></input><input type="date" name="vdate"></input></p>
<p>Ticket status: <input type="hidden" name="cid" value="<?php echo $cid ?>"></input>
<select name="tstatus" style="width: 170px;">
<option value="In Process">In Process</option>
<option value="Waiting for Parts">Waiting for Parts</option>
<option value="Waiting for Estimate Approval">Waiting for Estimate Approval</option>
<option value="Resolved">Resolved</option>
</select>
</p>
<p>Visit Remark: <textarea name="vremark" rows="5" cols="30"></textarea></p>
<p><input type="submit" name="update" Value="Update"></input></p>
</form>
<br />
<?php
}
?>
</form>




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
$vsql = "select * from cvisits where compid='$comid'";
$vresult = $con->query($vsql);
if ($vresult->num_rows > 0) {
?>
<p><strong><u>Visit History</u></strong></p>
<table class="names" width="100%" border="0">
<tr>
<td><strong>Visit Date</strong></td>
<td><strong>Visit Remark</strong></td>
<td><strong>Technician</strong></td>
</tr>
<?php
while($vrow = $vresult->fetch_assoc()) {
?>
<tr>
<td><?php echo $vrow["vdate"] ?></td>
<td><?php echo $vrow["remark"] ?></td>
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
<td><strong>Date</strong></td>
<td><strong>Item</strong></td>
<td><strong>Qty</strong></td>
</tr>
<?php
while($prrow = $prresult->fetch_assoc()) {
?>
<tr>
<td><?php echo $prrow["crdate"] ?></td>
<td><?php echo $prrow["parts"] ?></td>
<td><?php echo $prrow["qty"] ?></td>
</tr>

<?php
}
?>
</table>
<?php
}
?>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
<form method="get" action="">
    <h3><strong>Update Ticket</strong></h3>
<p>Date: <input type="hidden" name="comid" value="<?php echo $comid ?>"></input><input type="date" name="vdate"></input></p>
<p>Ticket status: <input type="hidden" name="cid" value="<?php echo $cid ?>"></input>
<select name="tstatus" style="width: 170px;">
<option value="In Process">In Process</option>
<option value="Waiting for Parts">Waiting for Parts</option>
<option value="Waiting for Estimate Approval">Waiting for Estimate Approval</option>
<option value="Resolved">Resolved</option>
</select>
</p>
<p>Visit Remark: <textarea name="vremark" rows="5" cols="30"></textarea></p>
<p><input type="submit" name="update" Value="Update"></input></p>
</form>
<br />
<?php
}
?>
</form>
    </div>
  </div><hr>
   <?php
 include 'footer.inc';
 ?>