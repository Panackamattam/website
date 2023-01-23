<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'report.inc';
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


$sql2 = "select * from Complaints where status!='$cst' order by compid";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
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
	$sql22 = "select * from estimates where compid='$comid' and estatus='$apr'";
	$result22 = $con->query($sql22);
	$row22 = $result22->fetch_assoc();

?>
<tr>
<td><?php echo $row2["invno"] ?></td>
<td><?php echo $row2["invdate"] ?></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["mobile"] ?></td>
<td><?php echo $row22["cat"] ?></td>
<td><?php echo $row2["totalamt"] ?></td>
<td><?php echo $row2["asained"] ?></td>
</tr>
<?php
}
?>
<tr>
<td><strong>TOTAL</strong></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td><strong><?php echo $tot ?></strong></td>
</tr>
</table>
<br />
<?php
}
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
