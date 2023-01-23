<?php
include 'head.inc';
include 'connection.php';
?>

  <?php
$user = $_SESSION["username"];
$role = $_SESSION["role"];
$dash = "-";  
$st = "Resolved";
$apst = "Approved";
$st1 = "Active";

$sub = $_REQUEST['sub'];
if ($sub) {
$search = $_REQUEST['search'];
$fld = $_REQUEST['sfld'];
if ($role == "technician") {
$sql2 = "select * from estdetails where estatus='$st1' and asained='$user' and $fld='$search' and apstatus!='$apst' order by compid desc";
}
if ($role == "Admin") {
$sql2 = "select * from estdetails where estatus='$st1' and $fld='$search' and apstatus!='$apst' order by compid desc";
}
}
else
{
$sql2 = "select * from estdetails where estatus='$st1' and apstatus!='$apst' order by compid desc";
}
$result2 = $con->query($sql2);

?>
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
				<h4 class="card-title"><strong>Update Estimates</strong></h4>
				
<form method="get" action="">
<table class="table">
<tr>
<td><input type="text" name="search" class="form-control form-control-sm" /></td><td> <select name="sfld" class="form-control form-control-sm">
<option value="eno">Estimate ID</option>
<option value="mobile">Mobile</option>
<option value="cname">Customer Name</option>

</td>
<td><button type="submit" name="sub" value="search" class="btn btn-primary mr-2">Search</button></td>
</tr>
</table>
</form>			
<table class="table table-hover">
	<?php
	if ($result2->num_rows > 0) {
?>

<tr>
<td><strong>Est #</td>
<td><strong>Name</td>
<td><strong>Amount</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
		$comid = $row2["compid"];
		$stat = "Active";
		$etsql = "select * from estimates where compid='$comid' and status='$stat'";
		$etr = $con->query($etsql);
			$tot = "0";
			while($etrw = $etr->fetch_assoc()) {
			$tot = ($tot + $etrw["total"]);
			}

?>
<tr>
<td>
<a href="approvestimate.php?comid=<?php echo $row2["compid"] ?>&search=search"><?php echo $row2["eno"] ?></a></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $tot; ?></td>
</tr>
<?php
}
?>
</table>
<br />
</div>
</div>
</div>
</div>
</div>

<?php
}
else
{
echo " No Estimates found !";
}
?>
  <?php
   include 'footer.inc';
   ?>
  