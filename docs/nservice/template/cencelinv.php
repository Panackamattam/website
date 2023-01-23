     <?php
include 'head.inc';
include 'gstconnection.php';
?>
	 
	 <div class="main-panel">
          <div class="content-wrapper">

                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Search Invoice to cancel</h4>
                    <p class="card-description"> 
					<div class="table-responsive">
					<form method="get" action="">
                      <table class="table table-bordered">
                          <tr>
                            <td>Invoice #</td>
                            <td><input type="text" name="invno" class="form-control" id="exampleInputMobile" placeholder="Enter Invoice number" /></td>
                            <td><button type="submit" name="btn" value="search" class="btn btn-primary"> Search </button></td>
                          </tr>
                        </table>
						</form>
						</div>
                    </p>
					<?php
					$st = "Active";
					$btn = $_REQUEST['btn'];
					if ($btn) {
					//echo "shine";
					$it = $_REQUEST['invno'];
					$sql = "select * from gstinvdetails where status='$st' and invno='$it'";
						}
			
					else {
					$sql = "select * from gstinvdetails where status='$st' order by id desc";
					}
					//echo $sql;
					$sre = $con->query($sql);
					if ($sre->num_rows > 0) {
					//echo "shine";
					?>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Inv#</th>
							<th>Date</th>
                            <th>Customer</th>
                            <th>Amount</th>
							                    </tr>
                        </thead>
						<?php
						$tot = "0";
						while($srow = $sre->fetch_assoc()) {
						$itn = $srow["invno"];
								$qry = "select * from gstinvoice where status='$st' and invno='$itn'";
								$sqr = $con->query($qry);
								if ($sqr->num_rows > 0) {
								while($irow = $sqr->fetch_assoc()){
								$tot = ($tot + $irow["total"] + $irow["sgst"] + $irow["cgst"] + $irow["cess"]);
								}
								}
								else
								{
								$tot = "0";
								}
												?>
                        <tbody>
                          <tr>
                            <td><a href="cancelinvoice.php?invno=<?php echo $srow["invno"] ?>"><?php echo $srow["invno"] ?></a></td>
                            <td><?php echo $srow["invdate"] ?></td>
                            <td><?php echo $srow["cname"] ?></td>
							<td><?php echo $tot; ?></td>
                          </tr>
                          <?php
						  }
						  ?>
						    
                        </tbody>
                      </table>
                    </div>
					<?php
					}
					?>
                  </div>
                </div>
              </div>

					
                  </div>
                </div>
              </div>
			  		<?php
			include 'footer.inc';
			?>