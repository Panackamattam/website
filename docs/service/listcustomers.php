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
$st = "Active";
$sql2 = "select * from Customers where status='$st' order by fname";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
  <div class="left">
    <h3><strong>Active Customers List</strong></h3>
	<br />
    <div class="left_box"> <form method="get" action="customers.php">
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>First Name</td>
<td><strong>Last Name</td><td><strong>City</td><td><strong>Phone</td><td><strong>Mobile</td><td><strong>Email</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><a href="vcustomer.php?cid=<?php echo $row2["cid"] ?>"><?php echo $row2["fname"] ?></a></td>
<td><?php echo $row2["lname"] ?></td>
<td><?php echo $row2["city"] ?></td>
<td><?php echo $row2["phone"] ?></td>
<td><?php echo $row2["mobile"] ?></td>
<td><?php echo $row2["email"] ?></td>
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
