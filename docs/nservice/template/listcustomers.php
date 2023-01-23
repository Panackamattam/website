<?php
include 'head.inc';
include 'connection.php';
?>

  <?php
$st = "Active";
$sql2 = "select * from Customers where status='$st' order by fname";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
  	 <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
<h4 class="card-title"><strong>Active Customers List</strong></h4>
<table class="table table-striped">
<tr>
<td><strong>Cus #</td>
<td><strong>First Name</td>
<td><strong>Last Name</td><td><strong>City</td><td><strong>Phone</td><td><strong>Mobile</td><td><strong>Email</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><?php echo $row2["cid"] ?></td>
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
</div>
</div>
</div>
</div>
</div>
<?php
}
?>
   <?php
   include 'footer.inc';
   ?>
 