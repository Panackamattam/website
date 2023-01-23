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
			
				$qry = "select * from gstinvdetails order by invno desc limit 1";
				$sre = $con->query($qry);
				if ($sre->num_rows > 0) {
				$row = $sre->fetch_assoc();
				$invno = ($row["invno"] + 1);
				}
				else
				{
				$invno = "1";
				}
				
				$sub = $_REQUEST['submit'];
				if ($sub)
				{
				$btype = $_REQUEST['btype'];
				$invno = $_REQUEST['invno'];
				//$indate = $_REQUEST['invdate'];
				$indate = date('Y-m-d');
				$z = "0";
				$cur = "INR";
				
				$cname= $_REQUEST['cname'];
				
				$qry3 = "select * from gstinvdetails where invno='$invno'";
				$sre3 = $con->query($qry3);	
				if ($sre3->num_rows > 0) {
				
				}
				else
				{				
				$inst = "INSERT INTO gstinvdetails(cname, invno, invdate, totalamount, curr, billtype, crby, crdate, status) VALUES ('$cname','$invno','$indate','$z','$cur', '$btype', '$user','$cdate','$st')";
				if(mysqli_query($con, $inst)){
				//echo $inst;
				//echo "Records added successfully.";
				//$msg = "Catagory added successfully.";
				} else{
				echo "ERROR: Could not able to execute $inst. " .mysqli_error($con);
				}
				}
				
				$item = $_REQUEST['item'];
				$qty = $_REQUEST['qty'];
				$rate = $_REQUEST['rate'];
				//$tot = ($qty * $rate);
				$z = "0";
				
				//stock deduction
					$qry6 = "select * from gststock where item='$item' order by sid";
					$sre6 = $con->query($qry6);	
					$sqty = "0";
					while($row6 = $sre6->fetch_assoc()) {
					$sqty = ($row6["balqty"] + $sqty);
					}
					if ($sqty < $qty) {
					//echo '<script>alert("No enough quantity to bill this item")</script>';
					echo '<script type="text/javascript">';
					echo ' alert("No enough quantity in stock to bill this item")';  //not showing an alert box.
					echo '</script>';
					}
					else
					{
					$qry5 = "select * from gststock where item='$item' and balqty>'$z'  order by sid";
					$sre5 = $con->query($qry5);	
					while($row5 = $sre5->fetch_assoc()) {
					if ($qty > 0 ) {
						if ($row5["balqty"] >= $qty ) {
						$invqty = $qty;
						
					//deduct qty from balance qty, balance qty > then inv qty
						$bqty = ($row5["balqty"] - $qty);
						$sid = $row5["sid"];
						$uqry = "update gststock set balqty='$bqty' where sid='$sid'";
						if(mysqli_query($con, $uqry)){
						//echo "Records added successfully.";
						//$msg = "Catagory added successfully.";
						} else{
						echo "ERROR: Could not able to execute $uqry. " .mysqli_error($con);
						}
						
						$unit = $row5["unit"];
						
						$qry1 = "select * from gstinventory where item='$item'";
						$sre1 = $con->query($qry1);		
						$row1 = $sre1->fetch_assoc();
				
						$hsn = $row1["hsncode"];
						$trate = $row1["taxschedule"];
						//echo $trate;
						$qry2 = "select * from gsttaxes where taxrate='$trate'";
						$sre2 = $con->query($qry2);		
						$row2 = $sre2->fetch_assoc();
						
						$tot = ($invqty * $rate);
						
						$cgst = $row2["cgst"];
						$cgst = ($cgst / 100) * $tot;
						$sgst = $row2["sgst"];
						$sgst = ($sgst / 100) * $tot;
						$cess = "0";
						//$cess = ($cess / 100) * $tot;
						
						//echo $cgst;
												
						$inst1 = "INSERT INTO gstinvoice(invno, invdate, item, hsncode, qty, unit, rate, curr, total, taxrate, billtype, cgst, sgst, igst, cess, crby, crdate, status, stockid) VALUES ('$invno','$indate','$item','$hsn','$invqty','$unit', '$rate','$cur','$tot', '$trate', '$btype', '$cgst','$sgst','$z','$cess','$user','$cdate','$st', '$sid')";
						//echo $inst1;
						if(mysqli_query($con, $inst1)){
						//echo "Records added successfully.";
						//$msg = "Catagory added successfully.";
						} else{
						echo "ERROR: Could not able to execute $inst1. " .mysqli_error($con);
						}
						$qty = "0";					
						
						}
						else
						{
						$invqty = $row5["balqty"];
						$tot = ($invqty * $rate);
						$unit = $row5["unit"];
						//deduct qty from balance qty, balance qty > then inv qty
						$bqty = "0";
						$sid = $row5["sid"];
						$uqry1 = "update gststock set balqty='$bqty' where sid='$sid'";
						if(mysqli_query($con, $uqry1)){
						//echo "Records added successfully.";
						//$msg = "Catagory added successfully.";
						} else{
						echo "ERROR: Could not able to execute $uqry1. " .mysqli_error($con);
						}
						
						$qry1 = "select * from gstinventory where item='$item'";
						$sre1 = $con->query($qry1);		
						$row1 = $sre1->fetch_assoc();
				
						$hsn = $row1["hsncode"];
						$trate = $row1["taxschedule"];
						//echo $trate;
						$qry2 = "select * from gsttaxes where taxrate='$trate'";
						$sre2 = $con->query($qry2);		
						$row2 = $sre2->fetch_assoc();
				
						$cgst = $row2["cgst"];
						$cgst = ($cgst / 100) * $tot;
						$sgst = $row2["sgst"];
						$sgst = ($sgst / 100) * $tot;
						$cess = "0";
						//$cess = ($cess / 100) * $tot;
						
						$inst2 = "INSERT INTO gstinvoice(invno, invdate, item, hsncode, qty, unit, rate, curr, total, taxrate, billtype, cgst, sgst, igst, cess, crby, crdate, status, stockid) VALUES ('$invno','$indate','$item','$hsn','$invqty', '$unit', '$rate','$cur','$tot', '$trate', '$btype', '$cgst','$sgst','$z','$cess','$user','$cdate','$st', '$sid')";
						//echo $inst1;
						if(mysqli_query($con, $inst2)){
						//echo "Records added successfully.";
						//$msg = "Catagory added successfully.";
						} else{
						echo "ERROR: Could not able to execute $inst2. " .mysqli_error($con);
						}
						$qty = ($qty - $row5["balqty"]);
						}
					}
					}
				
			
				
				}
				}
			?>
			
			<div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create Bill</h4>
                    <form  class="forms-sample" method="get" action="">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Customer Name</label>
                        <input type="text" name="cname" id="cname" value="<?php echo $cname; ?>" class="form-control" <?php if ($cname) {echo "readonly";} ?>/>
						<input type="hidden" name="btype" value="Wholesale"></input>
                      </div>
						<div class="form-group">
                        <label for="exampleInputEmail1">Invoice # and date</label>
                        <input type="text" name="invno" class="form-control"  value="<?php echo $invno; ?>" readonly />
                      </div>
					  
                    <div class="form-group">
                        <label for="exampleInputEmail1">Item</label>
						<input type="text" name="item" id="user_id" class='form-control' autofocus="autofocus" placeholder="Enter user id" onkeyup="GetDetail(this.value)" value="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Quantity</label>
                        <input type="text" name="qty" id="qty" class="form-control" />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Rate/Pc</label>
                        <input type="text" name="rate" id="srate" class="form-control"  />
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
			
			$sql1 = "select * from gstinvoice where invno='$invno' and status='$st'";
			$result = $con->query($sql1);
			
			?>
			
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
  <h4 class="card-title">Bill details&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <button type="button" class="btn btn-sm bg-white btn-icon-text border ml-3"><a href="printbill.php?invno=<?php echo $invno ?>">
                  <i class="mdi mdi-printer btn-icon-prepend"></i> Print </button></a></h4>
					<?php
					if ($result->num_rows > 0) {
					?>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
						  
                            <td>Item</td>
                            <td>Qty</td>
							<td>Unit</td>
                            <td>Rate</td>
                            <td align="right">Total</td>
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
                            <td><?php echo substr($row["item"], 0, 10); ?></td>
                            <td align="center"><?php echo $row["qty"]; ?></td>
							<td><?php echo $row["unit"]; ?></td>
                            <td><?php echo $row["rate"]; ?></td>
                            <td align="right"><?php echo $row["total"]; ?></td>
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
						  						  <tr>
                            <td></td>
                            <td></td>
									<td></td>
                            <td>CGST</td>
                            <td align="right"><?php echo $cgst1; ?></td>
                          </tr>

						  						  <tr>
                            <td></td>
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
 <script>

		// onkeyup event will occur when the user
		// release the key and calls the function
		// assigned to this event
		function GetDetail(str) {
			if (str.length == 0) {
				document.getElementById("srate").value = "";
				document.getElementById("qty").value = "";
				return;
			}
			else {

				// Creates a new XMLHttpRequest object
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function () {

					// Defines a function to be called when
					// the readyState property changes
					if (this.readyState == 4 &&
							this.status == 200) {
						
						// Typical action to be performed
						// when the document is ready
						var myObj = JSON.parse(this.responseText);

						// Returns the response data as a
						// string and store this array in
						// a variable assign the value
						// received to first name input field
						
						document.getElementById("srate").value = myObj[0];
						
						// Assign the value received to
						// last name input field
						document.getElementById("qty").value = myObj[1];
					}
				};

				// xhttp.open("GET", "filename", true);
				xmlhttp.open("GET", "gfg.php?user_id=" + str, true);
				
				// Sends the request to the server
				xmlhttp.send();
			}
		}
	</script>

	<script type="text/javascript">
  $(function() {
     $( "#cname" ).autocomplete({
       source: 'ajax-db-search-customer.php',
     });
  });
</script>

<script type="text/javascript">
  $(function() {
     $( "#user_id" ).autocomplete({
       source: 'ajax-db-search-item-stock.php',
     });
  });
</script>

<?php
			include 'footer1.inc';
			?>
			
  </body>
</html>
