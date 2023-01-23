<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php
$st = "Active";
$sql2 = "select * from parts where status='$st'";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
include 'Insert/parts.inc';
?>

<div class="w3-container">

    <h4><strong>List of Parts Requests</strong></h4>
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Comp. ID</td>
<td><strong>Customer Name</td>
<td><strong>Parts</td>
<td><strong>Qty</td>
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