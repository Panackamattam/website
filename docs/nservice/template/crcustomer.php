<?php
include 'head.inc';
include 'gstconnection.php';
?>
        <div class="main-panel">
          <div class="content-wrapper pb-0">
            
			<?php
			$btn1 = $_REQUEST['submit'];
			if ($btn1) {
			
			$user = "User";
			$cdate = date('Y-m-d H:i:s');
			$st = "Active";
			
			$cname = $_REQUEST['cname'];
			$fname = $_REQUEST['fname'];
			$add1 = $_REQUEST['add1'];
			$add2 = $_REQUEST['add2'];
			$city = $_REQUEST['city'];
			$state = $_REQUEST['state'];
			$pincode = $_REQUEST['pincode'];
			$country = $_REQUEST['county'];
			$mobile = $_REQUEST['mobile'];
			$email = $_REQUEST['email'];
			$gstno = $_REQUEST['gstno'];
			$stcode = $_REQUEST['stcode'];
			
$qry = "INSERT INTO gstcustomers (cname, fname, add1, add2, city, state, pincode, country, mobile, email, gst, scode, crby, crdate, status) VALUES ('$cname', '$fname', '$add1', '$add2', '$city', '$state', '$pincode', '$country', '$mobile', '$email', '$gstno', '$stcode', '$user', '$cdate', '$st')";		
			
			if(mysqli_query($con, $qry)){
			//echo "Records added successfully.";
			} else{
			echo "ERROR: Could not able to execute $qry. " .mysqli_error($con);
			}
			
			
			$acsub = "Sales";
			$ac = "Revenue";
			$aqry = "INSERT INTO gstachead(achead, acsubgroup, acgroup, ttype, crby, crdate, status) VALUES ('$cname','$acsub','$ac','$acsub','$user','$cdate','$st')";
			if(mysqli_query($con, $aqry)){
			//echo "Records added successfully.";
			} else{
			//echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
			}
			
			
			$msg = "Customer created successfully !";
			}
			?>
          <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Customer Details</h4>
                    <form class="form-sample" method="get" action="">
											<p><?php echo $msg ?></p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Cust. Name</label>
                            <div class="col-sm-9">
                              <input type="text" name="cname" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Firm Name</label>
                            <div class="col-sm-9">
                              <input type="text" name="fname" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address 1</label>
                            <div class="col-sm-9">
                              <input type="text" name="add1" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">State</label>
                            <div class="col-sm-9">
                              <input type="text" name="state" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address 2</label>
                            <div class="col-sm-9">
                              <input type="text" name="add2" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Postcode</label>
                            <div class="col-sm-9">
                              <input type="text" name="pincode" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">
                              <input type="text" name="city" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="county">
							 
<option value="India" selected>India</option>

                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
					  
					                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile</label>
                            <div class="col-sm-9">
                              <input type="text" name="mobile" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input type="text" name="email" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
					  
					  <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">GST #</label>
                            <div class="col-sm-9">
                              <input type="text" name="gstno" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">State Code</label>
                            <div class="col-sm-9">
                              <input type="text" name="stcode" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
			
			
<p align="center"> <button type="submit" name="submit" value="CreateCustomer" class="btn btn-primary"> Create Customer </button></p>		  
					  
                    </form>
                  </div>
                </div>
              </div>
			
			
			</div>
			<?php
			include 'footer.inc';
			?>
          