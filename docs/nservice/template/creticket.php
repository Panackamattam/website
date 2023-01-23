<?php
include 'head.inc';
include 'connection.php';
?>

  <?php
$user = $_SESSION["username"];
$role = $_SESSION["role"];
$dash = "-";  
$st = "Active";
$sub = $_REQUEST['sub'];
if ($sub) {
$search = $_REQUEST['search'];
$fld = $_REQUEST['sfld'];
if ($role == "technician") {
$sql2 = "select * from Customers where status='$st' and $fld='$search' order by fname";
}
if ($role == "Admin") {
$sql2 = "select * from Customers where status='$st' and $fld='$search' order by fname";
}
}
else
{
$sql2 = "select * from Customers where status='$st' order by fname";
}
$result2 = $con->query($sql2);

?>
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-12 grid-margin">
<div class="card">
<div class="card-body">
				<h4 class="card-title"><strong>Create ticket</strong></h4>
				
<form method="get" action="">
<table class="table">
<tr>
<td><input type="text" name="search" class="form-control form-control-sm" /></td><td> <select name="sfld" class="form-control form-control-sm">
<option value="cid">Customer ID</option>
<option value="mobile">Mobile</option>
<option value="cname">Customer Name</option>
<option value="bname">Firm Name</option>
<option value="email">Email</option>

</td>
<td><button type="submit" name="sub" value="search" class="btn btn-primary mr-2">Search</button></td>
</tr>
</table>
</form>			
<table class="table table-hover">
	<?php
	if ($result2->num_rows > 0) {
?>

<tr>
<td><strong>Customer#</td>
<td><strong>Mobile</td>
<td><strong>Customer Name</td>
<td><strong>City</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
$cname = $row2["fname"]." ".$row2["lname"];
?>
<tr>
<td><a href="createticket.php?cus=<?php echo $row2["cid"] ?>&search=search&compname=<?php echo $cname ?>"><?php echo $row2["cid"] ?></a></td>
<td><?php echo $row2["mobile"] ?></td>
<td><?php echo $row2["fname"] ?></td>
<td><?php echo $row2["city"] ?></td>
</tr>
<?php
}
?>
</table>
<br />
</div>
</div>
</div>
</div>
</div>

<?php
}
else
{
echo " No Customer found, please create a new customer !";
}
?>
  <?php
   include 'footer.inc';
   ?>
  