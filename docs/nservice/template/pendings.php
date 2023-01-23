<?php
include 'head.inc';
include 'connection.php';
?>

  <?php
$user = $_SESSION["username"];
$role = $_SESSION["role"];
  
$st = "Resolved";
if ($role == "technician") {
$sql2 = "select * from Complaints where cstatus!='$st' and asained='$user' order by compid desc";
}
if ($role == "Admin") {
$sql2 = "select * from Complaints where cstatus!='$st' order by compid desc";
}

$result2 = $con->query($sql2);

?>
	     <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
  <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
				<h4 class="card-title"><strong>Pending tickets</strong></h4>
<table class="table table-striped">
	<?php
	if ($result2->num_rows > 0) {
?>

<tr>
<td><strong>Complaint #</td>
<td><strong>Customer Name</td>
<td><strong>Catagory</td>
<td><strong>Complaint</td>
<td><strong>Tech.</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><a href="vticket.php?comid=<?php echo $row2["compid"] ?>"><?php echo $row2["compid"] ?></a></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["cat"] ?></td>
<td><?php echo $row2["complaint"] ?></td>
<td><?php echo $row2["asained"] ?></td>
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
  