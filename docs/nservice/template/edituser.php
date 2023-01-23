<?php
include 'head.inc';
include 'connection.php';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";


if ($_REQUEST['update']) {
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
$uid = $_REQUEST['uid'];
$stat = $_REQUEST['stat'];
$sql55 = "update users set Name='$fname', add1='$add1', add2='$add2', city='$city', state='$state', mobile='$phone', email='$email', role='$role', status='$stat', mdby='$user' where uid='$uid'";
if(mysqli_query($con, $sql55)){
   // echo "Records added successfully.";
   $msg = "User updated successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

$msg = "User details updated successfully !";

}

?>
    	

<?php
if ($_REQUEST['sub']) {
$uid = $_REQUEST['cus'];
$usq4 = "select * from users where uid='$uid'";
$usqresult = $con->query($usq4);
$row45 = $usqresult->fetch_assoc();
?>
  <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit User details</h4>
				  <h4><font color="red"><?php echo $msg; ?></font></h4>
<form method="get" action="">
<input type="hidden" name="uid" value="<?php echo $uid ?>"></input>
 			  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">User Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="uname" value="<?php echo $row45["uname"] ?>"  class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					  </div>
					  
					  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $row45["Name"] ?>" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address1</label>
                          <div class="col-sm-9">
                            <input type="text" name="add1" value="<?php echo $row45["add1"] ?>"class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
					 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address2</label>
                          <div class="col-sm-9">
                            <input type="text" name="add2" value="<?php echo $row45["add2"] ?>" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" name="city" value="<?php echo $row45["city"] ?>" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" name="state" value="<?php echo $row45["state"] ?>" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Pincode</label>
                          <div class="col-sm-9">
                            <input type="text" name="pin" value="<?php echo $row45["pin"] ?>" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                    </div>
					 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile</label>
                          <div class="col-sm-9">
                            <input type="text" name="mobile" value="<?php echo $row45["mobile"] ?>" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" name="email" value="<?php echo $row45["email"] ?>" class="form-control form-control-sm" />
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
			  <option value="user" <?php if ($row45["role"] == "user") { echo "selected"; } ?>>User</option>
<option value="technician" <?php if ($row45["role"] == "technician") { echo "selected";} ?>>Technician</option>
<option value="Admin" <?php if ($row45["role"] == "Admin") { echo "selected";} ?>>Admin</option>
</select>
                          </div>
                        </div>
                      </div>
			<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">User Status</label>
                          <div class="col-sm-9">
              <select name="stat" class="form-control form-control-sm" name="country">
			  <option value="Active" <?php if ($row45["status"] == "Active") { echo "selected"; } ?>>Active</option>
<option value="Inavice" <?php if ($row45["status"] == "Inactive") { echo "selected";} ?>>Inactive</option>
</select>
                          </div>
                        </div>
                      </div>
                    </div>
									
<p align="center"><input type="hidden" name="update" value="Update User"></input>
<input type="hidden" name="sub" value="search"></input>
<button type="submit" class="btn btn-primary mr-2">Update user details</button></p>
</form>
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


