<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
?>
<?php
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
include 'Insert/customer.inc';
?>

<form method="get" action="">
  <div class="w3-container">
    <h4><strong>Sucessfully updated customer details</strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
	  
<p><i class="fa fa-fw fa-male"></i> First Name: <input type="text" name="fname" size="25" value="<?php echo $fname ?>" disabled></p>
        <p><i class="fa fa-fw fa-male"></i> Last Name: <input type="text" name="lname" size="25" value="<?php echo $lname ?>" disabled></p>
        <p><i class="fa fa-fw fa-building"></i> Business Name: <input type="text" name="bname" size="25"  value="<?php echo $bname ?>" disabled></input></p>
		<p><i class="fa fa-fw fa-address-book"></i> Address1: <input type="text" name="add1" size="25"  value="<?php echo $add1 ?>" disabled></input></p>
		<p><i class="fa fa-fw fa-address-book"></i>Address2: <input type="text" name="add2" size="25"  value="<?php echo $add2 ?>" disabled></input></p>
        <p><i class="fa fa-fw fa-address-book"></i>City: <input type="text" name="city" size="25"  value="<?php echo $city ?>" disabled></input></p>
        <p><i class="fa fa-fw fa-address-book"></i>State: <input type="text" name="state" size="25"  value="<?php echo $state ?>" disabled></input></p>
		<p><i class="fa fa-fw fa-address-book"></i>Pincode: <input type="text" name="pin" size="25"  value="<?php echo $pin ?>" disabled></input></p>
		<p><i class="fa fa-fw fa fa-phone"></i>Phone: <input type="text" name="phone" size="25"  value="<?php echo $phone ?>" disabled></input></p>
		<p><i class="fa fa-fw fa fa-mobile-phone"></i>Mobile: <input type="text" name="mobile" size="25"  value="<?php echo $mobile ?>" disabled></input></p>
        <p><i class="fa fa-fw fa-envelope"></i>Email: <input type="text" name="email" size="25"  value="<?php echo $email ?>" disabled></input></p>
        <p><i class="fa fa-fw fa-male"></i>Reffered By: <input type="text" name="reff" size="25"  value="<?php echo $re ?>" disabled></input></p>
		    <hr>
    </div>
  </div>
  <?php
 include 'footer.inc';
 ?>
