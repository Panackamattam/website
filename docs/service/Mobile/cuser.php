<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php


if ($_REQUEST['submit']) {
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$bname = $_REQUEST['bname'];
$add1 = $_REQUEST['add1'];
$add2 = $_REQUEST['add2'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$pin = $_REQUEST['pin'];
$phone = $_REQUEST['mobile'];
$email = $_REQUEST['email'];
$role = $_REQUEST['role'];

$uname = $_REQUEST['uname'];
$pass = $_REQUEST['password'];
 
// Attempt insert query execution
$sql = "INSERT INTO users(Name, add1, add2, city, state, phone, mobile, email, role, crdate, status, uname, password, crby) VALUES ('$fname', '$add1', '$add2', '$city', '$state', '$phone', '$phone', '$email', '$role', '$cdate', '$st', '$uname', '$pass', '$user')";
if(mysqli_query($con, $sql)){
   // echo "Records added successfully.";
   $msg = "User added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
}
//include 'admin.inc';
?>
   <?php
include 'Insert/admin.inc';
?> 

	
<div class="w3-container">
    <h2>Create User</h2>
	    <p><font color="red"><?php echo $msg ?></font></p>
     <div class="w3-row w3-large">
      <div class="w3-col s6">
	
	<form method="get" action="">
<p>Enter Username: <input type="text" name="uname" size="25" required></p>
</tr>
<p>Password: <input type="password" name="password" size="25" required></p>
<p>First Name: <input type="text" name="fname" size="25" required></p>
<p>Address1: <input type="text" name="add1" size="25"></input></p>
<p>Address2: <input type="text" name="add2" size="25"></input></p>
<p>City: <input type="text" name="city" size="25"></input></p>
<p>State: <input type="text" name="state" size="25"></input></p>
<p>Pincode: <input type="text" name="pin" size="25"></input></p>
<p>Mobile: <input type="text" name="mobile" size="25" required></input></p>
<p>Email: <input type="text" name="email" size="25" required></input></p>
<p>Role: 
<select name="role">
<option value="user">User</option>
<option value="technician">Technician</option>
<option value="Admin">Admin</option>
</select>

</p>
<p><input type="submit" name="submit" value="Add User" class="w3-button w3-green w3-third"></input></p>

</form>
    </div>
  </div>
 <hr >
     <?php
 include 'footer.inc';
 ?>