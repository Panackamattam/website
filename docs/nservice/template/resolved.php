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
				<h4 class="card-title"><strong>REPORTS</strong></h4>
				<form method="post" action="">
 <form method="get" action="">
	<div class="row">
				  <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Catagory</label>
                          <div class="col-sm-9">
                            <select name="cat" class="form-control form-control-sm" >
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
	</select>
	</div>
    </div>
    </div>

<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Technician</label>
                          <div class="col-sm-9">
                            <select name="asained" class="form-control form-control-sm" >
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
	</select>
		</div>
    </div>
    </div>
	

	
	<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Branch</label>
                          <div class="col-sm-9">
                            <select name="cstatus" class="form-control form-control-sm" >
								<option value="all">All</option>
	<option value="Waiting for parts">Waiting for Parts</option>
	<option value="In Process">In Process</option>
	</select>
	</select>
		</div>
    </div>
    </div>
	</div>
	<p align="center"><input type="hidden" name="filter" value="Filter Report"></input><button type="submit" class="btn btn-primary mr-2">Filter</button></p>
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
<h4><?php echo $msg ?></h4><br />
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td><strong>Complaint #</td>
<td><strong>Date</td>
<td><strong>Customer</td>
<td><strong>Mobile</td>
<td><strong>Catagory</td>
<td><strong>Technician</td>
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
<td><?php echo $row2["technician"] ?></td>
</tr>
<?php
}
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


