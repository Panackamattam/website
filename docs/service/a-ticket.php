<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';

//$con =mysqli_connect("localhost","attinqst","9zYs%#*Es6vG4!3~","attinqst_service");
if($con){
//echo "Connected Sucessfully";
}
else{
//echo "Not Connected";
}
//mysqli_close($con);

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$cid = $_REQUEST['cus'];
$comid = $_REQUEST['comid'];

$cidsql = "select * from Complaints where compid='$comid'";
$cidresult = $con->query($cidsql);
$cidrow = $cidresult->fetch_assoc();
$comid = $cidrow["compid"];
$cid = $cidrow["cid"];
$tec = $cidrow["asained"];


$idsql ="select * from Customers where cid='$cid'";
$idresult = $con->query($idsql);
$idrow = $idresult->fetch_assoc();

$cname = $idrow["fname"]." ". $idrow["lname"];

$sub = $_REQUEST['asub'];
if ($sub){
$as = $_REQUEST['tec'];

$sql3 = "update Complaints set asained='$as' where compid='$comid'";
if(mysqli_query($con, $sql3)){
   // echo "Records updated successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}


//customer email started

$sqr1 = "select * from Company where status='$st' order by srno desc limit 1";
//echo $sqr;
$sqrresult1 = $con->query($sqr1);
$qryrow1 = $sqrresult1->fetch_assoc();

$sqr2 = "select * from users where Name='$user'";
//echo $sqr;
$sqrresult2 = $con->query($sqr2);
$qryrow2 = $sqrresult2->fetch_assoc();

$to = $idrow["email"];
$subject = "Your Complaint assigned to technician";

$body .= " \n "
."Dear ".$cname." ,<br /><br />\n "." \n "
."Your complaint assiged to our technician. Details are as follows.<br /><br />\n "." \n "
."<table><tr><td>Complaint ID :</td><td> ".$cidrow['compid']." </td></tr>\r\n "
."<tr><td>Customer Name :</td><td> ".$cidrow['cname'] ." </td></tr>\r\n "
."<tr><td>Address :</td><td> ".$idrow['add1'] ." </td></tr>\r\n "
."<tr><td>Address :</td><td> ".$idrow['add2'] ." </td></tr>\r\n "
."<tr><td>City :</td><td> ".$idrow['city'] ." </td></tr>\r\n "
."<tr><td>Mobile :</td><td> ".$idrow['mobile'] ." </td></tr>\r\n "
."<tr><td>Email :</td><td> ".$idrow['email'] ." </td></tr>\r\n "
//."<tr><td>Email : </td><td>".$crow['type'] ." </td></tr>\r\n "
."<tr><td>Complaint type :</td><td> ".$cidrow['type'] ." </td></tr>\r\n "
."<tr><td>Product Catagory :</td><td> ".$cidrow['cat'] ." </td></tr>\r\n "
."<tr><td>Brand : </td><td>".$cidrow['brand'] ." </td></tr>\r\n "
."<tr><td>Model. : </td><td>".$cidrow['model'] ." </td></tr>\r\n "
."<tr><td>Complaint :</td><td> ".$cidrow['complaint'] ." </td></tr>\r\n "
."<tr><td>&nbsp;</td><td></td></tr>\r\n "
."<tr><td><strong>Technician Name :</td><td> ".$qryrow2['Name'] ." </td></tr>\r\n "
."<tr><td><strong>Mobile Number :</td><td> ".$qryrow2['mobile'] ." </td></tr>\r\n "

//."<tr><td>Visit Remark :</td><td> ".$vr ." </td></tr>\r\n "
//."Version : ".$cmidrow['Version'] ." \n "
//."Renwal Date : ".cmid$row['Renewal']. "\n"
."<tr><td>&nbsp;\n". "\n". " ". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Thanks". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Admin <br />". $qryrow1["companyname"] . "</td></tr></table>\n";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <shinemon40@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$body,$headers);

//customer email ended

//admin email started

$sqr1 = "select * from Company where status='$st' order by srno desc limit 1";
//echo $sqr;
$sqrresult1 = $con->query($sqr1);
$qryrow1 = $sqrresult1->fetch_assoc();

$sqr2 = "select * from users where Name='$user'";
//echo $sqr;
$sqrresult2 = $con->query($sqr2);
$qryrow2 = $sqrresult2->fetch_assoc();

$to = $qryrow2["email"];
$subject = "New complaint assigned to you";

$body1 .= " \n "
."Dear ".$qryrow2['Name']." ,<br /><br />\n "." \n "
."A new complaint assigned to you. Details are as follows.<br /><br />\n "." \n "
."<table><tr><td>Complaint ID :</td><td> ".$cidrow['compid']." </td></tr>\r\n "
."<tr><td>Customer Name :</td><td> ".$cidrow['cname'] ." </td></tr>\r\n "
."<tr><td>Address :</td><td> ".$idrow['add1'] ." </td></tr>\r\n "
."<tr><td>Address :</td><td> ".$idrow['add2'] ." </td></tr>\r\n "
."<tr><td>City :</td><td> ".$idrow['city'] ." </td></tr>\r\n "
."<tr><td>Mobile :</td><td> ".$idrow['mobile'] ." </td></tr>\r\n "
."<tr><td>Email :</td><td> ".$idrow['email'] ." </td></tr>\r\n "
//."<tr><td>Email : </td><td>".$crow['type'] ." </td></tr>\r\n "
."<tr><td>Complaint type :</td><td> ".$cidrow['type'] ." </td></tr>\r\n "
."<tr><td>Product Catagory :</td><td> ".$cidrow['cat'] ." </td></tr>\r\n "
."<tr><td>Brand : </td><td>".$cidrow['brand'] ." </td></tr>\r\n "
."<tr><td>Model. : </td><td>".$cidrow['model'] ." </td></tr>\r\n "
."<tr><td>Complaint :</td><td> ".$cidrow['complaint'] ." </td></tr>\r\n "
//."<tr><td>Visit Remark :</td><td> ".$vr ." </td></tr>\r\n "
//."Version : ".$cmidrow['Version'] ." \n "
//."Renwal Date : ".cmid$row['Renewal']. "\n"
."<tr><td>&nbsp;\n". "\n". " ". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Thanks". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Admin <br />". $qryrow1["companyname"] . "</td></tr></table>\n";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <shinemon40@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$body1,$headers);

