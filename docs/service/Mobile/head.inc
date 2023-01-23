<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="images/reporttable.css" type="text/css" />
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
.mySlides {display: none}
</style>
<body class="w3-content w3-border-left w3-border-right">
<?php
$db_name = "bmibedyu_service";
$mysql_username = "bmibedyu_bmi";
$mysql_password = "7xWf7hFxLXWR";
$server_name = "localhost:3306";
$con3 = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
$ud = $_SESSION["uid"];

$usersql = "select * from users where uid='$ud'";
$usresult = $con3->query($usersql);
$usrow = $usresult->fetch_assoc();
//echo $usrow["Name"];

?>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-light-grey w3-collapse w3-top" style="z-index:3;width:200px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-transparent w3-display-topright"></i>
    <form action="/action_page.php" target="_blank">
  <?php
  if ($usrow["role"] == "Admin" ) {
  ?>
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
  <?php
  }
  ?>
  
    <?php
  if ($usrow["role"] == "technician" ) {
  ?>
       <p align="center"><a href="customers.php"><i class="fa fa-male" style="font-size:48px;color:gray"></i><br />Customer</a></p>   
<hr>    

<p align="center"><a href="tickets.php"><i class="fa fa-ticket" style="font-size:48px;color:gray"></i><br />Tickets</a></p>          
<hr>
      <p align="center"><a href="#"><i class="fa fa-navicon" style="font-size:48px;color:gray"></i><br />Estimate</a></p>            
<hr>    
  <p align="center"><a href="#"><i class="fa fa-wrench" style="font-size:48px;color:gray"></i><br />Parts</a></p>
<hr>	
 <p align="center"><a href="#"><i class="fa fa-server" style="font-size:48px;color:gray"></i><br />Inventory</a></p>       
<hr>    
  <p align="center"><a href="#"><i class="fa fa-cart-plus" style="font-size:48px;color:gray"></i><br />Invoice</a></p>          
<hr>    
  <p align="center"><a href="#"><i class="fa fa-bar-chart" style="font-size:48px;color:gray"></i><br />Reports</a></p>            
<hr>    
  <p align="center"><a href="#"><i class="fa fa-cog" style="font-size:48px;color:gray"></i><br />Admin</a></p>
  <?php
  }
  ?>
  
    <?php
  if ($usrow["role"] == "user" ) {
  ?>
       <p align="center"><a href="customers.php"><i class="fa fa-male" style="font-size:48px;color:gray"></i><br />Customer</a></p>   
<hr>    

<p align="center"><a href="tickets.php"><i class="fa fa-ticket" style="font-size:48px;color:gray"></i><br />Tickets</a></p>          
<hr>
      <p align="center"><a href="#"><i class="fa fa-navicon" style="font-size:48px;color:gray"></i><br />Estimate</a></p>            
<hr>    
  <p align="center"><a href="#"><i class="fa fa-wrench" style="font-size:48px;color:gray"></i><br />Parts</a></p>
<hr>	
 <p align="center"><a href="#"><i class="fa fa-server" style="font-size:48px;color:gray"></i><br />Inventory</a></p>       
<hr>    
  <p align="center"><a href="#"><i class="fa fa-cart-plus" style="font-size:48px;color:gray"></i><br />Invoice</a></p>          
<hr>    
  <p align="center"><a href="#"><i class="fa fa-bar-chart" style="font-size:48px;color:gray"></i><br />Reports</a></p>            
<hr>    
  <p align="center"><a href="#"><i class="fa fa-cog" style="font-size:48px;color:gray"></i><br />Admin</a></p>
  <?php
  }
  ?>
  
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