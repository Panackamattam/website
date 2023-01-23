<?php
include 'head.inc';
include 'gstconnection.php';
?>
	 
	 <div class="main-panel">
          <div class="content-wrapper">
           
			
			<?php
			$user = "User";
			$cdate = date('Y-m-d H:i:s');
			$st = "Active";

			$sub = $_REQUEST['submit'];
			if ($sub) {
			$tax = $_REQUEST['taxrate'];
			$cgst = $_REQUEST['cgst'];
			$sgst = $_REQUEST['sgst'];
			$igst = $_REQUEST['igst'];
			
			$sql = "INSERT INTO gsttaxes(taxrate, cgst, sgst, igst, crdate, status) VALUES ('$tax', '$cgst', '$sgst', '$igst', '$cdate', '$st')";
			if(mysqli_query($con, $sql)){
			//echo "Records added successfully.";
			} else{
			//echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
			}
			}
			?>
			
			<div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create new tax schedule</h4>
                    <form  class="forms-sample" method="get" action="">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Tax rate</label>
                        <input type="text" name="taxrate" class="form-control"/>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">CGST</label>
                        <input type="text" name="cgst" class="form-control"  />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">SGST</label>
                        <input type="text" name="sgst" class="form-control" />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">IGST</label>
                        <input type="text" name="igst" class="form-control"  />
                      </div>
                      <button type="submit" name="submit" value="Addtax" class="btn btn-primary mr-2"> Submit </button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
			  
			 <?php
			$user = "User";
			$cdate = date('Y-m-d H:i:s');
			$st = "Active";
			
			$sql1 = "select * from gsttaxes where status='$st' order by taxrate";
			$result = $con->query($sql1);
			
			?>
			
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
            

                    <h4 class="card-title">GST Table</h4>
					<?php
					if ($result->num_rows > 0) {
					?>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>GST RATE</th>
                            <th>CGST</th>
                            <th>SGST</th>
                            <th>IGST</th>
                          </tr>
                        </thead>
						<?php
						while($row = $result->fetch_assoc()) {
						?>
                        <tbody>
                          <tr>
                            <td><?php echo $row["taxrate"]; ?></td>
                            <td><?php echo $row["cgst"]; ?></td>
                            <td><?php echo $row["sgst"]; ?></td>
                            <td><?php echo $row["igst"]; ?></td>
                          </tr>
						  <?php
						  }
						  }
						  ?>
                           </tbody>
                      </table>
                    </div>
                  </div>

					
                  </div>
                </div>
              </div>
			  		<?php
			include 'footer.inc';
			?>