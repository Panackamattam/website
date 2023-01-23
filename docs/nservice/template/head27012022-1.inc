<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ABC Service</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  
  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

 	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
  
  
  
  
  
  
  
  
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/logo.svg" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="ti-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown mr-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="ti-email mx-0"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">David Grey
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">Tim Cook
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal"> Johnson
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="ti-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-view-list"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">
              <i class="ti-shield menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
		  
		         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic11" aria-expanded="false" aria-controls="auth">
              <i class="ti-ticket menu-icon"></i>
              <span class="menu-title">Leads Management</span>
              <i class="menu-arrow"></i>
            </a>
			<div class="collapse" id="ui-basic11">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="mycalls.php">Tele Calling</a></li>
                <li class="nav-item"> <a class="nav-link" href="mypending.php">To Do List</a></li>
				<li class="nav-item"> <a class="nav-link" href="actleads.php">Active Leads</a></li>
              </ul>
            </div>
          </li>
		  
		  
		   <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic12" aria-expanded="false" aria-controls="auth">
              <i class="ti-ticket menu-icon"></i>
              <span class="menu-title">Sales</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic12">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="gst/template/crbill.php">Retails Bill Entry</a></li>
				<li class="nav-item"><a class="nav-link" href="wholesale.php">Whole Sale Bill Entry</a></li>
                <li class="nav-item"><a class="nav-link" href="editinv.php">Edit Bills</a></li>
                <li class="nav-item"><a class="nav-link" href="cencelinv.php">Cancel Bills</a></li>
				<li class="nav-item"><a class="nav-link" href="crcustomer.php">Create Customer</a></li>
              </ul>
            </div>
          </li>
		  
		 <li class="nav-item">
   <a class="nav-link" data-toggle="collapse" href="#ui-basic13" aria-expanded="false" aria-controls="auth">
              <i class="ti-ticket menu-icon"></i>
              <span class="menu-title">Purchase</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic13">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="inventry.php">Purchase Entry</a></li>
				<li class="nav-item"><a class="nav-link" href="crvendor.php">Create Vendor</a></li>
              </ul>
            </div>
          </li>
		  
		  
<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#ui-basic14" aria-expanded="false" aria-controls="auth">
              <i class="ti-ticket menu-icon"></i>
              <span class="menu-title">Stock/Inventory</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic14">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="cinventory.php">Create Inventory Item</a></li>
				<li class="nav-item"><a class="nav-link" href="addtaxes.php">Add Taxes</a></li>
				<li class="nav-item"><a class="nav-link" href="sstock.php">Search Inventory</a></li>
				<li class="nav-item"><a class="nav-link" href="cprice.php">Change Prices</a></li>
              </ul>
            </div>
          </li>	
		  
		   	<li class="nav-item">
<a class="nav-link" data-toggle="collapse" href="#ui-basic15" aria-expanded="false" aria-controls="auth">
              <i class="ti-ticket menu-icon"></i>
              <span class="menu-title">Accounts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic15">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="paymente.php">Payment Entry</a></li>
				<li class="nav-item"><a class="nav-link" href="receipte.php">Receipt Entry</a></li>
				<li class="nav-item"><a class="nav-link" href="ledger.php">Ledger</a></li>
				<li class="nav-item"><a class="nav-link" href="cashbook.php">Cash Book</a></li>
				<li class="nav-item"><a class="nav-link" href="chartac.php">Chart of Accounts</a></li>
              </ul>
            </div>
          </li>
		  
		  
		  
		  
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="ti-palette menu-icon"></i>
              <span class="menu-title">Customer</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="customers.php">Create Customer</a></li>
                <li class="nav-item"> <a class="nav-link" href="editcustomers.php">Edit Customers</a></li>
				<li class="nav-item"> <a class="nav-link" href="listcustomers.php">View Customers</a></li>
              </ul>
            </div>
          </li>
		  
       <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="auth">
              <i class="ti-ticket menu-icon"></i>
              <span class="menu-title">Tickets</span>
              <i class="menu-arrow"></i>
            </a>
			<div class="collapse" id="ui-basic1">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="creticket.php">Create ticket</a></li>
                <li class="nav-item"> <a class="nav-link" href="astickets.php">Assign ticket</a></li>
				<li class="nav-item"> <a class="nav-link" href="uptickets.php">Update ticket</a></li>
				<li class="nav-item"> <a class="nav-link" href="reqparts.php">Request parts</a></li>
				<li class="nav-item"> <a class="nav-link" href="pendings.php">Pending tickets</a></li>
              </ul>
            </div>
          </li>
		  
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="auth">
              <i class="ti-view-list-alt menu-icon"></i>
              <span class="menu-title">Estimate</span>
              <i class="menu-arrow"></i>
            </a>
			
			<div class="collapse" id="ui-basic2">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="crestimate.php">Create estimate</a></li>
                <li class="nav-item"> <a class="nav-link" href="lestimate.php">Update estimate</a></li>
				<li class="nav-item"> <a class="nav-link" href="apestimate.php">Approve estimate</a></li>
              </ul>
            </div>
		  
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="auth">
              <i class="ti-view-list-alt menu-icon"></i>
              <span class="menu-title">Parts</span>
              <i class="menu-arrow"></i>
            </a>
			
			<div class="collapse" id="ui-basic3">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="reqparts.php">Request Parts</a></li>
                <li class="nav-item"> <a class="nav-link" href="iparts.php">Issue Parts to ticket</a></li>
				<li class="nav-item"> <a class="nav-link" href="listpartsrequest.php">List Parts Requests</a></li>
              </ul>
            </div>
			
			
<li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="auth">
              <i class="ti-view-list-alt menu-icon"></i>
              <span class="menu-title">Inventory</span>
              <i class="menu-arrow"></i>
            </a>
			
			<div class="collapse" id="ui-basic4">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="stockentry.php">Add Inventory</a></li>
                <li class="nav-item"> <a class="nav-link" href="iparts.php">Issue Inventory for ticket</a></li>
				<li class="nav-item"> <a class="nav-link" href="inventory.php">List Inventory</a></li>
              </ul>
            </div>
			
		  
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth2" aria-expanded="false" aria-controls="auth">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">Invoice</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth2">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="createinvoice.php">Create Invoice</a></li>
                <li class="nav-item"> <a class="nav-link" href="einv.php"> Edit Invoice</a></li>
                <li class="nav-item"> <a class="nav-link" href="viewinvoice.php"> View Invoice</a></li>
                <li class="nav-item"> <a class="nav-link" href="listinvoice.php"> List Invoice</a></li>
                <li class="nav-item"> <a class="nav-link" href="updateinvoice.php">Payment Entry</a></li>
              </ul>
            </div>
          </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth4" aria-expanded="false" aria-controls="auth">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">Reports</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth4">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pendingtickets.php">Pending tickets</a></li>
                <li class="nav-item"> <a class="nav-link" href="resolved.php">Resolved tickets</a></li>
                <li class="nav-item"> <a class="nav-link" href="totalrev.php">Total income</a></li>
                <li class="nav-item"> <a class="nav-link" href="exprevenue.php">Expected income</a></li>
              </ul>
            </div>
          </li>
      <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth5" aria-expanded="false" aria-controls="auth">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">Admin</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth5">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="cuser.php">Create user</a></li>
                <li class="nav-item"> <a class="nav-link" href="eusers.php">Edit user</a></li>
                <li class="nav-item"> <a class="nav-link" href="cpass.php">Change password</a></li>
                <li class="nav-item"> <a class="nav-link" href="addcat.php">Add Catagory</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>