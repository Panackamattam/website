<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'customer.inc';
?>
    
	
  </div>
  <?php
$user = $_SESSION["username"];
$role = $_SESSION["role"];
  
$st = "Resolved";
if ($role == "technician") {
$sql2 = "select * from Complaints where cstatus!='$st' and asained='$user' order by compid desc";
}
if ($role == "Admin") {
$sql2 = "select * from Complaints where cstatus!='$st' order by compid desc";
}

$result2 = $con->query($sql2);

?>
  <div class="left">
    <h3><strong>Pending Tickets</strong></h3>
	<br />
    <div class="left_box"> <form method="get" action="customers.php">
	<?php
	if ($result2->num_rows > 0) {
	?>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Complaint #</td>
<td><strong>Customer Name</td>
<td><strong>Catagory</td>
<td><strong>Complaint</td>
<td><strong>Current Status</td>
<td><strong>Technician</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><a href="vticket.php?comid=<?php echo $row2["compid"] ?>"><?php echo $row2["compid"] ?></a></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["cat"] ?></td>
<td><?php echo $row2["complaint"] ?></td>
<td><?php echo $row2["cstatus"] ?></td>
<td><?php echo $row2["asained"] ?></td>
</tr>
<?php
}
?>
</table>
<br />
<?php
}
else
{
echo " No pending tickets !";
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
