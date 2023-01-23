<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
  <?php
$st = "Resolved";
$z = "0";
$sql2 = "select * from Complaints where cstatus='$st' and invno='$z'";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
<?php
include 'Insert/invoice.inc';
?>
<div class="w3-container">
    <h4><strong>Resolved Ticket Details</strong></h4>

<table width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td align="center"><strong>Comp.#</td>
<td><strong>Date</td>
<td><strong>Name</td>
<td><strong>Complaint</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
$cname = $row2["fname"]. " " .$row2["lname"];
?>
<tr>
<td align="center"><a href="cinvoice.php?comid=<?php echo $row2["compid"] ?>&cr=CreateInvoice"><?php echo $row2["compid"] ?></a></td>
<td><?php echo $row2["crdate"] ?></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["complaint"] ?></td>
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
