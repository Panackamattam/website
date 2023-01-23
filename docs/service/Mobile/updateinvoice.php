<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php
$st = "Active";
$z = "0";
$sql2 = "select * from invdetails where paystatus='$z' order by invno desc";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
   <?php
include 'Insert/invoice.inc';
?> 
<div class="w3-container">
    <h4><strong>Payment Due Invoice List</strong></h4>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Invoice #</td>
<td><strong>Date</td><td>
<strong>Customer</td><td>
<strong>Mobile</td>
<td><strong>Amount</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><a href="pinventry.php?invno=<?php echo $row2["invno"] ?>&comid=<?php echo $row2["compid"] ?>"><?php echo $row2["invno"] ?></a></td>
<td><?php echo $row2["invdate"] ?></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["mobile"] ?></td>
<td><?php echo $row2["totalamt"] ?></td>
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