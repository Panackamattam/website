<?php
include 'title.inc';
?>
  <?php
 include 'connection.inc';
$sub1 = $_REQUEST['login'];
if ($sub1) {
$uname = $_REQUEST['uname'];
$upass = $_REQUEST['pass'];

$act = "Active";
$sql2 = "SELECT * FROM users WHERE uname='$uname' AND password='$upass' AND status='$act'";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
//echo "Shine";
$row3 = $result2->fetch_assoc();
// Set session variables
$_SESSION["uid"] = $row3["uid"];
$_SESSION["username"] = $row3["Name"];
$_SESSION["role"] = $row3["role"];
//echo "Session variables are set.";

?>
<?php
include 'head.inc';
include 'customer.inc';
?>
	
  </div>

  <div class="left">
    <h3><strong>Create Customers</strong></h3>
    <div class="left_box"> <form method="get" action="ticketd.php">
<table align="center" width="100%" border="0">
<tr>
<td align="right">First Name</td><td><input type="text" name="fname" size="25"></td>
<td align="right">Last Name</td><td><input type="text" name="lname" size="25"</td>
</tr>
<tr><td align="right">Business Name</td><td>	<input type="text" name="bname" size="25"</td>
<td align="right">Address1</td><td><input type="text" name="add1" size="25"</td>
</tr>
<tr><td align="right">Address2</td><td><input type="text" name="add2" size="25"</td>
<td align="right">City</td><td><input type="text" name="city" size="25"</td>
</tr>
<tr><td align="right">State</td><td><input type="text" name="state" size="25"</td>
<td align="right">Pincode</td><td><input type="text" name="pin" size="25"</td>
</tr>
<tr><td align="right">Phone</td><td><input type="text" name="phone" size="25"</td>
<td align="right">Mobile</td><td><input type="text" name="mobile" size="25"</td>
</tr>
<tr><td align="right">Email</td><td><input type="text" name="email" size="25"</td>
<td align="right">Reffered By</td><td>		<input type="text" name="reff" size="25"</td></tr>
</table>
<br />
    <h3><strong>Complaint Details</strong></h3>
	<br />
<table align="center" width="100%" border="0">
<tr>
<td align="right">Type of Complaint</td><td><select name="type" style="width: 150px;">
<option value="Out of Warranty" selected>Out of Warranty</option>
<option value="Warranty">Warranty</option>
</td>
<td align="right">Catagory of Product</td><td>
<select name="pcat" style="width: 150px;">

<?php
$st = "Active";
$sql = "SELECT * FROM catgaory where status='$st' order by pcat";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
?>
<option value="<?php echo $row["pcat"] ?>"><?php echo $row["pcat"] ?></option>
<?php
}
?>
</td>
</tr>
<tr><td align="right">Brand</td><td>	<input type="text" name="brand" size="20"></input></td>
<td align="right">Model Number</td><td><input type="text" name="model" size="20"></input></td>
</tr>
<tr><td align="right" valign="top">Complaint in Breif</td><td colspan="3"><textarea name="complaint" rows="7" cols="70"></textarea></td>
</tr>
<tr><td></td><td><button>Create Customer</button><td colspan="2"><button>Create & Make Ticket</button></td></tr>
</table>
<br />
</form>
    </div>
  </div>
  <div class="right">
   <?php
   include 'right.php';
   ?>
  </div>
  <?php
  }
  else 
  {
  include 'loginhead.inc';
  ?>
  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
  <?php
 $msg =  "Invalid username and password ";
  }
  ?>
  <p align="center"><font color="red"><?php echo $msg ?></font></p>
  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
  <?php
  }

  ?>
  <div class="footer">
 <?php
   include 'footer.php';
   ?>
  </div>
  </div>
</body>
</html>
