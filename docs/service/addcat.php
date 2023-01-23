<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';

$user = $_SESSION["username"];
$cdate = date('Y-m-d H:i:s');
$st = "Active";

if ($_REQUEST['submit']) {
$cname = $_REQUEST['catn'];
 
// Attempt insert query execution
$sql = "INSERT INTO catgaory(pcat, crby, crdate, status) VALUES ('$cname','$user','$cdate','$st')";
if(mysqli_query($con, $sql)){
   // echo "Records added successfully.";
   $msg = "Catagory added successfully.";
	} else{
   //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
}
include 'admin.inc';
?>
    <p><font color="red"><?php echo $msg ?></font></p>
	
  </div>
  <div class="left">
    <h3>Create Product Catagories</h3>
	<br /><br />
    <div class="left_box"> <form method="get" action="">
<table align="left" width="80%" border="0" cellpadding="4">
<tr>
<td align="right">Product Catagory Name</td><td><input type="text" name="catn" size="45" required></td>
</tr>
<tr>
<td></td><td><input type="submit" name="submit" value="Add Catagory"></input></td>
</tr>
<tr>
</table>
<br />
    
	
	
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
