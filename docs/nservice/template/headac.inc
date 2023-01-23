<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>CITS Online GST Software</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css" />
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="shortcut icon" href="assets/images/favicon.png" />
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

 	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
	
	<style>
.collapsible {
  background-color: #666;
  color: white;
  cursor: pointer;
  padding: 5px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.content {
  padding: 0 5px;
  display: none;
  overflow: hidden;
  background-color: #F9E79F;
}
</style>
  </head>
<?php
include 'gstconnection.php';
$act = "Active";
$cdate = date('Y-m-d');
$sql17 = "select * from gstinvoice where status='$act' and invdate='$cdate'";
$result17 = $con->query($sql17);
$ttotal = "0";
while($srow17 = $result17->fetch_assoc()){
$ttotal = ($ttotal + $srow17["total"] + $srow["sgst"] + $srow["cgst"] + $srow["igst"]);
}
if ($ttotal == "0") {
$ttotal = "0,000.00";
}
?>
  <body>
    <div class="container-scroller">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
          <a class="sidebar-brand brand-logo"><img src="assets/images/logo.svg" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini pl-4 pt-3"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="assets/images/faces/face21.jpg" alt="profile" />
                <span class="login-status online"></span>
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex flex-column pr-3">
                <span class="font-weight-medium mb-2"><?php echo $_SESSION["uname"]; ?></span>
                <span class="font-weight-normal"><?php echo $ttotal ?>/-</span>
              </div>
              <span class="badge badge-danger text-white ml-3 rounded"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dashbord.php">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
		  
		   <li class="nav-item">
		  <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Sales</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="crbill.php">Retails Bill Entry</a></li>
				<li class="nav-item"><a class="nav-link" href="wholesale.php">Whole Sale Bill Entry</a></li>
                <li class="nav-item"><a class="nav-link" href="editinv.php">Edit Bills</a></li>
                <li class="nav-item"><a class="nav-link" href="cencelinv.php">Cancel Bills</a></li>
				<li class="nav-item"><a class="nav-link" href="crcustomer.php">Create Customer</a></li>
              </ul>
            </div>
          </li>
		  
		  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Purchase</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic1">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="inventry.php">Purchase Entry</a></li>
				<li class="nav-item"><a class="nav-link" href="crvendor.php">Create Vendor</a></li>
              </ul>
            </div>
          </li>
		  
		  	<li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Inventory</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic2">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="cinventory.php">Create Inventory Item</a></li>
				<li class="nav-item"><a class="nav-link" href="addtaxes.php">Add Taxes</a></li>
				<li class="nav-item"><a class="nav-link" href="sstock.php">Search Inventory</a></li>
				
				<li class="nav-item"><a class="nav-link" href="cprice.php">Change Prices</a></li>
              </ul>
            </div>
          </li>	
	  
		  	<li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Reports</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic3">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="salessum.php">Sales Summary</a></li>
				<li class="nav-item"><a class="nav-link" href="sgstreport.php">Sales GST Report</a></li>
				<li class="nav-item"><a class="nav-link" href="stockreport.php">Stock Report</a></li>
              </ul>
            </div>
          </li>
		  
		  		  	<li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic8" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Accounts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic8">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="paymente.php">Payment Entry</a></li>
				<li class="nav-item"><a class="nav-link" href="receipte.php">Receipt Entry</a></li>
				<li class="nav-item"><a class="nav-link" href="ledger.php">Ledger</a></li>
				<li class="nav-item"><a class="nav-link" href="cashbook.php">Cash Book</a></li>
				<li class="nav-item"><a class="nav-link" href="chartac.php">Chart of Accounts</a></li>
              </ul>
            </div>
          </li>
		  
		  	          
          <li class="nav-item sidebar-actions">
            <div class="nav-link">
              <div class="mt-4">
                <div class="border-none">
                  <p class="text-black"></p>
                </div>
                <ul class="mt-4 pl-0">
                  <li><a href="signout.php">Sign Out</a></li>
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </nav>
      <div class="container-fluid page-body-wrapper">
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-default-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div> Default
          </div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div> Dark
          </div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles light"></div>
            <div class="tiles dark"></div>
          </div>
        </div>
        <nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
            <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
            <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
              <i class="mdi mdi-menu"></i>
            </button>
            <ul class="navbar-nav">
              
                
              <li class="nav-item nav-profile dropdown border-0">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown">
                  <img class="nav-profile-img mr-2" alt="" src="assets/images/faces/face21.jpg" />
                  <span class="profile-name"><?php echo $_SESSION["uname"]; ?></span>
                </a>
                <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                  <a class="dropdown-item" href="#">
                    <i class="mdi mdi-cached mr-2 text-success"></i> </a>
                  <a class="dropdown-item" href="logout.php">
                    <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>