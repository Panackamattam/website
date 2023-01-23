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
    <h3><strong>Un resolved tickets</strong></h3>
	<br />
    <div class="left_box"> <form method="get" action="">
	<table>
	<tr>
	<td>Filter:</td>
	<td>Select Catagory
	<select name="cat">
	<option value="all">All</option>
	
<?php
$st = "Active";
$sql = "SELECT * FROM catgaory where status='$st' order by pcat";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
?>
<option value="<?php echo $row["pcat"] ?>"><?php echo $row["pcat"] ?></option>
<?php
}
?>
	</select></td>
	<td>Select Technician<select name="asained">
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

	<td>Complaint Staus
	<select name="cstatus">
	<option value="all">All</option>
	<option value="Waiting for parts">Waiting for Parts</option>
	<option value="In Process">In Process</option>
	</select></td>
	<td><input type="submit" name="filter" value="Filter Report"></input></td>
	
	</tr>
	</table>
	<hr>
	<br />
  <?php
$st = "Active";
$cst = "Resolved";
$cat = $_REQUEST['cat'];
$asd = $_REQUEST['asained'];
$cstat = $_REQUEST['cstatus'];

if ($_REQUEST['filter']) {
$msg = "Un Resolved tickets of ";
$sql2 = "select * from Complaints";
	if ($_REQUEST['cat'] != "all") {
	$sql2 .= " where cat='$cat'";
	$msg .= "$cat";
	}
	if ($_REQUEST['asained'] != "all") {
		if ($_REQUEST['cat'] == "all"){
		$sql2 .= " where asained='$asd'";
		}
		else
		{
		$sql2 .= " and asained='$asd'";
		}
	$msg .= ", $asd";
	}
	
	if ($_REQUEST['cstatus'] != "all") {
		if ($_REQUEST['asained'] == "all") {
		$sql2 .= " where cstatus='$cstat'";
		}
		else
		{
		$sql2 .= " and cstatus='$cstat'";
		}
	$msg .= ", $cstat";
	}
	else
	{
	$sql2 = $sql2;
	}

$sql2 .= " order by compid desc";
}
else
{
$msg = "All Un resolved tickets";
$sql2 = "select * from Complaints where cstatus!='$cst' order by compid desc";
}
//echo $sql2;
//$sql2 = "select * from Complaints where cstatus!='$cst' order by compid desc";
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
<td><strong>Complaint Status</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
If ($row2["cstatus"] != "Resolved") {
?>
<tr>
<td><?php echo $row2["compid"] ?></td>
<td><?php echo $row2["crdate"] ?></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["mobile"] ?></td>
<td><?php echo $row2["cat"] ?></td>
<td><?php echo $row2["cstatus"] ?></td>
</tr>
<?php
}
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
