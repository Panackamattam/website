<?php
include 'head.inc';
include 'connection.php';
?>
  <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
				<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
 <h4 class="card-title">MEMBERS</h4>
<form method="post" action="">
<?php
$cd = $_REQUEST['cid'];
$sql1 = "select DISTINCT srno from pana order by srno";
$result1 = $con->query($sql1);
while($row1 = $result1->fetch_assoc()){
$sno = $row1["srno"];
	$sql2 = "select * from pana where srno='$sno' order by id";
	$result2 = $con->query($sql2);
	$row2 = $result2->fetch_assoc();
?>
<table width="100%">
<tr><td width="25%">Srno</td><td><?php echo $row2["srno"]; ?></td</tr>
<tr><td>Head Of Family</td><td><?php echo $row2["hof"]; ?></td</tr>
<tr><td>Family Extension</td><td><?php echo $row2["fmlyext"]; ?></td</tr>
<tr><td>Home Parish</td><td><?php echo $row2["parish"]; ?></td</tr>
<tr><td>Address</td><td><?php echo $row2["address"]; ?></td</tr>
<tr><td>Current Place</td><td><?php echo $row2["place"]; ?></td</tr>
<tr><td>Phone</td><td><?php echo $row2["phone"]; ?></td</tr>
<tr><td>Mobile</td><td><?php echo $row2["mobile"]; ?></td</tr>
<tr><td>Email</td><td><?php echo $row2["email"]; ?></td</tr>
<tr><td>Office Address</td><td><?php echo $row2["oadd"]; ?></td</tr>
<tr><td>Office Phone</td><td><?php echo $row2["ophone"]; ?></td</tr>
<tr><td>Name of Kudumnbanatha</td><td><?php echo $row2["knatha"]; ?></td</tr>
<tr><td>Father Name</td><td><?php echo $row2["fname"]; ?></td</tr>
<tr><td>Mother Name and Details</td><td><?php echo $row2["mname"]; ?></td</tr>
<tr><td>Thalamura</td><td><?php echo $row2["tmura"]; ?></td</tr>
</table>
<?php
	$sql3 = "select * from pana where srno='$sno' order by id";
	$result3 = $con->query($sql3);
	?>
		<table width="100%" border="1">
<tr>
<th>Member Name</th></th>
<th>Ralation with HOF</th>
<th>Date of Birth</th>
<th>Age</th>
<th>Educational Qualification</th>
<th>Occupation Place</th>
<th>Date of Marriage</th>
<th>Blood Group</th>
</tr>
	<?
	while($row3 = $result3->fetch_assoc()){
	
	?>
<tr>
<td><?php echo $row3["member"]; ?></td>
<td><?php echo $row3["relation"]; ?></td>
<td><?php echo $row3["dob"]; ?></td>
<td><?php echo $row3["age"]; ?></td>
<td><?php echo $row3["edu"]; ?></td>
<td><?php echo $row3["occ"]; ?></td>
<td><?php echo $row3["dom"]; ?></td>
<td><?php echo $row3["bgroup"]; ?></td>
</tr>

	<?php
	}
	?>
		<tr>
<td colspan="8">&nbsp;</td>
</tr>
	<?php
}
?>
