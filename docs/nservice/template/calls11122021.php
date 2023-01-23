<?php
include 'head.inc';
include 'connection.php';
include 'customer.inc';

$cid =  $_REQUEST['id'];
$add = $_REQUEST['add'];
If ($add) {

$cid = $_REQUEST['id'];
$crem = $_REQUEST['callremark'];
$tst = $_REQUEST['tst'];
$sdate = $_REQUEST['sdate'];


$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$sql = "INSERT INTO callremark(callid, remark, cat, crby, crdate) VALUES ('$cid','$crem','$crem','$user','$cdate')";

//$con->exec($sql);
if(mysqli_query($con, $sql)){
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
$sql = "select * from telecalling where id='$id' limit 2";
//echo $sqr;
$result = $con->query($sql);
$row = $result->fetch_assoc();

//$id = $_REQUEST['id'];
$sql1 = "select * from telecalling where id<'$id' order by id desc limit 1";
//echo $sqr;
$result1 = $con->query($sql1);
while($row1 = $result1->fetch_assoc()){
$nid = $row1["id"];
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
<button type="button" class="btn btn-inverse-primary btn-fw">Convert to Leads</button></p>
<BR />
				
                  <h4 class="card-title">TELE CALLING</h4>
				  <p><?php echo $msg; ?></p>

                    <p class="card-description">
					<table width="100%">
					<tr>
					<td>Customer Information</td>
					<td align="right"><a href="calls.php?id=<?php echo $nid; ?>"><button type="button" class="btn btn-primary btn-sm">Next</button></a></td>
					</tr>
					</table>
                    </p>
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
					<input type="text" name="lname" class="form-control form-control-sm"  value="<?php echo $row["gender"] ?>" readonly />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Firm Name</label>
                          <div class="col-sm-9">
                            <input class="form-control form-control-sm" name="bname" required  value="<?php echo $row["firmname"] ?>" readonly />
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
                            <input type="text" name="pin" class="form-control form-control-sm" value="<?php echo $row["postcode"] ?>" readonly  />
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
                            <input type="text" name="lname" class="form-control form-control-sm"  value="<?php echo $row["reff"] ?>" readonly />
							</select>
                          </div>
                        </div>
                      </div>
                    </div>
					
<h4><strong>Call Remark</strong></h4>
<form method="get" action="">
				  <div class="row">
					  <input type="hidden" name="id" value="<?php echo $id ?>"></input>
					      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Call Remark</label>
                          <div class="col-sm-9">
                            <textarea name="callremark" rows="4" cols="27" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Tele-Calling Status</label>
                          <div class="col-sm-9">
                        <select name="tst" class="form-control form-control-sm" name="country">
						<option value="Closed">Closed</option>
						<option value="Re-call" selected>Re-Call</option>
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
$rsql = "select * from callremark where callid='$cid' order by id desc";
$res = $con->query($rsql);
if ($res->num_rows > 0){
					?>
<div class="row">		  
<div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Last Call Remarks</th>
                        </tr>
                      </thead>
					                        <tbody>
					  <?php
while($row = $res->fetch_assoc()) {
?>

                        <tr>
                          <td>Call Remark: <?php echo $row["remark"]?> <br />Date: <?php echo $row["crdate"]?></td>
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
 