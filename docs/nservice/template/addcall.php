<?php
include 'head.inc';
include 'connection.php';
include 'customer.inc';

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
$re = $_REQUEST['ref'];
$as = $_REQUEST['staff'];

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$sql = "INSERT INTO telecalling(fname, lname, gender, firmname, add1, add2, city, state, postcode, phone, mobile, email, reff, tstatus, asigned, sdate, crdate, crby) VALUES ('$fname','$lname','$gen','$bname','$add1','$add2','$city','$state','$pin','$phone','$mobile','$email','$re','$st','$as','$cdate','$cdate','$user')";

//$con->exec($sql);
if(mysqli_query($con, $sql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

$msg = "Telecalling added sucessfully !";


}


?>
     <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
			
                  <h4 class="card-title">Asaign tele-calling</h4>
				  <p><?php echo $msg; ?></p>
                  <form class="form-sample" method="get" action="">
                    <p class="card-description">
                      Personal info
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="fname" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Last Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-9">
                            <select class="form-control form-control-sm" name="gen">
                              <option>Male</option>
                              <option>Female</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Firm Name</label>
                          <div class="col-sm-9">
                            <input class="form-control form-control-sm" name="bname" required />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 1</label>
                          <div class="col-sm-9">
                            <input type="text" name="add1" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" name="state" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 2</label>
                          <div class="col-sm-9">
                            <input type="text" name="add2" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Postcode</label>
                          <div class="col-sm-9">
                            <input type="text" name="pin" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" name="city" class="form-control form-control-sm" />
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
                            <input type="text" name="phone" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile</label>
                          <div class="col-sm-9">
                            <input type="text" name="mobile" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
					  					  
		
					  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" name="email" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Reffered By</label>
                          <div class="col-sm-9">
                            <select name="ref" class="form-control form-control-sm" name="country">
<?php
$resql = "select * from reff order by Refer";
$ref1 = $con->query($resql);
while($ref2 = $ref1->fetch_assoc()) {
?>
<option value="<?php echo $ref2["Refer"]?>"> <?php echo $ref2["Refer"]?></option>
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
                          <label class="col-sm-3 col-form-label">Lead Details</label>
                          <div class="col-sm-9">
                            <input type="text" name="leaddetail" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Asaigned to</label>
                          <div class="col-sm-9">
                            <select name="staff" class="form-control form-control-sm" name="country">
<?php
$ts = "Tele-Caller";
$ref3 = "select * from users where role='$ts' order by Name";
$ref31 = $con->query($ref3);
while($ref311 = $ref31->fetch_assoc()) {
?>
<option value="<?php echo $ref311["uname"]?>"> <?php echo $ref311["Name"]?></option>
<?php
}
?>
							</select>
                          </div>
                        </div>
                      </div>
                    </div>
					  
					  <input type="hidden" name="add" value="Submit"></input>
						  <p align="center"><button type="submit" class="btn btn-primary mr-2">Submit</button></p>
                  </form>
                </div>
              </div>
            </div>
 </div>
            </div>
 <?php
   include 'footer.inc';
   ?>
 