<?php
include 'head.inc';
include 'connection.php';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$comid = $_REQUEST['comid'];

$csql ="select * from Complaints where compid='$comid'";
$cresult = $con->query($csql);
$crow = $cresult->fetch_assoc();
$cid = $crow["cid"];

$cmid = "select * from Customers where cid='$cid'";
$cmidresult = $con->query($cmid);
$csrow = $cmidresult->fetch_assoc();

$cmid = $cmidrow["compid"];

$payupd = $_REQUEST["paymentupdate"];
if ($payupd){
$paystatus = "Received";
$inno = $_REQUEST['invno'];
$pmode = $_REQUEST['pmode'];
$pdate = $_REQUEST['pdate'];
$pdetails = $_REQUEST['pdetails'];
$pamount = $_REQUEST['pamount'];

$payentry = "update invdetails set paymode='$pmode', paydate='$pdate', details='$pdetails', recamt='$pamount', paystatus='$paystatus' where invno='$inno'";
if(mysqli_query($con, $payentry)){
   // echo "Records updated successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
}

?>
  
	<?php
	if ($msg) {
	?>
	<font color="red"><?php echo $msg ?></font>
	<?php	
	}
	?>
 <div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				<h4 class="card-title"><strong>Payment details entry</strong></h4>
<?php
//$sub = $_REQUEST['search'];
//if ($sub) {
?>
<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Invoice# </label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $_REQUEST['invno']; ?>" class="form-control form-control-sm" disabled />
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
                          <label class="col-sm-3 col-form-label">Firm Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["bname"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					<h4>
                     Ticket details
                    </h4>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Ticket Type</label>
                          <div class="col-sm-9">
                           <select name="type" class="form-control form-control-sm" readonly >
							<option value="Warranty" <?php if ($crow["type"] == "Warranty" ) {echo "selected";}?>>Warranty</option>
							<option value="Out of Warranty" <?php if ($crow["type"] == "Out Warranty" ) {echo "selected";}?>>Out of Warranty</option>
							<option value="Stock Damage" <?php if ($crow["type"] == "Stock Damage" ) {echo "selected";}?>>Stock Damage</option>
						   </select>
                          </div>
                        </div>
                      </div>
					     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Catagory</label>
                          <div class="col-sm-9">
                            <select name="pcat" class="form-control form-control-sm" readonly >
							<?php
$st = "Active";
$sql = "SELECT * FROM catgaory where status='$st' order by pcat";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
?>
<option value="<?php echo $row["pcat"] ?>" <?php if ($crow["cat"] == $row["pcat"] ) {echo "selected";}?>><?php echo $row["pcat"] ?></option>
<?php
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
                          <label class="col-sm-3 col-form-label">Brand</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $crow["brand"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Model</label></label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $crow["model"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	
					  <div class="row">
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Complaint in Breif</label>
                          <div class="col-sm-9">
                            <textarea name="complaint" rows="4" cols="27" disabled><?php echo $crow["complaint"] ?><?php echo $crow["complaint"] ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
<?php
$vsql = "select * from cvisits where compid='$comid'";
$vresult = $con->query($vsql);
if ($vresult->num_rows > 0) {
?>
<BR />
<caption><strong><u>Visit History</u></strong></caption>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td><strong>Visit Date</strong></td>
<td><strong>Visit Remark</strong></td>
<td><strong>Status</strong></td>
<td><strong>Technician</strong></td>
</tr>
<?php
while($vrow = $vresult->fetch_assoc()) {
?>
<tr>
<td><?php echo $vrow["vdate"] ?></td>
<td><?php echo $vrow["remark"] ?></td>
<td><?php echo $crow["cstatus"] ?></td>
<td><?php echo $vrow["user"] ?></td>
</tr>

<?php
}
?>
</table>
</div>
<?php
}
?>
<?php
$prsql = "select * from parts where compid='$comid'";
$prresult = $con->query($prsql);
if ($prresult->num_rows > 0) {
?>

<br /><hr>
<caption><strong><u>Parts Request</u></strong></caption>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td width="25%"><strong>Request Date</strong></td>
<td width="35%"><strong>Item</strong></td>
<td width="15%" align="center"><strong>Qty</strong></td>
<td width="25%"><strong>Item Status</strong></td>
</tr>
<?php
while($prrow = $prresult->fetch_assoc()) {
?>
<tr>
<td><?php echo $prrow["crdate"] ?></td>
<td><?php echo $prrow["parts"] ?></td>
<td align="center"><?php echo $prrow["qty"] ?></td>
<td><?php echo $prrow["pstatus"] ?></td>
</tr>

<?php
}
?>
</table>
</div>
<?php
}
?>

<?php
$z = "0";
$prsql1 = "select * from estimates where compid='$comid' and rate>'$z'";
$prresult1 = $con->query($prsql1);
if ($prresult1->num_rows > 0) {
?>

<br /><hr>
<caption><strong><u>Estimate Given</u></strong></caption>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td width="25%"><strong>Date</strong></td>
<td width="35%"><strong>Item</strong></td>
<td width="15%" align="center"><strong>Qty</strong></td>
<td width="25%"><strong>Estimate Status</strong></td>
</tr>
<?php
while($prrow11 = $prresult1->fetch_assoc()) {
?>
<tr>
<td><?php echo $prrow11["crdate"] ?></td>
<td><?php echo $prrow11["item"] ?></td>
<td align="center"><?php echo $prrow11["qty"] ?></td>
<td><?php echo $prrow11["estatus"] ?></td>
</tr>

<?php
}
?>
</table>
</div>
<?php
}
?>

<?php
$z = "0";
$in = $_REQUEST['invno'];
$prsql2 = "select * from invdetails where invno='$in'";
$prresult2 = $con->query($prsql2);
if ($prresult2->num_rows > 0) {
?>

<br /><hr>
<caption><strong><u>Invoice Details</u></strong></caption>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td width="25%"><strong>Invoice #</strong></td>
<td width="35%"><strong>Date</strong></td>
<td width="15%"><strong>Totam Amount</strong></td>
<td width="25%"><strong>Payment Status</strong></td>
</tr>
<?php
while($prrow2 = $prresult2->fetch_assoc()) {
	if ($prrow2["paystatus"] == "0") {
	$paystatus = "Not Received";
	}
	else
	{
	$paystatus = $prrow2["paystatus"];
		}
		$pmode = $prrow2["paymode"];
?>
<tr>
<td><?php echo $prrow2["invno"] ?></td>
<td><?php echo $prrow2["invdate"] ?></td>
<td><?php echo $prrow2["totalamt"] ?></td>
<td><?php echo $paystatus ?></td>
</tr>

<?php
}
?>
</table>
</div>
<?php
if ($paystatus != "Received"){
?>
<form method="get" action="">
<input type="hidden" name="invno" value="<?php echo $in ?>"></input>
<input type="hidden" name="comid" value="<?php echo $comid ?>"></input>

    <h4><strong>Update Payment Details</strong></h4>
	
	<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Payment date</label>
							<div class="col-sm-9">
                            <input type="date" name="pdate" value="" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Payment Mode</label>
                          <div class="col-sm-9">
                           <select name="pmode" class="form-control form-control-sm">
						   <option value="Cash" <?php if ($pmode == "Cash") { echo "selected"; }?>>By Cash</option>
							<option value="Cheque" <?php if ($pmode == "Cheque") {echo "selected"; }?>>By Cheque</option>
							<option value="Online" <?php if ($pmode == "Online") {echo "selected";} ?>>By Online</option>
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
                            <input type="text" name="pdetails" value="" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Amount</label>
							<div class="col-sm-9">
                            <input type="text" name="pamount" value="" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
	
	
<input type="hidden" name="paymentupdate" Value="Update Payment Details"></input><button type="submit" class="btn btn-primary mr-2">update payment details</button>
</form>
<?php
}
else
{
$msg1 = "Payment Received and Sucessfully Completed all process of this ticket !";
?>
<br />
<p align="center"><font color="red" size=3"><?php echo $msg1 ?></font></p>
<?php
}
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

