<body>
<div class="content">
  <div class="header">
    <div class="top_info">
      <div class="top_info_right">
        <p><b>You are not Logged in!</b> <a href="#">Log in</a> to check your messages.<br />
          
      </div>
      <div class="top_info_left">
        
      </div>
    </div>
    <div class="logo">
      <h1 align="left"><a href="#"><span class="dark">ABC &nbsp;</span>Services</a></h1>
    </div>
  </div>
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
  <div class="bar">
  <table align="right" width="80%" border="0">
  <?php
  if ($usrow["role"] == "Admin" ) {
  ?>
  <tr>
  <td align="center"><a href="customers.php"><i class="fa fa-male" style="font-size:48px;color:gray"></i><br />Customer</a></td>
   <td align="center"><a href="tickets.php"><i class="fa fa-ticket" style="font-size:48px;color:gray"></i><br />Tickets</a></td>
   <td align="center"><a href="estimate.php"><i class="fa fa-navicon" style="font-size:48px;color:gray"></i><br />Estimate</a></td>
   <td align="center"><a href="parts.php"><i class="fa fa-wrench" style="font-size:48px;color:gray"></i><br />Parts</a></td>
    <td align="center"><a href="inventory.php"><i class="fa fa-server" style="font-size:48px;color:gray"></i><br />Inventory</a></td>
	 <td align="center"><a href="invoice.php"><i class="fa fa-cart-plus" style="font-size:48px;color:gray"></i><br />Invoice</td>
	  <td align="center"><a href="reports.php"><i class="fa fa-bar-chart" style="font-size:48px;color:gray"></i><br />Reports</a></td>
	   <td align="center"><a href="admin.php"><i class="fa fa-cog" style="font-size:48px;color:gray"></i><br />Admin</a></td>
  </tr>
  <?php
 }
 ?>
 <?php
  if ($usrow["role"] == "technician") {
 // echo $usrow["role"];
  ?>
  <tr>
  <td align="center"><a href="customers.php"><i class="fa fa-male" style="font-size:48px;color:gray"></i><br />Customer</a></td>
   <td align="center"><a href="tickets.php"><i class="fa fa-ticket" style="font-size:48px;color:gray"></i><br />Tickets</a></td>
   <td align="center"><a href="#"><i class="fa fa-navicon" style="font-size:48px;color:gray"></i><br />Estimate</a></td>
   <td align="center"><a href=""><i class="fa fa-wrench" style="font-size:48px;color:gray"></i><br />Parts</a></td>
    <td align="center"><a href="#"><i class="fa fa-server" style="font-size:48px;color:gray"></i><br />Inventory</a></td>
	 <td align="center"><a href="#"><i class="fa fa-cart-plus" style="font-size:48px;color:gray"></i><br />Invoice</td>
	  <td align="center"><a href="#"><i class="fa fa-bar-chart" style="font-size:48px;color:gray"></i><br />Reports</a></td>
	   <td align="center"><a href="#"><i class="fa fa-cog" style="font-size:48px;color:gray"></i><br />Admin</a></td>
  </tr>
  <?php
 }
 ?>
  <?php
  if ($usrow["role"] == "user" ) {
  ?>
  <tr>
  <td align="center"><a href="customers.php"><i class="fa fa-male" style="font-size:48px;color:gray"></i><br />Customer</a></td>
   <td align="center"><a href="tickets.php"><i class="fa fa-ticket" style="font-size:48px;color:gray"></i><br />Tickets</a></td>
   <td align="center"><a href="#"><i class="fa fa-navicon" style="font-size:48px;color:gray"></i><br />Estimate</a></td>
   <td align="center"><a href="#"><i class="fa fa-wrench" style="font-size:48px;color:gray"></i><br />Parts</a></td>
    <td align="center"><a href="#"><i class="fa fa-server" style="font-size:48px;color:gray"></i><br />Inventory</a></td>
	 <td align="center"><a href="#"><i class="fa fa-cart-plus" style="font-size:48px;color:gray"></i><br />Invoice</td>
	  <td align="center"><a href="#"><i class="fa fa-bar-chart" style="font-size:48px;color:gray"></i><br />Reports</a></td>
	   <td align="center"><a href="#"><i class="fa fa-cog" style="font-size:48px;color:gray"></i><br />Admin</a></td>
  </tr>
  <?php
 }
 ?>
  </table>
   
  </div>
  <div class="search_field">
      <div class="search_form">
        
      </div>
    </form>