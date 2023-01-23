<p><a href="customers.php" class="button6">Create Customer</a></button>&nbsp;&nbsp;&nbsp;&nbsp;

 <?php
  if ($usrow["role"] == "Admin") {
	//echo $usrow["role"];
  ?>
  <a href="editcustomers.php" class="button6">Edit Customers</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="listcustomers.php" class="button6">List Customers</a></p>
<?php
}
?>