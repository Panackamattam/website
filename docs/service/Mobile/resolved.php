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
	<form method="get" action="">
    <h4><strong>Resolved tickets report</strong></h4>
	<p>Filter Report:</p>
	<p>Select Catagory:<br />
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
	</select></p>
	<p>Select Technician:<br /><select name="asained">
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
	</select></p>

	<p>Complaint Staus:<br />
	<select name="cstatus">
	<option value="all">All</option>
	<option value="Waiting for parts">Waiting for Parts</option>
	<option value="In Process">In Process</option>
	</select></p>
	<p><input type="submit" name="filter" value="Filter Report" class="w3-button w3-green w3-third"></input></p>
	
	</tr>
	</table>
	</form>
	<hr>
	<br />
  <?php
$st = "Active";
$cst = "Resolved";
$cat = $_REQUEST['cat'];
$asd = $_REQUEST['asained'];
$cstat = $_REQUEST['cstatus'];

if ($_REQUEST['filter']) {
$msg = "Resolved tickets of ";
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
	
	else
	{
	$sql2 = $sql2;
	}

$sql2 .= " order by compid desc";
}
else
{
$msg = "Resolved tickets";
$sql2 = "select * from Complaints where cstatus='$cst' order by compid desc";
}
//echo $sql2;
//$sql2 = "select * from Complaints where cstatus!='$cst' order by compid desc";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
<h4><u><?php echo $msg ?></u></h4><br />
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Com#</td>
<td><strong>Date</td>
<td><strong>Customer</td>
<td><strong>Mobile</td>
<td><strong>Catagory</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
If ($row2["cstatus"] == "Resolved") {
?>
<tr>
<td><?php echo $row2["compid"] ?></td>
<td><?php echo $row2["crdate"] ?></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["mobile"] ?></td>
<td><?php echo $row2["cat"] ?></td>
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
  <hr>
   <?php
 include 'footer.inc';
 ?>