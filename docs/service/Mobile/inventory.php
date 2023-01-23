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
$sql2 = "select * from Stock where status='$st' and balqty >'$z'";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
<?php
 include 'Insert/inventory.inc';
 ?>
<div class="w3-container">
    <h4><strong>Inventory items</strong></h4>
 <form method="get" action="customers.php">
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Item Code</td>
<td><strong>Item</td>
<td align="center"><strong>Brand</td>
<td align="center"><strong>Qty</td>
<td align="right"><strong>S.Rate</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><?php echo $row2["itemcode"] ?></td>
<td><?php echo $row2["item"] ?></td>
<td align="center"><?php echo $row2["brand"] ?></td>
<td align="center"><?php echo $row2["balqty"] ?></td>
<td align="right"><?php echo $row2["sellingrate"] ?></td>
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
