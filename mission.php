<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: mission.php
**** Description: File that displays mission statement
-->

<?php 

	$title = "Our Mission";

	include 'view/header.php'; 

	$mission = get_mission_text();
	$mission_text = $mission['infoText'];

?>

<div id="content_container"> 
        
    <div id="sub_nav">
    	<ul>
			<li><a class="pageMarker" href="http://localhost/web289/gregsgrub/index.php?action=mission">Our Mission</a></li>
			<li><a href="http://localhost/web289/gregsgrub/index.php?action=directions_page">Directions</a></li>
			<li><a href="http://localhost/web289/gregsgrub/index.php?action=faq_page">FAQ</a></li>
		</ul>
	</div>

	<script type='text/javascript'>
		$('#mabout').addClass('textColor1');
	</script>

	<h2 class="headings1">Our Mission</h2>
	
	<div id="main" class="fit6">        
        <div id="mission">
        	<h2 class="center"><?php echo $mission['infoFAQ']; ?></h2>	
			<p><?php echo $mission_text; ?></p>
			<img src="images/food_collage.jpg" alt="Food Collage">
    	</div>
    </div>
</div>

<?php include 'view/footer.php'; ?>