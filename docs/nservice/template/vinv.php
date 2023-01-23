<?php
include 'head.inc';
include 'connection.php';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
$inv = $_REQUEST['invno'];

$isq ="select * from invdetails where invno='$inv'";
$isqresult = $con->query($isq);
$isqrow = $isqresult->fetch_assoc();
$comid = $isqrow["compid"];
$cid = $isqrow["cid"];


$csql ="select * from Complaints where compid='$comid'";
$cresult = $con->query($csql);
$crow = $cresult->fetch_assoc();

$cmid = "select * from Customers where cid='$cid'";
$cmidresult = $con->query($cmid);
$csrow = $cmidresult->fetch_assoc();

$z = "0";
?>
    
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
				
	<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Invoice# </label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $inv ?>  Date: <?php echo $isqrow["invdate"]; ?>" class="form-control form-control-sm" disabled />
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
$prsql = "select * from invoice where invno='$inv'";
$prresult = $con->query($prsql);
if ($prresult->num_rows > 0) {
?>
<div class="table-responsive">
<table class="table table-striped">
	<tr>
<td width="8%"><strong>Sr. No</td>
<td width="37%"><strong>Description</td>
<td align="center" width="10%"><strong>Quantity</td>
<td align="right" width="15%"><strong>Price <br />(INR)</td>
<td align="right" width="15%"><strong>Total Amount<br />(INR)</td>
</tr>
<?php
$subtot = "0";
$cgst = "0";
$sgst = "0";
$gst = "0";
$srno = "0";
while($prrow = $prresult->fetch_assoc()) {
$subtot = ($subtot + $prrow["total"]);
$cgst = ($cgst + $prrow["cgst"]);
$sgst = ($sgst + $prrow["sgst"]);
$gst = ($cgst + $sgst);
$srno = ($srno + 1) ;
?>
	<tr>
<td><?php echo $srno ?></td>
<td width="30%"><?php echo $prrow["parts"] ?></td>
<td align="center"><?php echo $prrow["qty"] ?></td>
<td align="right"><?php echo $prrow["rate"] ?></td>
<td align="right"><?php echo $prrow["total"] ?></td>
</tr>
<?php
}
$cess = 1;
$cess = ($cess / 100) * $subtot;
$gts = ($subtot + $cgst + $sgst + $cess);
?>
<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%"><strong>Sub Total</td>
<td align="right" width="15%"><strong><?php echo $subtot ?></strong></td>
</tr>
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%">CGST</td>
<td align="right" width="15%"><strong><?php echo $cgst ?></strong></td>
</tr>
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%">SGST</td>
<td align="right" width="15%"><strong><?php echo $sgst ?></strong></td>
</tr>
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%">CESS</td>
<td align="right" width="15%"><strong><?php echo $cess ?></strong></td>
</tr>
	<tr>
<td width="8%"></td>
<td width="37%"></td>
<td align="center" width="10%"></td>
<td align="right" width="15%"><strong>GRAND TOTAL</td>
<td align="right" width="15%"><strong><?php echo $gts ?></strong></td>
</tr>
</table>
</div>
<?php
}
?>

  </div>
  </div>
  </div>  </div>
</div>
 <?php
   include 'footer.inc';
   ?>


