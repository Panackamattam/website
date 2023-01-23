<?php
include 'head.inc';
include 'connection.php';

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
  
	
	
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
    <h3><strong>Update Tickets</strong></h3>
	<?php
	if ($msg) {
	?>
	<font color="red"><?php echo $msg ?></font>
	<?php	
	}
	?>
   	<form method="get" action="">
<?php
$sub = $_REQUEST['search'];
if ($msg) {
?>
					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Your Complaint ID</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $comid ?>" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["fname"] ?>" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>

					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Last Name</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $csrow["lname"] ?>" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Firm Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["bname"] ?>" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address1</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $csrow["add1"] ?>" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address2</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["add2"] ?>" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>	

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
<h4><strong>Visit History</strong></h4>
<table class="table">
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
<h4><strong><u>Parts Request</u></strong></h4>
<table class="table">
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
}
?>
<?php
$sub = $_REQUEST['search'];
if ($sub) {
?>
<table class="table">
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
<h4><strong><u>Visit History</u></strong></h4>
<table  class="table">
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
<h4><strong><u>Parts Request</u></strong></h4>
<table  class="table">
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
    <h4><strong>Update Ticket</strong></h4>
<table class="table">
<tr>
<td><strong>Date<input type="hidden" name="comid" value="<?php echo $comid ?>"></input></td><td><input type="date" name="vdate"></input></td>
<td><strong>Ticket status<input type="hidden" name="cid" value="<?php echo $cid ?>"></input></td><td><select name="tstatus" style="width: 170px;">
<option value="In Process">In Process</option>
<option value="Waiting for Parts">Waiting for Parts</option>
<option value="Waiting for Customer Approval">Waiting for Customer Approval</option>
<option value="Resolved">Resolved</option>
</td>
</tr>
<tr>
<td valign="top"><strong>Visit Remark</td><td colspan="3"><textarea name="vremark" rows="5" cols="70"></textarea></td>
</tr>
<tr>
<td colspan="4" align="center"><input type="hidden" name="update" Value="Update"><button type="submit" class="btn btn-primary mr-2">Submit</button></input></td>
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
  </div>  </div>
</div>
 <?php
   include 'footer.inc';
   ?>
