<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'estimate.inc';

$rec = $_REQUEST["rec"];

if ($rec == "db") {

$sn = $_REQUEST['srno'];
$etsql = "select * from estimates where srno='$sn'";
$eresult = $con->query($etsql);
$erow = $eresult->fetch_assoc();
?>
    	
  </div>
  <div class="left">
    <h3><strong>Create Estimate</strong></h3>
    <div class="left_box"> <form method="get" action="createestimate.php">
	<br />
<table align="center" width="100%" border="0" cellpadding="7">
<tr>
<td align="right">Item<input type="hidden" name="srno" value="<?php echo $sn ?>"></input><input type="hidden" name="comid" value="<?php echo $erow["compid"] ?>"></input></td>
<td><input type="text" name="item" size="25" value="<?php echo $erow["item"] ?>"></td>
</tr>
<tr>
<td align="right">Quantity<input type="hidden" name="qty" value="<?php echo $erow["qty"] ?>"></td>
<td><input type="text" name="qty" size="25" value="<?php echo $erow["qty"] ?>"></input></td>
</tr>
<tr>
<tr><td align="right">Rate/Pc<input type="hidden" name="rec" value="<?php echo $rec ?>"></input></td>
<td>	<input type="text" name="rate" size="25" value="<?php echo $erow["rate"] ?>"></input></td>
</tr>
<tr>
<td></td><td><input type="submit" name="search" value="Add Rate"></input></td>
</tr>
</table>
<p><font color="red"><i>* If you want to remove item, please keep the rate as zero (0).</i></font></p>
<?php
}
?>

<?php
if ($rec == "new") {

$sn = $_REQUEST['srno'];
$etsql = "select * from estimates where srno='$sn'";
$eresult = $con->query($etsql);
$erow = $eresult->fetch_assoc();
?>
    	
  </div>
  <div class="left">
    <h3><strong>Create Estimate</strong></h3>
    <div class="left_box"> <form method="get" action="createestimate.php">
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
