<?php
include 'head.inc';
include 'connection.php';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$comid = $_REQUEST['comid'];

$csql ="select * from Complaints where compid='$comid'";
$cresult = $con->query($csql);
$crow = $cresult->fetch_assoc();
$cid = $crow["cid"];

$cmid = "select * from Customers where cid='$cid'";
$cmidresult = $con->query($cmid);
$csrow = $cmidresult->fetch_assoc();

$cmid = $cmidrow["compid"];

$psub = $_REQUEST['add'];
if ($psub) {
$prt = $_REQUEST['part'];
$qty = $_REQUEST['qty'];
$comid = $_REQUEST['comid'];
$pst = "In process";
$rt = "0";

$psql = "INSERT INTO parts(compid, cid, parts, qty, user, crdate, status, pstatus) VALUES ('$comid', '$cid', '$prt', '$qty' ,'$user' ,'$cdate' ,'$st' ,'$pst')";
if(mysqli_query($con, $psql)){
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

$esql = "INSERT INTO estimates(compid, cid, item, qty, rate, total, crdate, user, status) VALUES ('$comid', '$cid', '$prt', '$qty' ,'$rt', '$rt', '$cdate', '$user', '$st')";
if(mysqli_query($con, $esql)){
$msg = "Part requested given successfully";
   // echo "Records added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

//admin email started

$sqr1 = "select * from Company where status='$st' order by srno desc limit 1";
//echo $sqr;
$sqrresult1 = $con->query($sqr1);
$qryrow1 = $sqrresult1->fetch_assoc();

$to = $qryrow1["email"];
$subject = "Parts request received";

$body1 .= " \n "
."Dear ".$qryrow1['contact']." ,<br /><br />\n "." \n "
."Parts request received from .".$user ." Please check and process further <br /><br />\n "." \n "
."<table><tr><td>Complaint ID :</td><td> ".$crow['compid']." </td></tr>\r\n "
."<tr><td>Customer Name :</td><td> ".$crow['cname'] ." </td></tr>\r\n "
//."<tr><td>Email : </td><td>".$crow['type'] ." </td></tr>\r\n "
."<tr><td>Product Catagory :</td><td> ".$crow['type'] ." </td></tr>\r\n "
."<tr><td>Brand : </td><td>".$crow['brand'] ." </td></tr>\r\n "
."<tr><td>Model. : </td><td>".$crow['model'] ." </td></tr>\r\n "
."<tr><td>Complaint :</td><td> ".$crow['complaint'] ." </td></tr>\r\n "
."<tr><td>Visit Remark :</td><td> ".$vr ." </td></tr>\r\n "
//."Version : ".$cmidrow['Version'] ." \n "
//."Renwal Date : ".cmid$row['Renewal']. "\n"
."<tr><td>&nbsp;\n". "\n". " ". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Thanks". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Admin (ABC Service)". "</td></tr></table>\n";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <shinemon40@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$body1,$headers);

//admin email ended



}
?>
  <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
				<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
    <h4><strong>Request Parts</strong></h4>
	<?php
	if ($msg) {
	?>
	<font color="red"><?php echo $msg ?></font>
	<?php	
	}
	?>
<?php
$sub = $_REQUEST['search'];
if ($sub) {
?>
<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row" >
                          <label class="col-sm-3 col-form-label">Comp. ID</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $comid ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Customer ID</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["cid"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>

					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Name</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $cname; ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Firm Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["bname"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address1</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $csrow["add1"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address2</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["add2"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	

					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $csrow["city"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["state"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	


					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">PinCode</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $csrow["pincode"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["country"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	

					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $csrow["phone"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["email"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	
					
					
					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $csrow["mobile"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Refferd By</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $csrow["reff"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	
					
					
					<h4>
                     Ticket Details
                    </h4>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Ticket Type</label>
                          <div class="col-sm-9">
                           <select name="type" class="form-control form-control-sm" readonly >
							<option value="Warranty">Warranty</option>
							<option value="Out of Warranty">Out of Warranty</option>
							<option value="Stock Damage">Stock Damage</option>
						   </select>
                          </div>
                        </div>
                      </div>
					     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Catagory</label>
                          <div class="col-sm-9">
                            <select name="pcat" class="form-control form-control-sm" readonly >
							<?php
$st = "Active";
$sql = "SELECT * FROM catgaory where status='$st' order by pcat";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
?>
<option value="<?php echo $row["pcat"] ?>"><?php echo $row["pcat"] ?></option>
<?php
}
?>
							</select>
                          </div>
                        </div>
                      </div>
					     </div>	
					  
					  
					  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Brand</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $crow["brand"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Model</label></label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $crow["model"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	
					  <div class="row">
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Complaint in Breif</label>
                          <div class="col-sm-9">
                            <textarea name="complaint" rows="4" cols="27" disabled><?php echo $crow["complaint"] ?><?php echo $crow["complaint"] ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
<hr>
<form method="get" action="">
<input type="hidden" name="comid" value="<?php echo $comid ?>"></input>
<input type="hidden" name="cid" value="<?php echo $cid ?>"></input>
<input type="hidden" name="search" value="search">
<input type="hidden" name="add" Value="Request Parts">
    <h4><strong>Parts Request</strong></h4>
	<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Parts</label>
							<div class="col-sm-9">
                            <input type="text" name="part" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Quantity</label></label>
                          <div class="col-sm-9">
                            <input type="text" name="qty" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
                    </div>	
<p align="center"><button type="submit" class="btn btn-primary mr-2">Submit</button></input></p>

</table>
</form>
<?php
}
?>
<br />

</form>
    </div>
  </div>
   </div>
   </div>
   </div>
 <?php
   include 'footer.inc';
   ?>
 