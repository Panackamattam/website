<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'estimate.inc';

$rec = $_REQUEST["rec"];
$st = "Active";

if ($rec == "new") {
$it = $_REQUEST['it'];
$sn = $_REQUEST['srno'];
$etsql = "select * from estimates where srno='$sn'";
$eresult = $con->query($etsql);
$erow = $eresult->fetch_assoc();
?>
    	
  </div>
  <div class="left">
    <h3><strong>Add <?php echo $it ?></strong></h3>
    <div class="left_box"> <form method="get" action="cinvoice.php">
	<br />
<table align="center" width="100%" border="0" cellpadding="7">
<tr>
<td align="right">Item<input type="hidden" name="comid" value="<?php echo $_REQUEST['comid'] ?>"></input></td><td><input type="text" name="item" size="25" value="<?php echo $_REQUEST['it'] ?>"></td>
</tr>
<tr>
<td align="right">Quantity</td><td><input type="text" name="qty" size="25" value="1"></input></td>
</tr>
<tr>
<tr><td align="right">Rate/Pc<input type="hidden" name="rec" value="<?php echo $rec ?>"></td><td>	<input type="text" name="rate" size="25" value=""></input></td>
</tr>
<tr>
<tr><td align="right">Tax Rate</td>
<td>
<select name="tax" style="width: 170px;">
<option value="0">0</option>
<?php
$sq = "select * from taxes where status='$st'";
$sqr = $con->query($sq);

if ($sqr->num_rows > 0) {
while ($sqrow = $sqr->fetch_assoc()) {
$gst = $sqrow["gst"];
//$gst = var(int)$gst;
?>
<option value="<?php echo $sqrow["gst"] ?>"><?php echo $gst ?>%</option>
<?php
}
}
?>


</td>
</tr>
<tr>
<td></td><td><input type="submit" name="search" value="Add Rate"></input></td>
</tr>
</table>
<?php
}
?>

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
