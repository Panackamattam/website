<?php
include 'head.inc';
include 'connection.php';

$rec = $_REQUEST["rec"];
$st = "Active";

if ($rec == "new") {
$it = $_REQUEST['it'];
$sn = $_REQUEST['srno'];
$etsql = "select * from estimates where srno='$sn'";
$eresult = $con->query($etsql);
$erow = $eresult->fetch_assoc();
?>
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
    <h4><strong>Add <?php echo $it ?></strong></h4>
<form method="get" action="cinvoice.php">
<input type="hidden" name="comid" value="<?php echo $_REQUEST['comid'] ?>"></input>
<input type="hidden" name="rec" value="<?php echo $rec ?>">
<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Item</label>
							<div class="col-sm-9">
                            <input type="text" name="item" value="<?php echo $_REQUEST['it'] ?>" class="form-control form-control-sm" />
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
                          <label class="col-sm-3 col-form-label">Rate/Pc</label>
							<div class="col-sm-9">
                            <input type="text" name="rate" value="" class="form-control form-control-sm"  />
                          </div>
                        </div>
                      </div>
					  

 <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Select tax rate</label>
                          <div class="col-sm-9">
                            <select name="tax" class="form-control form-control-sm">
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

<input type="hidden" name="search" value="Add Rate"></input><button type="submit" class="btn btn-primary mr-2">Submit</button>
<?php
}
?>

<br />
</form>
    </div>
  </div>
   </div>  </div>
</div>
  <?php
   include 'footer.inc';
   ?>


