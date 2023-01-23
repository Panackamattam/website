<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
include 'Insert/cutsomer.inc';
?>    
 <?php
$st = "Active";
$sql2 = "select * from Customers where status='$st' order by fname";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>

  <form method="get" action="">
  <div class="w3-container">
    <h4><strong>Active Customers List</strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td>Name</td>
<td><strong>City</td>
<td><strong>Mobile</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><?php echo $row2["fname"]." ".$row2["lname"] ?></a></td>
<td><?php echo $row2["city"] ?></td>
<td><?php echo $row2["mobile"] ?></td>
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

