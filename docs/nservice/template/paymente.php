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
			
			
			$vid = $_REQUEST['vno'];
			$vdate = $_REQUEST['vdate'];
			$acc = $_REQUEST['cityname'];
			$bc = $_REQUEST['bc'];
			$amt = $_REQUEST['amt'];
			$rem = $_REQUEST['rem'];
			$ttype = $_REQUEST['ttype'];
			$crdr = "Debit";
			
			$sql1 = "select * from gstvendor where vname='$acc' and status='$st'";
			$result = $con->query($sql1);
			$row = $result->fetch_assoc();
			$comid = $row["vid"];
			
			$sql = "INSERT INTO gstpayment(comid, cname, voucherno, vdate, account, achead, bankcash, amount, remark, status, crby, crdate, transtype,crdr) VALUES ('$comid','$acc','$vid','$vdate','$acc','$acc','$bc','$amt','$rem','$st','$user','$cdate','$ttype','$crdr')";
					if(mysqli_query($con, $sql)){
			//echo "Records added successfully.";
			} else{
			//echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
			}
			
			if ($bc == "Cash") {
			
			$csql = "INSERT INTO cashbook(date, trasaction, amount, crdr, status,crby,crdate) VALUES ('$cdate','$rem','$amt','$crdr','$st','$cdate','$user')";
			if(mysqli_query($con, $csql)){
			//echo "Records added successfully.";
			} else{
			//echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
			}			
			}
			else
			{
			$csql = "INSERT INTO bankbook(date, transaction, amount, crdr, status,crby,crdate) VALUES ('$cdate','$rem','$amt','$crdr','$st','$user','$cdate')";
			
			//INSERT INTO `bankbook`(`id`, `date`, `transaction`, `amount`, `crdr`, `status`, `crby`, `crdate`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])
			if(mysqli_query($con, $csql)){
			//echo "Records added successfully.";
			} else{
			//echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
			}
			}
			
			$msg = "Item Added Successfully !";
			
			}
			
			?>
			
		  <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Payment Entry <?php if ($msg) { echo "-".$msg; }?></h4>
                    <form class="form-sample" method="get" action="">
                      <p class="card-description">&nbsp;</p>
			
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Voucher No.</label>
                            <div class="col-sm-9">
                              <input type="text" name="vno" value="<?php echo $invno; ?>" class="form-control" />
							  <input type="hidden" name="ttype" value="Payment" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                              <input type="date" name="vdate" value="<?php echo $invdate; ?>"class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
					  <hr color="black">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Accounts</label>
                            <div class="col-sm-9">
 <input type="text" name="cityname" id="searchac" placeholder="search here...." value="" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Bank/Cash</label>
                            <div class="col-sm-9">
                              <input type="text" name="bc" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Amount</label>
                            <div class="col-sm-9">
                              <input type="text" name="amt" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remark</label>
                            <div class="col-sm-9">
                              <input type="text" name="rem" value="" class="form-control" />
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
     $( "#searchac" ).autocomplete({
       source: 'ajax-db-searchac.php',
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
         