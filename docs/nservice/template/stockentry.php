<?php
include 'head.inc';
include 'connection.php';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$sub = $_REQUEST['submit'];
if ($sub) {

$itsql = "select * from Stock order by srno desc limit 1";
$sresult = $con->query($itsql);
$srow = $sresult->fetch_assoc();

$itcode = ($srow["itemcode"] + 1 );
$itm = $_REQUEST['item'];
$bra = $_REQUEST['brand'];
$qty = $_REQUEST['qty'];
$rem = $_REQUEST['sremark'];
$cpr = $_REQUEST['cprice'];
$spr = $_REQUEST['srate'];
$sty = $_REQUEST['stype'];
$gst = $_REQUEST['gst'];

$insql = "INSERT INTO Stock(itemcode, item, brand, stockqty, balqty, cost, sellingrate, stockremark, crdate, crby, mdate, status, stocktype, gst) VALUES ('$itcode', '$itm', '$bra', '$qty', '$qty', '$cpr', '$spr', '$rem', '$cdate', '$user', '$cdate', '$st', '$sty', '$gst')";
if(mysqli_query($con, $insql )){
   // echo "Records added successfully.";
		} else{
  // echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
		}
		$msg = "Inventory added successfully";
		
}
?>
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
    <h4><strong>Create Inventory</strong></h4>
	<h4><font color="red"><?php echo $msg; ?></font></h4>
	<br />	<br />
<form method="get" action="">

<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Item</label>
							<div class="col-sm-9">
                            <input type="text" name="item" value="" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Quantity</label>
                          <div class="col-sm-9">
                            <input type="text" name="qty" value="" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Brand</label>
							<div class="col-sm-9">
                            <input type="text" name="brand" value="" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Cost Rs</label>
                          <div class="col-sm-9">
                            <input type="text" name="cprice" value="" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
					
<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Selling Rate</label>
							<div class="col-sm-9">
                            <input type="text" name="srate" value="" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">GST Rate</label>
                          <div class="col-sm-9">
                            <select name="gst" class="form-control form-control-sm"  >
							<option value="0">0</option>
							<?php
$sq = "select * from taxes where status='$st'";
$sqr = $con->query($sq);

if ($sqr->num_rows > 0) {
while ($sqrow = $sqr->fetch_assoc()) {
$gst = $sqrow["gst"];
//$gst = var(int)$gst;
?>
<option value="<?php echo $sqrow["gst"] ?>"><?php echo $gst ?>%</option>
<?php
}
}
?>
</select>
                          </div>
                        </div>
                      </div>
                    </div>
					

<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Remark</label>
							<div class="col-sm-9">
                            <input type="text" name="sremark" value="" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Inventory type</label>
                          <div class="col-sm-9">
                            <select name="stype" class="form-control form-control-sm"  >
							<option value="Comsumable">Consumable</option>
							<option value="Tools">Tools</option>
							<option value="Asset">Asset</option>
							</select>
                          </div>
                        </div>
                      </div>
                    </div>
					<p align="center"><input type="hidden" name="submit" value="add stock"></input><button type="submit" class="btn btn-primary mr-2">Add Stock</button></input></td></p>
					</form>
					<br /><br /><br /><br /><br /><br /><br />

    </div>
  </div>
  </div>  </div>
</div>
 <?php
   include 'footer.inc';
   ?>

