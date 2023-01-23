<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'estimate.inc';

$rec = $_REQUEST["rec"];

$itcod = $_REQUEST['itemcod'];
$sn = $_REQUEST['srno'];
$etsql = "select * from invoice where srno='$sn'";
$eresult = $con->query($etsql);
$erow = $eresult->fetch_assoc();
?>
    	
  </div>
  <div class="left">
    <h3><strong>Edit Invoice item</strong></h3>
    <div class="left_box"> <form method="get" action="editinvoice.php">
	<br />
<table align="center" width="100%" border="0" cellpadding="7">
<tr>
<td align="right">Item<input type="hidden" name="srno" value="<?php echo $sn ?>"></input><input type="hidden" name="invno" value="<?php echo $erow["invno"] ?>"></input></td>
<td><input type="hidden" name="update" value="update rate"></input><input type="text" name="item" size="25" value="<?php echo $erow["parts"] ?>" readonly></td>
</tr>
<tr>
<td align="right">Quantity<input type="hidden" name="qty" value="<?php echo $erow["qty"] ?>"></td>
<td><input type="text" name="qty" size="25" value="<?php echo $erow["qty"] ?>" readonly ></input></td>
</tr>
<tr>
<tr><td align="right">Rate/Pc<input type="hidden" name="search" value="search"></input></td>
<td><input type="text" name="rate" size="25" value="<?php echo $erow["rate"] ?>"></input></td>
</tr>
<?php
if ($itcod == "0") {
?>
<tr>
<tr><td align="right">Tax Rate</td>
<td>
<select name="tax" style="width: 170px;">
<option value="0">0</option>
<?php
$st = "Active";
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
}
?>


</td>
</tr>




<tr>
<td></td><td><input type="hidden" name="itemcod" value="<?php echo $erow["itemcode"] ?>"><input type="submit" name="search" value="Edit Invoice Rate"></input></td>
</tr>
</table>
<p><font color="red"><i>* If you want to remove item, please keep the rate as zero (0).</i></font></p>

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
