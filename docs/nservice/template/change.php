<?php
include 'head.inc';
include 'gstconnection.php';
?>

        <div class="main-panel">
          <div class="content-wrapper pb-0">
           
		<?php
		$st = "Active";
		$sid = $_REQUEST["sid"];
		$qry4 = "select * from gststock where sid='$sid'";
		$sre1 = $con->query($qry4);
		$row1 = $sre1->fetch_assoc();
		
$btn = $_REQUEST['create'];
if ($btn) {
$user = "User";
$cdate = date('Y-m-d H:i:s');
$st = "Active";
$z = "0";
$sid = $_REQUEST['sid'];
$srate = $_REQUEST['srate'];

$sql5 = "update gststock set srate='$srate' where sid='$sid'";

//$sql = "INSERT INTO gstinventory(item, hsncode, taxschedule, unit, crdate, status) VALUES ('$item', '$hsncode', '$gstrate', '$unit', '$cdate', '$st')";
//echo $sql;
if(mysqli_query($con, $sql5)){
   //echo "Records added successfully.";
   //$msg = "Catagory added successfully.";
	} else{
   echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
}
$msg = "Rate updated successfully !";
}

?>
          <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Change Inventory selling rate <font color="red"><?php if ($btn) {?> - <?php echo $msg;} ?></font></h4>
					<p>&nbsp;</p>
                    <form method="get" action="" class="form-sample">
 						 <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Item</label>
							<input type="hidden" name="sid" value="<?php echo $sid; ?>"></input>
                            <div class="col-sm-9">
                              <input type="text" name="item" value="<?php echo $row1["item"]?>" class="form-control" readonly />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Stock Qty</label>
                            <div class="col-sm-9">
                              <input type="text" name="sqty" value="<?php echo $row1["balqty"]?>" class="form-control" readonly />
                            </div>
                          </div>
                        </div>
						</div>
						<div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Unit</label>
                            <div class="col-sm-9">
                              <input type="text" name="unit" value="<?php echo $row1["unit"]?>" class="form-control" readonly />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">HSN Code</label>
                            <div class="col-sm-9">
                              <input type="text" name="hsncode" value="<?php echo $row1["hsncode"]?>" class="form-control" readonly />
                            </div>
                          </div>
                        </div>
                      </div>
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pur Price</label>
                            <div class="col-sm-9">
                              <input type="text" name="unit" value="<?php echo $row1["prate"]?>" class="form-control" readonly />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Selling Rate</label>
                            <div class="col-sm-9">
                              <input type="text" name="srate" value="<?php if ($row1["srate"] != $z) { echo $row1["srate"]; } ?>" class="form-control" required />
                            </div>
                          </div>
                        </div>
                      </div>
			
<p > <button type="SUBMIT" class="btn btn-primary" name="create" value="Create Inventory"> Update Selling Rate </button></p>		  
					  
                    </form>
                  </div>
                </div>
              </div>
			
			
			</div>
			<?php
			include 'footer.inc';
			?>
          