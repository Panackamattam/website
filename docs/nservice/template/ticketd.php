<?php
include 'head.inc';
include 'connection.php';

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
$cntry = $_REQUEST['cntry'];
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

$sql = "INSERT INTO Customers(fname, lname, bname, add1, add2, city, state, pincode, country, phone, mobile, email, reff, crby, crdate, mdate, status) VALUES ('$fname', '$lname', '$bname', '$add1', '$add2', '$city', '$state', '$pin', '$cntry', '$phone', '$mobile', '$email', '$re', '$user', '$cdate', '$cdate' ,'$st')";

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
$csql = "INSERT INTO Complaints(cid, cname, cat, type, brand, model, complaint, cstatus, reff, crby, crdate, asained, remark, mobile) VALUES ('$cid', '$cname ', '$pcat', '$tp', '$brand', '$model', '$comp', '$cst', '$re ', '$user', '$cdate', '$asd', '$asd', '$mobile')";
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

include 'customer.inc';
?>
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create Customers</h4>
  
<table class="table">
<tr>
<td align="left" width="20%"><strong>Your Customer ID</td><td width="35%"><?php echo $cid ?></td>
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
    <h4 class="card-title"><strong>Complaint Details</strong></h4>
<table class="table">
<tr>
<td align="left" width="20%"><strong>Your Complaint ID</td><td width="35%"><?php echo $cmid ?></td>
<td align="right" width="12%">&nbsp;</td><td width="33%">&nbsp;</td>
</tr>
<tr>
<td><strong>Type of Complaint</td><td><?php echo $tp ?></td>
</td>
<td><strong>Catagory of Product</td><td><?php echo $pcat ?></td>
</tr>
<tr>
<td><strong>Brand</td><td align="left"><?php echo $brand ?></td>
<td><strong>Model Number</td><td align="left"><?php echo $model ?></td>
</tr>

<tr><td valign="top"><strong>Complaint in Breif</td><td colspan="3"><textarea name="w3review" rows="7" cols="70" readonly><?php echo $comp ?></textarea></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
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
</div>
</div>
</div>

 <?php
   include 'footer.inc';
   ?>
 