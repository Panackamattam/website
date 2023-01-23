<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

$sub = $_REQUEST['submit'];
if ($sub) {

$itsql = "select * from Stock order by srno desc limit 1";
$sresult = $con->query($itsql);
$srow = $sresult->fetch_assoc();

$itcode = ($srow["itemcode"] + 1 );
$itm = $_REQUEST['item'];
$bra = $_REQUEST['brand'];
$qty = $_REQUEST['qty'];
$rem = $_REQUEST['sremark'];
$cpr = $_REQUEST['cprice'];
$spr = $_REQUEST['srate'];
$sty = $_REQUEST['stype'];
$gst = $_REQUEST['gst'];

$insql = "INSERT INTO Stock(itemcode, item, brand, stockqty, balqty, cost, sellingrate, stockremark, crdate, crby, mdate, status, stocktype, gst) VALUES ('$itcode', '$itm', '$bra', '$qty', '$qty', '$cpr', '$spr', '$rem', '$cdate', '$user', '$cdate', '$st', '$sty', '$gst')";
if(mysqli_query($con, $insql )){
   // echo "Records added successfully.";
		} else{
  // echo "ERROR: Could not able to execute $upsql. " . mysqli_error($con);
		}
		
}

include 'inventory.inc';
?>
    
	
  </div>
  <div class="left">
    <h3><strong>Stock Entry</strong></h3>
    <div class="left_box"> <form method="get" action="">
<table align="left" width="100%" border="0" cellpadding="5">
<tr>
<td>Item</td><td><input type="text" name="item" size="25"></td>
<td>Quantity</td><td><input type="text" name="qty" size="25"></input></td>
</tr>
<tr><td>Brand</td><td>	<input type="text" name="brand" size="25"></input></td>
<td>Cost price</td><td><input type="text" name="cprice" size="25"></input></td>
</tr>
<tr><td>Selling Rate</td><td><input type="text" name="srate" size="25"></input></td>
<td>GST Rate</td><td>
<select name="gst" style="width: 170px;">
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
<td>Stock Remark</td><td><input type="text" name="sremark" size="25"></input></td>
<td>Stock Type</td><td>
<select name="stype" style="width: 170px;">
<option value="Comsumable">Consumable</option>
<option value="Tools">Tools</option>
<option value="Asset">Asset</option>
</td>
</tr>
<tr><td></td><td colspan="4"><input type="submit" name="submit" Value="Add Stock"></input></td></tr>
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
