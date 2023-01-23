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
$tec = $crow["asained"];

$cmid = "select * from Customers where cid='$cid'";
$cmidresult = $con->query($cmid);
$csrow = $cmidresult->fetch_assoc();
$cname = $csrow["fname"]. " " .$csrow["lname"];
$mobile = $csrow["mobile"];
$email = $csrow["email"];

$cmid = $cmidrow["compid"];
$z = "0";
$pst1 = "Issued";

//------invoice insert started
$cer = $_REQUEST["cr"];
if ($cer == "CreateInvoice"){
$idsql = "select * from invdetails order by invno desc limit 1";
$idresult = $con->query($idsql);
$idrow = $idresult->fetch_assoc();

$invno = ($idrow["invno"] + 1);
$insql = "INSERT INTO invdetails(invno, invdate, compid, cid, cname, mobile, email, invamount, paystatus, crby, crdate, status, asained) VALUES ('$invno', '$cdate', '$comid', '$cid', '$cname', '$mobile', '$email', '$z', '$z', '$user', '$cdate', '$st', '$tec')";
if(mysqli_query($con, $insql)){
    //echo "Records added successfully.";
			} else{
   //echo "ERROR: Could not able to execute $insql. " . mysqli_error($con);
			}

$psql1 = "select * from parts where compid='$comid' and pstatus='$pst1'";
$presult1 = $con->query($psql1);
if ($presult1->num_rows > 0) {
while($prrow1 = $presult1->fetch_assoc()) {
$part = $prrow1["parts"];
$qt = $prrow1["issuedqty"];
$srate = $prrow1["sellingrate"];
$tot = ($qt * $srate);
$itcod = $prrow1["itemcode"];

		$sq1 = "select * from Stock where itemcode='$itcod'";
		$re1 = $con->query($sq1);
		if ($re1->num_rows > 0) {
		$rw1 = $re1->fetch_assoc();
		$gst = $rw1["gst"];
		
			$sq2 = "select * from taxes where gst='$gst'";
			$re2 = $con->query($sq2);
			$rw2 = $re2->fetch_assoc();
			$cgst = $rw2["cgst"];
			$sgst = $rw2["sgst"];
			//echo $cgst;
		}
		else
		{
		$gst = "0";
		$cgst = "0";
		$sgst = "0";
		}
		
		$percentage = 50;
$totalWidth = 350;

$new_width = ($percentage / 100) * $totalWidth;

$cgst = ($cgst / 100) * $tot;
$sgst = ($sgst / 100) * $tot;
$gst = ($cgst + $sgst);
//echo $cgst;


$ipsql = "INSERT INTO invoice(invno, invdate, parts, qty, rate, total, compid, cid, status, crby, crdate, mdby, mddate, cgst, sgst, gst, itemcode) VALUES ('$invno', '$cdate', '$part', '$qt', '$srate', '$tot', '$comid', '$cid', '$st', '$user', '$cdate', '$z', '$cdate', '$cgst', '$sgst', '$gst', '$itcod')";
//echo $ipsql;
if(mysqli_query($con, $ipsql)){
  //  echo "Records added successfully.";
			} else{
  // echo "ERROR: Could not able to execute $ipsql. " . mysqli_error($con);
			}
}
}
}
//invoice insert ended

//Other charges insert started
$ne = $_REQUEST["search"];
if ($ne) {

$se1 = $_REQUEST['item'];
$sql61 = "select * from invoice where parts='$se1' and compid='$comid'";
$result6 = $con->query($sql61);
if ($result6->num_rows > 0) {
}
else
{

$sql8 = "select * from invdetails where compid='$comid' order by invno desc limit 1";
$result8 = $con->query($sql8);
$row8 = $result8->fetch_assoc();
$invno = $row8["invno"];
$invdt = $row8["invdate"];
$part = $_REQUEST['item'];
$qt = $_REQUEST['qty'];
$srate = $_REQUEST['rate'];
$tot = ($qt * $srate);

		$gst = $_REQUEST["tax"];
			$sq3 = "select * from taxes where gst='$gst'";
			$re3 = $con->query($sq3);
			$rw3 = $re3->fetch_assoc();
			$cgst = $rw3["cgst"];
			$sgst = $rw3["sgst"];

			$cgst = ($cgst / 100) * $tot;
			$sgst = ($sgst / 100) * $tot;
			$gst = ($cgst + $sgst);

$sql7 = "INSERT INTO invoice(invno, invdate, parts, qty, rate, total, compid, cid, status, crby, crdate, mdby, mddate, cgst, sgst, gst, itemcode) VALUES ('$invno', '$cdate', '$part', '$qt', '$srate', '$tot', '$comid', '$cid', '$st', '$user', '$cdate', '$z', '$cdate', '$cgst', '$sgst', '$gst', '$itcod')";
if(mysqli_query($con, $sql7)){
  //  echo "Records added successfully.";
			} else{
  // echo "ERROR: Could not able to execute $ipsql. " . mysqli_error($con);
			}
}
}

