<?php
include 'head.inc';
include 'connection.php';
?>
 <div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				<h4 class="card-title"><strong>REPORTS->EXPECTED REVENUE</strong></h4>
	
				<form method="get" action="">
  <?php
$st = "Active";
$cst = "Resolved";
$fdate = $_REQUEST['fdate'];
$tdate = $_REQUEST['tdate'];
$tec =  $_REQUEST['tec'];
$z = "0";

$sql2 = "select * from Complaints where cstatus!='$cst' order by compid";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
$msg = "Approved Estimates";
?>
<h4><?php echo $msg ?></H4><br />
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td><strong>Complaint #</td>
<td><strong>Date</td>
<td><strong>Customer</td>
<td><strong>Mobile</td>
<td><strong>Catagory</td>
<td align="right"><strong>Esimate Amount</td>
<td><strong>Technician</td>
</tr>
<?php
$tot = "0";
$apr = "Approved";
while($row2 = $result2->fetch_assoc()) {
	$comid = $row2["compid"];
	$sql22 = "select * from estimates where compid='$comid' and rate>'$z' and estatus='$apr'";
	$result22 = $con->query($sql22);
	if ($result22->num_rows > 0) {
	while($row22 = $result22->fetch_assoc()){
	$tot = ($tot + $row22["total"]);
	}
	
	?>
	<tr>
	<td><?php echo $row2["compid"] ?></td>
	<td><?php echo $row2["crdate"] ?></td>
	<td><?php echo $row2["cname"] ?></td>
	<td><?php echo $row2["mobile"] ?></td>
	<td><?php echo $row2["cat"] ?></td>
	<td align="right"><?php echo $tot ?></td>
	<td><?php echo $row2["asained"] ?></td>
	</tr>
<?php
}
}
?>
<tr>
<td><strong>TOTAL</strong></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td align="right"><strong><?php echo $tot ?></strong></td>
<td></td>
</tr>
</table>
</DIV>
<br />
<?php
}
?>

<?php
$cst = "Resolved";
$msg1 = "Estimates waiting for approval";
$sql23 = "select * from Complaints where cstatus!='$cst' order by compid";
$result23 = $con->query($sql23);
if ($result23->num_rows > 0) {
?>
<h4><?php echo $msg1 ?></h4><br />
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td><strong>Complaint #</td>
<td><strong>Date</td>
<td><strong>Customer</td>
<td><strong>Type</td>
<td><strong>Catagory</td>
<td align="right"><strong>Esimate Amount</td>
<td><strong>Technician</td>
</tr>
<?php
$tot = "0";
$apr = "Approved";
while($row23 = $result23->fetch_assoc()) {
	$comid = $row23["compid"];
	$sql223 = "select * from estimates where compid='$comid' and rate>'$z' and estatus!='$apr'";
	$result223 = $con->query($sql223);
	if ($result223->num_rows > 0) {
	while($row223 = $result223->fetch_assoc()){
	$tot = ($tot + $row223["total"]);
	}
	
	?>
	<tr>
	<td><?php echo $row23["compid"] ?></td>
	<td><?php echo $row23["crdate"] ?></td>
	<td><?php echo $row23["cname"] ?></td>
	<td><?php echo $row23["type"] ?></td>
	<td><?php echo $row23["cat"] ?></td>
	<td align="right"><?php echo $tot ?></td>
	<td><?php echo $row23["asained"] ?></td>
	</tr>
<?php
}
}
?>
<tr>
<td><strong>TOTAL</strong></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td align="right"><strong><?php echo $tot ?></strong></td>
<td></td>
</tr>
</table>
<br />
</div>
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


