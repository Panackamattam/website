<?php
include 'head.inc';
include 'connection.php';

//$con =mysqli_connect("localhost","attinqst","9zYs%#*Es6vG4!3~","attinqst_service");
if($con){
//echo "Connected Sucessfully";
}
else{
//echo "Not Connected";
}
//mysqli_close($con);

$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$bname = $_REQUEST['bname'];
$add1 = $_REQUEST['add1'];
$add2 = $_REQUEST['add2'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$pin = $_REQUEST['pin'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$re = $_REQUEST['reff'];
 
// Attempt insert query execution
//$sql = "INSERT INTO Customers (firstname, lastname, cname, address, address1, city, state, pin, phone, email, reff) VALUES ('$fname', '$lname', '$bname', '$add1', '$add2', '$city', '$state', '$pin', '$phone', '$email', '$re')";
//$sql = "INSERT INTO Customers (first-name, last-name, b-name, address, address1, city, state, pin, phone, email, reff) VALUES ('Sh', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l')";
//$con->exec($sql);
if(mysqli_query($con, $sql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
//echo $fname;
//echo $lname;
//echo $bname;
//echo $add1;
//echo $add2;
//echo $city;
//echo $state;
//echo $pin;
//echo $phone;
//echo $email;
//echo $re;
include 'customer.inc';
?>
     <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create Customers</h4>
                  <form class="form-sample" method="get" action="ticketd.php">
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
                            <select name="reff" class="form-control form-control-sm" name="country">
<?php
$ref = "select * from reff order by Refer";
$ref1 = $con->query($ref);
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

					   <p class="card-description">
                     TICKET DETAILS
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Ticket Type</label>
                          <div class="col-sm-9">
                           <select name="type" class="form-control form-control-sm">
							<option value="Warranty">Warranty</option>
							<option value="Out of Warranty">Out of Warranty</option>
							<option value="Stock Damage">Stock Damage</option>
						   </select>
                          </div>
                        </div>
                      </div>
					     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Catagory</label>
                          <div class="col-sm-9">
                            <select name="pcat" class="form-control form-control-sm">
							<?php
$st = "Active";
$sql = "SELECT * FROM catgaory where status='$st' order by pcat";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
?>
<option value="<?php echo $row["pcat"] ?>"><?php echo $row["pcat"] ?></option>
<?php
}
?>
							</select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Brand</label>
                          <div class="col-sm-9">
                            <input type="text" name="brand" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
					   <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Model</label>
                          <div class="col-sm-9">
                            <input type="text" name="model" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
					  					   <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Complaint in Breif</label>
                          <div class="col-sm-9">
                            <textarea name="complaint" rows="4" cols="27"></textarea>
                          </div>
                        </div>
                      </div>
				
                    </div>
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
 