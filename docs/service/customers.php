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
$email = $_REQUEST['email'];
$re = $_REQUEST['reff'];
 
// Attempt insert query execution
//$sql = "INSERT INTO Customers (firstname, lastname, cname, address, address1, city, state, pin, phone, email, reff) VALUES ('$fname', '$lname', '$bname', '$add1', '$add2', '$city', '$state', '$pin', '$phone', '$email', '$re')";
//$sql = "INSERT INTO Customers (first-name, last-name, b-name, address, address1, city, state, pin, phone, email, reff) VALUES ('Sh', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l')";
//$con->exec($sql);
if(mysqli_query($con, $sql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
//echo $fname;
//echo $lname;
//echo $bname;
//echo $add1;
//echo $add2;
//echo $city;
//echo $state;
//echo $pin;
//echo $phone;
//echo $email;
//echo $re;
include 'customer.inc';
?>
    
	
  </div>
  <div class="left">
    <h3><strong>Create Customers</strong></h3>
    <div class="left_box"> <form method="get" action="ticketd.php">
<table align="center" width="100%" border="0">
<tr>
<td align="right">First Name</td><td><input type="text" name="fname" size="25" required></td>
<td align="right">Last Name</td><td><input type="text" name="lname" size="25" required></input></td>
</tr>
<tr><td align="right">Business Name</td><td>	<input type="text" name="bname" size="25"></input></td>
<td align="right">Address1</td><td><input type="text" name="add1" size="25"></input></td>
</tr>
<tr><td align="right">Address2</td><td><input type="text" name="add2" size="25"></input></td>
<td align="right">City</td><td><input type="text" name="city" size="25"></input></td>
</tr>
<tr><td align="right">State</td><td><input type="text" name="state" size="25"></input></td>
<td align="right">Pincode</td><td><input type="text" name="pin" size="25"></input></td>
</tr>
<tr><td align="right">Phone</td><td><input type="text" name="phone" size="25"></input></td>
<td align="right">Mobile</td><td><input type="text" name="mobile" size="25" required></input></td>
</tr>
<tr><td align="right">Email</td><td><input type="text" name="email" size="25" required></input></td>
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
<select name="pcat" style="width: 150px;" required>

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
<tr><td></td><td><button>Create Customer & Ticket</button><td colspan="2"></td></tr>
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
  <div class="footer">
 <?php
   include 'footer.php';
   ?>
  </div>
</div>
</body>
</html>
