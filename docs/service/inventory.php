<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'inventory.inc';
?>
    
	
  </div>
  <?php
$st = "Active";
$z = "0";
$sql2 = "select * from Stock where status='$st' and balqty >'$z'";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
  <div class="left">
    <h3><strong>Active Inventory List</strong></h3>
	<br />
    <div class="left_box"> <form method="get" action="customers.php">
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Item Code</td>
<td><strong>Item</td>
<td align="center"><strong>Brand</td>
<td align="center"><strong>Qty</td>
<td align="right"><strong>S.Rate</td>
<td><strong>Remark</td>
<td><strong>S. Type</td>
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
<td><?php echo $row2["stockremark"] ?></td>
<td><?php echo $row2["stocktype"] ?></td>
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
