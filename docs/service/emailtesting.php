<?php
$to = "shine.panackamuttathu@gmail.com, shinemon40@gmail.com";
$subject = "Complain Registration Details";

$message = "
<html>
<head>
<title>Complain Registration Details</title>
</head>
<body>
<p>Dear Sir <br /> <br />Your complaint is succefully registered with ABC Service.  Our technitian will contact you shortly.</p>
<caption><strong><u>Your Complaint Details</u></strong></caption>
<table>
<tr>
<td>Complaint Number</td>
<td>125365</td>
</tr>
<tr>
<td>Customer Name</td>
<td>125365</td>
</tr>
<tr>
<td>Mobile Number</td>
<td>125365</td>
</tr>
<tr>
<td>Product Catagory</td>
<td>125365</td>
</tr>
<tr>
<td>Product Brand</td>
<td>125365</td>
</tr>
<tr>
<td>Product Model #</td>
<td>125365</td>
</tr>
<tr>
<td>Complaint in Bref</td>
<td>125365</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <shinemon40@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
?>
