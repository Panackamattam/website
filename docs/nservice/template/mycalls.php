<?php
include 'head.inc';
include 'connection.php';
?>

  <?php
$user = $_SESSION["username"];
$role = $_SESSION["role"];
$dash = "-";  
$st = "Resolved";
$apst = "Approved";
$st1 = "Active";

$sub = $_REQUEST['sub'];
if ($sub) {
$search = $_REQUEST['search'];
$fld = $_REQUEST['sfld'];
if ($role == "technician") {
$sql2 = "select * from telecalling where tstatus='$st1' and $fld='$search' order by id desc";
}
if ($role == "Admin") {
$sql2 = "select * from telecalling where tstatus='$st1' and $fld='$search' order by id desc";
}
}
else
{
$sql2 = "select * from telecalling where tstatus='$st1' order by id desc";
}
$result2 = $con->query($sql2);

?>
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">


				<h4 class="card-title"><strong>Tele-Marketing</strong></h4>
<form method="get" action="">
<p><button type="button" class="btn btn-inverse-primary btn-fw"><a href="mclist.php">Today Call List</a></button>&nbsp;&nbsp;&nbsp;
<button type="button" class="btn btn-inverse-primary btn-fw"><a href="addcall.php">Add Telecalling</a></button>&nbsp;&nbsp;&nbsp;
<button type="button" class="btn btn-inverse-primary btn-fw"><a href="impcall.php">Import Call List</a></button></p>

<table class="table">
<tr>
<td><input type="text" name="search" class="form-control form-control-sm" /></td><td> <select name="sfld" class="form-control form-control-sm">
<option value="id">Call ID</option>
<option value="mobile">Mobile</option>
<option value="fname">First Name</option>

</td>
<td><button type="submit" name="sub" value="search" class="btn btn-primary mr-2">Search</button></td>
</tr>
</table>
</form>		
                  <div class="table-responsive">	
<table class="table table-striped">
	<?php
	if ($result2->num_rows > 0) {
?>

<tr>
<td><strong>Call ID</td>
<td><strong>Name</td>
<td><strong>City</td>
<td><strong>Phone</td>
<td><strong>Mobile</td>
<td><strong>Email</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><a href="calls.php?id=<?php echo $row2["id"]?>"><?php echo $row2["id"]?></a></td>
<td><a href="calls.php?id=<?php echo $row2["id"]?>"><?php echo $row2["fname"]." ".$row["lname"]?></a></td>
<td><?php echo $row2["city"]?></td>
<td><?php echo $row2["phone"]?></td>
<td><?php echo $row2["mobile"]?></td>
<td><?php echo $row2["email"]?></td>
</tr>
<?php
}
?>
</table>
</div>
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
echo " No Estimates found !";
}
?>
  <?php
   include 'footer.inc';
   ?>
  