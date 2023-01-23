<?php
include 'head.inc';
include 'gstconnection.php';
?>

        <div class="main-panel">
          <div class="content-wrapper pb-0">
          
			<?php
			$btn4 = $_REQUEST['pbtn'];
			if ($btn4) {
			$user = "User";
			$cdate = date('Y-m-d H:i:s');
			$st = "Active";
			
			$vname = $_REQUEST['cityname'];
			$invno = $_REQUEST['invno'];
			$invdate = $_REQUEST['invdate'];
			$item = $_REQUEST['cityname1'];
			$qty = $_REQUEST['qty'];
			$rate = $_REQUEST['rate'];
			$curr = $_REQUEST['curr'];
			$total = ($rate * $qty);
			
			$cqry = "select * from gstvendor where vname='$vname' and status='$st'";
			$result = $con->query($cqry);
			$row = $result->fetch_assoc();
			$vid = $row["vid"];
			
			$hqry = "select * from gstinventory where item='$item' and status='$st'";
			$hresult = $con->query($hqry);
			$hrow = $hresult->fetch_assoc();
			$hsncode = $hrow["hsncode"];
			$unit = $hrow["unit"];
			$taxrate = $hrow["taxschedule"];
			
						
			$qry = "INSERT INTO gstpurdetails(invno, invdate, vname, invstatus, crby, crdate) VALUES ('$invno','$invdate','$vname','$st','$user','$cdate')";
			if(mysqli_query($con, $qry)){
			//echo "Records added successfully.";
			} else{
			//echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
			}
			
			$tqry2 = "select * from gsttaxes where taxrate='$taxrate'";
			$tsre2 = $con->query($tqry2);		
			$ttrow2 = $tsre2->fetch_assoc();
			
			$cgst = $ttrow2["cgst"];
			$cgst = ($cgst / 100) * $total;
			$sgst = $ttrow2["sgst"];
			$sgst = ($sgst / 100) * $total;
			$igst = "0";
			
			$qry1 = "INSERT INTO gstpurchase(vid, vname, item, hsncode, quantity, unit, rate, total, curr, vinvno, vinvdate, recdate, status,cgst,sgst,igst) VALUES ('$vid','$vname','$item','$hsncode','$qty','$unit','$rate','$total','$curr','$invno','$invdate','$invdate','$st','$cgst','$sgst','$igst')";
			if(mysqli_query($con, $qry1)){
			//echo "Records added successfully.";
			} else{
			//echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
			}
			$z = "0";
			$sqry = "INSERT INTO gststock(item, stockqty, balqty, unit, hsncode, prate, curr, srate, vid, vname, staus, crby, crdate) VALUES ('$item','$qty','$qty','$unit','$hsncode','$rate','$curr','$z','$vid','$vname','$st','$user','$cdate')";
			if(mysqli_query($con, $sqry)){
			//echo "Records added successfully.";
			} else{
			//echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
			}	
			
			$msg = "Item Added Successfully !";
			
			}
			
			?>
			
		  <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Purchase Entry <?php if ($msg) { echo "-".$msg; }?></h4>
                    <form class="form-sample" method="get" action="">
                      <p class="card-description">&nbsp;</p>
			
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
						    <label class="col-sm-3 col-form-label">Vendor</label>
                              <div class="col-sm-9">
							   <input type="text" name="cityname" id="search" placeholder="search here...." value="<?php echo $vname; ?>" <?php if ($invno) {?> readonly <?php } ?>class="form-control">
							 </div>
                          </div>
                        </div>
						 <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                             
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Invoice#</label>
                            <div class="col-sm-9">
                              <input type="text" name="invno" value="<?php echo $invno; ?>" class="form-control" <?php if ($invno) {?> readonly <?php } ?>/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                              <input type="date" name="invdate" value="<?php echo $invdate; ?>"class="form-control" <?php if ($invno) {?> readonly <?php } ?>/>
                            </div>
                          </div>
                        </div>
                      </div>
					  <hr color="black">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Item</label>
                            <div class="col-sm-9">
<input type="text" name="cityname1" id="searchitem" placeholder="search here...." class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Quantity</label>
                            <div class="col-sm-9">
                              <input type="text" name="qty" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Rate/Pc</label>
                            <div class="col-sm-9">
                              <input type="text" name="rate" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Curr</label>
                            <div class="col-sm-9">
                              <input type="text" name="curr" value="Rs." class="form-control" readonly  />
                            </div>
                          </div>
                        </div>
                      </div>
                     
			
<p align="center"> <button type="submit" name="pbtn" value="purchase" class="btn btn-primary"> Add item </button></p>		  
					  
                    </form>
	                

				<?php
					$iqry = "select * from gstpurchase where vinvno='$invno' and status='$st'";
					$iresult = $con->query($iqry);
					if ($iresult->num_rows > 0) {			
					
					?>
	                    <p class="card-description"> Item details</code>	</p>			
<div class="table-responsive">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Rate</th>
							<th>Total</th>
                          </tr>
                        </thead>
							<?php
							$tot = "0";
while($irow = $iresult->fetch_assoc()) {
$tot = ($irow["quantity"] * $irow["rate"] );
$gtot = ($gtot + $tot);
?>				
                        <tbody>
                          <tr>
                            <td><?php echo $irow["item"] ?></td>
                            <td><?php echo $irow["quantity"] ?></td>
                            <td><?php echo $irow["unit"] ?></td>
                            <td><?php echo $irow["rate"] ?></td>
							<td><?php echo $tot ?></td>
                          </tr>
                         <?php
						 }
						 ?>
						    <tr>
                            <td><font color="yellow"><strong>TOTAL</strong></font></td>
                            <td></td>
                            <td></td>
                            <td></td>
							<td><font color="yellow"><strong><?php echo $gtot ?><strong></font></td>
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

<script type="text/javascript">
  $(function() {
     $( "#search" ).autocomplete({
       source: 'ajax-db-search.php',
     });
  });
</script>

<script type="text/javascript">
  $(function() {
     $( "#searchitem" ).autocomplete({
       source: 'ajax-db-search-item.php',
     });
  });
</script>
 <?php
   include 'footer1.inc';
   ?>
         