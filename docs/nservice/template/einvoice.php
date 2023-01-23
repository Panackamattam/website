<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'estimate.inc';

$rec = $_REQUEST["rec"];

$itcod = $_REQUEST['itemcod'];
$sn = $_REQUEST['srno'];
$etsql = "select * from invoice where srno='$sn'";
$eresult = $con->query($etsql);
$erow = $eresult->fetch_assoc();
?>
  	 <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
<h4 class="card-title"><strong>Edit Invoice item</strong></h4>
	
	<form method="get" action="editinvoice.php">
	<input type="hidden" name="update" value="update rate"></input>
	<input type="hidden" name="srno" value="<?php echo $sn ?>"></input>
	<input type="hidden" name="qty" value="<?php echo $erow["qty"] ?>">
	<input type="hidden" name="search" value="search">
	<input type="hidden" name="invno" value="<?php echo $erow["invno"] ?>"></input>
	<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Item</label>
							<div class="col-sm-9">
                            <input type="text" name="item" value="<?php echo $erow["parts"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Quantity</label>
                          <div class="col-sm-9">
                            <input type="text" name="qty" value="<?php echo $erow["qty"] ?>" class="form-control form-control-sm"  disabled />
                          </div>
                        </div>
                      </div>
                    </div>

					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Rate/Pc</label>
							<div class="col-sm-9">
                            <input type="text" name="rate" value="<?php echo $erow["rate"] ?>" class="form-control form-control-sm"  />
                          </div>
                        </div>
                      </div>
	
<?php
if ($itcod == "0") {
?>
<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Select tax rate</label>
                          <div class="col-sm-9">
                            <select name="tax" class="form-control form-control-sm">
<option value="0">0</option>
<?php
$st = "Active";
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
}
?>
</select>
                          </div>
                        </div>
                      </div>
					     </div>	


<p align="center"><input type="hidden" name="itemcod" value="<?php echo $erow["itemcode"] ?>"><input type="hidden" name="search" value="Edit Invoice Rate"></input><button type="submit" class="btn btn-primary mr-2">Update</button>
</p><br />
<p><font color="red"><i>* If you want to remove item, please keep the rate as zero (0).</i></font></p>

<br />
</form>
    </div>
  </div>
   </div>  </div>
</div>
  <?php
   include 'footer.inc';
   ?>

