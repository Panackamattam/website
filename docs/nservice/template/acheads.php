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
			$das = "-";
			$mg = $_REQUEST['mg'];
			$sgp = $_REQUEST['sgp'];

			$sub = $_REQUEST['submit'];
			if ($sub) {
			$mgrp = $_REQUEST['mg'];
			$sgrp = $_REQUEST['sgp'];
			$hd = $_REQUEST['hed'];
			
			$sql = "INSERT INTO gstachead(achead, acsubgroup, acgroup, ttype, crby, crdate, status) VALUES ('$hd','$sgrp','$mgrp','$das','$user','$cdate','$st')";		
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
                    <h4 class="card-title">Create Chart of Accounts</h4>
                    <form  class="forms-sample" method="get" action="">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Group</label>
                        <input type="text" name="mg" value="<?php echo $mg; ?>" class="form-control" readonly />
           </div>
		   
		                         <div class="form-group">
                        <label for="exampleInputEmail1">Subgroup</label>
                        <input type="text" name="sgp" value="<?php echo $sgp; ?>" class="form-control" readonly />
           </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Enter Head Name</label>
                        <input type="text" name="hed" class="form-control" />
                      </div>
					  
                      <div class="form-group">
                        <label for="exampleInputPassword1"></label>
            
                      </div>
					    <div class="form-group">
                        <label for="exampleInputPassword1"></label>
                   
                      </div>
				  
                      <button type="submit" name="submit" value="Addtax" class="btn btn-primary mr-2"> Submit </button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
						<div class="form-group">
                        <label for="exampleInputPassword1"></label>
                   
                      </div>

					  					                        <div class="form-group">
                        <label for="exampleInputPassword1"></label>
                   
                      </div>
                  </div>
                </div>
              </div>
			  
			 <?php
			$user = "User";
			$cdate = date('Y-m-d H:i:s');
			$st = "Active";
			$grp = $_REQUEST['mg'];
			$sgrp = $_REQUEST['sgp'];
			
	?>
			
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
            

                    <h4 class="card-title">Account heads</h4>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th><?php echo $grp;  ?>
							
                          </tr>
						  <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $sgrp;  ?></b></td></tr>
                        </thead>
                        <tbody>
                      
						    <?php
  $grpn = $grp;
  $qry6 = "select * from gstachead where acsubgroup='$sgrp' and status='$st'";
  $res6 = $con->query($qry6);
  if ($res6->num_rows > 0){
  while($qry6row = $res6->fetch_assoc()){
  ?>
      <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $qry6row["achead"]; ?></td>
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