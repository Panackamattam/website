<?php
include 'head.inc';
include 'Insert/cutsomer.inc';
?>

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
<i class="fa fa-fw fa-shower"></i> Type of Complaint<select name="type" style="width: 150px;">
<option value="Out of Warranty" selected>Out of Warranty</option>
<option value="Warranty">Warranty</option></select>
</p>

 <p>
 <i class="fa fa-fw fa-wifi"></i> Catagory of Product: <select name="pcat" style="width: 150px;" required>
<option value="Out of Warranty" selected>Out of Warranty</option>
<option value="Warranty">Warranty</option></select>
</select>
</p>
        <p><i class="fa fa-fw fa-tv"></i>Brand: <input type="text" name="brand" size="20"></input></p>
		
		        <p><i class="fa fa-fw fa-tv"></i>Model Number:  <input type="text" name="model" size="20"></input></p>
				        <p><i class="fa fa-fw fa-tv"></i>Complaint in Breif:  <textarea name="complaint" rows="5" cols="30"></textarea></p>
				
				    
      </div>
    </div>
     <div class="w3-container" id="contact">
	     <button type="submit" class="w3-button w3-green w3-third">Create customer and ticket</button>
		 </div>
	<hr>
  
 <?php
 include 'footer.inc';
 ?>