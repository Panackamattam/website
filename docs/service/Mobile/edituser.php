<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php


if ($_REQUEST['update']) {
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
$uid = $_REQUEST['uid'];
$stat = $_REQUEST['stat'];
$sql55 = "update users set Name='$fname', add1='$add1', add2='$add2', city='$city', state='$state', mobile='$phone', email='$email', role='$role', status='$stat', mdby='$user' where uid='$uid'";
if(mysqli_query($con, $sql55)){
   // echo "Records added successfully.";
   $msg = "User updated successfully.";
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
    <h3><strong>Edit/Update User Details</strong></h3>
<p><font color="red"><?php echo $msg ?></font></p>
     <div class="w3-row w3-large">
      <div class="w3-col s6">
<form method="get" action="">
<p>Select User: 

<select name="cus" style="width: 150px;">

<?php
$st = "Active";
$sql = "SELECT * FROM users where status='$st'";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
$cname = $row["fname"]." ".$row["lname"];
?>
<option value="<?php echo $row["uid"] ?>"><?php echo $row["Name"] ?></option>
<?php
}
?>
</select>
</p>
<p><input type="submit" name="sub" Value="Search" class="w3-button w3-green w3-third"></p>
</form>

<br /><br />
<?php
if ($_REQUEST['sub']) {
$uid = $_REQUEST['cus'];
$usq4 = "select * from users where uid='$uid'";
$usqresult = $con->query($usq4);
$row45 = $usqresult->fetch_assoc();
?>
<form method="get" action="">
<p>Enter Username: <input type="hidden" name="uid" value="<?php echo $uid ?>"></input><input type="text" name="uname" size="25" value="<?php echo $row45["uname"] ?>" disabled></p>
<p>First Name: <input type="text" name="fname" size="25" value="<?php echo $row45["Name"] ?>" disabled></p>
<p">Address1: <input type="text" name="add1" size="45"value="<?php echo $row45["add1"] ?>" ></input></p>
<p>Address2: <input type="text" name="add2" size="45" value="<?php echo $row45["add2"] ?>" ></input></p>
<p>City: <input type="text" name="city" size="45" value="<?php echo $row45["city"] ?>"></input></p>
<p>State: <input type="text" name="state" size="45" value="<?php echo $row45["state"] ?>"></input></p>
<p>Mobile<input type="text" name="mobile" size="45" value="<?php echo $row45["mobile"] ?>" required></input></p>
<p>Email: <input type="text" name="email" size="45" value="<?php echo $row45["email"] ?>" required></input></p>
<p>Role: 
<select name="role">
<option value="user" <?php if ($row45["role"] == "user") { echo "selected"; } ?>>User</option>
<option value="technician" <?php if ($row45["role"] == "technician") { echo "selected";} ?>>Technician</option>
<option value="Admin" <?php if ($row45["role"] == "Admin") { echo "selected";} ?>>Admin</option>
</select>
</p>
<p>User Status:
<select name="stat">
<option value="Active" <?php if ($row45["status"] == "Active") { echo "selected"; } ?>>Active</option>
<option value="Inavice" <?php if ($row45["status"] == "Inactive") { echo "selected";} ?>>Inactive</option>
</select>
</p>
<p><input type="submit" name="update" value="Update User" class="w3-button w3-green w3-third"></input></p>
</tr>
<?php
}
?>
</form>

 </div>
  </div>
   <hr >
     <?php
 include 'footer.inc';
 ?>