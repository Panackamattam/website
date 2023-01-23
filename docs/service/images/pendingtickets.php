<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Internet Services</title>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<link rel="stylesheet" href="images/style.css" type="text/css" />
<link rel="stylesheet" href="images/reporttable.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<?php
include 'head.inc';
include 'connection.inc';
include 'report.inc';
?>
    
	
  </div>
  <?php
$st = "Active";
$cst = "Resolved";
$sql2 = "select * from Complaints where cstatus='$cst' order by compid desc";
$result2 = $con->query($sql2);
if ($result2->num_rows > 0) {
?>
  <div class="left">
    <h3><strong>Un resolved tickets</strong></h3>
	<br />
    <div class="left_box"> <form method="get" action="customers.php">
	<table>
	<tr>
	<td>Filter:</td>
	<td>Select Catagory
	<select name="cat">
	<option value="LED Tv">LED Tv</option>
	<option value="Refrigrator">Refrigrator</option>
	<option value="Washing Machine">Washing Machine</option>
	<option value="Microwave">Microwave</option>
	</select></td>
	<td><input type="submit" name="filter" value="Filter Report"></input></td>
	</tr>
	</table>
<table class="names" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
<td><strong>Complaint #</td>
<td><strong>Date</td>
<td><strong>Customer</td>
<td><strong>Mobile</td>
<td><strong>Catagory</td>
<td><strong>Complaint Status</td>
</tr>
<?php
while($row2 = $result2->fetch_assoc()) {
?>
<tr>
<td><?php echo $row2["compid"] ?></td>
<td><?php echo $row2["crdate"] ?></td>
<td><?php echo $row2["cname"] ?></td>
<td><?php echo $row2["mobile"] ?></td>
<td><?php echo $row2["cat"] ?></td>
<td><?php echo $row2["cstatus"] ?></td>
</tr>
<?php
}
?>
</table>
<br />
<?php
}
?>
   
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