<?php
session_start();

if ($_SESSION["username"] == ""){
header("Location: http://www.bmibearings.com/service/login.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Internet Services</title>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<link rel="stylesheet" href="images/style.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
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

$insql = "INSERT INTO Stock(itemcode, item, brand, stockqty, balqty, cost, sellingrate, stockremark, crdate, crby, mdate, status, stocktype) VALUES ('$itcode', '$itm', '$bra', '$qty', '$qty', '$cpr', '$spr', '$rem', '$cdate', '$user', '$cdate', '$st', '$sty')";
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
<td>Stock Remark</td><td><input type="text" name="sremark" size="25"></input></td>
</tr>
<tr><td>Stock Type</td><td>
<select name="stype" style="width: 170px;">
<option value="Comsumable">Consumable</option>
<option value="Tools">Tools</option>
<option value="Asset">Asset</option>
</td>
<td></td><td></td>
</tr>
<tr><td></td><td colspan="4"><input type="submit" name="submit" Value="Add Stock"></input></td></tr>
</table>
<br />
</form>
    </div>
  </div>
  <div class="right">
    <h3>Pending</h3>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <h3>Completed</h3>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
    <div class="right_articles">
      <p><img src="images/image.gif" alt="Image" title="Image" class="image" /><b>Lorem ipsum dolor sit amet</b><br />
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
    </div>
  </div>
  <div class="footer">
    <p><a href="#">Homepage</a> | <a href="#">Contact</a> | <a href="#">Accessibility</a> | <a href="#">Products</a> | <a href="#">Disclaimer</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a><br />
&copy; Copyright 2006 Internet Services, Design: Luka Cvrk - <a href="http://www.solucija.com/" title="What's your solution?">Solucija</a></p>
  </div>
</div>
</body>
</html>