//admin email ended



}
?>
<?php
include 'tickets.inc';
?>
	  <?php
  if ($sub){
  $msg= "Successfully assigned ticket to technician";
  ?>
  <font color="red"><?php echo $msg ?></font>
  <?php
  }
  ?>
  </div>
  <div class="left">

    <h3><strong>Assign ticket to technician</strong></h3>
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
?>
<form method="get" action="">	
	<table align="center" width="100%" border="0">
<tr>
<td align="left" width="20%"><strong>Complaint ID</td><td width="35%"><?php echo $comid ?><input type="hidden" name="comid" value="<?php echo $comid ?>"></input></td>
<td align="right" width="12%"><input type="hidden" name="cus" value="<?php echo $cid ?>">&nbsp;</td><td width="33%">&nbsp;</td>
</tr>
<tr>
<td><strong>First Name</td><td><?php echo $idrow["fname"] ?></td>
<td><strong>Last Name</td><td><?php echo $idrow["lname"] ?></td>
</tr>
<tr><td><strong>Business Name</td><td><?php echo $idrow["bname"] ?></td>
<td><strong>Address1</td><td><?php echo $idrow["add1"] ?></td>
</tr>
<tr><td><strong>Address2</td><td><?php echo $idrow["add2"] ?></td>
<td><strong>City</td><td><?php echo $idrow["city"] ?></td>
</tr>
<tr><td><strong>State</td><td><?php echo $idrow["state"] ?></td>
<td><strong>Pincode</td><td><?php echo $idrow["pincode"] ?></td>
</tr>
<tr><td><strong>Phone</td><td><?php echo $idrow["phone"] ?></td>
<td><strong>Mobile</td><td><?php echo $idrow["mobile"] ?></td>
</tr>
<tr><td><strong>Email</td><td><?php echo $idrow["email"] ?></td>
<td><strong>Reffered By</td><td><?php echo $idrow["reff"] ?></td></tr>
</table>
<br />
    <h3><strong>Complaint Details</strong></h3>
	<br />
	<?php
	$stat = "Active";
$te = "technician";
$sq51 = "select * from users where status='$stat' and role='$te'";
//echo $sq51;
$resultu = $con->query($sq51);
?>
<table width="100%" border="0" cellpadding="5">
<tr>
<td width="22%"><strong>Complaint Raised By</td><td width="28%"><?php echo $cidrow["reff"] ?></td>
<td width="22%">&nbsp;</td><td width="28%">&nbsp;</td>
<tr>
<td><strong>Type of Complaint</td><td><?php echo $cidrow["type"] ?></td>
</td>
<td><strong>Catagory of Product</td><td><?php echo $cidrow["cat"] ?></td>
</tr>
<tr>
<td><strong>Brand</td><td align="left"><?php echo $cidrow["brand"] ?></td>
<td><strong>Model Number</td><td align="left"><?php echo $cidrow["model"] ?></td>
</tr>
<tr><td valign="top"><strong>Complaint in Breif</td><td colspan="3"><textarea name="w3review" rows="7" cols="70" readonly><?php echo $cidrow["complaint"] ?></textarea></td>
</tr>
<tr>
<td>Select Technician</td><td>
<select name="tec" style="width: 150px;">
<?php
while($rowu = $resultu->fetch_assoc()) {
?>
<option value="<?php echo $rowu["Name"] ?>"><?php echo $rowu["Name"] ?></option>
<?php
}
?>
</select>
</td>
<td></td>
<td></td>
</tr>
<tr><td colspan="4" align="center"><input type="submit" name="asub" value="Assign Ticket"></input></td></tr>
</table>
<br />
<?php
$urole = "Admin";
if ($urole == "Admin") {
?>

    <p><a href="a-ticket.php" class="button6">Assian Ticket</a></button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="editcustomers.php" class="button6">Update Ticket</a></p>

<?php
}
?>
</form>
<?php
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
