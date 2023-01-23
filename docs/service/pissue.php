<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'estimate.inc';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$rec = $_REQUEST["rec"];

$sn = $_REQUEST['srno'];
$etsql = "select * from parts where srno='$sn'";
$eresult = $con->query($etsql);
$erow = $eresult->fetch_assoc();
?>
    	
  </div>
  <div class="left">
    <h3><strong>Issue Parts</strong></h3>
    <div class="left_box"> <form method="get" action="partsissue.php">
	<br />
<table width="100%" border="0" cellpadding="7">
<tr>
<td>Item<input type="hidden" name="comid" value="<?php echo $erow["compid"] ?>"></input></td><td><input type="text" name="item" size="25" value="<?php echo $erow["parts"] ?>" readonly></td>
</tr>
<tr>
<td>Quantity<input type="hidden" name="srno" size="25" value="<?php echo $erow["srno"] ?>"></td><td><input type="text" name="qty" size="25" value="<?php echo $erow["qty"] ?>" readonly></input></td>
</tr>
<tr>
<tr><td>Inventroy Item Code</td><td><input type="text" name="itcode" size="25" value="" required></input></td>
</tr>
<tr>
<td></td><td><input type="submit" name="search" value="Issue Stock"></input></td>
</tr>
</table>
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
<td>Stock Remark</td>
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
<td><?php echo $row3["stockremark"] ?></td>
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

