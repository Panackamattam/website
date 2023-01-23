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
				<h4 class="card-title"><strong>REPORTS->REVENUE</strong></h4>
	
				<form method="get" action="">
					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">From</label>
							<div class="col-sm-9">
                            <input type="date" name="fdate" value="" class="form-control form-control-sm" />
                          </div>
                        </div>
						</div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">To</label>
							<div class="col-sm-9">
                            <input type="date" name="tdate" value="" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>           
                       <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Technician</label>
                          <div class="col-sm-9">
                           <select name="tec" class="form-control form-control-sm">
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
					  </div>
	
	<P align="center"><input type="hidden" name="filter" value="Show Income"></input><button type="submit" class="btn btn-primary mr-2">Filter</button></P>
	<hr>
	<br />
  <?php
$st = "Active";
$cst = "Resolved";
$fdate = $_REQUEST['fdate'];
$tdate = $_REQUEST['tdate'];
$tec =  $_REQUEST['tec'];

if ($_REQUEST['filter']) {
	if ($_REQUEST['tec'] != "all") {
	$sql2 = "select * from invdetails where status='$st' and asained='$tec' and invdate between '$fdate' and '$tdate' order by invno";
	}
	else
	{
	$sql2 = "select * from invdetails where status='$st' and invdate between '$fdate' and '$tdate' order by invno";
	}
//echo $sql2;
//$sql2 = "select * from Complaints where cstatus!='$cst' order by compid desc";

$msg = "Total income for the period from ";
$msg .= "$fdate"." to ".$tdate;
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
<h4><?php echo $msg ?></h4><br />
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td><strong>Invoice #</td>
<td><strong>Date</td>
<td><strong>Customer</td>
<td><strong>Mobile</td>
<td><strong>Catagory</td>
<td><strong>Invoice Amount</td>
<td><strong>Technician</td>
</tr>
<?php
$tot = "0";
while($row2 = $result2->fetch_assoc()) {
$tot = ($tot + $row2["totalamt"]);
$comid = $row2["compid"];
$sql22 = "select * from Complaints where compid='$comid'";
$result22 = $con->query($sql22);
$row22 = $result22->fetch_assoc();

?>
<tr>
<td><?php echo $row2["invno"] ?></td>
<td><?php echo $row2["invdate"] ?></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["mobile"] ?></td>
<td><?php echo $row22["cat"] ?></td>
<td align="right"><?php echo $row2["totalamt"] ?></td>
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
<td align="right"><strong><?php echo $tot ?></strong></td>
</tr>
</table>
<br />
<?php
}
}
?>
   
    </div>
  </div>
  </div>  </div>
</div>
 <?php
   include 'footer.inc';
   ?>


