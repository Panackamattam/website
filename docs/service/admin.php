<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'admin.inc';
?>
 </div>
  <div class="left">
    <h3><strong>User details</strong></h3>
	<br />
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
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
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
	<td><?php echo $row2["Name"] ?></td>
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
