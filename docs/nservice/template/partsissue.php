<?php
include 'head.inc';
include 'connection.php';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st1 = "Active";

$comid = $_REQUEST['comid'];
$csql ="select * from Complaints where compid='$comid'";
$cresult = $con->query($csql);
$crow = $cresult->fetch_assoc();
$cid = $crow["cid"];

$cmid = "select * from Customers where cid='$cid'";
$cmidresult = $con->query($cmid);
$csrow = $cmidresult->fetch_assoc();

$cmid = $cmidrow["compid"];

?>
<font color="red"><?php echo $msg ?></font>
  
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
 
				<h4 class="card-title"><strong>Issue parts to ticket</strong></h4>
	
	<form method="get" action="">
	
<?php
$sub = $_REQUEST['search'];
if ($sub) {

	$itcode= $_REQUEST['itcode'];
	if ($itcode) {
	$z = "0";
	$it = $_REQUEST['item'];
	$isql = "select * from Stock where itemcode='$itcode' and balqty>'$z' and item='$it' and status='$st1'";

	$result4 = $con->query($isql);
	if ($result4->num_rows > 0) {
	$irow = $result4->fetch_assoc();
	
	$stqty = $irow["balqty"];
	$rqty = $_REQUEST['qty'];
	$srno = $_REQUEST['srno'];
	$srate = $irow["sellingrate"];
	$issued = "Issued";
	
		if ($stqty >= $rqty) {
		$bqty = ($stqty - $rqty);
		//echo $bqty;
		$issuedqty = $rqty;
		
		$upstck = "update Stock set balqty='$bqty' where itemcode='$itcode'";
			if(mysqli_query($con, $upstck )){
			// echo "Records added successfully.";
			} else{
		// echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
			}
			
		$upparts = "update parts set issuedqty='$rqty', sellingrate='$srate', issuedby='$user', issueddate='$cdate', pstatus='$issued', itemcode='$itcode' where srno='$srno'";
		//echo $upparts;
			if(mysqli_query($con, $upparts )){
			// echo "Records added successfully.";
			} else{
		// echo "ERROR: Could not able to execute $upparts. " . mysqli_error($con);
			}
			
			
		}
		
		else
		{
		$issuedqty = $stqty;
		$bqty = "0";
		$brqty = ($rqty - $stqty);
		
			$upstck = "update Stock set balqty='$bqty' where itemcode='$itcode'";
			if(mysqli_query($con, $upstck )){
			// echo "Records added successfully.";
			} else{
		// echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
			}
			
			$upparts = "update parts set issuedqty='$issuedqty', sellingrate='$srate', issuedby='$user', issueddate='$cdate', pstatus='$issued', itemcode='$itcode' where srno='$srno'";
			if(mysqli_query($con, $upparts )){
			// echo "Records added successfully.";
			} else{
		// echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
			}
			//echo "please sari akku";
			
			$psql = "select * from parts where srno='$srno' and status='$st1'";
			$resultp = $con->query($psql);
			$prow = $resultp->fetch_assoc();
			$comid = $prow["compid"];
			$cid = $prow["cid"];
			$prt = $prow["parts"];
			$cdt = $prow["crdate"];
			
			$pst = "In Process";
			$insrt = "INSERT INTO parts(compid, cid, parts, qty, user, crdate, status, pstatus) VALUES ('$comid', '$cid', '$prt', '$brqty' ,'$user' ,'$cdt' ,'$st1' ,'$pst')";
			//echo $insrt;
			if(mysqli_query($con, $insrt )){
			echo "Records added successfully.";
			} else{
			 echo "ERROR: Could not able to execute $insrt. " . mysqli_error($con);
			}
		
		}
		}
		else
		{
		$msg =  "Wrong itemcode entered !, please checked and enter corrent itemcode relevant to the item";
		}
		
	
}
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
$prsql = "select * from parts where compid='$comid'";
$prresult = $con->query($prsql);
if ($prresult->num_rows > 0) {
?>
                 <div class="table-responsive">
<p><font color="red" size="3"><?php echo $msg ?></font></p>
<caption><strong><u>Parts Request details</u></strong></caption>


<table class="table table-hover">
<tr>
<td align="left"><strong>Item</strong></td>
<td align="center"><strong>Qty</strong></td>
<td align="center" >Issued Qty</td>
<td align="right">Selling Rate</td>
</tr>
<?php
$tot = "0.00";
while($prrow = $prresult->fetch_assoc()) {
$tot = ($tot + $prrow["total"]);
?>
<tr>
<td><a href="pissue.php?srno=<?php echo $prrow["srno"] ?>"><?php echo $prrow["parts"] ?></a></td>
<td align="center"><?php echo $prrow["qty"] ?></td>
<td align="center"><?php echo $prrow["issuedqty"] ?></td>
<td align="right"><?php echo $prrow["sellingrate"] ?></td>
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
<br /><br />
<font color="red">No any parts request received for this complaint</font>
<?
//echo "No any parts request received for this complaint.";
}
?>
<br /><br />

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

