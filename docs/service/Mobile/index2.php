<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
.mySlides {display: none}
</style>
<body class="w3-content w3-border-left w3-border-right">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-light-grey w3-collapse w3-top" style="z-index:3;width:200px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-transparent w3-display-topright"></i>
    <form action="/action_page.php" target="_blank">
       <p align="center"><a href="customers.php"><i class="fa fa-male" style="font-size:48px;color:gray"></i><br />Customer</a></p>   
<hr>    

<p align="center"><a href="tickets.php"><i class="fa fa-ticket" style="font-size:48px;color:gray"></i><br />Tickets</a></p>          
<hr>
      <p align="center"><a href="estimate.php"><i class="fa fa-navicon" style="font-size:48px;color:gray"></i><br />Estimate</a></p>            
<hr>    
  <p align="center"><a href="parts.php"><i class="fa fa-wrench" style="font-size:48px;color:gray"></i><br />Parts</a></p>
<hr>	
 <p align="center"><a href="inventory.php"><i class="fa fa-server" style="font-size:48px;color:gray"></i><br />Inventory</a></p>       
<hr>    
  <p align="center"><a href="invoice.php"><i class="fa fa-cart-plus" style="font-size:48px;color:gray"></i><br />Invoice</a></p>          
<hr>    
  <p align="center"><a href="reports.php"><i class="fa fa-bar-chart" style="font-size:48px;color:gray"></i><br />Reports</a></p>            
<hr>    
  <p align="center"><a href="admin.php"><i class="fa fa-cog" style="font-size:48px;color:gray"></i><br />Admin</a></p>
    </form>
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <span class="w3-bar-item">ABC Service</span>
  <a href="javascript:void(0)" class="w3-right w3-bar-item w3-button" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main w3-white" style="margin-left:260px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:80px"></div>

  <!-- Slideshow Header -->
    </div>

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
  
  <!-- Contact -->
  <div class="w3-container" id="contact">
    <h3>Contact</h3>
    <i class="fa fa-map-marker" style="width:30px"></i> Chris IT Solutions<br>
    <i class="fa fa-phone" style="width:30px"></i> Phone: +91 986 987 9400<br>
    <i class="fa fa-envelope" style="width:30px"> </i> Email: chrisitsolutions@gmail.com<br>
  </div>
  
  <footer class="w3-container w3-padding-16" style="margin-top:32px">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">Chris IT Solutions, Kerala</a></footer>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar when on tablets and phones
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Slideshow Apartment Images
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}
</script>

</body>
</html>
