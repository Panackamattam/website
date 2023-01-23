<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php

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
include 'Insert/tickets.inc';
?>
	  
<form method="get" action="">
  <div class="w3-container">
    <h4><strong>Assign ticket to technician</strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
		  <?php
  if ($sub){
  $msg= "Successfully assigned ticket to technician";
  ?>
  <p><font color="red"><?php echo $msg ?></font></p>
  <?php
  }
  ?>
<p>Select Ticket: 
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
</select>
<button type="submit" name="search" value="Search" class="w3-button w3-green w3-third">Search</button></p>
	</form>
<hr>
<br /><br />
<?php
$sub = $_REQUEST['search'];
if ($sub) {
?>
<form method="get" action="">	

<p>Your Complaint ID: <input type="text" name="fname" size="25" value="<?php echo $comid ?>" disabled><input type="hidden" name="comid" value="<?php echo $comid ?>"></input></p>
<p>First Name: <input type="text" name="fname" size="25" value="<?php echo $idrow["fname"] ?>" disabled><input type="hidden" name="cus" value="<?php echo $cid ?>"></p>
<p>Last Name: <input type="text" name="fname" size="25" value="<?php echo $idrow["lname"] ?>" disabled></p>
<p>Business Name: <input type="text" name="fname" size="25" value="<?php echo $idrow["bname"] ?>" disabled></p>
<p>Address1: <input type="text" name="fname" size="25" value="<?php echo $idrow["add1"] ?>" disabled></p>
<p>Address2: <input type="text" name="fname" size="25" value="<?php echo $idrow["add2"] ?>" disabled></p>
<p>City: <input type="text" name="fname" size="25" value="<?php echo $idrow["city"] ?>" disabled><p>
<p>State: <input type="text" name="fname" size="25" value="<?php echo $idrow["state"] ?>" disabled></p>
<p>Pincode: <input type="text" name="fname" size="25" value="<?php echo $idrow["pincode"] ?>" disabled></p>
<p>Phone: <input type="text" name="fname" size="25" value="<?php echo $idrow["phone"] ?>" disabled></p>
<p>Mobile: <input type="text" name="fname" size="25" value="<?php echo $idrow["mobile"] ?>" disabled></p>
<p>Email: <input type="text" name="fname" size="25" value="<?php echo $idrow["email"] ?>" disabled></p>
<p>Reffered By: <input type="text" name="fname" size="25" value="<?php echo $idrow["reff"] ?>" disabled></p>
<p><strong>Complaint Details</strong></p>
<p>Type of Complaint: <input type="text" name="fname" size="25" value="<?php echo $cidrow["type"] ?>" disabled></p>
<p>Product Catagory: <input type="text" name="fname" size="25" value="<?php echo $cidrow["cat"] ?>" disabled></p>
<p>Brand: <input type="text" name="fname" size="25" value="<?php echo $cidrow["brand"] ?>" disabled></p>
<p>Model Number: <input type="text" name="fname" size="25" value="<?php echo $cidrow["model"] ?>" disabled></p>
<p>Complaint in Breif: <textarea name="w3review" rows="7" cols="30"  disabled><?php echo $cidrow["complaint"] ?></textarea></p>


<p>Select Technician: 
<select name="tec" style="width: 150px;">
<?php
	$stat = "Active";
$te = "technician";
$sq51 = "select * from users where status='$stat' and role='$te'";
//echo $sq51;
$resultu = $con->query($sq51);
while($rowu = $resultu->fetch_assoc()) {
?>
<option value="<?php echo $rowu["Name"] ?>"><?php echo $rowu["Name"] ?></option>
<?php
}
?>
</select>
</p>
<p><input type="submit" name="asub" value="Assign Ticket"></input></p>

<br />
</form>
<?php
}
?>
    </div>
  </div>
  <hr>
  <?php
 include 'footer.inc';
 ?>