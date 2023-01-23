<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Internet Services</title>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<link rel="stylesheet" href="images/style.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<?php
include 'head.inc';

$con =mysqli_connect("localhost","attinqst","9zYs%#*Es6vG4!3~","attinqst_service");
if($con){
echo "Connected Sucessfully";
}
else{
echo "Not Connected";
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
$sql = "INSERT INTO Customers (firstname, lastname, cname, address, address1, city, state, pin, phone, email, reff) VALUES ('$fname', '$lname', '$bname', '$add1', '$add2', '$city', '$state', '$pin', '$phone', '$email', '$re')";
//$sql = "INSERT INTO Customers (first-name, last-name, b-name, address, address1, city, state, pin, phone, email, reff) VALUES ('Sh', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l')";
//$con->exec($sql);
if(mysqli_query($con, $sql)){
    echo "Records added successfully.";
	} else{
   echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
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

?>
    <p><a href="customers.php" class="button6">Create Customer</a></button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="editcustomers.php" class="button6">Edit Customers</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="listcustomers.php" class="button6">List Customers</a></p>
	
  </div>
  <div class="left">
    <h3><strong>Create Customers</strong></h3>
    <div class="left_box"> <form method="get" action="customers.php">
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
<td align="right">Type of Complaint</td><td><input type="text" name="fname" size="25"></td>
<td align="right">Catagory of Product</td><td><input type="text" name="lname" size="25"></input></td>
</tr>
<tr><td align="right">Brand</td><td>	<input type="text" name="bname" size="25"></input></td>
<td align="right">Model Number</td><td><input type="text" name="add1" size="25"></input></td>
</tr>
<tr><td align="right">Complaint in Breif</td><td><input type="text" name="add2" size="25"></input></td>
<td align="right">&nbsp;</td><td></td>
</tr>
<tr><td colspan="2"><button class="button button1">Create Customer</button><td colspan="2"><button class="button button1">Create & Make Ticket</button></td></tr>
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
  <div class="footer">
    <p><a href="#">Homepage</a> | <a href="#">Contact</a> | <a href="#">Accessibility</a> | <a href="#">Products</a> | <a href="#">Disclaimer</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a><br />
&copy; Copyright 2006 Internet Services, Design: Luka Cvrk - <a href="http://www.solucija.com/" title="What's your solution?">Solucija</a></p>
  </div>
</div>
</body>
</html>
