<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'parts.inc';
?>
    
	
  </div>
  <?php
$st = "Active";
$sql2 = "select * from parts where status='$st'";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
  <div class="left">
    <h3><strong>Active Parts Requests</strong></h3>
	<br />
    <div class="left_box"> <form method="get" action="customers.php">
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Comp. ID</td>
<td><strong>Customer Name</td><td><strong>Parts</td><td><strong>Qty</td><td><strong>Status</td><td><strong>Owner</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
$cd = $row2["cid"];
$cidsql = "select * from Customers where cid='$cd'";
$cidr = $con->query($cidsql);
$cidrow = $cidr->fetch_assoc();

?>
<tr>
<td><?php echo $row2["compid"] ?></td>
<td><?php echo $cidrow["fname"]." ".$cidrow["lname"] ?></td>
<td><?php echo $row2["parts"] ?></td>
<td><?php echo $row2["qty"] ?></td>
<td><?php echo $row2["pstatus"] ?></td>
<td><?php echo $row2["user"] ?></td>
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
