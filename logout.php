<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: logout.php
**** Description: File that allows user to logout of the system
-->

<?php 

	$title = 'Logout Page';
	include 'view/header.php'; 

?>

<div id="content_container" class="fit3">    
	<h2 class="headings1">Logout Page</h2>
	<h2 class="center">You have successfully logged out</h2>
</div>

<script type="text/javascript">
	function leave() {
	  window.location = "//localhost/web289/gregsgrub";
	}
	setTimeout("leave()", 2000);
</script>


<?php include 'view/footer.php'; ?>
