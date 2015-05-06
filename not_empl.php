<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: not_empl.php
**** Description: File displayed if a terminated or suspended employee logs in
-->

<?php 

	$title = $jobStatus;
	include 'view/header.php'; 

?>

<div id="content_container">
    <h1 class="headings1">No Access!</h1>
    <h2 class="center">YOU HAVE BEEN <?php echo $jobStatus; ?><br>LOGIN PRIVILEGES HAVE BEEN REMOVED!</h2>
</div>

<?php include 'view/footer.php'; ?>