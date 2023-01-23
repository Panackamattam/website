<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
//include 'Insert/cutsomer.inc';
?>
 <?php
include 'Insert/customer.inc';
?>
<form method="get" action="ticketd.php">
  <div class="w3-container">
    <h4><strong>Create customer & ticket</strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
   <p><i class="fa fa-fw fa-male"></i> First Name: <input type="text" name="fname" size="25" required></p>
        <p><i class="fa fa-fw fa-male"></i> Last Name: <input type="text" name="lname" size="25" required></p>
        <p><i class="fa fa-fw fa-building"></i> Business Name: <input type="text" name="bname" size="25"></input></p>
		<p><i class="fa fa-fw fa-address-book"></i> Address1: <input type="text" name="add1" size="25"></input></p>
		<p><i class="fa fa-fw fa-address-book"></i>Address2: <input type="text" name="add2" size="25"></input></p>
        <p><i class="fa fa-fw fa-address-book"></i>City: <input type="text" name="city" size="25"></input></p>
        <p><i class="fa fa-fw fa-address-book"></i>State: <input type="text" name="state" size="25"></input></p>
		<p><i class="fa fa-fw fa-address-book"></i>Pincode: <input type="text" name="pin" size="25"></input></p>
		<p><i class="fa fa-fw fa fa-phone"></i>Phone: <input type="text" name="phone" size="25"></input></p>
		<p><i class="fa fa-fw fa fa-mobile-phone"></i>Mobile: <input type="text" name="mobile" size="25" required></input></p>
        <p><i class="fa fa-fw fa-envelope"></i>Email: <input type="text" name="email" size="25" required></input></p>
        <p><i class="fa fa-fw fa-male"></i>Reffered By: <input type="text" name="reff" size="25"></input></p>
		    <hr>
			    
				
				<h4><strong>Complaint Details</strong></h4>
				 
				<p>
 Type of Complaint<select name="type" style="width: 150px;">
<option value="Out of Warranty" selected>Out of Warranty</option>
<option value="Warranty">Warranty</option></select>
</p>
 <p>
 Catagory of Product: <select name="pcat" style="width: 150px;" required>
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
</p>
        <p>Brand: <input type="text" name="brand" size="20"></input></p>
		
		        <p>Model Number:  <input type="text" name="model" size="20"></input></p>
				        <p>Complaint in Breif:  <textarea name="complaint" rows="5" cols="30"></textarea></p>
				
				    
      </div>
    </div>
     <div class="w3-container" id="contact">
	     <button type="submit" class="w3-button w3-green w3-third">Create customer and ticket</button>
		 </div>
		 </form>
	<hr>
  
 <?php
 include 'footer.inc';
 ?>