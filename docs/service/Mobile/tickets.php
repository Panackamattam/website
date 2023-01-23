<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
?>
	
  </div>
  <?php
$st = "Resolved";
$sql2 = "select * from Complaints where cstatus!='$st' order by compid";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
//echo "Shine";
?>
<?php
include 'Insert/tickets.inc';
?>
<form method="get" action="">
  <div class="w3-container">
    <h4><strong>Pending Complaint Lists</strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
<table border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Comp. ID</td>
<td><strong>Cus. Name</td>
<td><strong>Type</td>
<td><strong>Catagory</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><?php echo $row2["compid"] ?></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["type"] ?></td>
<td><?php echo $row2["cat"] ?></td>
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
  <?php
 include 'footer.inc';
 ?>