<?php
include 'head.inc';
include 'connection.php';
?>

  <?php
$st = "Resolved";
$z = "0";
$sql2 = "select * from Complaints where cstatus='$st' and invno='$z'";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
<h4 class="card-title"><strong>Create Invoices</strong></h4>

<div class="table-responsive">
<table class="table table-striped">
<tr>
<td><strong>Comp.#</td>
<td><strong>Name</td><td><strong>Mobile</td><td><strong>Complaint</td><td><strong>Staus</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
$cname = $row2["fname"]. " " .$row2["lname"];
?>
<tr>
<td><a href="cinvoice.php?comid=<?php echo $row2["compid"] ?>&cr=CreateInvoice"><?php echo $row2["compid"] ?></a></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["mobile"] ?></td>
<td><?php echo $row2["complaint"] ?></td>
<td><?php echo $row2["cstatus"] ?></td>
</tr>
<?php
}
?>
</table>
</div>
<br />
<?php
}
else
{
echo "There is no resolved ticket to make invoice.";
}
?>
   
    </div>
  </div>
  </div>  </div>
</div>
 <?php
   include 'footer.inc';
   ?>


