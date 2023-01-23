<?php
include 'head.inc';
include 'gstconnection.php';
?>
	 
	 <div class="main-panel">
          <div class="content-wrapper">

                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Search Stock</h4>
                    <p class="card-description"> 
					<div class="table-responsive">
					<form method="get" action="">
                      <table class="table">
                          <tr>
                            <td>Item</td>
                            <td><input type="text" name="item" class="form-control" id="exampleInputMobile" placeholder="Enter Item" /></td>
                            <td>  <select name="option" class="form-control">
							<option value="exact">Exact Match</option>
							<option value="contains">Contains</option>
							
							</td>
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
					$it = $_REQUEST['item'];
					$op = $_REQUEST['option'];
					
					
						if ($op == "contains") {
						$sql = "select * from gststock where staus='$st' and item like '$it%'";
						}
						if ($op == "exact") {
						$sql = "select * from gststock where staus='$st' and item='$it'";
						}
					}
					else {
					$sql = "select * from gststock where staus='$st'";
					}
					//echo $sql;
					$sre = $con->query($sql);
					if ($sre->num_rows > 0) {
					//echo "shine";
					?>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Item</th>
                            <th>HSN Code</th>
                            <th>Stock Qty</th>
							<th>Unit</th>
                            <th>P Rate</th>
							<th>Total</th>
                            <th>Vendor</th>
                          </tr>
                        </thead>
						<?php
						$tot = "0";
						while($srow = $sre->fetch_assoc()) {
						$tot = ($srow["balqty"] * $srow["prate"] );
						$gtot = ($gtot + $tot);
						?>
                        <tbody>
                          <tr class="table-info">
                            <td><?php echo $srow["item"] ?></td>
                            <td><?php echo $srow["hsncode"] ?></td>
                            <td><?php echo $srow["balqty"] ?></td>
							<td><?php echo $srow["unit"] ?></td>
                            <td><?php echo $srow["prate"] ?></td>
                            <td><?php echo $tot; ?></td>
							 <td><?php echo $srow["vname"] ?></td>
                          </tr>
                          <?php
						  }
						  ?>
						    <tr class="table-info">
                            <td>TOTAL</td>
                            <td></td>
                            <td></td>
                            <td></td>
							         <td></td>
                            <td><?php echo $gtot; ?></td>
							 <td></td>
                          </tr>
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