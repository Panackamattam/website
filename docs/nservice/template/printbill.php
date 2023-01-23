<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="style1.css" />
</head>
     <?php
//include 'head.inc';
include 'gstconnection.php';
?>
<?php

//$qn = $_REQUEST['invno'];
$qn = $_REQUEST['invno'];
$psql = "SELECT * FROM gstinvdetails WHERE invno='$qn' LIMIT 1";
$result1 = $con->query($psql);
$row1 = $result1->fetch_assoc();
$conid = $row1["conid"];
	 
$coname = $row1["cname"];
$csql = "SELECT * FROM gstcustomers WHERE cname='$coname' LIMIT 1";
$cresult = $con->query($csql);
$row2 = $cresult->fetch_assoc();

//$cnsql = "SELECT * FROM Contact WHERE srno='$conid' LIMIT 1";
//$cnresult = $con->query($cnsql);
//$nrow2 = $cnresult->fetch_assoc();
//$contactname = $nrow2["fname"];
//$eid = $nrow2["email"];

$qsql = "SELECT * FROM gstinvoice WHERE invno='$qn'";
$resultq = $con->query($qsql); 

?>

<body>

  <div class="page-header" style="text-align: left">
      <br/>
    <button type="button" onClick="window.print()" style="background: pink">
      PRINT
    </button>
 <table border="0" cellpadding="1px" cellspacing="0" width="100%">
  <tr>
	<td border="0" align="center"><font face="arial" size="5">ABC STORES</font><br />
	Vikhroli East <br />
	Mumbai - 400 080.<br />
	Tel.: 022 2564 0000  Fax: 022 2561 4680<br />
	Email: sales@ddd.com<br /> <br />
	GSTIN: 32AACDG3697Q1Z6<br />
	<strong><u>Tax Invocie</u></strong>
	</td>
   
  </tr>
     </table>
	</table>
	<table width="95%">
	<tr>
	<td colspan="1"><font face="arial" size="3">Customer Details</td>
	<td colspan="2"><font face="arial" size="3">Bill Details</td>
	</tr>
	
	<tr>
	<td><?php echo $row2["cname"]; ?></td>
	<td>Bill No.</td><td><?php echo $row1["invno"]; ?></td>
	</tr>
	
		<tr>
	<td><?php echo $row2["add1"]; ?></td>
	<td>Date</td><td><?php echo $row1["invdate"]; ?></td>
	</tr>
	
		<tr>
	<td><?php echo $row2["add2"]; ?></td>
	<td>Time</td><td><?php echo $row1["time"]; ?></td>
	</tr>
	
	<tr>
	<td><?php echo $row2["city"]; ?></td>
	<td></td><td></td>
	</tr>
	

	</table>
  </div>

  <div class="page-footer">
  <?php
  $act = "Active";
  $qry1 = "select DISTINCT taxrate from gstinvoice where invno='$qn' and status='$act'";
 // echo $qry1;
  $sre = $con->query($qry1);
  if ($sre->num_rows > 0) { 
  
  ?>
<table width="100%" border="0">
	<tr>
	<td colspan="6">GST Summary</td>
	</tr>
	<tr>
	<td>GST%</td>
	<td>Taxable<?php echo $tax0 ?></td>
	<td>GST</td>
	<td>CGST</td>
	<td>SGST</td>
	<td>IGST</td>
	</tr>
<?php
while($qrow1 = $sre->fetch_assoc()) {
$trte = $qrow1["taxrate"];
		$qry2 = "select * from gstinvoice where invno='$qn' and status='$act' and taxrate='$trte'";
		$sre2 = $con->query($qry2);
		$taxvalue = "0";
		$tgst = "0";
		$cgst = "0";
		$sgst = "0";
		$igst = "0";
		while($qrow2 = $sre2->fetch_assoc()) {
		$taxvalue = ($taxvalue + $qrow2["total"]);
		$tgst = ($tgst + $qrow2["cgst"] + $qrow2["sgst"] + $qrow2["igst"]);
		$cgst = ($cgst + $qrow2["cgst"]);
		$sgst = ($sgst + $qrow2["sgst"]);
		$igst = ($igst + $qrow2["igst"]);
		}
		?>
			<tr>
		<td><?php echo $trte ?></td>
		<td><?php echo $taxvalue ?></td>
	<td><?php echo $tgst ?></td>
	<td><?php echo $cgst ?></td>
	<td><?php echo $sgst ?></td>
	<td><?php echo $igst ?></td>
	</tr>
		
		<?
		}

	
?>	
	</table>
	<?php
	}
	?>
  </div>

  
	<?php
	$sr = "0";
	$gt = "0";
	$pgrn = "0";
	$pgsr = "0";
	$totalqty = "0";

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
		  
<table border="0" cellpadding="1px" cellspacing="0" width="100%">
	<tr>
	<td style="border-bottom: 1px solid black;"><b>Sr No</td>
	<td width="55%" style="border-bottom: 1px solid black;"><b>Bearings Number</td>
	<td align="center" style="border-bottom: 1px solid black;"><b>Qty</td>
	<td align="right" style="border-bottom: 1px solid black;"><b>Rate</td>
	<td align="right" style="border-bottom: 1px solid black;"><b>Tax</td>
	<td align="right" style="border-bottom: 1px solid black;"><b>Total</td>
	</tr>
	<?php
		while($row21 = $resultq->fetch_assoc()) {
	$pgsr = ($pgsr + 1);
	$sr = ($sr + 1);
	?>
	
	<tr>
	<td><?php echo $sr ?></td>
	<td><?php echo $row21["item"]; ?></td>
	<td align="center"><?php echo $row21["qty"]; ?>  <?php echo $row21["qrem"]; ?></td>
	<td align="right"><?php echo $row21["rate"]; ?></td>
	<?php
	$ittax = "0";
	$ittax = ($row21["cgst"] + $row21["sgst"] + $row21["igst"]);
	?>
	<td align="right"><?php echo (number_format($ittax,2)); ?></td>
	<?php
	$itemtotal = "0";
	$itemtotal = ($row21["total"] + $ittax );
	?>
	<td align="right"><?php echo (number_format($itemtotal,2)); ?></td>
	</tr>
<?php
$gt = ($gt + $itemtotal);
$totalqty = ($totalqty + $row21["qty"]);
}

?>
 <tr>
	<td colspan="5" align="center">TOTAL</td>
		<td ALIGN="RIGHT"><B><?php echo (number_format($gt,2)) ?> </B></td>
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