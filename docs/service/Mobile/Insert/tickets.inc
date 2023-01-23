 <?php
  if ($usrow["role"] == "Admin") {
	//echo $usrow["role"];
  ?>
<p align="center">&nbsp;&nbsp;<a href="createticket.php" class="button6">Create Ticket</a></button>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="a-ticket.php" class="button6">Assign Tickets</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="updateticket.php" class="button6">Update Tickets</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="requestpart.php" class="button6">Parts Request</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="pendings.php" class="button6">List Pending Tickets</a>&nbsp;&nbsp;</p>
<?php
}
?>
 <?php
  if ($usrow["role"] == "technician") {
	//echo $usrow["role"];
  ?>
  <p align="center">&nbsp;&nbsp;<a href="createticket.php" class="button6">Create Ticket</a></button>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="updateticket.php" class="button6">Update Tickets</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="requestpart.php" class="button6">Parts Request</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="pendings.php" class="button6">List Pending Tickets</a>&nbsp;&nbsp;</p>

<?php
}
?>
<?php
  if ($usrow["role"] == "user") {
	echo $usrow["role"];
  ?>
    <p align="center">&nbsp;&nbsp;<a href="createticket.php" class="button6">Create Ticket</a></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<?php
	}
	?>