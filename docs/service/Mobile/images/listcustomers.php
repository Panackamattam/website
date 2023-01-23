<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Internet Services</title>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<link rel="stylesheet" href="images/style.css" type="text/css" />
<link rel="stylesheet" href="images/table.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<?php
include 'head.inc';
//include 'tablestle.inc';
$con =mysqli_connect("localhost","attinqst","9zYs%#*Es6vG4!3~","attinqst_service");
if($con){
echo "Connected Sucessfully";
}
else{
echo "Not Connected";
}
// Attempt insert query execution
 $sql = "SELECT * FROM Customers";
//$sql = "INSERT INTO Customers (first-name, last-name, b-name, address, address1, city, state, pin, phone, email, reff) VALUES ('Sh', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l')";
//$con->exec($sql);
$result = $con->query($sql);

?>
    <p><a href="#"><button class="butt butt1">Edit Customer</a></button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><button class="butt butt1">List Customers</a></p>
  </div>
  <div class="left">
    <h3><strong>Create Customers</strong></h3>
    <div class="left_box"> <form method="get" action="customers.php">
	<P>&nbsp;</P>
 <div class="table">
    <div class="row header green">
      <div class="cell">
        Customer Name
      </div>
      <div class="cell">
        Address
      </div>
      <div class="cell">
        City
      </div>
      <div class="cell">
       Phone Number
      </div>
	    <div class="cell">
       Email
      </div>
      <div class="cell">
        Status
      </div>
    </div>
	</div>
    
    
<?php
if ($result->num_rows > 0) {
    // output data of each row
  while($row = $result->fetch_assoc()) {
    //echo "<tr><td>".$row["firstname"]." ".$row["lastname"]."</td>	<td>".$row["city"]."</td><td>".$row["phone"]."</td><td>".$row["email"]."</td></tr>";
	?>
	<div class="row">
      <div class="cell" data-title="Product">
        <?php
		echo $row["firstname"] .$row["lastname"];
		?>
      </div>
      <div class="cell" data-title="Unit Price">
        $800
      </div>
      <div class="cell" data-title="Quantity">
        10
      </div>
      <div class="cell" data-title="Date Sold">
        03/15/2014
      </div>
      <div class="cell" data-title="Status">
        Waiting for Pickup
      </div>
<div class="cell" data-title="Status">
        Waiting for Pickup
      </div>
    </div>
	<?php
	  }
} else {
  echo "0 results";
}
?>
</table>
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
