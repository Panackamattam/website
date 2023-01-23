<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>

<?php
$st = "Resolved";
$sql2 = "select * from Complaints where cstatus!='$st' order by compid";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
  <?php
include 'Insert/estimate.inc';
?>
<div class="w3-container">
    <h4><strong>Pending tickets</strong></h4>
	
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Complaint #</td>
<td><strong>Customer Name</td>
<td><strong>Catagory</td>
<td><strong>Technician</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><a href="vticket.php?comid=<?php echo $row2["compid"] ?>"><?php echo $row2["compid"] ?></a></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["cat"] ?></td>
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
  <hr>
   <?php
 include 'footer.inc';
 ?>