<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';

?>
<?php
include 'Insert/tickets.inc';
?>
		<form method="get" action="cticket.php">
   <div class="w3-container">
    <h4><strong>Create ticket</strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
<p>Select Customer: <select name="cus" style="width: 250px;">

<?php
$st = "Active";
$sql = "SELECT * FROM Customers where status='$st' order by fname";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
$cname = $row["fname"]." ".$row["lname"];
?>
<option value="<?php echo $row["cid"] ?>"><?php echo $cname ?></option>
<?php
}
?>
</select>
</p>

<p>Type of Complaint: <select name="type">
<option value="Out of Warranty" selected>Out of Warranty</option>
<option value="Warranty">Warranty</option></select>
</p>

<p>Product Catagory
<select name="pcat" style="width: 250px;">

<?php
$st = "Active";
$sql = "SELECT * FROM catgaory where status='$st' order by pcat";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
?>
<option value="<?php echo $row["pcat"] ?>"><?php echo $row["pcat"] ?></option>
<?php
}
?>
</select>
</p>
<p>Brand: <input type="text" name="brand" size="20"></input><p>
<p>Model Number: <input type="text" name="model" size="20"></input><p>
<p>Reffered By:	<input type="text" name="reff" size="20"></input></p>
<p>Complaint in Breif: <textarea name="complaint" rows="7" cols="30"></textarea></p>
<p><button type="submit" class="w3-button w3-green w3-third">Create ticket</button></p>
<br />
</form>
    </div>
  </div>
  <?php
 include 'footer.inc';
 ?>
