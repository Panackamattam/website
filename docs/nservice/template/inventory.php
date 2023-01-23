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
				<h4>Inventory list</h4>
	<form method="get" action="">
<input type="hidden" name="comid" value="<?php echo $erow["compid"] ?>"></input>
<input type="hidden" name="srno" size="25" value="<?php echo $erow["srno"] ?>">
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td><input type="text" name="search" class="form-control form-control-sm" /></td><td> <select name="sopt" class="form-control form-control-sm">
<option value="all">All</option>
<option value="exact">Exact Match</option>
<option value="contains">Contains</option>
</td>
<td><button type="submit" name="iserach" value="isearch" class="btn btn-primary mr-2">Search Inventory</button></td>
</tr>
</table>
</div>
</form>	
 <?php
$st = "Active";
$z = "0";

$isearch = $_REQUEST['iserach'];
if ($isearch) {
$item = $_REQUEST['search'];
$opt = $_REQUEST['sopt'];
$z = "0";
	if ($opt == "exact"){
	$sql2 = "select * from Stock where item='$item' and status='$st' and balqty>'$z'";
	}
	if ($opt == "contains"){
	$sql2 = "select * from Stock where item like '%$item%' and status='$st' and balqty>'$z'";
	}
	if ($opt == "all"){
		$sql2 = "select * from Stock where status='$st' and balqty>'$z'";
	}
	}
else
{
$sql2 = "select * from Stock where status='$st' and balqty>'$z'";
}



//$sql2 = "select * from Stock where status='$st' and balqty >'$z'";
//$sql3i = "select * from Stock where item like '%$item%' and status='$st' and balqty>'$z'";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
                 <div class="table-responsive">
                    <table class="table table-striped">
<tr>
<td><strong>Item Code</td>
<td><strong>Item</td>
<td align="center"><strong>Brand</td>
<td align="center"><strong>Qty</td>
<td align="right"><strong>S.Rate</td>
<td><strong>Remark</td>
<td><strong>S. Type</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><?php echo $row2["itemcode"] ?></td>
<td><?php echo $row2["item"] ?></td>
<td align="center"><?php echo $row2["brand"] ?></td>
<td align="center"><?php echo $row2["balqty"] ?></td>
<td align="right"><?php echo $row2["sellingrate"] ?></td>
<td><?php echo $row2["stockremark"] ?></td>
<td><?php echo $row2["stocktype"] ?></td>
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


