<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'invoice.inc';
?>
    
	
  </div>
  <?php
$st = "Resolved";
$z = "0";
$sql2 = "select * from Complaints where cstatus='$st' and invno='$z'";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
  <div class="left">
    <h3><strong>Resolved Ticket Details</strong></h3>
	<br />
    <div class="left_box"> <form method="get" action="customers.php">
<table width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Comp.#</td>
<td><strong>Date</td><td><strong>Name</td><td><strong>Mobile</td><td><strong>Complaint</td><td><strong>Staus</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
$cname = $row2["fname"]. " " .$row2["lname"];
?>
<tr>
<td><a href="cinvoice.php?comid=<?php echo $row2["compid"] ?>&cr=CreateInvoice"><?php echo $row2["compid"] ?></a></td>
<td><?php echo $row2["crdate"] ?></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["mobile"] ?></td>
<td><?php echo $row2["complaint"] ?></td>
<td><?php echo $row2["cstatus"] ?></td>
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
