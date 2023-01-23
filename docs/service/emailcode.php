//email sending started
$cemail = $qryrow["email"];


$to = $cemail;
$subject = "Complaint Registration Details";

$body .= " \n "
."Dear ".$cmidrow['cname']." ,<br /><br />\n "." \n "
."Your complaint is succefully registered with ABC Service.  Our technitian will contact you shortly."." <br /><br />\n "." \n "
."<table><tr><td>Complaint ID :</td><td> ".$cmidrow['compid']." </td></tr>\r\n "
."<tr><td>Customer Name :</td><td> ".$cmidrow['cname'] ." </td></tr>\r\n "
."<tr><td>Email : </td><td>".$qryrow['email'] ." </td></tr>\r\n "
."<tr><td>Product Catagory :</td><td> ".$cmidrow['cat'] ." </td></tr>\r\n "
."<tr><td>Brand : </td><td>".$cmidrow['brand'] ." </td></tr>\r\n "
."<tr><td>Model. : </td><td>".$cmidrow['model'] ." </td></tr>\r\n "
."<tr><td>Complaint :</td><td> ".$cmidrow['complaint'] ." </td></tr>\r\n "
//."Version : ".$cmidrow['Version'] ." \n "
//."Renwal Date : ".cmid$row['Renewal']. "\n"
."<tr><td>&nbsp;\n". "\n". " ". "</td></tr>\r\n"
."<tr><td>\n". "\n". "Thanks for choosing ABC Service". "</td></tr>\r\n"
."<tr><td>\n". "\n". "ABC Service". "</td></tr></table>\n";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <shinemon40@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$body,$headers);

//email sending ended
