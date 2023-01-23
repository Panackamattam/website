<?php
include 'head.inc';
include 'gstconnection.php';
?>
	 
	 <div class="main-panel">
          <div class="content-wrapper">
                           <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Select Company</h4>
                    <p class="card-description"> 
					<div class="table-responsive">
					<form method="get" action="">
                      <table class="table table-bordered">
                          <tr>
                           <td><input type="text" name="item" class="form-control" id="searchcus" placeholder="Select Company" /></td>
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
					$st = "Active";
					$cname = $_REQUEST['item'];
					
					$sql0 = "select * from gstopbalance where hname='$cname' and status='$st'";
					$result0 = $con->query($sql0);
					if ($result0->num_rows > 0) {
					$row0 = $result0->fetch_assoc();
					$tdt = $row0["tdate"];
					$dsc = "Opening Balance";
					$tmd = $row0["opstatus"];
					$am = $row0["amount"];
					$inst = "INSERT INTO ledger(tdate, cname, description, tmode, amt, ttype) VALUES ('$tdt','$cname','$dsc','$dsc','$am','$tmd')";
					if(mysqli_query($con, $inst)){
			//echo "Records added successfully.";
						} else{
			//echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
							}
					
					}
					
					
					
					$sql = "select * from gstinvdetails where cname='$cname' and status='$st'";
					$result = $con->query($sql);
					if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc())
					{
					$tdate = $row["invdate"];
					$des = "Sales Invoice"." ".$row["invno"];
					$tmode = "Sales";
					$invno = $row["invno"];
					$type = "Debit";
						$sql1 = "select * from gstinvoice where invno='$invno' and status='$st'";
						$result1 = $con->query($sql1);
						if ($result1->num_rows > 0) {
						$amt = "0";
						while($row1 = $result1->fetch_assoc())	{
						$amt = ($amt + $row1["total"] + $row1["cgst"] + $row1["igst"] + $row1["sgst"]);
						}
						}
					$ins = "INSERT INTO ledger(tdate, cname, description, tmode, amt, ttype) VALUES ('$tdate','$cname','$des','$tmode','$amt','$type')";
										if(mysqli_query($con, $ins)){
			//echo "Records added successfully.";
						} else{
			//echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
							}
					}
					
					}
					
					//****PURCHASE
					
					$psql = "select * from gstpurdetails where vname='$cname' and invstatus='$st'";
					$presult = $con->query($psql);
					if ($presult->num_rows > 0) {
					while($prow = $presult->fetch_assoc())
					{
					$ptdate = $prow["invdate"];
					$pdes = "Purchase Invoice-"." ".$prow["invno"];
					$ptmode = "Purchase";
					$pinvno = $prow["invno"];
					$ptype = "Credit";
						$psql1 = "select * from gstpurchase where vinvno='$pinvno' and status='$st'";
						$presult1 = $con->query($psql1);
						if ($presult1->num_rows > 0) {
						$pamt = "0";
						while($prow1 = $presult1->fetch_assoc())	{
						$pamt = ($pamt + $prow1["total"] + $prow1["cgst"] + $prow1["igst"] + $prow1["sgst"]);
						}
						}
					$pins = "INSERT INTO ledger(tdate, cname, description, tmode, amt, ttype) VALUES ('$ptdate','$cname','$pdes','$ptmode','$pamt','$ptype')";
										if(mysqli_query($con, $pins)){
			//echo "Records added successfully.";
						} else{
			//echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
							}
					}
					
					}
					
					//****PURCHASE
					
					$sql2 = "select * from gstpayment where cname='$cname' and status='$st'";
					$result2 = $con->query($sql2);
					if ($result2->num_rows > 0) {
					while($row2 = $result2->fetch_assoc()){
					$tdate1 = $row2["vdate"];
					$des1 = $row2["remark"];
					$tmode1 = $row2["bankcash"];
					$type1 = $row2["crdr"];
					$amt1 = $row2["amount"];
					
					$ins1 = "INSERT INTO ledger(tdate, cname, description, tmode, amt, ttype) VALUES ('$tdate1','$cname','$des1','$tmode1','$amt1','$type1')";
						if(mysqli_query($con, $ins1)){
			//echo "Records added successfully.";
						} else{
			//echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
							}
					}
					
					
					}
					
					$sql4 = "select * from ledger where cname='$cname' order by tdate";
					$result4 = $con->query($sql4);
					if ($result4->num_rows > 0) {
					
					
				//echo "shine";
					?>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Particulars</th>
                            <th>Voucher Type</th>
							<th>Voucher No.</th>
                            <th>Debit</th>
							<th>Credit</th>
                          </tr>
                        </thead>
						<?php
						$tot = "0";
						while($srow = $result4->fetch_assoc()) {
						?>
                        <tbody>
                          <tr class="table">
                            <td><?php echo $srow["tdate"] ?></td>
                            <td><?php echo $srow["description"] ?></td>
                            <td><?php echo $srow["tmo"] ?></td>
							<td><?php echo $srow["unit"] ?></td>
							<?php
							if ($srow["ttype"] == "Debit") {
							$dtotal = $dtotal + $srow["amt"];
							?>
                            <td align="right"><?php echo $srow["amt"] ?></td>
							 <td></td>
							<?php
							}
							else
							{
							$ctotal = $ctotal + $srow["amt"];
							?>
							 <td></td>
                            <td align="right"><?php echo $srow["amt"] ?></td>
							<?php
							}
							?>
                          </tr>
<?php
}
?>
						    <tr class="table">
                            <td>TOTAL</td>
                            <td></td>
                            <td></td>
                            <td></td>
							<td align="right"><?php echo $dtotal; ?></td>
                            <td align="right"><?php echo $ctotal; ?></td>
                          </tr>
						  <?php
						  if ($dtotal > $ctotal) {
						  $drdiff = $dtotal - $ctotal;
						  }
						  else
						  {
						  $crdiff = $ctotal - $dtotal;
						  }
						  ?>
						  	<tr class="table">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
							<td align="right"><font color="red"><?php echo $crdiff; ?></font></td>
                            <td align="right"><font color="red"><?php echo $drdiff; ?></td>
                          </tr>
						  <?php
						  $gdrt = $dtotal + $crdiff;
						  $gcrt = $ctotal + $drdiff;
						  ?>
						  	<tr class="table">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
							<td align="right"><?php echo $gdrt; ?></td>
                            <td align="right"><?php echo $gcrt; ?></td>
                          </tr>
						  
						  
                        </tbody>
                      </table>
                    </div>
					<?php
					}
					$del1 = "DELETE FROM ledger";
					if(mysqli_query($con, $del1)){
			//echo "Records added successfully.";
					} else{
			//echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);
							}
					
					}
										?>
                  </div>
                </div>
              </div>

					
                  </div>
                </div>
              </div>
			
<script type="text/javascript">
  $(function() {
     $( "#searchcus" ).autocomplete({
       source: 'ajax-db-searchcus.php',
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