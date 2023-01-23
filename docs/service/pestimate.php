<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="pstyle.css" />
</head>
<?php
include 'connection.inc';

$comid = $_REQUEST['comid'];
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$sql1 = "select * from Company where status='$st' limit 1";
$result1 = $con->query($sql1);
$row1 = $result1->fetch_assoc();
$comname = $row1["companyname"];

$sql4 = "select * from estimates where compid='$comid' and status='$st'";
$result4 = $con->query($sql4);
$gst = "0";
while($row4 = $result4->fetch_assoc()){
$gts = ($gts + $row4["total"]);
$cid = $row4["cid"];
$coid = $row4["compid"];
}

$sql2 = "select * from Customers where cid='$cid' and status='$st'";
$result2 = $con->query($sql2);
$row2 = $result2->fetch_assoc();
$cname = $row2["fname"]." ".$row2["lname"];
$bname = $row2["bname"];
$add1 = $row2["add1"];
$add2 = $row2["add2"];
$city = $row2["city"];
$state = $row2["state"];
$pin = $row2["pincode"];

$cmid = "select * from Complaints where compid='$coid'";
$cmidresult = $con->query($cmid);
$cmidrow = $cmidresult->fetch_assoc();

//email sending started
$cemail = $row2["email"];


$to = $cemail;
$subject = "Complaint Estimate for Approval";

$message = '<table width="80%"cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2">Dear Sir,</td>
    </tr>
   <tr>
      <td colspan="2">Your complaint '.$coid.' repairing estimate as follows.  Onece you approve the same, our technician will visit and complete work.</td>
	</tr> 
	<tr><td colspan="2"></td></tr>
	<tr><td>Customer Name :</td><td>'. $cmidrow["cname"].'</td></tr>
<tr><td>Email : </td><td>'. $row2["email"].'</td></tr>
<tr><td>Product Catagory :</td><td>'. $cmidrow["cat"].'</td></tr>
<tr><td>Brand : </td><td>'. $cmidrow["brand"].'</td></tr>
<tr><td>Model. : </td><td>'. $cmidrow["model"].' </td></tr>
<tr><td>Complaint :</td><td>'. $cmidrow["complaint"] .'</td></tr>
</table>
<hr >
<table width="80%"><tr><td width="30%">Item</td><td width="20%" align="center">Qty</td><td width="20%" align="right">Rate</td><td width="20%" align="right">Total</td></tr>';

$sql6 = "select * from estimates where compid='$comid' and status='$st'";
$result6 = $con->query($sql6);
$gst = "0";
while($row6 = $result6->fetch_assoc()){
$message .= '<tr><td width="30%">'. $row6["item"].'</td><td width="20%" align="center">'. $row6["qty"].'</td><td width="20%" align="right">'.$row6["rate"].'</td><td width="20%" align="right">'.$row6["total"].'</td></tr>';
}
$message .='<tr><td>Total</td><td></td><td></td><td align="right">'. $gts .'</td></tr>
<tr><td colspan="4">* Taxes Extra As applicable</td></tr>
<tr><td colspan="4">*<i>Estimate given as per the current Diagnostic, it may vary when actual servicing done.</td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr><td colspan="4">Thanks and waiting for your approval for our further process.</td></tr>
<tr><td colspan="4">Administrator <br/>'.$comname.'</td></tr>
</table>';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <shinemon40@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);

//email sending ended

//admin email started

$sqr1 = "select * from Company where status='$st' order by srno desc limit 1";
//echo $sqr;
$sqrresult1 = $con->query($sqr1);
$qryrow1 = $sqrresult1->fetch_assoc();

$to = $qryrow1["email"];
$subject = "Complaint Estimate for Approval";

$message1 = '<table width="80%"cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2">Dear Sir,</td>
    </tr>
   <tr>
      <td colspan="2">Complaint'.$coid.' repairing estimate as follows.</td>
	</tr> 
		<tr><td colspan="2"></td></tr>
	<tr><td>Customer Name :</td><td>'. $cmidrow["cname"].'</td></tr>
