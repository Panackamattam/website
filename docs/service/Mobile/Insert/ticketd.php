<?php
include 'Insert/head.inc';
include 'Insert/cutsomer.inc';
include 'Insert/connection.inc';
?>
<?php

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

$cname = $fname." ". $lname;
$tp = $_REQUEST['type'];
$pcat = $_REQUEST['pcat'];
$brand = $_REQUEST['brand'];
$model = $_REQUEST['model'];
$comp = $_REQUEST['complaint'];
$cst = "Registered";
$asd = "-";
//$cid = $idrow["cid"];

// Attempt insert query execution

$sql = "INSERT INTO Customers(fname, lname, bname, add1, add2, city, state, pincode, phone, mobile, email, reff, crby, crdate, mdate, status) VALUES ('$fname', '$lname', '$bname', '$add1', '$add2', '$city', '$state', '$pin', '$phone', '$mobile', '$email', '$re', '$user', '$cdate', '$cdate' ,'$st')";

//$con->exec($sql);
if(mysqli_query($con, $sql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}


$idsql ="select * from Customers where fname='$fname' and lname='$lname' and mobile='$mobile' order by cid desc limit 1";
$idresult = $con->query($idsql);
$idrow = $idresult->fetch_assoc();
$cid = $idrow["cid"];



//echo $cid;
$csql = "INSERT INTO Complaints(cid, cname, cat, type, brand, model, complaint, cstatus, reff, crby, crdate, asained, remark) VALUES ('$cid', '$cname ', '$pcat', '$tp', '$brand', '$model', '$comp', '$cst', '$re ', '$user', '$cdate', '$asd', '$asd')";
if(mysqli_query($con, $csql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $csql. " . mysqli_error($con);
}

$sqr = "select * from Customers where fname='$fname' and lname='$lname' and email='$email' order by cid desc limit 1";
//echo $sqr;
$sqrresult = $con->query($sqr);
$qryrow = $sqrresult->fetch_assoc();

$cmid = "select * from Complaints where cid='$cid' and cat='$pcat' and type='$tp' and brand='$brand' and model='$model' and complaint='$comp' and crdate='$cdate'";
$cmidresult = $con->query($cmid);
$cmidrow = $cmidresult->fetch_assoc();

$cmid = $cmidrow["compid"];

//email sending started
$cemail = $qryrow["email"];


$to = $cemail;
$subject = "Complaint Registration Details";

$body .= " \n "
."Dear ".$cmidrow['cname']." ,<br /><br />\n "." \n "
."Your complaint is succefully registered with ABC Service.  Our technitian will contact you shortly."." <br /><br />\n "." \n "
."<table><tr><td>Complaint ID :</td><td> ".$cmidrow['compid']." </td></tr>\r\n "
."<tr><td>Customer Name :</td><td> ".$cmidrow['cname'] ." </td></tr>\r\n "
."<tr><td>Email : </td><td>".$qryrow['email'] ." </td></tr>\r\n "
."<tr><td>Product Catagory :</td><td> ".$cmidrow['cat'] ." </td></tr>\r\n "
."<tr><td>Brand : </td><td>".$cmidrow['brand'] ." </td></tr>\r\n "
."<tr><td>Model. : </td><td>".$cmidrow['model'] ." </td></tr>\r\n "
."<tr><td>Complaint :</td><td> ".$cmidrow['complaint'] ." </td></tr>\r\n "
//."Version : ".$cmidrow['Version'] ." \n "
//."Renwal Date : ".cmid$row['Renewal']. "\n"
."<tr><td>&nbsp;\n". "\n". " ". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Thanks for choosing ABC Service". "</td></tr>\r\n"
."<tr><td>\n". "\n". "ABC Service". "</td></tr></table>\n";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <shinemon40@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$body,$headers);

//email sending ended

//admin email started

$sqr1 = "select * from Company where status='$st' order by srno desc limit 1";
//echo $sqr;
$sqrresult1 = $con->query($sqr1);
$qryrow1 = $sqrresult1->fetch_assoc();

$to = $qryrow1["email"];
$subject = "New Complaint Registration Details";

$body1 .= " \n "
."Dear ".$cmidrow['cname']." ,<br /><br />\n "." \n "
."Received a new complaint registration.  Please process further."." <br /><br />\n "." \n "
."<table><tr><td>Complaint ID :</td><td> ".$cmidrow['compid']." </td></tr>\r\n "
."<tr><td>Customer Name :</td><td> ".$cmidrow['cname'] ." </td></tr>\r\n "
."<tr><td>Email : </td><td>".$qryrow['email'] ." </td></tr>\r\n "
."<tr><td>Product Catagory :</td><td> ".$cmidrow['cat'] ." </td></tr>\r\n "
."<tr><td>Brand : </td><td>".$cmidrow['brand'] ." </td></tr>\r\n "
."<tr><td>Model. : </td><td>".$cmidrow['model'] ." </td></tr>\r\n "
."<tr><td>Complaint :</td><td> ".$cmidrow['complaint'] ." </td></tr>\r\n "
//."Version : ".$cmidrow['Version'] ." \n "
//."Renwal Date : ".cmid$row['Renewal']. "\n"
."<tr><td>&nbsp;\n". "\n". " ". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Thanks". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Admin (ABC Service)". "</td></tr></table>\n";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <shinemon40@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$body1,$headers);

