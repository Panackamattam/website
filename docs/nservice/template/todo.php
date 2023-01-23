<?php
include 'head.inc';
include 'connection.php';
?>

  <?php
$user = $_SESSION["username"];
$role = $_SESSION["role"];
$dash = "-";  
$st = "Resolved";
$apst = "Approved";
$st1 = "Active";

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$sub = $_REQUEST['submit'];
if ($sub) {
$wd = $_REQUEST['wd'];
$asn = $_REQUEST['asn'];
$ddt = $_REQUEST['ddt'];
$prt = $_REQUEST['prt'];

$sqry = "INSERT INTO todo(work, ddate, asto, prty, crdate, crby, tstatus) VALUES ('$wd','$ddt','$asn','$prt','$cdate','$user','$st')";
//$con->exec($sql);
if(mysqli_query($con, $sqry)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

}


$qry = "select * from todo where tstatus='$st' order by id desc";
$res = $con->query($qry);

?>
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
                       <div class="col-md-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
								
								
								
				<h4 class="card-title">Pending</h4>
                  <p class="card-description">
                    Work Details
                  </p>
				  
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Work</th>
                          <th>Status</th>
                        </tr>
                      </thead>
					  									<?php
									while($rrow = $res->fetch_assoc()){
									?>
                      <tbody>
                        <tr>
                          <td><a href="task.php?id=<?php echo $rrow["id"]?>"><?php echo $rrow["work"] ?></a></td>
                          <td><label class="badge badge-danger"><?php echo $rrow["ddate"] ?></label></td>
                        </tr>
																			
											<?php
											}
											?>
										</table>
                  </div>
                  <div class="add-items d-flex mb-0 mt-4">
										<input type="text" class="form-control todo-list-input mr-2"  placeholder="Add new task">
										<button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i class="ti-location-arrow"></i></button>
									</div>
								</div>
							</div>
            </div>
			<div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Add new task</p>
               
			   <form method="get" action="">
			    <div class="form-group">
                      <label for="exampleInputUsername1">Work Details</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="work details" name="wd">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Asaigned to</label>
                      <select name="asn" class="form-control form-control-sm">
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
</select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Due Date</label>
                      <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Due Date" name="ddt">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Priority</label>
                                         <select name="prt" class="form-control form-control-sm">
										 <option value="high">High</option>
										 <option value="Medium">Medium</option>
										 <option value="low">Low</option>
										 </select>
                    </div>
                                       <button type="submit" class="btn btn-primary mr-2" name="submit" value="submit">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
			   
					
                </div>
              </div>
            </div>
          </div>


  <?php
   include 'footer.inc';
   ?>
  