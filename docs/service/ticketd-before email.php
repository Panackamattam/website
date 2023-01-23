<?php
session_start();

if ($_SESSION["username"] == ""){

header("Location: http://www.bmibearings.com/service/login.php");

}
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
$mobile = $_REQUEST['mobile'];
$email = $_REQUEST['email'];
$re = $_REQUEST['reff'];

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$idsql ="select * from Customers where fname='$fname' and lname='$lname' and mobile='$mobile'";
$idresult = $con->query($idsql);
$idrow = $idresult->fetch_assoc();

$cname = $fname." ". $lname;
$tp = $_REQUEST['type'];
$pcat = $_REQUEST['pcat'];
$brand = $_REQUEST['brand'];
$model = $_REQUEST['model'];
$comp = $_REQUEST['complaint'];
$cst = "Registered";
$asd = "-";

// Attempt insert query execution

$sql = "INSERT INTO Customers(fname, lname, bname, add1, add2, city, state, pincode, phone, mobile, email, reff, crby, crdate, mdate, status) VALUES ('$fname', '$lname', '$bname', '$add1', '$add2', '$city', '$state', '$pin', '$phone', '$mobile', '$email', '$re', '$user', '$cdate', '$cdate' ,'$st')";

//$con->exec($sql);
if(mysqli_query($con, $sql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

$csql = "INSERT INTO Complaints(cid, cname, cat, type, brand, model, complaint, cstatus, reff, crby, crdate, asained, remark) VALUES ('$cid', '$cname ', '$pcat', '$tp', '$brand', '$model', '$comp', '$cst', '$re ', '$user', '$cdate', '$asd', '$asd')";
if(mysqli_query($con, $csql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $csql. " . mysqli_error($con);
}

$cmid = "select * from Complaints where cid='$cid' and cat='$pcat' and type='$tp' and brand='$brand' and model='$model' and complaint='$comp' and crdate='$cdate'";
$cmidresult = $con->query($cmid);
$cmidrow = $cmidresult->fetch_assoc();

$cmid = $cmidrow["compid"];
include 'customer.inc';
?>
    	
  </div>
  <div class="left">
    <h3><strong>Sucessfully Created Ticket. Your Ticket details are as follows;</strong></h3>
    <div class="left_box"> <form method="get" action="customers.php">
<table align="center" width="100%" border="0">
<tr>
<td align="left" width="20%"><strong>Your Complaint ID</td><td width="35%"><?php echo $cmid ?></td>
<td align="right" width="12%">&nbsp;</td><td width="33%">&nbsp;</td>
</tr>
<tr>
<td><strong>First Name</td><td><?php echo $fname ?></td>
<td><strong>Last Name</td><td><?php echo $lname ?></td>
</tr>
<tr><td><strong>Business Name</td><td><?php echo $bname ?></td>
<td><strong>Address1</td><td><?php echo $add1 ?></td>
</tr>
<tr><td><strong>Address2</td><td><?php echo $add2 ?></td>
<td><strong>City</td><td><?php echo $city ?></td>
</tr>
<tr><td><strong>State</td><td><?php echo $state ?></td>
<td><strong>Pincode</td><td><?php echo $pin ?></td>
</tr>
<tr><td><strong>Phone</td><td><?php echo $phone ?></td>
<td><strong>Mobile</td><td><?php echo $mobile ?></td>
</tr>
<tr><td><strong>Email</td><td><?php echo $email ?></td>
<td><strong>Reffered By</td><td><?php echo $re ?></td></tr>
</table>
<br />
    <h3><strong>Complaint Details</strong></h3>
	<br />
<table width="100%" border="0">
<tr>
<td><strong>Type of Complaint</td><td><?php echo $tp ?></td>
</td>
<td><strong>Catagory of Product</td><td><?php echo $pcat ?></td>
</tr>
<tr>
<td><strong>Brand</td><td align="left"><?php echo $brand ?></td>
<td><strong>Model Number</td><td align="left"><?php echo $model ?></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr><td valign="top"><strong>Complaint in Breif</td><td colspan="3"><textarea name="w3review" rows="7" cols="70" readonly><?php echo $comp ?></textarea></td>
</tr>
</table>
<br />
<?php
$urole = "Admin";
if ($urole == "Admin") {
?>

    <p><a href="customers.php" class="button6">Assian Ticket</a></button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="editcustomers.php" class="button6">Update Ticket</a></p>

<?php
}
?>
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