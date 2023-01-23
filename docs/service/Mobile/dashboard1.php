<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="images/style.css" type="text/css" />
<body>

<div class="w3-container w3-green">
  <h1>W3Schools Demo</h1>
  <p>Resize this responsive page!</p>
</div>

<div class="w3-row-padding">
  <div class="w3-third">
   <table align="right" width="80%" border="0">
  <tr>
  <td align="center"><a href="customers.php"><i class="fa fa-male" style="font-size:48px;color:gray"></i><br />Customer</a></td>
   <td align="center"><a href="tickets.php"><i class="fa fa-ticket" style="font-size:48px;color:gray"></i><br />Tickets</a></td>
   <td align="center"><a href="estimate.php"><i class="fa fa-navicon" style="font-size:48px;color:gray"></i><br />Estimate</a></td>
   <td align="center"><a href="parts.php"><i class="fa fa-wrench" style="font-size:48px;color:gray"></i><br />Parts</a></td>
    <td align="center"><a href="inventory.php"><i class="fa fa-server" style="font-size:48px;color:gray"></i><br />Inventory</a></td>
	 <td align="center"><a href="invoice.php"><i class="fa fa-cart-plus" style="font-size:48px;color:gray"></i><br />Invoice</td>
	  <td align="center"><a href="reports.php"><i class="fa fa-bar-chart" style="font-size:48px;color:gray"></i><br />Reports</a></td>
	   <td align="center"><a href="admin.php"><i class="fa fa-cog" style="font-size:48px;color:gray"></i><br />Admin</a></td>
  </tr>
  </table>
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
include 'customer.inc';
?>

    <h3><strong>Create Customers</strong></h3>
<form method="get" action="ticketd.php">
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
<?php
}
}
?>
  </div>
</div>

</body>
</html>