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
			
			$invno = $_REQUEST['invno'];
			$qry3 = "select * from gstinvdetails where invno='$invno'";
			$sre3 = $con->query($qry3);	
			$invrow = $sre3->fetch_assoc();
			$cname = $invrow["cname"];
			
			//delete code starts
			
			$pr = $_REQUEST['submit'];
			$invno = $_REQUEST['invno'];
			if ($pr) {
			
			$qry9 = "select * from gstinvoice where invno='$invno'";
			$sre9 = $con->query($qry9);	
			while($row9 = $sre9->fetch_assoc()){
			$id = $row9["id"];
			$stockid = $row9["stockid"];			
			//echo $stockid;
			
			$qry8 = "select * from gststock where sid='$stockid'";
			$sre8 = $con->query($qry8);	
			$row8 = $sre8->fetch_assoc();
			$bqty = ($row8["balqty"] + $row9["qty"]);
			
			$uqry = "update gststock set balqty='$bqty' where sid='$stockid'";
			//echo $uqry;
			if(mysqli_query($con, $uqry)){
			//echo "Records added successfully.";
			} else{
			echo "ERROR: Could not able to execute $uqry. " .mysqli_error($con);
			}
			
			$de = "Cancelled";
			$uqry1 = "update gstinvoice set status='$de' where id='$id'";
			if(mysqli_query($con, $uqry1)){
			//echo "Records added successfully.";
			} else{
			echo "ERROR: Could not able to execute $uqry1. " .mysqli_error($con);
			}
			}
			//delete code ends
			$de = "Cancelled";
			$canr = $_REQUEST['canr'];
			$invqry = "update gstinvdetails set status='$de', canremark='$canr', candate='$cdate' where invno='$invno'";
			if(mysqli_query($con, $invqry)){
			//echo "Records added successfully.";
			} else{
			echo "ERROR: Could not able to execute $invqry. " .mysqli_error($con);
			}
			}
			
		
			?>
			
			<div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Cacnel Invoice</h4>
                    <form  class="forms-sample" method="get" action="">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Customer Name</label>
                        <input type="text" name="cname" value="<?php echo $cname; ?>" class="form-control" <?php if ($cname) {echo "readonly";} ?>/>
                      </div>
						<div class="form-group">
                        <label for="exampleInputEmail1">Invoice # and date</label>
                        <input type="text" name="invno" class="form-control"  value="<?php echo $invno; ?>" readonly />
                      </div>
					  <br />
					  <br />
					  
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Cancelation Reason</label>
                        <input type="text" name="canr" class="form-control"  />
                      </div>
                      
                      <button type="submit" name="submit" value="Cancell" class="btn btn-primary mr-2"> Cancel Bill </button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
			  
			 <?php
			$user = "User";
			$cdate = date('Y-m-d H:i:s');
			$st = "Active";
			
			//$invno = $_REQUEST['invno'];
			$sql1 = "select * from gstinvoice where invno='$invno' and status='$st'";
			$result = $con->query($sql1);
			//$idrow = $result->fetch_assoc();
		
			?>
			
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
  <h4 class="card-title">Bill details</h4>
					<?php
					if ($result->num_rows > 0) {
				
					?>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
						  <td></td>
                            <td>Item</td>
                            <td>Qty</td>
                            <td>Rate</td>
							<td>Total</td>
                          </tr>
                        </thead>
						<?php
						$subtotal = "0";
						$sgst1 = "0";
						$cgst1 = "0";
						$cess1 = "0";
						while($row = $result->fetch_assoc()) {
						$subtotal = ($subtotal + $row["total"]);
						$sgst1 = ($sgst1 + $row["sgst"]);
						$cgst1 = ($cgst1 + $row["cgst"]);
						$cess1 = ($cess1 + $row["cess"]);
						?>
                        <tbody>
                          <tr>
						  <td><i class="mdi mdi-delete"></i>	</td>				  
                            <td><?php echo substr($row["item"], 0, 10); ?></td>
                            <td align="center"><?php echo $row["qty"]; ?>&nbsp;<?php echo $row["unit"]; ?></td>
                            <td><?php echo $row["rate"]; ?></td>
							<td><?php echo $row["total"]; ?></td>
                          </tr>
						  <?php
						  }
						  $grandtotal = ($subtotal + $cgst1 + $sgst1 + $cess1);
						  
						  ?>
						  <tr>
						  <td></td>
                            <td></td>
                            <td></td>
                            <td>Subtotal</td>
                            <td align="right"><?php echo $subtotal; ?></td>
                          </tr>
						  <tr>
						  <td></td>
                            <td></td>
                            <td></td>

                            <td>SGST</td>
                            <td align="right"><?php echo $sgst1; ?></td>
                          </tr>
						  						  <tr><td></td>
                            <td></td>
                            <td></td>
                            <td>CGST</td>
                            <td align="right"><?php echo $cgst1; ?></td>
                          </tr>
						  						  <tr><td></td>
                            <td></td>
                            <td></td>
                            <td>CESS</td>
                            <td align="right"><?php echo $cess1; ?></td>
                          </tr>
						  						  <tr><td></td>
                            <td></td>
                            <td></td>
                            <td>Grandtotal</td>
                            <td align="right"><h4><?php echo $grandtotal ; ?></h4></td>
                          </tr>
						  
						  
						  <?php
						  }
						  else
						  {
						  	echo "This invoice is canceled !";
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
			
