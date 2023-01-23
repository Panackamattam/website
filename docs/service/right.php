<?php
$res = "Resolved";
$rsql = "select * from Complaints where cstatus!='$res' order by compid desc limit 10";
$rresult = $con->query($rsql);

?>
<h3>Last 10 pending tickets</h3>
    <div class="right_articles">
      <p>
		<?php
		if ($rresult->num_rows > 0) {
		?>
	  <table width="100%">
	  <tr>
	  <td width="12%">Comp.#</td>
	  <td>Name</td>
	  <td>Catagory</td>
	  <td>Status</td>
	  </tr>
	  <?php
		while($rrow = $rresult->fetch_assoc()) {
	  ?>
	   <tr>
	  <td><?php echo $rrow["compid"] ?></td>
	  <td><?php echo $rrow["cname"] ?></td>
	  <td><?php echo $rrow["cat"] ?></td>
	  <td><?php echo $rrow["cstatus"] ?></td>
	  </tr>
	   <?php
	  }
	  ?>
	   </table>
	  <?php
	  }else 
	  { 
	  $msg = "No Pending tickets !"; 
?>
<br / ><br / >
<p align="center"><font color="red"><?php echo $msg ?></font></p>
<br / ><br / >
<?php	  
	  }
	  ?>
	  </p>
    </div>
	
	<?php
	// Second right started
$res = "Resolved";
$rsql1 = "select * from Complaints where cstatus='$res' order by compid desc limit 10";
$rresult1 = $con->query($rsql1);

?>
	
    <h3>Last 10 Completed Tickets</h3>
    <div class="right_articles">
      <p>
		<?php
		if ($rresult1->num_rows > 0) {
		?>
	  <table width="100%">
	  <tr>
	  <td width="12%">Comp.#</td>
	  <td>Name</td>
	  <td>Catagory</td>
	  <td>Status</td>
	  </tr>
	  <?php
		while($rrow1 = $rresult1->fetch_assoc()) {
	  ?>
	   <tr>
	  <td><?php echo $rrow1["compid"] ?></td>
	  <td><?php echo $rrow1["cname"] ?></td>
	  <td><?php echo $rrow1["cat"] ?></td>
	  <td><?php echo $rrow1["cstatus"] ?></td>
	  </tr>
	   <?php
	  }
	  ?>
	   </table>
	  <?php
	  }else 
	  { 
	  $msg = "No Records found !"; 
?>
<br / ><br / >
<p align="center"><font color="red"><?php echo $msg ?></font></p>
<br / ><br / >
<?php	  
	  }
	  ?>
	  </p>
    </div>