<?php
include 'head.inc';
include 'connection.php';
?>

  <?php
$user = $_SESSION["username"];
$role = $_SESSION["role"];
$dash = "-";  
$st = "Resolved";
$sub = $_REQUEST['sub'];
if ($sub) {
$search = $_REQUEST['search'];
$fld = $_REQUEST['sfld'];
if ($role == "technician") {
$sql2 = "select * from Complaints where cstatus!='$st' and asained='$user' and $fld='$search' order by compid desc";
}
if ($role == "Admin") {
$sql2 = "select * from Complaints where cstatus!='$st' and $fld='$search' order by compid desc";
}
}
else
{
$sql2 = "select * from Complaints where cstatus!='$st' order by compid desc";
}
$result2 = $con->query($sql2);

?>
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
				<h4 class="card-title"><strong>Issue Parts to tickets</strong></h4>
				
<form method="get" action="">
<table class="table">
<tr>
<td><input type="text" name="search" class="form-control form-control-sm" /></td><td> <select name="sfld" class="form-control form-control-sm">
<option value="compid">Complaint ID</option>
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
<td><strong>Comp #</td>
<td><strong>Name</td>
<td><strong>Catagory</td>
<td><strong>Comp date</td>
<td><strong>Complaint</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
	$comp = $row2["compid"];
	$partstatus = "Issued";
	$st1 = "Active";
	$partqry = "select * from parts where compid='$comp' and pstatus!='$partstatus' and status='$st1'";
	$partrlt = $con->query($partqry);
	if ($partrlt->num_rows > 0) {

?>
<tr>
<td><a href="partsissue.php?comid=<?php echo $row2["compid"] ?>&search=search"><?php echo $row2["compid"] ?></a></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["cat"] ?></td>
<td><?php echo $row2["crdate"] ?></td>
<td><?php echo $row2["complaint"] ?></td>
</tr>
<?php
}
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
echo " No pending tickets to issue !";
}
?>
  <?php
   include 'footer.inc';
   ?>
  