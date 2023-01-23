<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'tickets.inc';
?>
	
  </div>
  <?php
  $user = $_SESSION["username"];
  $role = $_SESSION["role"];
$st = "Completed";

  if ($role == "technician") {
	//echo $usrow["role"];
	$sql2 = "select * from Complaints where cstatus!='$st' and asained='$user' order by compid";
	}

if ($role == "user") {
	//echo $usrow["role"];
	$sql2 = "select * from Complaints where cstatus!='$st' and crby='$user' order by compid";
	}
	
	if ($role == "Admin") {
	//echo $usrow["role"];
	$sql2 = "select * from Complaints where cstatus!='$st' order by compid";
	}

$result2 = $con->query($sql2);
?>

  <div class="left">
    <h3><strong>Pending Complaint Lists</strong></h3>
	<br />
    <div class="left_box"> <form method="get" action="customers.php">
	<?php
	if ($result2->num_rows > 0) {
//echo "Shine";
?>
<table border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Comp. ID</td>
<td><strong>Cus. Name</td>
<td><strong>Type</td>
<td><strong>Catagory</td>
<td><strong>Complaint</td>
<td><strong>Technician</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><a href="vticket.php?comid=<?php echo $row2["compid"] ?>"><?php echo $row2["compid"] ?></a></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["type"] ?></td>
<td><?php echo $row2["cat"] ?></td>
<td><?php echo $row2["complaint"] ?></td>
<td><?php echo $row2["asained"] ?></td>
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
