<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
 <?php
$st = "Active";
$sql2 = "select * from invdetails where status='$st' order by invno desc";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
   <?php
include 'Insert/invoice.inc';
?> 
<div class="w3-container">
    <h3><strong>Whole Invoice List</strong></h3>

<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Invoice #</td>
<td><strong>Date</td>
<td><strong>Customer</td>
<td><strong>Amount</td>
<td><strong>Payment Status</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
	if ($row2["paystatus"] == "0") {
	$paystatus = "Not Received";
	}
	else
	{
	$paystatus = "Payment Received";
	}
?>
<tr>
<td><a href="vinv.php?invno=<?php echo $row2["invno"] ?>"><?php echo $row2["invno"] ?></a></td>
<td><?php echo $row2["invdate"] ?></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["totalamt"] ?></td>
<td><?php echo $paystatus ?></td>
</tr>
<?php
}
?>
</table>
<br />
<?php
}
?>
   
    </div>
  </div>
  <hr>
   <?php
 include 'footer.inc';
 ?>