<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";


if ($_REQUEST['cpassword']) {
$npass = $_REQUEST['npass'];
$cpass = $_REQUEST['cpass'];
$uid = $_REQUEST['uid'];

		If ($cpass == $npass){
		$sql55 = "update users set password='$npass', mdby='$user' where uid='$uid'";
		if(mysqli_query($con, $sql55)){
   // echo "Records added successfully.";
		$msg = "User updated successfully.";
		} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
		}
		}
		else
		{
		echo "Missmatch New Password and confirmed password";
		}
		}

include 'admin.inc';
?>
    	
  </div>
  <div class="left">
    <h3><strong>Change Password</strong></h3>
    <div class="left_box"> 
<form method="get" action="">
<br />
<table width="100%" border="0" align="left">
<tr>
<td align="left" width="25%">Select User</td><td>

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
</td>
<td><input type="submit" name="sub" Value="Search"></td>
</tr>
</table>
</form>
<br /><br />
<hr>
<br /><br />
<?php
if ($_REQUEST['sub']) {
$uid = $_REQUEST['cus'];
$usq4 = "select * from users where uid='$uid'";
$usqresult = $con->query($usq4);
$row45 = $usqresult->fetch_assoc();
?>
<form method="get" action="">
<table align="left" width="80%" border="0" cellpadding="4">
<tr>
<td align="right">Enter Username</td>
<td><input type="hidden" name="uid" value="<?php echo $uid ?>"></input><input type="text" name="uname" size="45" value="<?php echo $row45["uname"] ?>" disabled></td>
</tr>
<tr>
<td align="right">First Name</td>
<td><input type="text" name="fname" size="45" value="<?php echo $row45["Name"] ?>"  disabled></td>
</tr>
<tr>
<td align="right">Address1</td>
<td><input type="text" name="add1" size="45"value="<?php echo $row45["add1"] ?>"  disabled></input></td>
</tr>
<tr>
<td align="right">Address2</td>
<td><input type="text" name="add2" size="45" value="<?php echo $row45["add2"] ?>"  disabled></input></td>
</tr>
<tr>
<td align="right">City</td>
<td><input type="text" name="city" size="45" value="<?php echo $row45["city"] ?>" disabled></input></td>
</tr>
<tr>
<tr><td align="right">State</td>
<td><input type="text" name="state" size="45" value="<?php echo $row45["state"] ?>" disabled></input></td>
</tr>
<tr>
<td align="right">Mobile</td>
<td><input type="text" name="mobile" size="45" value="<?php echo $row45["mobile"] ?>" disabled></input></td>
</tr>
<tr>
<td align="right">Email</td>
<td><input type="text" name="email" size="45" value="<?php echo $row45["email"] ?>"  disabled></input></td>
</tr>
<tr>
<td align="right">Role</td>
<td> 
<select name="role"  disabled>
<option value="user" <?php if ($row45["role"] == "user") { echo "selected"; } ?>>User</option>
<option value="technician" <?php if ($row45["role"] == "technician") { echo "selected";} ?>>Technician</option>
<option value="Admin" <?php if ($row45["role"] == "Admin") { echo "selected";} ?>>Admin</option>
</select>
</td>
</tr>
</table>
<hr>
<table align="left" width="80%" border="0" cellpadding="4">
<tr>
<td align="right">Username</td><td><input type="text" name="uname" size="45" value="<?php echo $row45["uname"] ?>" disabled></input></td>
</tr>
<tr>
<td align="right">New Password</td><td><input type="pass" name="npass" size="45" value=""></input></td>
</tr>
<tr>
<td align="right">Confirm Password</td><td><input type="pass" name="cpass" size="45" value=""></input></td>
</tr>
<tr>
<td></td><td><input type="submit" name="cpassword" value="Change Password"></input></td>
</tr>
</table>
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
