<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";


if ($_REQUEST['cpassword']) {
$npass = $_REQUEST['npass'];
$cpass = $_REQUEST['cpass'];
$uid = $_REQUEST['uid'];

		If ($cpass == $npass){
		$sql55 = "update users set password='$npass', mdby='$user' where uid='$uid'";
		if(mysqli_query($con, $sql55)){
   // echo "Records added successfully.";
		$msg = "Password updated successfully.";
		} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
		}
		}
		else
		{
		echo "Missmatch New Password and confirmed password";
		}
		}

?>
   <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Change password</h4>
				  <h4><font color="red"><?php echo $msg; ?></font></h4>  	

<?php
if ($_REQUEST['sub']) {
$uid = $_REQUEST['cus'];
$usq4 = "select * from users where uid='$uid'";
$usqresult = $con->query($usq4);
$row45 = $usqresult->fetch_assoc();
?>
<form method="get" action="">
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
                            <input type="text" name="fname" value="<?php echo $row45["Name"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address1</label>
                          <div class="col-sm-9">
                            <input type="text" name="add1" value="<?php echo $row45["add1"] ?>"class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
					 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address2</label>
                          <div class="col-sm-9">
                            <input type="text" name="add2" value="<?php echo $row45["add2"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" name="city" value="<?php echo $row45["city"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" name="state" value="<?php echo $row45["state"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Pincode</label>
                          <div class="col-sm-9">
                            <input type="text" name="pin" value="<?php echo $row45["pin"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
					 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile</label>
                          <div class="col-sm-9">
                            <input type="text" name="mobile" value="<?php echo $row45["mobile"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" name="email" value="<?php echo $row45["email"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Role</label>
                          <div class="col-sm-9">
              <select name="role" class="form-control form-control-sm" name="country" disabled>
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
              <select name="stat" class="form-control form-control-sm" name="country" disabled>
			  <option value="Active" <?php if ($row45["status"] == "Active") { echo "selected"; } ?>>Active</option>
<option value="Inavice" <?php if ($row45["status"] == "Inactive") { echo "selected";} ?>>Inactive</option>
</select>
                          </div>
                        </div>
                      </div>
                    </div>




<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" name="pass" value=""class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
					
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Confirm Pass</label>
                          <div class="col-sm-9">
                            <input type="text" name="fname" value="" class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
                      </div>


<p align="center"><input type="hidden" name="cpassword" value="Change Password"></input><button type="submit" class="btn btn-primary mr-2">Change Password</button></p>
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


