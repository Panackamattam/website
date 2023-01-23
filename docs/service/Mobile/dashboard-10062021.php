<?php
// Start the session
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Internet Services</title>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<link rel="stylesheet" href="images/style.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
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
$_SESSION["username"] = $row3["Name"];
$_SESSION["role"] = $row3["role"];
//echo "Session variables are set.";

?>
<?php
include 'head.inc';
?>


    <p><a href="customers.php" class="button6">Create Customer</a></button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="editcustomers.php" class="button6">Edit Customers</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="listcustomers.php" class="button6">List Customers</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="listcustomers.php" class="button6">List Customers</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="listcustomers.php" class="button6">List Customers</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="listcustomers.php" class="button6">List Customers</a></p>
	
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
$sql = "SELECT * FROM productcat where status='$st' order by pcat";
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
    <h3>Pending</h3>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <h3>Completed</h3>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
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
    <p><a href="#">Homepage</a> | <a href="#">Contact</a> | <a href="#">Accessibility</a> | <a href="#">Products</a> | <a href="#">Disclaimer</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a><br />
&copy; Copyright 2006 Internet Services, Design: Luka Cvrk - <a href="http://www.solucija.com/" title="What's your solution?">Solucija</a></p>
  </div>
</div>
</body>
</html>
