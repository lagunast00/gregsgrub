<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: about.php
**** Description: File that displays all manager and current employees with profile
-->

<?php 

$title = "About Us";

include 'view/header.php'; 

$about = get_active_employees();
$about2 = show_admins();

?>

<div id="sub_nav">
	<ul>
		<li><a href="http://localhost/web289/gregsgrub/index.php?action=mission">Our Mission</a></li>
		<li><a href="http://localhost/web289/gregsgrub/index.php?action=directions_page">Directions</a></li>
		<li><a href="http://localhost/web289/gregsgrub/index.php?action=faq_page">FAQ</a></li>
	</ul>
</div>

	<script type='text/javascript'>
		$('#mabout').addClass('textColor1');
	</script>

<div id="content_container" class="fit2">
	<h2 class="headings1">About Us</h2>
	
	<div id='main'>		
		<h2>Managers</h2>
	
	<?php foreach($about2 as $each) : ?>
	
		<div class="about_emp">
			<img src="<?php echo $each['thumbnailURL']; ?>" alt="Profile Pic">
			<h3><?php echo $each['fName']; ?> <?php echo $each['lName']; ?></h3>
			<p><?php echo $each['profile']; ?></p>
		</div>

	<?php endforeach; ?>
	
		<h2>Employees</h2>
	
	<?php foreach($about as $each) : ?>

		<div class="about_emp">
			<img src="<?php echo $each['thumbnailURL']; ?>" alt="Profile Pic">
			<h3><?php echo $each['fName']; ?> <?php echo $each['lName']; ?></h3>
			<p><?php echo $each['profile']; ?></p>
		</div>

		<?php endforeach; ?>
		
	</div>
</div>
		
<?php include 'view/footer.php'; ?>