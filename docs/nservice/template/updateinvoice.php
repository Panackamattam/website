<?php
include 'head.inc';
include 'connection.php';
?>

  <?php
$st = "Active";
$z = "0";
$sql2 = "select * from invdetails where status='$st' and paystatus='$z' order by invno desc";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
  <div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				<h4 class="card-title"><strong>List Invoices</strong></h4>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td><strong>Invoice #</td>
<td><strong>Date</td><td><strong>Customer</td><td><strong>Mobile</td><td><strong>Amount</td><td><strong>Payment Status</td>
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
<td><a href="pinventry.php?invno=<?php echo $row2["invno"] ?>&search=search&comid=<?php echo $row2["compid"] ?>"><?php echo $row2["invno"] ?></a></td>
<td><?php echo $row2["invdate"] ?></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["mobile"] ?></td>
<td><?php echo $row2["totalamt"] ?></td>
<td><?php echo $paystatus ?></td>
</tr>
<?php
}
?>
</table>
</div>
<?php
}
?>
   
    </div>
  </div>  </div>
</div>
     </div>
   <?php
   include 'footer.inc';
   ?>


