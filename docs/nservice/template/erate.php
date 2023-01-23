<?php
include 'head.inc';
include 'connection.php';

$comid = $_REQUEST['comid'];

$csql ="select * from Complaints where compid='$comid'";
$cresult = $con->query($csql);
$crow = $cresult->fetch_assoc();
$cid = $crow["cid"];

$cmid = "select * from Customers where cid='$cid'";
$cmidresult = $con->query($cmid);
$csrow = $cmidresult->fetch_assoc();
$cname = $csrow["fname"]." ".$csrow["lname"];
$rec = $_REQUEST["rec"];

if ($rec == "db") {

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
    <h4><strong>Create Estimate for ticket</strong></h4>
<form method="get" action="createestimate.php">
<input type="hidden" name="srno" value="<?php echo $sn ?>"></input>
<input type="hidden" name="comid" value="<?php echo $erow["compid"] ?>"></input>
<input type="hidden" name="qty" value="<?php echo $erow["qty"] ?>">
<input type="hidden" name="rec" value="<?php echo $rec ?>"></input>
	<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Comp. ID</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $comid ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Customer ID</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["cid"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>

					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Name</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $cname; ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["mobile"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
	<hr>
<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Item</label>
							<div class="col-sm-9">
                            <input type="text" name="item" value="<?php echo $erow["item"] ?>" class="form-control form-control-sm" />
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
                          <label class="col-sm-3 col-form-label">Rate/Pc</label>
							<div class="col-sm-9">
                            <input type="text" name="rate"  value="<?php echo $erow["rate"] ?>" class="form-control form-control-sm"  />
                          </div>
                        </div>
                      </div>
<input type="hidden" name="search" value="Add Rate"></input>
<p align="center"><button type="submit" class="btn btn-primary mr-2">Submit</button></p>
</form>
	<br />
	<br />
		<br />
	<br />
<p><font color="red"><i>* If you want to remove item, please keep the rate as zero (0).</i></font></p>
<?php
}
?>

<?php
if ($rec == "new") {

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
    <h4><strong>Create Estimate for ticket</strong></h4>
<form method="get" action="createestimate.php">
<input type="hidden" name="comid" value="<?php echo $_REQUEST['comid'] ?>"></input>
<input type="hidden" name="rec" value="<?php echo $rec ?>">
	<br />	
		<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Comp. ID</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $comid ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Customer ID</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["cid"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>

					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Name</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $cname; ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["mobile"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
	<hr>
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
<input type="hidden" name="search" value="Add Rate"></input>
<p align="center"><button type="submit" class="btn btn-primary mr-2">Submit</button></p>
</form>
<?php
}
?>
	<br />
	<br />
		<br />
	<br />	<br />
	<br />
		<br />
	<br />
		<br />
		<br />
	<br />	<br />
		<br />
	<br />	<br />
		<br />
	<br />
</form>
    </div>
  </div>
  <div class="right">
   <?php
   include 'right.php';
   ?>
  </div>
  <div class="footer">
 <?php
   include 'footer.php';
   ?>
  </div>
</div>
</body>
</html>
