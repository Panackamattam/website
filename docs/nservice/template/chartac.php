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
			$grp = $_REQUEST['acgrp'];
			$sgrp = $_REQUEST['subacgrp'];

			
			$sql = "INSERT INTO gstsubgroups(subgroupname, groupname, crby, crdate, status) VALUES ('$sgrp','$grp','$user','$cdate','$st')";
			
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
                        <label for="exampleInputEmail1">Select Group</label>
                              <select class="form-control" name="acgrp">
							  <option value="Select"></option>
							  <?php
							  $qry = "select * from gstacgroups where status='$st' order by groupname";
							  $qryres = $con->query($qry);
							  if ($qryres->num_rows > 0){
							  while($qryrow=$qryres->fetch_assoc())
							  {
							  ?>
							 <option value="<?php echo $qryrow["groupname"] ?>"><?php echo $qryrow["groupname"] ?></option>
							 <?php
							 }
							 }
							 ?>
</select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Create Subgroup</label>
                        <input type="text" name="subacgrp" class="form-control" />
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
			
			$sql1 = "select * from gstacgroups where status='$st' order by groupname";
			$result = $con->query($sql1);
			
			?>
			
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
            

                    <h4 class="card-title">Main Groups</h4>
					<?php
					if ($result->num_rows > 0) {
					?>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Group Name</th>
                          </tr>
                        </thead>
						<?php
						while($row = $result->fetch_assoc()) {
						?>
                        <tbody>
                          <tr>
                            <td>
<button type="button" class="collapsible"><?php echo $row["groupname"]; ?></button>
<div class="content">
  <p>
  <?php
  $grpn = $row["groupname"];
  $qry7 = "select * from gstsubgroups where groupname='$grpn' and status='$st'";
  $res7 = $con->query($qry7);
  if ($res7->num_rows > 0){
  while($qry7row = $res7->fetch_assoc()){
  $sqp = $qry7row["subgroupname"];
  //echo ($qry7row["subgroupname"]);
  ?>
  <a href="acheads.php?mg=<?php echo $grpn ?>&sgp=<?php echo $sqp ?>"><?php echo $qry7row["subgroupname"] ?></a>
  </p>
  <?php
  }
  }
  ?>
</div>
							
							
							
							</td>
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
			  <script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
			  		<?php
			include 'footer.inc';
			?>