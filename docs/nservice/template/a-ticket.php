<?php
include 'head.inc';
include 'connection.php';

//$con =mysqli_connect("localhost","attinqst","9zYs%#*Es6vG4!3~","attinqst_service");
if($con){
//echo "Connected Sucessfully";
}
else{
//echo "Not Connected";
}
//mysqli_close($con);

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$cid = $_REQUEST['cus'];
$comid = $_REQUEST['comid'];

$cidsql = "select * from Complaints where compid='$comid'";
$cidresult = $con->query($cidsql);
$cidrow = $cidresult->fetch_assoc();
$comid = $cidrow["compid"];
$cid = $cidrow["cid"];
$tec = $cidrow["asained"];


$idsql ="select * from Customers where cid='$cid'";
$idresult = $con->query($idsql);
$idrow = $idresult->fetch_assoc();

$cname = $idrow["fname"]." ". $idrow["lname"];

$sub = $_REQUEST['asub'];
if ($sub){
$as = $_REQUEST['tec'];

$sql3 = "update Complaints set asained='$as' where compid='$comid'";
if(mysqli_query($con, $sql3)){
   // echo "Records updated successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}


//customer email started

$sqr1 = "select * from Company where status='$st' order by srno desc limit 1";
//echo $sqr;
$sqrresult1 = $con->query($sqr1);
$qryrow1 = $sqrresult1->fetch_assoc();

$sqr2 = "select * from users where Name='$user'";
//echo $sqr;
$sqrresult2 = $con->query($sqr2);
$qryrow2 = $sqrresult2->fetch_assoc();

$to = $idrow["email"];
$subject = "Your Complaint assigned to technician";

$body .= " \n "
."Dear ".$cname." ,<br /><br />\n "." \n "
."Your complaint assiged to our technician. Details are as follows.<br /><br />\n "." \n "
."<table><tr><td>Complaint ID :</td><td> ".$cidrow['compid']." </td></tr>\r\n "
."<tr><td>Customer Name :</td><td> ".$cidrow['cname'] ." </td></tr>\r\n "
."<tr><td>Address :</td><td> ".$idrow['add1'] ." </td></tr>\r\n "
."<tr><td>Address :</td><td> ".$idrow['add2'] ." </td></tr>\r\n "
."<tr><td>City :</td><td> ".$idrow['city'] ." </td></tr>\r\n "
."<tr><td>Mobile :</td><td> ".$idrow['mobile'] ." </td></tr>\r\n "
."<tr><td>Email :</td><td> ".$idrow['email'] ." </td></tr>\r\n "
//."<tr><td>Email : </td><td>".$crow['type'] ." </td></tr>\r\n "
."<tr><td>Complaint type :</td><td> ".$cidrow['type'] ." </td></tr>\r\n "
."<tr><td>Product Catagory :</td><td> ".$cidrow['cat'] ." </td></tr>\r\n "
."<tr><td>Brand : </td><td>".$cidrow['brand'] ." </td></tr>\r\n "
."<tr><td>Model. : </td><td>".$cidrow['model'] ." </td></tr>\r\n "
."<tr><td>Complaint :</td><td> ".$cidrow['complaint'] ." </td></tr>\r\n "
."<tr><td>&nbsp;</td><td></td></tr>\r\n "
."<tr><td><strong>Technician Name :</td><td> ".$qryrow2['Name'] ." </td></tr>\r\n "
."<tr><td><strong>Mobile Number :</td><td> ".$qryrow2['mobile'] ." </td></tr>\r\n "

//."<tr><td>Visit Remark :</td><td> ".$vr ." </td></tr>\r\n "
//."Version : ".$cmidrow['Version'] ." \n "
//."Renwal Date : ".cmid$row['Renewal']. "\n"
."<tr><td>&nbsp;\n". "\n". " ". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Thanks". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Admin <br />". $qryrow1["companyname"] . "</td></tr></table>\n";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <shinemon40@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$body,$headers);

//customer email ended

//admin email started

$sqr1 = "select * from Company where status='$st' order by srno desc limit 1";
//echo $sqr;
$sqrresult1 = $con->query($sqr1);
$qryrow1 = $sqrresult1->fetch_assoc();

$sqr2 = "select * from users where Name='$user'";
//echo $sqr;
$sqrresult2 = $con->query($sqr2);
$qryrow2 = $sqrresult2->fetch_assoc();

$to = $qryrow2["email"];
$subject = "New complaint assigned to you";

$body1 .= " \n "
."Dear ".$qryrow2['Name']." ,<br /><br />\n "." \n "
."A new complaint assigned to you. Details are as follows.<br /><br />\n "." \n "
."<table><tr><td>Complaint ID :</td><td> ".$cidrow['compid']." </td></tr>\r\n "
."<tr><td>Customer Name :</td><td> ".$cidrow['cname'] ." </td></tr>\r\n "
."<tr><td>Address :</td><td> ".$idrow['add1'] ." </td></tr>\r\n "
."<tr><td>Address :</td><td> ".$idrow['add2'] ." </td></tr>\r\n "
."<tr><td>City :</td><td> ".$idrow['city'] ." </td></tr>\r\n "
."<tr><td>Mobile :</td><td> ".$idrow['mobile'] ." </td></tr>\r\n "
."<tr><td>Email :</td><td> ".$idrow['email'] ." </td></tr>\r\n "
//."<tr><td>Email : </td><td>".$crow['type'] ." </td></tr>\r\n "
."<tr><td>Complaint type :</td><td> ".$cidrow['type'] ." </td></tr>\r\n "
."<tr><td>Product Catagory :</td><td> ".$cidrow['cat'] ." </td></tr>\r\n "
."<tr><td>Brand : </td><td>".$cidrow['brand'] ." </td></tr>\r\n "
."<tr><td>Model. : </td><td>".$cidrow['model'] ." </td></tr>\r\n "
."<tr><td>Complaint :</td><td> ".$cidrow['complaint'] ." </td></tr>\r\n "
//."<tr><td>Visit Remark :</td><td> ".$vr ." </td></tr>\r\n "
//."Version : ".$cmidrow['Version'] ." \n "
//."Renwal Date : ".cmid$row['Renewal']. "\n"
."<tr><td>&nbsp;\n". "\n". " ". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Thanks". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Admin <br />". $qryrow1["companyname"] . "</td></tr></table>\n";

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
    <h4><strong>Assign ticket to technician</strong></h4>
	  <?php
  if ($sub){
  $msg= "Successfully assigned ticket to technician";
  ?>
  <font color="red"><?php echo $msg ?></font>
  <?php
  }
  ?>
<?php
$sub = $_REQUEST['search'];
if ($sub) {
?>
<form method="get" action="">
<input type="hidden" name="cus" value="<?php echo $cid ?>">	
<input type="hidden" name="comid" value="<?php echo $comid ?>"></input>
<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
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
                            <input type="text" name="lname" value="<?php echo $idrow["cid"] ?>" class="form-control form-control-sm" disabled />
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
                            <input type="text" name="lname" value="<?php echo $idrow["bname"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>
					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address1</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $idrow["add1"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address2</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $idrow["add2"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	

					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $idrow["city"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $idrow["state"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	


					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">PinCode</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $idrow["pincode"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $idrow["country"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	

					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $idrow["phone"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $idrow["email"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	
					
					
					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile</label>
							<div class="col-sm-9">
                            <input type="text" name="fname" value="<?php echo $idrow["mobile"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Refferd By</label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $idrow["reff"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	
					
<br />
    <h4><strong>Complaint Details</strong></h4>
	<br />
	<?php
	$stat = "Active";
$te = "technician";
$sq51 = "select * from users where status='$stat' and role='$te'";
//echo $sq51;
$resultu = $con->query($sq51);
?>
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
                            <input type="text" name="fname" value="<?php echo $cidrow["brand"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Model</label></label>
                          <div class="col-sm-9">
                            <input type="text" name="lname" value="<?php echo $cidrow["model"] ?>" class="form-control form-control-sm" disabled />
                          </div>
                        </div>
                      </div>
                    </div>	
					  <div class="row">
					<div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Complaint in Breif</label>
                          <div class="col-sm-9">
                            <textarea name="complaint" rows="4" cols="27" disabled><?php echo $cidrow["complaint"] ?><?php echo $crow["complaint"] ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
					

<h4>Select Technician</h4>
					  <div class="row">
					     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Assign Tech.</label>
                          <div class="col-sm-9">
                            <select name="tec" class="form-control form-control-sm">
<?php
while($rowu = $resultu->fetch_assoc()) {
?>
<option value="<?php echo $rowu["Name"] ?>" <?php if ($rowu["Name"] == $as){ echo "selected"; }?>><?php echo $rowu["Name"] ?></option>
<?php
}
?>
</select>
</div>
</div>
</div>
</div>
<p align="center"><input type="hidden" name="asub" value="Assign Ticket"></input><input type="hidden" name="search" Value="Update"><button type="submit" class="btn btn-primary mr-2">Submit</button></input></p>

<br />
</form>
<?php
}
?>
</div>
</div>
</div>
</div>
</div>
 <?php
   include 'footer.inc';
   ?>

