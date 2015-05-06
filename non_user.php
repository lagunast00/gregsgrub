<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: non_user.php
**** Description: Page displayed if an unrecognozed user level is given access
-->

<?php 

	$title = $jobStatus;
	include 'view/header.php'; 

?>

<div id="content_container">
	<h1 class="headings1">No Access!</h1>
    <h2 class="center">Unrecognized User Level</h2>
</div>

<?php include 'view/footer.php'; ?>