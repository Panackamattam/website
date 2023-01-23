<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
?>
<p align="center">&nbsp;&nbsp;&nbsp;<a href="customers.php" class="button6">Create Customer</a></button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="editcustomers.php" class="button6">Edit Customers</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="listcustomers.php" class="button6">List Customers</a>&nbsp;&nbsp;</p>
<form method="get" action="">
<hr>
  <div class="w3-container">
    <h4><strong>Create customer & ticket</strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
	  
	  <p>Customer:<select name="cus">

<?php
$st = "Active";
$sql = "SELECT * FROM Customers where status='$st' order by fname";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
$cname = $row["fname"]." ".$row["lname"];
?>
<option value="<?php echo $row["cid"] ?>"><?php echo $cname ?></option>
<?php
}
?></select>
	     <button type="submit" name="sub" value="Search" class="w3-button w3-green w3-third">Search</button></p>
		 </form>
		 
<p>&nbsp;</p>

<form method="get" action="ucustomer.php">
<?php
$up = $_REQUEST['sub'];
if ($up) {
$cd = $_REQUEST['cus'];
$sql1 = "select * from Customers where cid='$cd'";
$result1 = $con->query($sql1);
$row1 = $result1->fetch_assoc();
?>  
	  
		<p><i class="fa fa-fw fa-male"></i> First Name: <input type="text" name="fname" size="25" value="<?php echo $row1["fname"] ?>" readonly></p>
        <p><i class="fa fa-fw fa-male"></i> Last Name: <input type="text" name="lname" size="25" value="<?php echo $row1["lname"] ?>" readonly></p>
        <p><i class="fa fa-fw fa-building"></i> Business Name: <input type="text" name="bname" size="25"  value="<?php echo $row1["bname"] ?>"></input></p>
		<p><i class="fa fa-fw fa-address-book"></i> Address1: <input type="text" name="add1" size="25"  value="<?php echo $row1["add1"] ?>"></input></p>
		<p><i class="fa fa-fw fa-address-book"></i>Address2: <input type="text" name="add2" size="25"  value="<?php echo $row1["add2"] ?>"></input></p>
        <p><i class="fa fa-fw fa-address-book"></i>City: <input type="text" name="city" size="25"  value="<?php echo $row1["city"] ?>"></input></p>
        <p><i class="fa fa-fw fa-address-book"></i>State: <input type="text" name="state" size="25"  value="<?php echo $row1["state"] ?>"></input></p>
		<p><i class="fa fa-fw fa-address-book"></i>Pincode: <input type="text" name="pin" size="25"  value="<?php echo $row1["pincode"] ?>"></input></p>
		<p><i class="fa fa-fw fa fa-phone"></i>Phone: <input type="text" name="phone" size="25"  value="<?php echo $row1["phone"] ?>"></input></p>
		<p><i class="fa fa-fw fa fa-mobile-phone"></i>Mobile: <input type="text" name="mobile" size="25"  value="<?php echo $row1["mobile"] ?>"></input></p>
        <p><i class="fa fa-fw fa-envelope"></i>Email: <input type="text" name="email" size="25"  value="<?php echo $row1["email"] ?>"></input></p>
        <p><i class="fa fa-fw fa-male"></i>Reffered By: <input type="text" name="reff" size="25"  value="<?php echo $row1["reff"] ?>"></input></p>
		    <hr>
			    				    

     <div class="w3-container" id="contact">
	     <button type="submit" class="w3-button w3-green w3-third">Update Details</button>
		 </div>
		 </form>
		 <?php
		 }
		 ?>
      </div>
    </div>		
	<hr>
  <br /><br /><br /><br />
 <?php
 include 'footer.inc';
 ?>

