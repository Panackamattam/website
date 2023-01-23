<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'invoice.inc';
?>
    
	
  </div>
  <?php
$st = "Active";
$z = "0";
$sql2 = "select * from invdetails where paystatus='$z' order by invno desc";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
  <div class="left">
    <h3><strong>Payment Due Invoice List</strong></h3>
	<br />
    <div class="left_box"> <form method="get" action="customers.php">
<table width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Invoice #</td>
<td><strong>Date</td><td><strong>Customer</td><td><strong>Mobile</td><td><strong>Amount</td><td><strong>Payment Status</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
	if ($row2["paystatus"] == 0) {
	$paystatus = "Not Received";
	}
?>
<tr>
<td><a href="pinventry.php?invno=<?php echo $row2["invno"] ?>&comid=<?php echo $row2["compid"] ?>"><?php echo $row2["invno"] ?></a></td>
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
<br />
<?php
}
?>
   
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
