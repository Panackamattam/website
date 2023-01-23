<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php
if ($_REQUEST['cpassword']) {
$npass = $_REQUEST['npass'];
$cpass = $_REQUEST['cpass'];
$uid = $_REQUEST['uid'];

		If ($cpass == $npass){
		$sql55 = "update users set password='$npass', mdby='$user' where uid='$uid'";
		if(mysqli_query($con, $sql55)){
   // echo "Records added successfully.";
		$msg = "Password changed successfully.";
		} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
		}
		}
		else
		{
		echo "Missmatch New Password and confirmed password";
		}
		}

//include 'admin.inc';
?>
 <?php
include 'Insert/admin.inc';
?> 

	
<div class="w3-container">
    <h3><strong>Change Password</strong></h3>
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
<p><input type="submit" name="sub" Value="Search" class="w3-button w3-green w3-third"><p>
</form>
<br />
<hr>
<br />
<?php
if ($_REQUEST['sub']) {
$uid = $_REQUEST['cus'];
$usq4 = "select * from users where uid='$uid'";
$usqresult = $con->query($usq4);
$row45 = $usqresult->fetch_assoc();
?>
<form method="get" action="">
<p>Enter Username: <input type="hidden" name="uid" value="<?php echo $uid ?>"></input><input type="text" name="uname" size="45" value="<?php echo $row45["uname"] ?>" disabled></p>
<p>First Namep: <input type="text" name="fname" size="45" value="<?php echo $row45["Name"] ?>"  disabled></p>
<p>Address1: <input type="text" name="add1" size="45"value="<?php echo $row45["add1"] ?>"  disabled></input></p>
<p>Address2: <input type="text" name="add2" size="45" value="<?php echo $row45["add2"] ?>"  disabled></input></p>
<p>City: <input type="text" name="city" size="45" value="<?php echo $row45["city"] ?>" disabled></input></p>
<p>State: <input type="text" name="state" size="45" value="<?php echo $row45["state"] ?>" disabled></input></p>
<p>Mobile: <input type="text" name="mobile" size="45" value="<?php echo $row45["mobile"] ?>" disabled></input></p>
<p>Email: <input type="text" name="email" size="45" value="<?php echo $row45["email"] ?>"  disabled></input></p>
<p>Role: 
<select name="role"  disabled>
<option value="user" <?php if ($row45["role"] == "user") { echo "selected"; } ?>>User</option>
<option value="technician" <?php if ($row45["role"] == "technician") { echo "selected";} ?>>Technician</option>
<option value="Admin" <?php if ($row45["role"] == "Admin") { echo "selected";} ?>>Admin</option>
</select>
</p>


<p>Username: <input type="text" name="uname" size="45" value="<?php echo $row45["uname"] ?>" disabled></input></p>
<p>New Password: <input type="pass" name="npass" size="45" value=""></input></p>
<p>Confirm Password: <input type="pass" name="cpass" size="45" value=""></input></p>
<p><input type="submit" name="cpassword" value="Change Password" class="w3-button w3-green w3-third"></input></p>
</tr>
</table>
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
