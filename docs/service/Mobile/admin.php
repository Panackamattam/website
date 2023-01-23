<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
   <?php
include 'Insert/admin.inc';
?> 
<div class="w3-container">
    <h3><strong>All users details</strong></h3>
<form method="get" action="">
	
  <?php
$st = "Active";
$cst = "Resolved";
$fdate = $_REQUEST['fdate'];
$tdate = $_REQUEST['tdate'];
$tec =  $_REQUEST['tec'];
$z ="0";

$sql2 = "select * from users order by uid desc";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
//$msg = "Approved Estimates";
?>
<h2><?php echo $msg ?></h2>
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Name</td>
<td><strong>Mobile</td>
<td><strong>Role</td>
<td><strong>Status</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
	<tr>
	<td><?php echo $row2["Name"] ?></td>
	<td><?php echo $row2["mobile"] ?></td>
	<td><?php echo $row2["role"] ?></td>
	<td><?php echo $row2["status"] ?></td>
	</tr>
<?php
}
?>
</table>
<?php
}
?>
 
    </div>
  </div>
  <hr >
     <?php
 include 'footer.inc';
 ?>