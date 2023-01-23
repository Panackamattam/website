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

$submit = $_REQUEST['Submit'];
if ($submit) {
$z = "0";
$est = $_REQUEST['ap'];
$comid = $_REQUEST['comid'];
$apest = "update estimates set estatus='$est' where compid='$comid' and rate>'$z'";
if(mysqli_query($con, $apest )){
   // echo "Records added successfully.";
		} else{
  // echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
		}
$msg = "Estimate Approved Successfully !";
$apstatus = $_REQUEST['ap'];

$eqry = "update estdetails set apstatus='$apstatus' where compid='$comid'";
if(mysqli_query($con, $eqry )){
   // echo "Records added successfully.";
		} else{
  // echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
		}

}

?>

  
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

				<h4 class="card-title"><strong>Create Estimates</strong></h4>
				<h4><font color="red"><?php echo $msg ?></font></h4>
<form method="get" action="">
	


<?php
$sub = $_REQUEST['search'];
if ($sub) {
?>

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
                          <label class="col-sm-3 col-form-label">Firm Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["bname"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address1</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $csrow["add1"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address2</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["add2"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	

					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $csrow["city"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["state"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	


					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">PinCode</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $csrow["pincode"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["country"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	

					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $csrow["phone"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["email"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	
					
					
					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $csrow["mobile"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Refferd By</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["reff"] ?>" class="form-control form-control-sm" disabled />
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
$prsql = "select * from estimates where compid='$comid'";
$prresult = $con->query($prsql);
if ($prresult->num_rows > 0) {
?>

<br /><hr>
                  <div class="table-responsive">
<caption><strong><u>Create Estimate</u></strong></caption>
<table class="table">
<tr>
<td align="left"><strong>Item</strong></td>
<td align="center"><strong>Qty</strong></td>
<td align="right"><strong>Rate</strong></td>
<td align="right"><strong>Total</strong></td>
</tr>
<?php
$tot = "0.00";
while($prrow = $prresult->fetch_assoc()) {
$tot = ($tot + $prrow["total"]);
?>
<tr>
<td><?php echo $prrow["item"] ?></a></td>
<td align="center"><?php echo $prrow["qty"] ?></td>
<td align="right"><?php echo $prrow["rate"] ?></td>
<td align="right"><?php echo $prrow["total"] ?></td>

</tr>
<?php
}
?>
<tr>
<td>Any Other Charges</td>
<td align="center"></td>
<td align="right">0.00</td>
<td align="right">0.00</td>
</tr>
<?php
$se = "Service Charge";
$sql = "select * from estimates where item='$se' and compid='$comid'";
$result21 = $con->query($sql);
if ($result21->num_rows > 0) {
}
else
{
?>
<tr>
<td>Service Charges</td>
<td align="center"></td>
<td align="right"></td>
<td align="right">0.00</td>
</tr>
<?php
}
?>

<tr>
<td>Total</td>
<td></td>
<td align="center"></td>
<td align="right"><?php echo $tot ?></td>
</tr>
</table>
</div>
<form method="get" action="">
<?php
							$esql1 = "select * from estdetails where compid='$comid' and estatus='$st'";
							$esqlresult = $con->query($esql1);
							if ($esqlresult->num_rows > 0) {
							$etrow = $esqlresult->fetch_assoc();
							$estno = $etrow["eno"];
							$est = $etrow["apstatus"];
							}
?>
                  <div class="table-responsive">
<table class="table">
<tr>
<td>Approve/Reject<input type="hidden" name="comid" value="<?php echo $comid ?>"</td>
<td><input type="hidden" name="search" value="search"><select name="ap" style="width: 170px;">
<option value="Approved" <?php if ($est == "Approved"){ echo "selected";} ?>>Approved</option>
<option value="Rejcted" <?php if ($est == "Rejected"){ echo "selected";} ?>>Rejected</option>
</select></td>
<td><input type="hidden" name="Submit" Value="Submit"><button type="submit" class="btn btn-primary mr-2">Submit</button></input></td>
</table>
</div>
</form>
<?php
}
?>
<br />

<?php
}
?>
</form>
    </div>
  </div>
    </div>  </div>
</div>
 <?php
   include 'footer.inc';
   ?>

