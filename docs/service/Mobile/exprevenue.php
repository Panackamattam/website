<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
   <?php
include 'Insert/report.inc';
?> 
<div class="w3-container">
    <h3><strong>Expected revenue</strong></h3>
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
<h4><u><?php echo $msg ?></u></h4><br />
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Com#</td>
<td><strong>Customer</td>
<td><strong>Catagory</td>
<td align="right"><strong>Esimate Amount</td>
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
	<td><?php echo $row2["cname"] ?></td>
	<td><?php echo $row2["cat"] ?></td>
	<td align="right"><?php echo $tot ?></td>
	</tr>
<?php
}
}
?>
<tr>
<td><strong>TOTAL</strong></td>
<td></td>
<td></td>
<td align="right"><strong><?php echo $tot ?></strong></td>
</tr>
</table>
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
<h4><u><?php echo $msg1 ?></u></h4><br />
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Com#</td>
<td><strong>Customer</td>
<td><strong>Catagory</td>
<td align="right"><strong>Esimate Amount</td>
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
	<td><?php echo $row23["cname"] ?></td>
	<td><?php echo $row23["cat"] ?></td>
	<td align="right"><?php echo $tot ?></td>
	</tr>
<?php
}
}
?>
<tr>
<td><strong>TOTAL</strong></td>
<td></td>
<td></td>
<td align="right"><strong><?php echo $tot ?></strong></td>
</tr>
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