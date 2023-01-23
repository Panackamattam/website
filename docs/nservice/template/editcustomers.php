<?php
include 'head.inc';
include 'connection.php';
?>
  <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
				<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
 <h4 class="card-title">EDIT CUSTOMERS</h4>
<form method="post" action="">
<table class="table" width="100%" border="0" align="left">
<tr>
<td><input type="text" name="search" class="form-control form-control-sm" /></td><td> <select name="sfld" class="form-control form-control-sm">
<option value="cid">Customer ID</option>
<option value="mobile">Mobile</option>
<option value="fname">First Name</option>
<option value="bname">Firm Name</option>
<option value="email">Email</option>

</td>
<td><button type="submit" name="sub" value="search" class="btn btn-primary mr-2">Search</button></td>
</tr>
</table>
</form>
<hr>	
<br /><br />
<?php
$up = $_REQUEST['sub'];
if ($up) {
$cd = $_REQUEST['search'];
$spara = $_REQUEST['sfld'];


$sql1 = "select * from Customers where $spara='$cd'";
$result1 = $con->query($sql1);
$row1 = $result1->fetch_assoc();
?>
<form method="post" action="ucustomer.php">
 <p class="card-description">
                      Personal info
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="fname" class="form-control form-control-sm" value="<?php echo $row1["fname"] ?>" disabled />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Last Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" class="form-control form-control-sm" value="<?php echo $row1["lname"] ?>" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-9">
                            <select class="form-control form-control-sm">
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
                            <input class="form-control form-control-sm" name="bname" value="<?php echo $row1["bname"] ?>" required />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 1</label>
                          <div class="col-sm-9">
                            <input type="text" name="add1" class="form-control form-control-sm" value="<?php echo $row1["add1"] ?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" name="state" class="form-control form-control-sm" value="<?php echo $row1["state"] ?>"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 2</label>
                          <div class="col-sm-9">
                            <input type="text" name="add2" class="form-control form-control-sm" value="<?php echo $row1["add2"] ?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Postcode</label>
                          <div class="col-sm-9">
                            <input type="text" name="pin" class="form-control form-control-sm" value="<?php echo $row1["pincode"] ?>"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" name="city" class="form-control form-control-sm" value="<?php echo $row1["city"] ?>"/>
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
<option value="<?php echo $cntr2["country"]?>" <?php if ($cntr2["country"] == $row1["country"]) {echo "selected";}?>> <?php echo $cntr2["country"]?></option>

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
                            <input type="text" name="phone" class="form-control form-control-sm" value="<?php echo $row1["phone"] ?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile</label>
                          <div class="col-sm-9">
                            <input type="text" name="mobile" class="form-control form-control-sm" value="<?php echo $row1["mobile"] ?>"/>
                          </div>
                        </div>
                      </div>
                    </div>
					  					  
		
					  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" name="email" class="form-control form-control-sm" value="<?php echo $row1["email"] ?>"/>
                          </div>
                        </div>
                      </div>
					  
					  <input type="hidden" name="coid" value="<?php echo $cd ?>"></input>
					  <input type="hidden" name="fname" size="25" value="<?php echo $row1["fname"] ?>">
					  <input type="hidden" name="lname" size="25" value="<?php echo $row1["lname"] ?>">
					  
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Reffered By</label>
                          <div class="col-sm-9">
                            <select name="reff" class="form-control form-control-sm" name="country">
<?php
$ref = "select * from reff order by Refer";
$ref1 = $con->query($ref);
while($ref2 = $ref1->fetch_assoc()) {
?>
<option value="<?php echo $ref2["Refer"]?>" <?php if ($ref2["Refer"] == $row1["reff"]) {echo "selected"; } ?>> <?php echo $ref2["Refer"]?></option>
<?php
}
?>
							</select>
                          </div>
                        </div>
                      </div>
					  
                    </div>
<p align="center"><button type="submit" class="btn btn-primary mr-2">Update</button></p>
<?php
}
?>
</form>
                 </div>
              </div>
            </div>
 </div>
            </div>
 <?php
   include 'footer.inc';
   ?>

