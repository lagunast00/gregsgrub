<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: view/header.php
**** Description: Header
-->

<?php

	$categories3 = get_grub_menu();

	if (isset($_SESSION['userLevel'])){
		if ($_SESSION['userLevel'] == 'C'){
			$login_details = get_all_customer_info($_SESSION['userID']);
			if (isset($_SESSION['orderID']))
				$order = get_current_order($_SESSION['orderID']);
		} else {
			$login_details = get_employee_all($_SESSION['userID']);
		}
	}

?>
<!doctype html>
<html>
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<title><?php echo $title; ?> | Greg's Grub</title>
	<link rel="stylesheet" href="//localhost/web289/gregsgrub/css/main.css">
	<link rel="stylesheet" href="//localhost/web289/gregsgrub/plugin/jquery-ui.css">
	<link rel="stylesheet" href="//localhost/web289/gregsgrub/css/bjqs.css">
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;signed_in=true"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript" src="//localhost/web289/gregsgrub/js/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="//localhost/web289/gregsgrub/plugin/jquery-ui.js"></script>
	<script type="text/javascript" src="//localhost/web289/gregsgrub/js/bjqs-1.3.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script type="text/javascript" src="//localhost/web289/gregsgrub/js/gregsgrub.js"></script>
</head>

<body>
	
	<header>
		<img src="//localhost/web289/gregsgrub/images/logo1.png" alt="Logo">
			
		<div id="login_container">
			
		<?php if (!isset($_SESSION['userID'])) { ?>

			<div id="login_buttons1">
			<p><a class="buttons" href="http://localhost/web289/gregsgrub/index.php?action=login_page">Login/Register</a></p>

		<?php } else { ?>

			<div id="login_buttons2">

			<?php if ($_SESSION['userLevel'] != 'E'){ ?>

				<img id="loginImage" src="<?php echo $login_details['thumbnailURL']; ?>" alt="Profile Image">

			<?php } else { ?>

				<img id="loginImage" src="<?php echo $login_details['thumbnailURL']; ?>" alt="Profile Image">

			<?php } ?>

				<div>
					<h3 class="headings">Welcome <?php echo $_SESSION['fName']; ?>!</h3>
					<ul>
						<li><a class="buttons format_login" href="http://localhost/web289/gregsgrub/cust/index.php?action=edit_profile">Edit Profile</a></li>
						<li><a class="buttons format_login" href="http://localhost/web289/gregsgrub/index.php?action=logout">Logout</a></li>
					</ul>
				</div>				
			<?php } ?>
		    </div>
	    </div>
    <?php if (isset($_SESSION['userID'])) {
	   	if ($_SESSION['userLevel'] == 'C'){ ?>
    		<div id="cart_header">
				<h3 class="headings">Current Cart Subtotal</h3>
				<h2>$<?php if (isset($_SESSION['orderID'])) { echo money($order['orderSubTotal']); } else echo "0"; ?></h2>
				<a class="buttons format_login" href="http://localhost/web289/gregsgrub/cust/index.php?action=view_cart">View Cart</a>
			</div>
	<?php } } ?>
	</header>

	<nav>
		<div id="nav_bar">
			<ul>
				<li><a id="mpromo" href="http://localhost/web289/gregsgrub/index.php?action=promotions">PROMOTIONS</a></li>
				<li><a id="mgrub" href="http://localhost/web289/gregsgrub/index.php?action=menu_main">GRUB</a>
					<ul>
						<?php foreach ($categories3 as $category) : ?>
							<li><a href="http://localhost/web289/gregsgrub/index.php?action=menu_main&amp;categoryID=<?php echo $category['categoryID']; ?>"><?php echo $category['categoryName']; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>
				<li><a id="mmerch" href="http://localhost/web289/gregsgrub/index.php?action=merch">GRUB MERCH</a>
					<ul>
						<li><a href="http://localhost/web289/gregsgrub/index.php?action=merch&amp;categoryID=13">Accessories</a></li>
						<li><a href="http://localhost/web289/gregsgrub/index.php?action=merch&amp;categoryID=11">Clothing</a></li>
						<li><a href="http://localhost/web289/gregsgrub/index.php?action=merch&amp;categoryID=12">Gift Cards</a></li>
					</ul>
				</li>
				<li><a id="mabout" href="http://localhost/web289/gregsgrub/index.php?action=about">ABOUT US</a>
					<ul>
						<li><a href="http://localhost/web289/gregsgrub/index.php?action=mission">Our Mission</a></li>
						<li><a href="http://localhost/web289/gregsgrub/index.php?action=directions_page">Directions</a></li>
						<li><a href="http://localhost/web289/gregsgrub/index.php?action=faq_page">FAQ</a></li>
					</ul>
				</li>
				<li><a id="mcomm" href="http://localhost/web289/gregsgrub/index.php?action=comments">COMMENTS</a>
					<ul>
						<li><a href="http://localhost/web289/gregsgrub/cust/index.php?action=prev_comments">Previous Comments</a></li>
						<li><a href="http://localhost/web289/gregsgrub/cust/index.php?action=new_comment">New Comment</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>		
	
	<div id="main_content">