<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: directions_page.php
**** Description: File that uses Google API to display directions based over user input
-->

<?php 

	$title = "Find Us";

	include 'view/header.php'; 

?>

<div id="content_container" class="fit2">

    <div id="sub_nav">
    	<ul>
			<li><a href="http://localhost/web289/gregsgrub/index.php?action=mission">Our Mission</a></li>
			<li><a class="pageMarker" href="http://localhost/web289/gregsgrub/index.php?action=directions_page">Directions</a></li>
			<li><a href="http://localhost/web289/gregsgrub/index.php?action=faq_page">FAQ</a></li>
		</ul>
	</div>
	<script type='text/javascript'>
		$('#mabout').addClass('textColor1');
	</script>

	<h1 class="headings1">Directions</h1>
	<h3 class="center">123 College St</h3>
	<h3 class="center">Asheville, NC 28801</h3>

    <div id="main">

	    <div id="panel">
			<form action="." method="post" id="directions_form">
		        <label><input type="text" id="start" name="start" placeholder="Enter starting point" required></label>
		        <input type="submit" value="Directions" class="submit_button">
		    </form>
	    </div>

	    <div id="map-canvas"></div>

	    <div id="directions-panel"></div>

    </div>    
</div>

<?php include 'view/footer.php'; ?>



