<tr><td>Email : </td><td>'. $row2["email"].'</td></tr>
<tr><td>Product Catagory :</td><td>'. $cmidrow["cat"].'</td></tr>
<tr><td>Brand : </td><td>'. $cmidrow["brand"].'</td></tr>
<tr><td>Model. : </td><td>'. $cmidrow["model"].' </td></tr>
<tr><td>Complaint :</td><td>'. $cmidrow["complaint"] .'</td></tr>
</table>
<hr >
<table width="80%"><tr><td width="30%">Item</td><td width="20%" align="center">Qty</td><td width="20%" align="right">Rate</td><td width="20%" align="right">Total</td></tr>';

$sql6 = "select * from estimates where compid='$comid' and status='$st'";
$result6 = $con->query($sql6);
$gst = "0";
while($row6 = $result6->fetch_assoc()){
$message1 .= '<tr><td width="30%">'. $row6["item"].'</td><td width="20%" align="center">'. $row6["qty"].'</td><td width="20%" align="right">'.$row6["rate"].'</td><td width="20%" align="right">'.$row6["total"].'</td></tr>';
}
$message1 .='<tr><td>Total</td><td></td><td></td><td align="right">'. $gts .'</td></tr>
<tr><td colspan="4">* Taxes Extra As applicable</td></tr>
<tr><td colspan="4">*<i>Estimate given as per the current Diagnostic, it may vary when actual servicing done.</td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr><td colspan="4">Thanks and waiting for your approval for our further process.</td></tr>
<tr><td colspan="4">Administrator <br/>'.$comname.'</td></tr>
</table>';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <shinemon40@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message1,$headers);

//admin email ended

?>
<body>

  <div class="page-header" style="text-align: left">
      <br/>
    <button type="button" onClick="window.print()" style="background: pink">
      PRINT
    </button>
	
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="center"><?php echo $row1["companyname"] ?></td>
</tr>
<tr>
<td align="center"><?php echo $row1["address1"] ?></td>
</tr>
<tr>
<td align="center"><?php echo $row1["address2"] ?></td>
</tr>
<tr>
<td align="center"><?php echo $row1["city"] ?>,<?php echo $row1["state"] ?>-<?php echo $row1["pincode"] ?>, <?php echo $row1["country"] ?> </td>
</tr>
<tr>
<td align="center">Phone:&nbsp;<?php echo $row1["address2"] ?>&nbsp;&nbsp;|Email:&nbsp;<?php echo $row1["email"] ?></td>
</tr>
</table>
<hr>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td ALIGN="CENTER"><strong>ESTIMATE</strong></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</table>
	<font size="1" face="times new roman" >
 <table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="50%">CUSTOMER</td>
<td width="25%">ESTIMATE NO:</td>
<td><?php echo $row4["invno"] ?></td>
</tr>
<tr>
<td><?php echo $cname ?></td>
<td>ESTIMATE DATE</td>
<td><?php echo $cdate ?></td>
</tr>
<tr>
<td><?php echo $bname ?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php echo $add1 ?></td>
<td>COMPLAINT #</td>
<td><?php echo $coid ?></td>
</tr>
<tr>
<td><?php echo $add2 ?>, &nbsp;<?php echo $city ?> </td>
<td>COMPLAINT DATE</td>
<td><?php echo $row4["crdate"] ?></td>
</tr>
<tr>
<td><?php echo $state ?>, &nbsp;<?php echo $pin ?> </td>
<td></td>
<td></td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
</table>
</font>

  </div>
 
  <div class="page-footer">
 <table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%"><strong></td>
