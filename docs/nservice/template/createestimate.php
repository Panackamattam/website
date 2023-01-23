<?php
include 'head.inc';
include 'connection.php';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
$z= "0";

$comid = $_REQUEST['comid'];
$csql ="select * from Complaints where compid='$comid'";
$cresult = $con->query($csql);
$crow = $cresult->fetch_assoc();
$cid = $crow["cid"];
//echo $cid;

$ad = $_REQUEST['search'];
if ($ad){
$re = $_REQUEST['rec'];
		if ($re == "db") {
		$rate = $_REQUEST['rate'];
		$qty = $_REQUEST['qty'];
		$srn = $_REQUEST['srno'];
		$total = ($rate * $qty);
		$upsql = "update estimates set rate='$rate', total='$total' where srno='$srn'";
		
		if(mysqli_query($con, $upsql)){
   // echo "Records added successfully.";
		} else{
  // echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
		}
							$esql1 = "select * from estdetails where compid='$comid' and estatus='$st'";
							$esqlresult = $con->query($esql1);
							if ($esqlresult->num_rows > 0) {
							$etrow = $esqlresult->fetch_assoc();
							$estno = $etrow["eno"];
							$comup = "update Complaints set estimateno='$estno' where compid='$comid'";
								if(mysqli_query($con, $comup)){
							// echo "Records added successfully.";
								} else{
							// echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
								}
							}
							else
							{
							$esql2 = "INSERT INTO estdetails(estdate, compid, cid, total, curr, crby, crdate, mby, mdate, estatus) VALUES ('$cdate', '$comid', '$cid', '$z', '$z', '$user', '$cdate', '$user', '$cdate', '$st')";
							if(mysqli_query($con, $esql2)){
							// echo "Records added successfully.";
								} else{
							// echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
								}
							}
							
						

		}
		
		if ($re == "new") {
		$item = $_REQUEST['item'];
			$sql1 = "select * from estimates where item='$item' and compid='$comid'";
			$result211 = $con->query($sql1);
			if ($result211->num_rows > 0) {
			}
			else
			{
			$qt = $_REQUEST['qty'];
			$rat = $_REQUEST['rate'];
			$total = ($rat * $qt);
			$isql = "INSERT INTO estimates(compid, cid, item, qty, rate, total, crdate, user, status) VALUES ('$comid', '$cid', '$item', '$qt', '$rat', '$total', '$cdate', '$user', '$st')";
			if(mysqli_query($con, $isql)){
   // echo "Records added successfully.";
			} else{
  // echo "ERROR: Could not able to execute $ipsql. " . mysqli_error($con);
			}
						$esql1 = "select * from estdetails where compid='$comid' and estatus='$st'";
							$esqlresult = $con->query($esql1);
							if ($esqlresult->num_rows > 0) {
							$etrow = $esqlresult->fetch_assoc();
							$estno = $etrow["eno"];
							$comup = "update Complaints set estimateno='$estno' where compid='$comid'";
								if(mysqli_query($con, $comup)){
							// echo "Records added successfully.";
								} else{
							// echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
								}
							}
							else
							{
							$esql2 = "INSERT INTO estdetails(estdate, compid, cid, total, curr, crby, crdate, mby, mdate, estatus) VALUES ('$cdate', '$comid', '$cid', '$z', '$z', '$user', '$cdate', '$user', '$cdate', '$st')";
							//echo $esql2;
							if(mysqli_query($con, $esql2)){
							 //echo "Records added successfully.";
								} else{
							// echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
								}
							}
			}
		}
}


$cmid = "select * from Customers where cid='$cid'";
$cmidresult = $con->query($cmid);
$csrow = $cmidresult->fetch_assoc();

$cmid = $cmidrow["compid"];

?>
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
    <h4><strong>Create Estimate for ticket</strong></h4>
<?php
$sub = $_REQUEST['search'];
if ($sub) {
$csqo = "select * from Customers where cid='$cid'";
//echo $csqo;
$cmidresult = $con->query($csqo);
$csrow = $cmidresult->fetch_assoc();
$cname = $csrow["fname"]." ".$csrow["lname"];
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
//if ($prresult->num_rows > 0) {
?>

<caption><strong><u>Create Estimate</u></strong></caption>
                 <div class="table-responsive">
                    <table class="table table-striped">
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
<td align="right">
<?php
$rt = $prrow["rate"] ;
if ($rt == "0"){
?>
<a href="erate.php?srno=<?php echo $prrow["srno"]?>&rec=db&comid=<?php echo $comid ?>">Click to Add Rate</a>
<?php
}
else
{
echo $prrow["rate"];
?>
</td>
<?php
}
?>

<td align="right"><?php echo $prrow["total"] ?></td>

</tr>
<?php
}
?>
<tr>
<td>Any Other Charges</td>
<td align="center"></td>
<td align="right"><a href="erate.php?rec=new&it=Other Charges&comid=<?php echo $comid ?>">Click to Add Rate</td>
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
<td align="right"><a href="erate.php?rec=new&it=Service Charge&comid=<?php echo $comid ?>">Click to Add Rate</td>
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
<form method="get" action="pestimate.php">
<tr>
<td colspan="4" align="center">
<input type="hidden" name="comid" value="<?php echo $comid ?>"></input>
<input type="hidden" name="sestimate" value="Send Estimate to Customer">
<input type="hidden" name="search" value="Search">
<button type="submit" class="btn btn-primary mr-2">Send Estimate to Customer</button></input></td>
</tr>
</form>
</table>
</div>
<?php
//}
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

