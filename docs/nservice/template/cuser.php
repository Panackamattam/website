<?php
include 'head.inc';
include 'connection.php';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

if ($_REQUEST['submit']) {
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$bname = $_REQUEST['bname'];
$add1 = $_REQUEST['add1'];
$add2 = $_REQUEST['add2'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$pin = $_REQUEST['pin'];
$phone = $_REQUEST['mobile'];
$email = $_REQUEST['email'];
$role = $_REQUEST['role'];

$uname = $_REQUEST['uname'];
$pass = $_REQUEST['password'];
 
// Attempt insert query execution
$sql = "INSERT INTO users(Name, add1, add2, city, state, phone, mobile, email, role, crdate, status, uname, password, crby) VALUES ('$fname', '$add1', '$add2', '$city', '$state', '$phone', '$phone', '$email', '$role', '$cdate', '$st', '$uname', '$pass', '$user')";
if(mysqli_query($con, $sql)){
   // echo "Records added successfully.";
   $msg = "User added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
}
include 'admin.inc';
?>
 
     <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create User</h4>
				     <p><font color="red"><?php echo $msg ?></font></p>
	<form method="post" action="">
	 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">User Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="uname" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" name="password" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
	
	 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="fname" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address1</label>
                          <div class="col-sm-9">
                            <input type="text" name="add1" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
					 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address2</label>
                          <div class="col-sm-9">
                            <input type="text" name="add2" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" name="city" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" name="state" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Pincode</label>
                          <div class="col-sm-9">
                            <input type="text" name="pin" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
					 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile</label>
                          <div class="col-sm-9">
                            <input type="text" name="mobile" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" name="email" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Role</label>
                          <div class="col-sm-9">
              <select name="role" class="form-control form-control-sm" name="country">
			  <option value="user">User</option>
<option value="technician">Technician</option>
<option value="Admin">Admin</option>
<option value="Tele-Caller">Tele-Caller</option>
</select>
                          </div>
                        </div>
                      </div>
                    </div>
									
<p align="center"><input type="hidden" name="submit" value="Add User"></input><button type="submit" class="btn btn-primary mr-2">Create user</button></p>
</form>
    </div>
  </div>
    </div>
 <?php
   include 'footer.inc';
   ?>
  </div>
</div>

