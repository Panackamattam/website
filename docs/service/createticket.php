<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'tickets.inc';
?>

	
  </div>
  <div class="left">
    <h3><strong>Create Tickets</strong></h3>
    <div class="left_box"> 
	<form method="get" action="cticket.php">
<br />
<table width="100%" border="0" align="left">
<tr>
<td align="left" width="25%">Select Customer</td><td>

<select name="cus" style="width: 170px;">

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
</td>
</tr>
</table>
<BR />
<hr>
<br />
<table align="center" width="100%" border="0" cellpadding="5">
<tr>
<td align="right">Type of Complaint</td><td><select name="type" style="width: 170px;">
<option value="Out of Warranty" selected>Out of Warranty</option>
<option value="Warranty">Warranty</option>
</td>
<td align="right">Catagory of Product</td><td>
<select name="pcat" style="width: 180px;">

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
</td>
</tr>
<tr><td align="right">Brand</td><td>	<input type="text" name="brand" size="20"></input></td>
<td align="right">Model Number</td><td><input type="text" name="model" size="20"></input></td>
</tr>
<tr>
<tr><td align="right">Reffered By</td><td>	<input type="text" name="reff" size="20"></input></td>
<td align="right">&nbsp;</td><td>&nbsp;</input></td>
</tr>
<tr><td align="right" valign="top">Complaint in Breif</td><td colspan="3"><textarea name="complaint" rows="7" cols="70"></textarea></td>
</tr>
<tr><td colspan="4" align="center"><button>Create Ticket</button></td></tr>
</table>
<br />
</form>
    </div>
  </div>
  <div class="right">
   <?php
   include 'right.php';
   ?>
  </div>
  <div class="footer">
 <?php
   include 'footer.php';
   ?>
  </div>
</div>
</body>
</html>
