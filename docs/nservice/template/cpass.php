<?php
include 'head.inc';
include 'connection.php';
?>
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				<h4 class="card-title"><strong>change password</strong></h4>
	
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
$msg = "User details";
?>
<h4><?php echo $msg ?></h4><br />
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td><strong>Name</td>
<td><strong>City</td>
<td><strong>Mobile</td>
<td><strong>Role</td>
<td><strong>Status</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
	<tr>
	<td><a href="changepassword.php?cus=<?php echo $row2["uid"]?>&sub=search"><?php echo $row2["Name"] ?></a></td>
	<td><?php echo $row2["city"] ?></td>
	<td><?php echo $row2["mobile"] ?></td>
	<td><?php echo $row2["role"] ?></td>
	<td><?php echo $row2["status"] ?></td>
	</tr>
<?php
}
?>
</table>
<?
}
?>
   
    </div>
  </div>
  </div>  </div>
</div>
 <?php
   include 'footer.php';
   ?>
