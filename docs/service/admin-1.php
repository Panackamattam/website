<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'admin.inc';
?>
 </div>
  <div class="left">
    <h3><strong>Service Details</strong></h3>
	<br />
    <div class="left_box"> <form method="get" action="">
	<table>
	<tr>
	<td></td>
	<td>Select From <input type="date" name="fdate" value=""></input></td>
	<td>Select To<input type="date" name="tdate" value=""></input></td>
	<td>Select Technician<select name="tec">
	<option value="all">All</option>
	<?php
	$sta = "Active";
	$tec = "technician";
	$tsql = "select * from users where status='$sta' and role='$tec'";
	$resultt = $con->query($tsql);
	while($rowt = $resultt->fetch_assoc()) {
	?>
	<option value="<?php echo $rowt["Name"] ?>"><?php echo $rowt["Name"] ?></option>
	<?php
	}
	?>
	</select></td>	
	<td><input type="submit" name="filter" value="Show Income"></input></td>
	</tr>
	</table>
	<hr>
	<br />
  <?php
$st = "Active";
$cst = "Resolved";
$fdate = $_REQUEST['fdate'];
$tdate = $_REQUEST['tdate'];
$tec =  $_REQUEST['tec'];
$z ="0";

$sql2 = "select * from Complaints where cstatus!='$cst' order by compid";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
$msg = "Approved Estimates";
?>
<h2><?php echo $msg ?></h2><br />
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Complaint #</td>
<td><strong>Date</td>
<td><strong>Customer</td>
<td><strong>Mobile</td>
<td><strong>Catagory</td>
<td><strong>Esimate Amount</td>
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
	<td><?php echo $tot ?></td>
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
<td><strong><?php echo $tot ?></strong></td>
<td></td>
</tr>
</table>
<br />
<?php
}
?>

<?php
$msg1 = "Estimates waiting for approval";
$sql23 = "select * from Complaints where cstatus!='$cst' order by compid";
$result23 = $con->query($sql23);
if ($result23->num_rows > 0) {
?>
<h2><?php echo $msg1 ?></h2><br />
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Complaint #</td>
<td><strong>Date</td>
<td><strong>Customer</td>
<td><strong>Mobile</td>
<td><strong>Catagory</td>
<td><strong>Esimate Amount</td>
<td><strong>Technician</td>
</tr>
<?php
$tot = "0";
$apr = "Approved";
while($row23 = $result23->fetch_assoc()) {
	$comid = $row23["compid"];
	$sql223 = "select * from estimates where compid='$comid' and rate>'$z' and estatus!='$apr'";
	$result22 = $con->query($sql223);
	if ($result223->num_rows > 0) {
	while($row223 = $result223->fetch_assoc()){
	$tot = ($tot + $row223["total"]);
	}
	
	?>
	<tr>
	<td><?php echo $row23["compid"] ?></td>
	<td><?php echo $row23["crdate"] ?></td>
	<td><?php echo $row23["cname"] ?></td>
	<td><?php echo $row23["mobile"] ?></td>
	<td><?php echo $row23["cat"] ?></td>
	<td><?php echo $tot ?></td>
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
<td><strong><?php echo $tot ?></strong></td>
<td></td>
</tr>
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