<td align="right" width="15%"><strong></strong></td>
</tr>
<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%"><strong>GRAND TOTAL</td>
<td align="right" width="15%"><strong><?php echo $gts ?></strong></td>
</tr>
</table>

  <font size="1" face="times new roman" >
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr style="border: 0px">
<td width="8%"><strong>&nbsp;</td>
<td width="37%"><strong>&nbsp;</td>
<td align="center" width="10%"><strong>&nbsp;</td>
<td align="right" width="15%"><strong>&nbsp;</td>
<td align="right" width="15%"><strong>&nbsp;</td>
<td align="center" width="15%"><strong>&nbsp;</td>
</tr>
<tr>
<td colspan="6">&nbsp;</td>
</tr>
<tr>
<td colspan="4">Declaration<br />
We declare that this invoice shows the actual price of the goods described and all particulars are true and correct THIS TRANSACTION IS SUBJECT TO JURISDICTION OF COURTS IN CHENGANNUR BOTH THE PARTY HEREBY AGREE THAT IF THERE IS ANY DISPUTE BETWEEN THE PARTY REGARDING THIS TRANSACTION THE SAME WILL BE REFFERED TO THE \COMPETENT COURTS IN CHENGANNUR</td><td colspan="3" valign="top" align="right">Signature and Date</td>
</tr>
</table>
  </div>
  
  
<?php
$z = "0";
$sql5 = "SELECT * FROM estimates WHERE compid='$comid' and rate>'$z' and status='$st'";
//echo $sql3;
$result5 = $con->query($sql5);
//if ($result5->num_rows > 0) {
?>
  
	<?php
	$sr = "0";
	$gt = "0";
	$pgrn = "0";
	$pgsr = "0";
	$tot = "0";
	while($row5 = $result5->fetch_assoc()) {
	$gt = ($gt + $row5["total"]);
	$pgsr = ($pgsr + 1);
	$sr = ($sr + 1);
	//$tot = ($tot + $row5["total"]);
	//$gt = ($gt + $row5["total"]);
	if ($pgrn == "0"){
	?>
          <!--*** CONTENT GOES HERE ***-->
		  </td>
		  </tr>
		  </table>
			  </div>
    </tbody>
	<table width="100%">

    <thead>
      <tr>
        <td>
          <!--place holder for the fixed-position header-->
          <div class="page-header-space"></div>
        </td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          <div class="page">
		  
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
<td width="8%"><strong>Sr. No</td>
<td width="37%"><strong>Description</td>
<td align="center" width="10%"><strong>Quantity</td>
<td align="right" width="15%"><strong>Price <br />(INR)</td>
<td align="right" width="15%"><strong>Total Amount<br />(INR)</td>
</tr>
	<tr>
<td><?php echo $sr ?></td>
<td width="30%"><?php echo $row5["item"] ?></td>
<td align="center"><?php echo $row5["qty"] ?></td>
<td align="right"><?php echo $row5["rate"] ?></td>
<td align="right"><?php echo $row5["total"] ?></td>
</tr>
<?php
}
else
{
?>
	<tr>
<td><?php echo $sr ?></td>
<td width="30%"><?php echo $row5["item"] ?></td>
<td align="center"><?php echo $row5["qty"] ?></td>
<td align="right"><?php echo $row5["rate"] ?></td>
<td align="right"><?php echo $row5["total"] ?></td>
</tr>
<?php
}
if ($pgsr == "8"){
$pgrn = "0";
}
else
{
$pgrn = "1";
}
}
?>

	<tr>
<td></td>
<td width="30%">&nbsp;</td>
<td align="center"></td>
<td align="right"></td>
<td align="right"></td>
</tr>
	<tr>
<td></td>
<td width="30%">* Taxes Extra As applicable</td>
<td align="center"></td>
<td align="right"></td>
<td align="right"></td>
</tr>	<tr>
<td></td>
<td width="30%">*<i>Estimate given as per the current Diagnostic, it may vary when actual servicing done.</td>
<td align="center"></td>
<td align="right"></td>
<td align="right"><?php echo $gt ?></td>
</tr>
	</table> 
	</td>
		  </tr>
		  </table>
			  </div>
    </tbody>
	</div>
	
    <tfoot>
      <tr>
        <td>
          <!--place holder for the fixed-position footer-->
          <div class="page-footer-space"></div>
        </td>
      </tr>
    </tfoot>

  </table>

</body>

</html>