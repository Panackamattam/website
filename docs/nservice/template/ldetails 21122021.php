<?php
include 'head.inc';
include 'connection.php';
include 'customer.inc';

$cid =  $_REQUEST['id'];
$add = $_REQUEST['add'];



$bsub = $_REQUEST['sub3'];
if ($bsub){
$billno = $_REQUEST['bno'];
$billdt = $_REQUEST['bdt'];
$billam = $_REQUEST['bam'];

$ins = "INSERT INTO leadbills(leadid, billno, billdate, billamt) VALUES ('$cid','$billno','$billdt','$billam')";
if(mysqli_query($con, $ins)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
}



If ($add) {

$cid = $_REQUEST['id'];
$crem = $_REQUEST['callremark'];
$tst = $_REQUEST['lst'];
$sdate = $_REQUEST['sdate'];

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$sql = "INSERT INTO leadremark(leadid, leadremark, leadstatus, crdate, crby) VALUES ('$cid','$crem','$tst','$cdate','$user')";

//$con->exec($sql);
if(mysqli_query($con, $sql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

$sql2 = "update leads set lstatus='$tst' where lid='$cid'";
if(mysqli_query($con, $sql2)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

$sql1 = "UPDATE telecalling set sdate='$sdate' where id='$cid'";

//$con->exec($sql);
if(mysqli_query($con, $sql1)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}



$msg = "Remarks updated added sucessfully !";

}

$id = $_REQUEST['id'];
$sql = "select * from leads where lid='$id' limit 2";
//echo $sqr;
$result = $con->query($sql);
$row = $result->fetch_assoc();

//$id = $_REQUEST['id'];
$sql1 = "select * from leads where lid<'$id' order by lid desc limit 1";
//echo $sqr;
$result1 = $con->query($sql1);
while($row1 = $result1->fetch_assoc()){
$nid = $row1["lid"];
}
$nid = $nid;
?>
     <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
<p><button type="button" class="btn btn-inverse-primary btn-fw"><a href="createlead.php">Add Telecalling</a></button>&nbsp;&nbsp;&nbsp;
<button type="button" class="btn btn-inverse-primary btn-fw">Update Telecalling</button>&nbsp;&nbsp;&nbsp;
<button type="button" class="btn btn-inverse-primary btn-fw"><a href="crleads.php?id=<?php echo $id ?>">Convert to Leads</a></button></p>
<BR />
				
                  <h4 class="card-title">TELE CALLING</h4>
				  <p><?php echo $msg; ?></p>
                   <p class="card-description">
					<table width="100%">
					<tr>
					<td>Customer Information</td>
					<td align="right"><a href="ldetails.php?id=<?php echo $nid; ?>"><button type="button" class="btn btn-primary btn-sm">Next</button></a></td>
					</tr>
					</table>
                    </p>

<?php
$cmp = $_REQUEST['lst'];
if ($cmp == "Completed") {
?>
<form method="post" action="">
<p class="card-description">
<table class="table">
<tr>
<td>Bill #<input type="text" name="bno" class="form-control form-control-sm" /></td>
<td>Date<input type="date" name="bdt" class="form-control form-control-sm" /></td>
<td>Amount<input type="text" name="bam" class="form-control form-control-sm" /></td>
<td><button type="submit" name="sub3" value="search" class="btn btn-primary mr-2">Submit</button></td>
</tr>
</table>
	</form>			
<?php
}
?>	

</p>
<hr>					
					
					
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="fname" class="form-control form-control-sm" value="<?php echo $row["fname"] ?>" readonly />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Last Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" class="form-control form-control-sm"  value="<?php echo $row["lname"] ?>" readonly />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-9">
					<input type="text" name="gen" class="form-control form-control-sm"  value="<?php echo $row["gen"] ?>" readonly />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Firm Name</label>
                          <div class="col-sm-9">
                            <input class="form-control form-control-sm" name="bname" required  value="<?php echo $row["bname"] ?>" readonly />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 1</label>
                          <div class="col-sm-9">
                            <input type="text" name="add1" class="form-control form-control-sm"  value="<?php echo $row["add1"] ?>" readonly />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" name="state" class="form-control form-control-sm"  value="<?php echo $row["state"] ?>" readonly />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 2</label>
                          <div class="col-sm-9">
                            <input type="text" name="add2" class="form-control form-control-sm"  value="<?php echo $row["add2"] ?>" readonly />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Postcode</label>
                          <div class="col-sm-9">
                            <input type="text" name="pin" class="form-control form-control-sm" value="<?php echo $row["pin"] ?>" readonly  />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" name="city" class="form-control form-control-sm"  value="<?php echo $row["city"] ?>" readonly />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country</label>
                          <div class="col-sm-9">
                            <select name="cntry" class="form-control form-control-sm" name="country">
<?php
$cntr = "select * from country order by country";
$cntr1 = $con->query($cntr);
while($cntr2 = $cntr1->fetch_assoc()) {
?>
<option value="<?php echo $cntr2["country"]?>" <?php if ($cntr2["country"] == "India") {echo "selected";}?>> <?php echo $cntr2["country"]?></option>

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
                          <label class="col-sm-3 col-form-label">Phone</label>
                          <div class="col-sm-9">
                            <input type="text" name="phone" class="form-control form-control-sm"  value="<?php echo $row["phone"] ?>" readonly />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile</label>
                          <div class="col-sm-9">
                            <input type="text" name="mobile" class="form-control form-control-sm"  value="<?php echo $row["mobile"] ?>" readonly />
                          </div>
                        </div>
                      </div>
                    </div>
					  					  
		
					  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" name="email" class="form-control form-control-sm"  value="<?php echo $row["email"] ?>" readonly />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Reffered By</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" class="form-control form-control-sm"  value="<?php echo $row["leadsource"] ?>" readonly />
							</select>
                          </div>
                        </div>
                      </div>
                    </div>
					
<h4><strong>Lead Follow-up Remark</strong></h4>
<form method="get" action="">
				  <div class="row">
					  <input type="hidden" name="id" value="<?php echo $id ?>"></input>
					      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Lead Call Remark</label>
                          <div class="col-sm-9">
                            <textarea name="callremark" rows="4" cols="27" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Lead Status</label>
                          <div class="col-sm-9">
                        <select name="lst" class="form-control form-control-sm" name="country">
<?php
$lsqry = "select * from leadstatus order by lstatus";
$lres = $con->query($lsqry);
while($lrow = $lres->fetch_assoc()) {
?>
<option value="<?php echo $lrow["lstatus"]?>" <?php if ($lrow["country"] == "India") {echo "selected";}?>> <?php echo $lrow["lstatus"]?></option>

<?php
}
?>
						</SELECT>
						</div>
                        </div>
                      </div>				  
					   </div>
					   <div class="row">
						<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Next Call Date</label>
                          <div class="col-sm-9">
						<input type="date" name="sdate" class="form-control form-control-sm"  value="" />
						</div>
                        </div>
                      </div>		
					  <input type="hidden" name="add" value="add"></input>		  
						<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-9">
						<button type="submit" class="btn btn-primary mr-2">Submit</button>
						</div>
                        </div>
                      </div>	
						</div>
 		  </form>
		  
		  
		  <?php
$rsql = "select * from leadremark where leadid='$cid' order by id desc";
$res = $con->query($rsql);
if ($res->num_rows > 0){
					?>
<div class="row">		  
<div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Call Remarks</th>
                        </tr>
                      </thead>
					                        <tbody>
					  <?php
while($row = $res->fetch_assoc()) {
?>

                        <tr>
                          <td>Call Remark: <?php echo $row["leadremark"]?> <br />Date: <?php echo $row["crdate"]?></td>
                        </tr>
						<?php
}
?>
</table>
<?php
}
?>
</div>
</div>
</div>

            </div>
			</div>
 <?php
   include 'footer.inc';
   ?>
 