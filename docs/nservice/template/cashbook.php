<?php
include 'head.inc';
include 'gstconnection.php';
?>
	 
	 <div class="main-panel">
          <div class="content-wrapper">
                            <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Filter</h4>
                    <p class="card-description"> 
					<div class="table-responsive">
					<form method="get" action="">
                      <table class="table table-bordered">
                          <tr>
                            <td>From</td>
                            <td><input type="date" name="fdate" class="form-control" id="exampleInputMobile" /></td>
                            <td>  
							<td><input type="date" name="tdate" class="form-control" id="exampleInputMobile" /></td>
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
					$fdate = $_REQUEST['fdate'];
					$tdate = $_REQUEST['tdate'];
							$user = "User";
							$cdate = date('Y-m-d H:i:s');
							$dopbal = "0";
							$copbal = "0";
							
							$qry1 = "select * from fyear where ystatus='$crnt'";
							$sre = $con->query($qry1);
							$frow = $sre->fetch_assoc();
							$sdate = $frow["sdate"];	
							$qry = "select * from cashbook where status='$st' and date between '$sdate' and '$fdate'";
							$cresult = $con->query($qry);
							if ($cresult->num_rows > 0){
							while ($crow = $cresult->fetch_assoc())
							{
								if ($crow["crdr"] == "Debit"){
								$dopbal = ($dopbal + $crow["amount"]);
								}
								else
								{
								$copbal = ($copbal + $crow["amount"]);
								}
							
							}
								if ($dopbal > $copbal) {
								$dopbal1 = ($dopbal - $copbal);
								}
								else
								{
								$copbal1 = ($copbal - $dopbal);
								}
							}
							
							
					$sql = "SELECT * FROM cashbook where status='$st' and date between '$fdate' and '$tdate' order by date";
					}
					else
					{
					$sql = "SELECT * FROM cashbook where status='$st' order by date";
					}
					$sre = $con->query($sql);
					
					//echo "shine";
					?>
					<p><strong>Cashbook from <?php echo $fdate ?> to <?php echo $tdate ?></strong></p>
                    <div class="table-responsive">
                      <table class="table table-{color}">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Particulars</th>
							<th>Voucher type</th>
							<th>Voucher No.</th>
                            <th>Debit</th>
							<th>Credit</th>
                          </tr>
                        </thead>
						<?php
						$dtot = $dopbal1;
						$ctot = $copbal1;
						?>
						<tbody>
						<?php
						if ($btn) {						
						?>
						
                          <tr class="table-info">
                            <td><?php echo $fdate; ?></td>
                            <td><?php echo "Opening Balance"; ?></td>
                            <td><?php echo "Cash" ?></td>
							<td></td>
							<td align="center"><?php echo $dopbal1; ?></td>
							<td align="center"><?php echo $copbal1; ?></td>
							
                          </tr>						
						
						
						
						
						<?php	
}					
						while($srow = $sre->fetch_assoc()) {
						
						?>
                        <tbody>
                          <tr class="table-info">
                            <td><?php echo $srow["date"] ?></td>
                            <td><?php echo $srow["trasaction"] ?></td>
                            <td><?php echo "Cash" ?></td>
							<td><?php echo $srow["id"] ?></td>
							<?php
							if ($srow["crdr"] == "Debit") {
							$dtot = ($dtot + $srow["amount"]);
							?>
							<td align="center"><?php echo $srow["amount"] ?></td>
							<td align="center"></td>
							<?php
							}
							else
							{
							$ctot = ($ctot + $srow["amount"]);
							?>
							<td align="center"></td>
                            <td align="center"><?php echo $srow["amount"] ?></td>
							<?php
							}
							?>
                          </tr>
                          <?php
						  }
						  ?>
						    <tr class="table-info">
                            <td>TOTAL</td>
                            <td></td>
                            <td></td>
							  <td></td>
                            <td align="center"><?php echo $dtot; ?></td>
							<td align="center"><?php echo $ctot; ?></td>
                          </tr>
						  <?php 
						  if ($dtot > $ctot) {
						  $ddiff = $dtot - $ctot;
						  }
						  else
						  {
						  $cdiff = $ctot - $dtot;
						  }
						  ?>
						   <tr class="table-info">
                            <td>Closing Balance</td>
                            <td></td>
                            <td></td>
							  <td></td>
                            <td align="center"><?php echo $ddiff; ?></td>
				            <td align="center"><?php echo $cdiff; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

					
                  </div>
                </div>
              </div>
			  		<?php
			include 'footer.inc';
			?>