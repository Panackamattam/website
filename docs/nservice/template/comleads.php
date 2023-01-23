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
$lstat = "Completed";
if ($sub) {
$search = $_REQUEST['search'];
$fld = $_REQUEST['sfld'];
if ($role == "technician") {
$sql2 = "select * from leads where status='$st1' and $fld='$search' order by lid desc";
}
if ($role == "Admin") {
$sql2 = "select * from leads where status='$st1' and $fld='$search' order by lid desc";
}
}
else
{
$sql2 = "select * from leads where status='$st1' and lstatus='$lstat' order by lid desc";
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
<p><button type="button" class="btn btn-inverse-primary btn-fw"><a href="addleads.php">Add New Lead</a></button>&nbsp;&nbsp;&nbsp;
<button type="button" class="btn btn-inverse-primary btn-fw"><a href="implead.php">Import Leads</a></button>

&nbsp;&nbsp;&nbsp;
<button type="button" class="btn btn-inverse-primary btn-fw"><a href="comleads.php">Completed Leads</a></button>
&nbsp;&nbsp;&nbsp;
<button type="button" class="btn btn-inverse-primary btn-fw"><a href="lostlead.php">Lost Leads</a></button>
</p>

<table class="table">
<tr>
<td><input type="text" name="search" class="form-control form-control-sm" /></td><td> <select name="sfld" class="form-control form-control-sm">
<option value="lid">Lead ID</option>
<option value="mobile">Mobile</option>
<option value="fname">First Name</option>

</td>
<td><button type="submit" name="sub" value="search" class="btn btn-primary mr-2">Search</button></td>
</tr>
</table>
</form>	
<h4><strong>Completed Leads Details</strong></h4>	
                  <div class="table-responsive">	
<table class="table table-striped">
	<?php
	if ($result2->num_rows > 0) {
?>

<tr>
<td><strong>Lead ID</td>
<td><strong>Name</td>
<td><strong>City</td>
<td><strong>Mobile</td>
<td><strong>Lead Details</td>
<td><strong>Bill Amount</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><a href="ldetails.php?id=<?php echo $row2["lid"]?>&lst=Con"><?php echo $row2["lid"]?></a></td>
<td><a href="ldetails.php?id=<?php echo $row2["lid"]?>"><?php echo $row2["fname"]." ".$row2["lname"]?></a></td>
<td><?php echo $row2["city"]?></td>
<td><?php echo $row2["mobile"]?></td>
<td><?php echo $row2["leaddetails"]?></td>

<?php
$ledid = $row2["lid"];
$qry10 = "select * from leadbills where leadid='$ledid'";
$qryres = $con->query($qry10);
$row10 = $qryres->fetch_assoc();
$bamt = $row10["billamt"];
?>
<td><?php echo $bamt?></td>
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
  