//Other charges insert ended


?>
    
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
<h4 class="card-title"><strong>Create Invoices</strong></h4>
<form method="get" action="pinvoice.php">
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
$pst = "Issued";
$total = "0";
$prsql = "select * from invoice where compid='$comid' and status='$st'";
$prresult = $con->query($prsql);
//if ($prresult->num_rows > 0) {
?>

<br /><hr>
<caption><strong><u>Parts Issued</u></strong></caption>
                  <div class="table-responsive">
                    <table class="table table-striped">
<tr>
<td></td>
<td><strong>Date</strong></td>
<td><strong>Item</strong></td>
<td align="center"><strong>Issued Qty</strong></td>
<td><strong>Item Status</strong></td>
<td align="right"><strong>Selling Rate</strong></td>
<td align="right">Total</td>
</tr>
<?php
$tot = "0";
$total = "0";
while($prrow = $prresult->fetch_assoc()) {
$tot = ($prrow["qty"] * $prrow["rate"]);
$total = ($total + $tot);
?>
<tr>
<td><a href="irate.php?srno=<?php echo $prrow["srno"]?>&rec=db&comid=<?php echo $comid ?>"><img src="images/edit21.png"></a></td>
<td><?php echo $prrow["crdate"] ?></td>
<td><?php echo $prrow["parts"] ?></td>
<td align="center"><?php echo $prrow["qty"] ?></td>
<td><?php echo $prrow["status"] ?></td>
<td align="right"><?php echo $prrow["rate"] ?></td>
<td align="right"><?php echo $tot ?></td>
</tr>

<?php
$tot = "0";
}
?>
<tr>
<td></td>
<td align="center"></td>
<td>Total</td>
<td align="center"></td>
<td align="center"></td>
<td align="right"></td>
<td align="right"><?php echo $total ?></td>
</tr>
<?php
$se = $_REQUEST['item'];
$sql6 = "select * from invoice where parts='$se' and compid='$comid'";
$result6 = $con->query($sql6);
if ($result6->num_rows > 0) {
$msg =  "item already added";
?>
<font color="red">&nbsp;&nbsp;<?php echo $msg ?></font>
<?
}
else
{
?>
<tr>
<td></td>
<td align="center"></td>
<td>Service Charges</td>
<td align="center"></td>
<td align="center"></td>
<td align="right"><a href="irate.php?rec=new&it=Service Charges&comid=<?php echo $comid ?>">Click to Add Rate</td>
<td align="center"></td>
</tr>
<?php
}
?>
<tr>
<td></td>
<td align="center"></td>
<td>Any Other Charges</td>
<td align="center"></td>
<td align="center"></td>
<td align="right"><a href="irate.php?rec=new&it=Other Charge&comid=<?php echo $comid ?>">Click to Add Rate</td>
<td align="center"></td>
</tr>
<tr>
<td colspan="7" align="center"><input type="hidden" name="comid" value="<?php echo $comid ?>"></input><input type="hidden" name="minvoice" value="Make Invoice"></input><button type="submit" class="btn btn-primary mr-2">Make Invoice</button></td>
</tr>
</table>
</div>
<hr>
<?php
//}
?>

  </div>
  </div>
   </div>
 <?php
   include 'footer.inc';
   ?>
  </div>
</div>
