<?php
include 'head.inc';
include 'connection.php';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

if ($_REQUEST['submit']) {
$cname = $_REQUEST['catn'];
 
// Attempt insert query execution
$sql = "INSERT INTO catgaory(pcat, crby, crdate, status) VALUES ('$cname','$user','$cdate','$st')";
if(mysqli_query($con, $sql)){
   // echo "Records added successfully.";
   $msg = "Catagory added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
}

?>
 
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				<h4 class="card-title"><strong>Add Product Catagory</strong></h4>
	   <h4><font color="red"><?php echo $msg ?></font></h4>
	   <form method="get" action="">
	   <br /><br /><br />
	   <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Catagory</label>
                          <div class="col-sm-9">
                            <input type="text" name="catn" value="<?php echo $row45["uname"] ?>"  class="form-control form-control-sm" />
                          </div>
                        </div>
                      </div>
					  </div>
					  
<p align="center"><input type="hidden" name="submit" value="Add Catagory"></input><button type="submit" class="btn btn-primary mr-2">Add Catagory</button></p>

</form>
    </div>
  </div>
    </div>  </div>
</div>
 <?php
   include 'footer.inc';
   ?>
