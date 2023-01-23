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

$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$bname = $_REQUEST['bname'];
$add1 = $_REQUEST['add1'];
$add2 = $_REQUEST['add2'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$pin = $_REQUEST['pin'];
$phone = $_REQUEST['phone'];
$mobile = $_REQUEST['mobile'];
$email = $_REQUEST['email'];
$re = $_REQUEST['reff'];
$cd = $_REQUEST['coid'];

$user = "Shine";
$cdate = date('Y-m-d H:i:s');
$st = "Active";

// Attempt insert query execution

//$sql = "INSERT INTO Customers(fname, lname, bname, add1, add2, city, state, pincode, phone, mobile, email, reff, crby, crdate, mdate, status) VALUES ('$fname', '$lname', '$bname', '$add1', '$add2', '$city', '$state', '$pin', '$phone', '$mobile', '$email', '$re', '$user', '$cdate', '$cdate' ,'$st')";

$sql = "update Customers set bname='$bname', add1='$add1', add2='$add2', city='$city', state='$state', pincode='$pin', phone='$phone', mobile='$mobile', email='$email', reff='$re', mdate='$cdate' where cid='$cd'";


//$con->exec($sql);
if(mysqli_query($con, $sql)){
   // echo "Records updated successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
include 'customer.inc';
?>
  	
  </div>
  <div class="left">
    <h3><strong>Sucessfully Updated Customer Details</strong></h3>
	<br />
    <div class="left_box"> <form method="get" action="customers.php">
<table align="center" width="100%" border="0" cellpadding="5">
<tr>
<td width="20%"><strong>First Name</td><td width="35%"><?php echo $fname ?></td>
<td width="16%"><strong>Last Name</td><td width="35%"><?php echo $lname ?></td>
</tr>
<tr><td><strong>Business Name</td><td><?php echo $bname ?></td>
<td><strong>Address1</td><td><?php echo $add1 ?></td>
</tr>
<tr><td><strong>Address2</td><td><?php echo $add2 ?></td>
<td><strong>City</td><td><?php echo $city ?></td>
</tr>
<tr><td><strong>State</td><td><?php echo $state ?></td>
<td><strong>Pincode</td><td><?php echo $pin ?></td>
</tr>
<tr><td><strong>Phone</td><td><?php echo $phone ?></td>
<td><strong>Mobile</td><td><?php echo $mobile ?></td>
</tr>
<tr><td><strong>Email</td><td><?php echo $email ?></td>
<td><strong>Reffered By</td><td><?php echo $re ?></td></tr>
</table>
<br /><br /><br /><br /><br /><br /><br /><br />
<?php
$urole = "Admin";
if ($urole == "Admin") {
?>

    <p><a href="createticket.php" class="button6">Create Ticket</a></button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="pendingtickets.php" class="button6">View Pending Tickets</a></p>

<?php
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
