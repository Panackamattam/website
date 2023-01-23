<?php
include 'head.inc';
include 'connection.php';
?>

  <?php
$st = "Active";

$psearch = $_REQUEST['psub'];
if ($psearch){
$sfld = $_REQUEST['sfld'];
$sql2 = "select * from parts where status='$st' and pstatus='$sfld'";
}
else
{
$sql2 = "select * from parts where status='$st'";
}
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>


  <div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				<h4>List of parts requests</h4>
				
				<form method="get" action="">
<table class="table table-hover">
<tr>
<td><input type="text" name="search" Value="Filter" class="form-control form-control-sm" disabled /></td><td> <select name="sfld" class="form-control form-control-sm">
<option value="Issued">Parts issued</option>
<option value="In Process">Parts not issued</option>
</td>
<td><button type="submit" name="psub" value="search" class="btn btn-primary mr-2">Search</button></td>
</tr>
</table>
</form>	
				
				
				                  <div class="table-responsive">
                    <table class="table table-striped">
<tr>
<td><strong>Comp#</td>
<td><strong>Customer Name</td>
<td><strong>Parts</td>
<td><strong>Qty</td>
<td><strong>Status</td>
<td><strong>Owner</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
$cd = $row2["cid"];
$cidsql = "select * from Customers where cid='$cd'";
$cidr = $con->query($cidsql);
$cidrow = $cidr->fetch_assoc();

?>
<tr>
<td><?php echo $row2["compid"] ?></td>
<td><?php echo $cidrow["fname"]." ".$cidrow["lname"] ?></td>
<td><?php echo $row2["parts"] ?></td>
<td><?php echo $row2["qty"] ?></td>
<td><?php echo $row2["pstatus"] ?></td>
<td><?php echo $row2["user"] ?></td>
</tr>
<?php
}
?>
</table>
</div>
<br />
<?php
}
?>
   
    </div>
  </div>
    </div>  </div>
</div>
 <?php
   include 'footer.inc';
   ?>

