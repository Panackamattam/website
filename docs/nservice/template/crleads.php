<?php
include 'head.inc';
include 'connection.php';
include 'customer.inc';

$lid =  $_REQUEST['id'];
$add = $_REQUEST['add'];
If ($add) {

$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$gen = $_REQUEST['gen'];
$bname = $_REQUEST['bname'];
$add1 = $_REQUEST['add1'];
$add2 = $_REQUEST['add2'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$pin = $_REQUEST['pin'];
$cntry = $_REQUEST['cntry'];
$phone = $_REQUEST['phone'];
$mobile = $_REQUEST['mobile'];
$email = $_REQUEST['email'];
$re = $_REQUEST['reff'];
$ldetails = $_REQUEST['ldetails'];
$sman =  $_REQUEST['sman'];
$lbr = $_REQUEST['lbr'];
$lst = $_REQUEST['lst'];

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$sql = "INSERT INTO leads(fname, lname, gen, bname, add1, add2, city, state, pin, phone, mobile, email, leadsource, leaddetails, lstatus, lbranch, lsalesman, crby, crdate, status,tid) VALUES ('$fname','$lname','$gen','$bname','$add1','$add2','$city','$state','$pin','$phone','$mobile','$email','$re','$ldetails','$lst','$lbr','$sman','$user','$cdate','$st','$lid')";
//echo $sql;

//$con->exec($sql);
if(mysqli_query($con, $sql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
$cdate1 = date('Y-m-d');
$qry = "select * from leads where fname='$fname' and lname='$lname' and mobile='$mobile' and leaddetails='$ldetails' and crdate='$cdate1' order by lid desc limit 1";
//echo $qry;

$qryresult = $con->query($qry);
$nro = $qryresult->num_rows;
//echo $nro;
$qryrow = $qryresult->fetch_assoc();
$leadid = $qryrow["lid"];

$sqll = "INSERT INTO leadremark(leadid, leadremark, leadstatus, crdate, crby) VALUES ('$leadid','$ldetails','$lst','$cdate','$user')";
//echo $sqll;
//$con->exec($sql);
if(mysqli_query($con, $sqll)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}



$msg = "Leads added sucessfully !";

$tstat = "Converted";
$sql1 = "UPDATE telecalling set tstatus='$tstat' where id='$lid'";

//$con->exec($sql);
if(mysqli_query($con, $sql1)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

}





//$msg = "Remarks updated added sucessfully !";


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
<p><button type="button" class="btn btn-inverse-primary btn-fw"><a href="crleads.php">Create Leads</a></button>&nbsp;&nbsp;&nbsp;
<button type="button" class="btn btn-inverse-primary btn-fw">Update Leads</button>&nbsp;&nbsp;&nbsp;
<button type="button" class="btn btn-inverse-primary btn-fw">List Leads</button></p>
<BR />
				
                  <h4 class="card-title">LEADS</h4>
				  <p><?php echo $msg; ?></p>

                    <p class="card-description">
					<table width="100%">
					<tr>
					<td>Customer Information</td>
					<td align="right">&nbsp;</td>
					</tr>
					</table>
                    </p>
					<form method="get" action="">
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
					<input type="text" name="gen" class="form-control form-control-sm"  value="<?php echo $row["gender"] ?>" readonly />
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
                            <input type="text" name="reff" class="form-control form-control-sm"  value="Tele-Calling" readonly />
							</select>
                          </div>
                        </div>
                      </div>
                    </div>
					
<h4><strong>Lead Detail</strong></h4>
<form method="get" action="">
				  <div class="row">
					  <input type="hidden" name="id" value="<?php echo $id ?>"></input>
					      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Lead in Detail</label>
                          <div class="col-sm-9">
                            <textarea name="ldetails" rows="4" cols="27" class="form-control" id="exampleTextarea1" rows="4"></textarea>
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
                          <label class="col-sm-3 col-form-label">Lead to</label>
                          <div class="col-sm-9">
                        <select name="lbr" class="form-control form-control-sm" name="country">
<?php
$lsqry1 = "select * from Stores order by storename";
$lres1 = $con->query($lsqry1);
while($lrow1 = $lres1->fetch_assoc()) {
?>
<option value="<?php echo $lrow1["storename"]?>" <?php if ($lrow1["country"] == "India") {echo "selected";}?>> <?php echo $lrow1["storename"]?></option>

<?php
}
?>
						</SELECT>
						</div>
                        </div>
                      </div>	
						<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Salesman</label>
                          <div class="col-sm-9">
                        <select name="sman" class="form-control form-control-sm">
<?php
$sman1 = "Salesman";
$lsqry2 = "select * from users where role='$sman1' order by Name";
$lres2 = $con->query($lsqry2);
while($lrow2 = $lres2->fetch_assoc()) {
?>
<option value="<?php echo $lrow2["Name"]?>" <?php if ($lrow1["country"] == "India") {echo "selected";}?>> <?php echo $lrow2["Name"]?></option>

<?php
}
?>
						</SELECT>
						</div>
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
		  
	</div>

            </div>
			</div>
 <?php
   include 'footer.inc';
   ?>
 