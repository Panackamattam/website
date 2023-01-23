<?php
include 'head.inc';
include 'gstconnection.php';
?>

        <div class="main-panel">
          <div class="content-wrapper pb-0">
           
		<?php
$btn = $_REQUEST['create'];
if ($btn) {
$user = "User";
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$item = $_REQUEST['item'];
$unit = $_REQUEST['units'];
$hsncode = $_REQUEST['hsncode'];
$gstrate = $_REQUEST['gstrate'];

$sql = "INSERT INTO gstinventory(item, hsncode, taxschedule, unit, crdate, status) VALUES ('$item', '$hsncode', '$gstrate', '$unit', '$cdate', '$st')";
//echo $sql;
if(mysqli_query($con, $sql)){
   //echo "Records added successfully.";
   //$msg = "Catagory added successfully.";
	} else{
   echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
}
$msg = "Item added successfully !";
}

?>
          <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create Inventory  <font color="red"><?php if ($btn) {?> - <?php echo $msg;} ?></font></h4>
                    <form method="get" action="" class="form-sample">
 						 <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Item</label>
                            <div class="col-sm-9">
                              <input type="text" name="item" class="form-control" required />
                            </div>
                          </div>
                        </div>
						</div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Unit</label>
                            <div class="col-sm-9">
                              <input type="text" name="units" class="form-control" required />
                            </div>
                          </div>
                        </div>
						</div>
						<div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">HSN Code</label>
                            <div class="col-sm-9">
                              <input type="text" name="hsncode" class="form-control" required />
                            </div>
                          </div>
                        </div>
                      </div>
						<div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">GST Rate</label>
                            <div class="col-sm-9">
							<select class="form-control" name="gstrate">
 <?php
							  $sta = "Active";
							  $qry1 = "select * from gsttaxes where status='$sta' order by taxrate";
							  $reslt = $con->query($qry1);
							  if ($reslt->num_rows > 0) {
							while($row = $reslt->fetch_assoc()){
							  ?>
							  
                                <option value="<?php echo $row["taxrate"];?>"> <?php echo $row["taxrate"]; ?></option>
<?php
}
}
?>
</select>
                            </div>
                          </div>
                        </div>
                      </div>
                    
			
<p > <button type="SUBMIT" class="btn btn-primary" name="create" value="Create Inventory"> Create inventory item </button></p>		  
					  
                    </form>
                  </div>
                </div>
              </div>
			
			
			</div>
			<?php
			include 'footer.inc';
			?>
          