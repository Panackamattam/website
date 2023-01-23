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
$sql2 = "select * from Complaints where cstatus!='$st' and asained='$dash' and $fld='$search' order by compid desc";
}
else
{
if ($role == "Admin") {
$sql2 = "select * from Complaints where cstatus!='$st' and asained='$dash' order by compid desc";
}
}
$result2 = $con->query($sql2);

?>
	     <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
				<h4 class="card-title"><strong>Pending tickets to assign</strong></h4>
				
<form method="get" action="">
<table class="table" width="100%" border="0" align="left">
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
<hr>	
<br /><br />
				
				
				
				
				
<table class="table table-striped">
	<?php
	if ($result2->num_rows > 0) {
?>

<tr>
<td><strong>Complaint #</td>
<td><strong>Comp date</td>
<td><strong>Customer Name</td>
<td><strong>Catagory</td>
<td><strong>Complaint</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><a href="a-ticket.php?comid=<?php echo $row2["compid"] ?>&search=search"><?php echo $row2["compid"] ?></a></td>
<td><?php echo $row2["crdate"] ?></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["cat"] ?></td>
<td><?php echo $row2["complaint"] ?></td>
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
echo " No pending tickets !";
}
?>
  <?php
   include 'footer.inc';
   ?>
  