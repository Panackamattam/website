<?php
include 'head.inc';
include 'connection.php';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$rec = $_REQUEST["rec"];

$sn = $_REQUEST['srno'];
$etsql = "select * from parts where srno='$sn'";
$eresult = $con->query($etsql);
$erow = $eresult->fetch_assoc();
?>
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

				<h4 class="card-title"><strong>Parts issue to ticket</strong></h4>
<form method="get" action="partsissue.php">
<input type="hidden" name="comid" value="<?php echo $erow["compid"] ?>"></input>
<input type="hidden" name="srno" size="25" value="<?php echo $erow["srno"] ?>">
<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Item</label>
							<div class="col-sm-9">
                            <input type="text" name="item" value="<?php echo $erow["parts"] ?>" class="form-control form-control-sm" readonly />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Quantity</label>
                          <div class="col-sm-9">
                            <input type="text" name="qty" value="<?php echo $erow["qty"] ?>" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>

					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Inventory item Code</label>
							<div class="col-sm-9">
                            <input type="text" name="itcode"  value="" class="form-control form-control-sm"  />
                          </div>
                        </div>
                      </div>

<input type="hidden" name="search" value="Issue Stock"></input>
<p align="center"><button type="submit" class="btn btn-primary mr-2">Issue Parts</button></p>
</form>
<br />
<hr>
<form method="get" action="">
<input type="hidden" name="comid" value="<?php echo $erow["compid"] ?>"></input>
<input type="hidden" name="srno" size="25" value="<?php echo $erow["srno"] ?>">
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td><input type="text" name="search" class="form-control form-control-sm" /></td><td> <select name="sopt" class="form-control form-control-sm">
<option value="exact">Exact Match</option>
<option value="contains">Contains</option>
</td>
<td><button type="submit" name="iserach" value="isearch" class="btn btn-primary mr-2">Search Inventory</button></td>
</tr>
</table>
</div>
</form>	
<br />		<br />	

<?php
$isearch = $_REQUEST['iserach'];
if ($isearch) {
$item = $_REQUEST['search'];
$opt = $_REQUEST['sopt'];
$z = "0";
	if ($opt == "exact"){
	$sql3i = "select * from Stock where item='$item' and status='$st' and balqty>'$z'";
	}
	if ($opt == "contains"){
$sql3i = "select * from Stock where item like '%$item%' and status='$st' and balqty>'$z'";
}
//echo $sql3;
	$result3i = $con->query($sql3i);
	if ($result3i->num_rows > 0) {
	?>
	<br />
	 <div class="table-responsive">
	 <caption>Inventory Search Result</caption>
<table class="table table-striped">
<tr>
<td>Item Code</td>
<td>Item</td>
<td>Brand</td>
<td>Qty</td>
<td>Selling Rate</td>
<td>Stock Remark</td>
</tr>
<?php
while($row3i = $result3i->fetch_assoc()) {
?>
<tr>
<td><?php echo $row3i["itemcode"] ?></td>
<td><?php echo $row3i["item"] ?></td>
<td><?php echo $row3i["brand"] ?></td>
<td><?php echo $row3i["balqty"] ?></td>
<td><?php echo $row3i["sellingrate"] ?></td>
<td><?php echo $row3i["stockremark"] ?></td>
</tr>
<?php
}
?>
</table>
</div>
	<?php
}
else
{
?>
<br />
<?php
$item = $erow["parts"];
$sql3 = "select * from Stock where item like '%$item%' and status='$st'";
//echo $sql3;
$result3 = $con->query($sql3);
if ($result3->num_rows > 0) {

//$row3 = $result3->fetch_assoc();
?>
<br />
 <table class="table table-striped">
<tr>
<td>Item Code</td>
<td>Item</td>
<td>Brand</td>
<td>Qty</td>
<td>Selling Rate</td>
<td>Stock Remark</td>
</tr>
<?php
while($row3 = $result3->fetch_assoc()) {
?>
<tr>
<td><?php echo $row3["itemcode"] ?></td>
<td><?php echo $row3["item"] ?></td>
<td><?php echo $row3["brand"] ?></td>
<td><?php echo $row3["balqty"] ?></td>
<td><?php echo $row3["sellingrate"] ?></td>
<td><?php echo $row3["stockremark"] ?></td>
</tr>
<?php
}
?>
</table>
<?php
}
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
