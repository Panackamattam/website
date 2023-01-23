<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="pstyle.css" />
</head>
<?php
include 'connection.php';

$comid = $_REQUEST['comid'];
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$inv = $_REQUEST['invno'];

$sql1 = "select * from Company where status='$st' limit 1";
$result1 = $con->query($sql1);
$row1 = $result1->fetch_assoc();
$comname = $row1["companyname"];

$sql4 = "select * from invdetails where invno='$inv' and status='$st'";
$result4 = $con->query($sql4);
$row4 = $result4->fetch_assoc();
$cid = $row4["cid"];
$comid = $row4["compid"];

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

$cmid = "select * from Complaints where compid='$comid'";
$cmidresult = $con->query($cmid);
$cmidrow = $cmidresult->fetch_assoc();

$sql21 = "SELECT * FROM invoice WHERE invno='$inv' and status='$st'";
//echo $sql3;
$cgst = "0";
$sgst = "0";
$result21 = $con->query($sql21);
while($row21 = $result21->fetch_assoc()) {
$gts = ($gts + $row21["total"]);
$cgst = ($cgst + $row21["cgst"]);
$sgst = ($sgst + $row21["sgst"]);
}
$subtot = $gts;
$cess = "1";
$cess = ($cess / 100) * $gts;
$tgst = ($cgst + $sgst);

$gts = ($gts + $cgst + $sgst + $cess);


//email sending started
$cemail = $row2["email"];


$to = $cemail;
$subject = "Revised Invoice of your complaint";

$message = '<table width="80%"cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2">Dear Sir,</td>
    </tr>
   <tr>
      <td colspan="2">Your complaint <b>'.$comid.'</b> resolved.  Given below the invoice details for payment</td>
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

$sql6 = "select * from invoice where invno='$inv'";
$result6 = $con->query($sql6);
$gst = "0";
while($row6 = $result6->fetch_assoc()){
$message .= '<tr><td width="30%">'. $row6["parts"].'</td><td width="20%" align="center">'. $row6["qty"].'</td><td width="20%" align="right">'.$row6["rate"].'</td><td width="20%" align="right">'.$row6["total"].'</td></tr>';
}
if ($row1["taxenable"] == "yes") {
$message .='<tr><td>Total</td><td></td><td></td><td align="right">'. $subtot .'</td></tr>
<tr><td colspan="3" align="right">CGST</td><td align="right">'. $cgst .'</td></tr>
<tr><td colspan="3" align="right">SGST</td><td align="right">'. $sgst .'</td></tr>
<tr><td colspan="3" align="right">CESS</td><td align="right">'. $cess .'</td></tr>
<tr><td colspan="3" align="right">TOTAL AMT</td><td align="right">'. $gts .'</td></tr>
<tr><td colspan="4"></td></tr>
<tr><td colspan="4">Thanks and request to make payment to the technician.</td></tr>
<tr><td colspan="4">Administrator <br/>'.$comname.'</td></tr>
</table>';
}
else
{
$message .='<tr><td colspan="3" align="right">TOTAL AMT</td><td align="right">'. $gts .'</td></tr>
<tr><td colspan="4"></td></tr>
<tr><td colspan="4">Thanks and request to make payment to the technician.</td></tr>
<tr><td colspan="4">Administrator <br/>'.$comname.'</td></tr>
</table>';
}

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
$subject = "Revised Invoice of complaint";

$message1 = '<table width="80%"cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2">Dear Sir,</td>
    </tr>
   <tr>
      <td colspan="2">Complaint <b>'.$comid.' </b> resolved.  Given below the invoice details for payment</td>
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

$sql6 = "select * from invoice where invno='$inv'";
$result6 = $con->query($sql6);
$gst = "0";
while($row6 = $result6->fetch_assoc()){
$message1 .= '<tr><td width="30%">'. $row6["parts"].'</td><td width="20%" align="center">'. $row6["qty"].'</td><td width="20%" align="right">'.$row6["rate"].'</td><td width="20%" align="right">'.$row6["total"].'</td></tr>';
}
if ($row1["taxenable"] == "yes") {
$message1 .='<tr><td>Total</td><td></td><td></td><td align="right">'. $subtot .'</td></tr>
<tr><td colspan="3" align="right">CGST</td><td align="right">'. $cgst .'</td></tr>
<tr><td colspan="3" align="right">SGST</td><td align="right">'. $sgst .'</td></tr>
<tr><td colspan="3" align="right">CESS</td><td align="right">'. $cess .'</td></tr>
<tr><td colspan="3" align="right">TOTAL AMT</td><td align="right">'. $gts .'</td></tr>
<tr><td colspan="4"></td></tr>
<tr><td colspan="4">Thanks and request to make payment to the technician.</td></tr>
<tr><td colspan="4">Administrator <br/>'.$comname.'</td></tr>
</table>';
}
else
{
$message1 .= '<tr><td colspan="3" align="right">TOTAL AMT</td><td align="right">'. $gts .'</td></tr>
<tr><td colspan="4"></td></tr>
<tr><td colspan="4">Thanks and request to make payment to the technician.</td></tr>
<tr><td colspan="4">Administrator <br/>'.$comname.'</td></tr>
</table>';
}


// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <shinemon40@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message1,$headers);

//admin email ended			
			
//tech email started

$sqr11 = "select * from users where Name='$user' limit 1";
//echo $sqr;
$sqrresult11 = $con->query($sqr11);
$qryrow11 = $sqrresult11->fetch_assoc();

$to = $qryrow11["email"];
$subject = "Revised Invoice of complaint | Please collect payment";

$message11 = '<table width="80%"cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2">Dear Sir,</td>
    </tr>
   <tr>
      <td colspan="2">Complaint <b>'.$comid.' </b> resolved.  Given below the invoice details for payment</td>
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

$sql6 = "select * from invoice where invno='$inv'";
$result6 = $con->query($sql6);
$gst = "0";
while($row6 = $result6->fetch_assoc()){
$message11 .= '<tr><td width="30%">'. $row6["parts"].'</td><td width="20%" align="center">'. $row6["qty"].'</td><td width="20%" align="right">'.$row6["rate"].'</td><td width="20%" align="right">'.$row6["total"].'</td></tr>';
}
if ($row1["taxenable"] == "yes") {
$message11 .='<tr><td>Total</td><td></td><td></td><td align="right">'. $subtot .'</td></tr>
<tr><td colspan="3" align="right">CGST</td><td align="right">'. $cgst .'</td></tr>
<tr><td colspan="3" align="right">SGST</td><td align="right">'. $sgst .'</td></tr>
<tr><td colspan="3" align="right">CESS</td><td align="right">'. $cess .'</td></tr>
<tr><td colspan="3" align="right">TOTAL AMT</td><td align="right">'. $gts .'</td></tr>
<tr><td colspan="4"></td></tr>
<tr><td colspan="4">Thanks and request to make payment to the technician.</td></tr>
<tr><td colspan="4">Administrator <br/>'.$comname.'</td></tr>
</table>';
}
else
{
$message11 .= '<tr><td colspan="3" align="right">TOTAL AMT</td><td align="right">'. $gts .'</td></tr>
<tr><td colspan="4"></td></tr>
<tr><td colspan="4">Thanks and request to make payment to the technician.</td></tr>
<tr><td colspan="4">Administrator <br/>'.$comname.'</td></tr>
</table>';
}


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
<td ALIGN="CENTER"><strong>COMMERCIAL INVOICE</strong></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</table>
	<font size="1" face="times new roman" >
 <table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td>CUSTOMER</td>
<td>INVOICE NO:</td>
<td><?php echo $row4["invno"] ?></td>
</tr>
<tr>
<td><?php echo $cname ?></td>
<td>INVOICE DATE</td>
<td><?php echo $row4["invdate"] ?></td>
</tr>
<tr>
<td><?php echo $bname ?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php echo $add1 ?></td>
<td>COMPLAINT #</td>
<td><?php echo $row4["compid"] ?></td>
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
    <?php
  $sq3 = "select * from Company where companyname='$comname'";
  $re3 = $con->query($sq3);
  $rw3 = $re3->fetch_assoc();
  if ($rw3["taxenable"] == "yes") {
  ?>
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%"><strong>Sub Total</td>
<td align="right" width="15%"><strong><?php echo $subtot ?></strong></td>
</tr>
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%">CGST</td>
<td align="right" width="15%"><strong><?php echo $cgst ?></strong></td>
</tr>
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%">SGST</td>
<td align="right" width="15%"><strong><?php echo $sgst ?></strong></td>
</tr>
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%">CESS</td>
<td align="right" width="15%"><strong><?php echo $cess ?></strong></td>
</tr>
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%"><strong>GRAND TOTAL</td>
<td align="right" width="15%"><strong><?php echo $gts ?></strong></td>
</tr>
</table>
<?php
}
else
{
?>
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
<td align="right" width="15%"><strong><?php echo $subtot ?></strong></td>
</tr>
</table>

<?php
}
?>
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
$in = $row4["invno"];
$sql5 = "SELECT * FROM invoice WHERE invno='$in' and status='$st'";
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
<td width="30%"><?php echo $row5["parts"] ?></td>
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
<td width="30%"><?php echo $row5["parts"] ?></td>
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
<td width="30%">TOTAL</td>
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