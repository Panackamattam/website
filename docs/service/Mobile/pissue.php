<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php

$rec = $_REQUEST["rec"];

$sn = $_REQUEST['srno'];
$etsql = "select * from parts where srno='$sn'";
$eresult = $con->query($etsql);
$erow = $eresult->fetch_assoc();
include 'Insert/parts.inc';
?>
    	
<div class="w3-container">

	<?php
	if ($msg) {
	?>
	<p align="center"><font color="red"><?php echo $msg ?></font></p>
	<?php
	}
	?>
	    <h4><strong><u>Update ticket</u></strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
 <form method="get" action="partsissue.php">
<p>Item:<input type="hidden" name="comid" value="<?php echo $erow["compid"] ?>"></input><input type="text" name="item" size="25" value="<?php echo $erow["parts"] ?>" readonly></p>
<p>Quantity: <input type="hidden" name="srno" size="25" value="<?php echo $erow["srno"] ?>"><input type="text" name="qty" size="25" value="<?php echo $erow["qty"] ?>" readonly></input></p>
<p>Inventroy Item Code: <input type="text" name="itcode" size="25" value="" required></input></p>
<p><input type="submit" name="search" value="Issue Stock" class="w3-button w3-green w3-third"></input></p>

<br />
<?php
$item = $erow["parts"];
$sql3 = "select * from Stock where item like '%$item%' and status='$st'";
//echo $sql3;
$result3 = $con->query($sql3);
if ($result3->num_rows > 0) {

//$row3 = $result3->fetch_assoc();
?>
<table width="100%" border="0" cellpadding="7">
<tr>
<td>Item Code</td>
<td>Item</td>
<td>Brand</td>
<td>Qty</td>
<td>Selling Rate</td>
</tr>
<?php
while($row3 = $result3->fetch_assoc()) {
?>
<tr>
<td><?php echo $row3["itemcode"] ?></td>
<td><?php echo $row3["item"] ?></td>
<td><?php echo $row3["brand"] ?></td>
<td><?php echo $row3["balqty"] ?></td>
<td><?php echo $row3["sellingrate"] ?></td>
</tr>
<?php
}
?>
</table>

<?php
}
?>
</form>
    </div>
  </div>
 <hr>
   <?php
 include 'footer.inc';
 ?>
