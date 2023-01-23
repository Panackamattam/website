<?php
include 'title.inc';
?>
<?php
include 'head.inc';
include 'connection.inc';
$add = $_REQUEST['subm'];
if ($add) {
	$coname = $_REQUEST['cname'];
	$contact = $_REQUEST['contact'];
	$ad1 = $_REQUEST['add1'];
	$ad2 = $_REQUEST['add2'];
	$city = $_REQUEST['city'];
	$state = $_REQUEST['state'];
	$pin = $_REQUEST['pin'];
	$country = $_REQUEST['country'];
	$phone = $_REQUEST['phone'];
	$email = $_REQUEST['email'];
	$web = $_REQUEST['web'];
	$gst = $_REQUEST['gst'];
	$stc = $_REQUEST['stcode'];
	
	$sql5 = "INSERT INTO Company(companyname, address1, address2, city, state, pincode, country, phone, email, web, gstno, statecode, crby, crdate, status) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15])";
	


}

include 'admin.inc';
?>
    
	
  </div>
  <div class="left">
    <h3><strong>Update Company Information</strong></h3>
    <div class="left_box"> <form method="get" action="">
<table align="left" width="100%" border="0" cellpadding="7">
<tr>
<td align="right">Company Name</td><td><input type="text" name="cname" size="25"></td>
<td align="right">Contact Person</td><td><input type="text" name="contact" size="25"></td>
</tr>
<tr><td align="right">Address1</td><td>	<input type="text" name="add1" size="25"></td>
<td align="right">Address2</td><td><input type="text" name="add3" size="25"></td>
</tr>
<tr><td align="right">City</td><td><input type="text" name="city" size="25"></td>
<td align="right">State</td><td><input type="text" name="state" size="25"></td>
</tr>
<tr><td align="right">Pincode</td><td><input type="text" name="pin" size="25"></td>
<td align="right">Country</td><td><input type="text" name="country" size="25"></td>
</tr>
<tr><td align="right">Phone</td><td><input type="text" name="phone" size="25"></td>
<td align="right">Email</td><td><input type="text" name="email" size="25"></td>
</tr>
<tr><td align="right">Website</td><td><input type="text" name="web" size="25"></td>
<td align="right"></td><td></td></tr>
</table>
<hr>
<caption><strong><u>Tax Details</strong></caption>
<table align="left" width="100%" border="0" cellpadding="7">
</tr>
<tr><td align="right">GST No:</td><td><input type="text" name="gst" size="25"></td>
<td align="right">State Code</td><td><input type="text" name="stcode" size="25"></td>
</tr>
<tr>
<td colspan="4" align="center"><input type="submit" name="subm" value="Add Company Info"></input></td></tr>
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