//admin email ended

include 'Insert/customer.inc';
?>  
 <div class="w3-container">
    <h4><strong>Create customer & ticket</strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
   <p><i class="fa fa-fw fa-male"></i> First Name: <input type="text" name="fname" size="25" value="<?php echo $fname ?>" disabled></p>
        <p><i class="fa fa-fw fa-male"></i> Last Name: <input type="text" name="lname" size="25" value="<?php echo $lname ?>" disabled></p>
        <p><i class="fa fa-fw fa-building"></i> Business Name: <input type="text" name="bname" size="25"  value="<?php echo $bname ?>" disabled></input></p>
		<p><i class="fa fa-fw fa-address-book"></i> Address1: <input type="text" name="add1" size="25"  value="<?php echo $add1 ?>" disabled></input></p>
		<p><i class="fa fa-fw fa-address-book"></i>Address2: <input type="text" name="add2" size="25"  value="<?php echo $add2 ?>" disabled></input></p>
        <p><i class="fa fa-fw fa-address-book"></i>City: <input type="text" name="city" size="25"  value="<?php echo $city ?>" disabled></input></p>
        <p><i class="fa fa-fw fa-address-book"></i>State: <input type="text" name="state" size="25"  value="<?php echo $state ?>" disabled></input></p>
		<p><i class="fa fa-fw fa-address-book"></i>Pincode: <input type="text" name="pin" size="25"  value="<?php echo $pin ?>" disabled></input></p>
		<p><i class="fa fa-fw fa fa-phone"></i>Phone: <input type="text" name="phone" size="25"  value="<?php echo $phone ?>" disabled></input></p>
		<p><i class="fa fa-fw fa fa-mobile-phone"></i>Mobile: <input type="text" name="mobile" size="25"  value="<?php echo $mobile ?>" disabled></input></p>
        <p><i class="fa fa-fw fa-envelope"></i>Email: <input type="text" name="email" size="25"  value="<?php echo $email ?>" disabled></input></p>
        <p><i class="fa fa-fw fa-male"></i>Reffered By: <input type="text" name="reff" size="25"  value="<?php echo $re ?>" disabled></input></p>
		    <hr>
			    
				
				<h4><strong>Complaint Details</strong></h4>
				<p>
<i class="fa fa-fw fa-shower"></i> Type of Complaint:  <input type="text" name="brand" size="20" value="<?php echo $tp ?>" disabled></p>
<p> <i class="fa fa-fw fa-wifi"></i> Catagory of Product: <input type="text" name="brand" size="20" value="<?php echo $pcat ?>" disabled></p>
        <p><i class="fa fa-fw fa-tv"></i>Brand: <input type="text" name="brand" size="20" value="<?php echo $brand ?>" disabled></input></p>
		<p><i class="fa fa-fw fa-tv"></i>Model Number:  <input type="text" name="model" size="20" value="<?php echo $model ?>" disabled></input></p>
		<p><i class="fa fa-fw fa-tv"></i>Complaint in Breif:  <textarea name="complaint" rows="5" cols="30" disabled><?php echo $comp ?></textarea></p>
				
				    
      </div>
    </div>
<br />
</form>
   </div>
    </div>
	<hr>
  
 <?php
 include 'footer.inc';
 ?>