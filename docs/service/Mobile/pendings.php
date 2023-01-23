<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php
$user = $_SESSION["username"];
$role = $_SESSION["role"];
$st = "Resolved";

if ($role == "technician") {
$sql2 = "select * from Complaints where cstatus!='$st' and asained='$user' order by compid";
}
if ($role == "Admin") {
$sql2 = "select * from Complaints where cstatus!='$st' order by compid";
}

$result2 = $con->query($sql2);

?>
  <?php
include 'Insert/tickets.inc';
?>
 <div class="w3-container">
    <h4><strong>Pending tickets</strong></h4>
<?php
if ($result2->num_rows > 0) {
?>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td>Complaint #</td>
<td>Customer Name</td>
<td>Catagory</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><?php echo $row2["compid"] ?></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["cat"] ?></td>
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
 <hr>
   <?php
 include 'footer.inc';
 ?>