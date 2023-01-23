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
			
			$pr = $_REQUEST['pr'];
			$id = $_REQUEST['rec'];
			if ($pr == "del") {
			
			$qry9 = "select * from gstinvoice where id='$id'";
			$sre9 = $con->query($qry9);	
			$row9 = $sre9->fetch_assoc();
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
			
			$de = "Deleted";
			$uqry1 = "update gstinvoice set status='$de' where id='$id'";
			if(mysqli_query($con, $uqry1)){
			//echo "Records added successfully.";
			} else{
			echo "ERROR: Could not able to execute $uqry1. " .mysqli_error($con);
			}
			}
			//delete code ends
			
			
		
			?>
			
			<div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Invioce</h4>
                    <form  class="forms-sample" method="get" action="crbill.php">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Customer Name</label>
                        <input type="text" name="cname" value="<?php echo $cname; ?>" class="form-control" <?php if ($cname) {echo "readonly";} ?>/>
                      </div>
						<div class="form-group">
                        <label for="exampleInputEmail1">Invoice # and date</label>
                        <input type="text" name="invno" class="form-control"  value="<?php echo $invno; ?>" readonly />
                      </div>
					  
					  
                    <div class="form-group">
                        <label for="exampleInputEmail1">Item</label>
                        <input type="text" name="item" class="form-control"  />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Quantity</label>
                        <input type="text" name="qty" class="form-control" />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Rate/Pc</label>
                        <input type="text" name="rate" class="form-control"  />
                      </div>
                      <button type="submit" name="submit" value="Additem" class="btn btn-primary mr-2"> Add Item </button>
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
  <h4 class="card-title">Invoice details</h4>
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
						  <td><a href="editinvoice.php?pr=del&rec=<?php echo $row["id"] ?>&invno=<?php echo $invno ?>"><i class="mdi mdi-delete">Del</i></a>	</td>				  
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
                          						  						  <tr><td></td>
                            <td></td>
                            <td></td>
                            <td>Grandtotal</td>
                            <td align="right"><h4><?php echo $grandtotal ; ?></h4></td>
                          </tr>
						  
						  
						  <?php
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
			
