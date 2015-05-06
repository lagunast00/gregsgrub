<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: view/admin_header.php
**** Description: Admin header
-->

<?php 

	if (isset($_SESSION['userLevel'])){
		if ($_SESSION['userLevel'] == 'A')
			$login_details = get_all_admin_info($_SESSION['userID']);
	}

	$categories3 = get_categories();

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?> | Greg's Grub</title>
	<link rel="stylesheet" href="//localhost/web289/gregsgrub/css/main.css">
	<link rel="stylesheet" href="//localhost/web289/gregsgrub/plugin/jquery-ui.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;signed_in=true"></script>
	<script type="text/javascript" src="//localhost/web289/gregsgrub/js/bjqs-1.3.js"></script>
	<script type="text/javascript" src="//localhost/web289/gregsgrub/js/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="//localhost/web289/gregsgrub/plugin/jquery-ui.js"></script>
	<script type="text/javascript" src="//localhost/web289/gregsgrub/js/gregsgrub.js"></script>
</head>

<body>
	<header>
		<img src="//localhost/web289/gregsgrub/images/logo1.png" alt="Logo">
			
		<div id="login_container">
	
		<?php if (!isset($_SESSION['userID'])) { ?>
	
			<div id="login_buttons1">
				<p><a class="buttons" href="http://localhost/web289/gregsgrub/index.php?action=login_page">Sign In</a></p>
	
		<?php } else { ?>
			<div id="login_buttons2">
				<div>
					<img id="loginImage" src="../<?php echo $login_details['thumbnailURL']; ?>" alt="Profile Image">
					<h3 class="headings">Welcome <?php echo $_SESSION['fName']; ?>!</h3>
					<ul>
						<li><a class="buttons format_login" href="http://localhost/web289/gregsgrub/admin/index.php?action=edit_profile">Edit Profile</a></li>
						<li><a class="buttons format_login" href="http://localhost/web289/gregsgrub/index.php?action=logout">Logout</a></li>
					</ul>
				</div>
			<?php } ?>
		    </div>
	    </div>
	</header>

	<nav>
		<div id="nav_bar">
			<ul>
				<li><a id="mreport" href="http://localhost/web289/gregsgrub/admin/index.php?action=admin_main">Reports</a>
					<ul>
						<li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=admin_main&amp;event=sales">Sales Reports</a></li>
			            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=admin_main&amp;event=coupons">Coupon Reports</a></li>
			            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=admin_main&amp;event=employees">Employee Reports</a></li>
					</ul>
				</li>
				<li><a id="muser" href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users">Manage Users</a>
					<ul>
						<li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users&amp;event=admin">Managers</a></li>
			            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users&amp;event=emp">Employees</a></li>
			            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users&amp;event=cust">Customers</a></li>
					</ul>
				</li>
				<li><a id="mprod" href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_products&amp;event=all">Manage Products</a>
					<ul>
						<?php foreach ($categories3 as $category) : ?>
							<li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_products&amp;event=<?php echo $category['categoryID']; ?>"><?php echo $category['categoryName']; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>
				<li><a id="minfo" href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info">Manage Info</a>
					<ul>
						<li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=comments">Manage Comments</a></li>
		                <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=faqs">Manage FAQs</a></li>
		                <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=promos">Manage Promos</a></li>
		                <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=mission">Manage Mission</a></li>
		                <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=coupons">Manage Coupons</a></li>
					</ul>
				</li>
				<li><a id="morder" href="http://localhost/web289/gregsgrub/admin/index.php?action=all_orders">All Orders</a>
					<ul>
						<li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=all_orders&amp;event=date">By Date</a></li>
						<li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=all_orders&amp;event=customer">By Customer</a></li>
						<li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=all_orders&amp;event=number">By Order #</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
		
	<div id="main_content">