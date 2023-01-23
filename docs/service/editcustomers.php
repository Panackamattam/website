<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
include 'customer.inc';
?>
    	
  </div>
  <div class="left">
    <h3><strong>Edit Customer Details</strong></h3>
    <div class="left_box"> 
<form method="get" action="">
<br />
<table width="100%" border="0" align="left">
<tr>
<td align="left" width="25%">Select Customer</td><td>

<select name="cus" style="width: 150px;">

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
<td><input type="submit" name="sub" Value="Search"></td>
</tr>
</table>
</form>
<br /><br />
<hr>	

<?php
$up = $_REQUEST['sub'];
if ($up) {
$cd = $_REQUEST['cus'];
$sql1 = "select * from Customers where cid='$cd'";
$result1 = $con->query($sql1);
$row1 = $result1->fetch_assoc();
?>
<form method="get" action="ucustomer.php">
<table align="center" width="100%" border="0" cellpadding="5">
<tr>
<td align="right">First Name<input type="hidden" name="coid" value="<?php echo $cd ?>"></input></td>
<td><input type="hidden" name="fname" size="25" value="<?php echo $row1["fname"] ?>"><input type="text" name="fname" size="25" value="<?php echo $row1["fname"] ?>" disabled></td>
<td align="right">Last Name<input type="hidden" name="lname" size="25" value="<?php echo $row1["lname"] ?>"></td>
<td><input type="text" name="lname" size="25" value="<?php echo $row1["lname"] ?>" disabled></input></td>
</tr>
<tr><td align="right">Business Name</td><td>	<input type="text" name="bname" size="25" value="<?php echo $row1["bname"] ?>"></td>
<td align="right">Address1</td><td><input type="text" name="add1" size="25" value="<?php echo $row1["add1"] ?>"></input></td>
</tr>
<tr><td align="right">Address2</td><td><input type="text" name="add2" size="25" value="<?php echo $row1["add2"] ?>"></input></td>
<td align="right">City</td><td><input type="text" name="city" size="25" value="<?php echo $row1["city"] ?>"></td>
</tr>
<tr><td align="right">State</td><td><input type="text" name="state" size="25" value="<?php echo $row1["state"] ?>"></td>
<td align="right">Pincode</td><td><input type="text" name="pin" size="25" value="<?php echo $row1["pincode"] ?>"></td>
</tr>
<tr><td align="right">Phone</td><td><input type="text" name="phone" size="25" value="<?php echo $row1["phone"] ?>"></td>
<td align="right">Mobile</td><td><input type="text" name="mobile" size="25" value="<?php echo $row1["mobile"] ?>"></td>
</tr>
<tr><td align="right">Email</td><td><input type="text" name="email" size="25" value="<?php echo $row1["email"] ?>"></td>
<td align="right">Reffered By</td><td>		<input type="text" name="reff" size="25" value="<?php echo $row1["reff"] ?>"></td></tr>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td colspan="4" align="center"><input type="submit" name="update" value="Update Details"></input></td>
</tr>
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
