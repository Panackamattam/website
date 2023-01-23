<?php
include 'Insert/head.inc';
include 'Insert/connection.inc';
$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";
?>
<?php

$rec = $_REQUEST["rec"];

if ($rec == "db") {

$sn = $_REQUEST['srno'];
$etsql = "select * from estimates where srno='$sn'";
$eresult = $con->query($etsql);
$erow = $eresult->fetch_assoc();
include 'Insert/estimate.inc';
?>

  	  <form method="get" action="createestimate.php">  	
  <div class="w3-container">
    <h4><strong>Add price to estimate</strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
	<br />
<p>Item : <input type="hidden" name="srno" value="<?php echo $sn ?>"></input><input type="hidden" name="comid" value="<?php echo $erow["compid"] ?>"></input>
<input type="text" name="item" size="25" value="<?php echo $erow["item"] ?>"></p>
<p>Quantity: <input type="hidden" name="qty" value="<?php echo $erow["qty"] ?>"><input type="text" name="qty" size="25" value="<?php echo $erow["qty"] ?>"></input></p>
<p>Rate/Pc<input type="hidden" name="rec" value="<?php echo $rec ?>"></input><input type="text" name="rate" size="25" value="<?php echo $erow["rate"] ?>"></input></p>
<p><input type="submit" name="search" value="Add Rate" class="w3-button w3-green w3-third"></input></p>
<p>&nbsp;</p>
<p><font color="red"><i>* If you want to remove item, please keep the rate as zero (0).</i></font></p>
</div>
</div>
<?php
}
?>

<?php
if ($rec == "new") {

$sn = $_REQUEST['srno'];
$etsql = "select * from estimates where srno='$sn'";
$eresult = $con->query($etsql);
$erow = $eresult->fetch_assoc();
include 'Insert/estimate.inc';
?>
    	
 	  <form method="get" action="createestimate.php">  	
  <div class="w3-container">
    <h4><strong>Add price to estimate</strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
<p>Item: <input type="hidden" name="comid" value="<?php echo $_REQUEST['comid'] ?>"></input><input type="text" name="item" size="25" value="<?php echo $_REQUEST['it'] ?>"></p>
<p>Quantity: <input type="text" name="qty" size="25" value="1"></input></p>
<p>Rate/Pc: <input type="hidden" name="rec" value="<?php echo $rec ?>">	<input type="text" name="rate" size="25" value=""></input></p>
<p><input type="submit" name="search" value="Add Rate" class="w3-button w3-green w3-third"></input></p>
    </div>
  </div>
  </form>
<?php
}
?>

  <hr>
   <?php
 include 'footer.inc';
 ?>
