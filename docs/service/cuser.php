<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

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
include 'admin.inc';
?>
    <p><font color="red"><?php echo $msg ?></font></p>
	
  </div>
  <div class="left">
    <h2>Create User</h2>
    <div class="left_box"> <form method="get" action="">
<table align="left" width="80%" border="0" cellpadding="4">
<tr>
<td align="right">Enter Username</td><td><input type="text" name="uname" size="45" required></td>
</tr>
<tr>
<td align="right">Password</td><td><input type="password" name="password" size="45" required></td>
</tr>
<tr>
<td align="right">First Name</td><td><input type="text" name="fname" size="45" required></td>
</tr>
<td align="right">Address1</td><td><input type="text" name="add1" size="45"></input></td>
</tr>
<tr><td align="right">Address2</td><td><input type="text" name="add2" size="45"></input></td>
</tr>
<td align="right">City</td><td><input type="text" name="city" size="45"></input></td>
</tr>
<tr>
<tr><td align="right">State</td><td><input type="text" name="state" size="45"></input></td>
</tr>
<tr>
<td align="right">Pincode</td><td><input type="text" name="pin" size="45"></input></td>
</tr>
<tr>
<td align="right">Mobile</td><td><input type="text" name="mobile" size="45" required></input></td>
</tr>
<tr><td align="right">Email</td><td><input type="text" name="email" size="45" required></input></td>
</tr>
<tr>
<td align="right">Role</td><td> 
<select name="role">
<option value="user">User</option>
<option value="technician">Technician</option>
<option value="Admin">Admin</option>
</select>

</td>
</tr>
<tr>
<td></td><td><input type="submit" name="submit" value="Add User"></input></td>
</tr>
<tr>
</table>
<br />
    
	
	
<br />
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
