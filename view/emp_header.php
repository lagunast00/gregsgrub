<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: view/emp_header.php
**** Description: Employee header
-->

<?php 

if (isset($_SESSION['userLevel'])){
	if ($_SESSION['userLevel'] == 'E'){
		$login_details = get_employee($_SESSION['userID']);
		$login_details = $login_details->fetch();
	}
}

$employee = get_employee_all($_SESSION['userID']);
$emp = $employee['employeeID'];

$new_orders = get_new_orders_count();
$new_orders_count = $new_orders->rowCount();

$cooking_orders = get_cooking_orders_count();
$cooking_orders_count = $cooking_orders->rowCount();

$checking_orders = get_check_orders_count();
$checking_orders_count = $checking_orders->rowCount();

$total_orders_count = $checking_orders_count + $cooking_orders_count + $new_orders_count;

$new_deliveries = get_delivery_orders($emp);
$new_delivery_count = $new_deliveries->rowCount();

$new_carryouts = get_carryout_orders();
$new_carryout_count = $new_carryouts->rowCount();

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?> | Greg's Grub</title>
	<link rel="stylesheet" href="//localhost/web289/gregsgrub/css/main.css">
	<link rel="stylesheet" href="//localhost/web289/gregsgrub/plugin/jquery-ui.css">
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;signed_in=true"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript" src="//localhost/web289/gregsgrub/js/bjqs-1.3.js"></script>
	<script type="text/javascript" src="//localhost/web289/gregsgrub/js/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="//localhost/web289/gregsgrub/plugin/jquery-ui.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
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
						<li><a class="buttons format_login" href="http://localhost/web289/gregsgrub/emp/index.php?action=edit_profile">Edit Profile</a></li>
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
				<li><a id="mmain" href="http://localhost/web289/gregsgrub/emp/">Employee Main</a></li>
				<li><a id="mcomp" href="http://localhost/web289/gregsgrub/emp/index.php?action=completed_orders">Completed Orders</a>
					<ul>
			            <li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=completed_orders&amp;event=time">By Date</a></li>
						<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=completed_orders&amp;event=name">By Name</a></li>
						<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=completed_orders&amp;event=number">By Order #</a></li>
					</ul>
				</li>
				<li><a id="mcurr" href="http://localhost/web289/gregsgrub/emp/index.php?action=orders_page">Current Orders</a>
					<?php if ($total_orders_count > 0) { ?><p class="new_orders"><?php echo $total_orders_count; ?></p><?php } ?>
					<ul>
						<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=orders_page&amp;event=new_orders">New Orders</a><?php if ($new_orders_count > 0) { ?><p class="new_orders color"><?php echo $new_orders_count; ?></p><?php } ?></li>
						<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=orders_page&amp;event=orders_cooking">Orders Cooking</a><?php if ($cooking_orders_count > 0) { ?><p class="new_orders color"><?php echo $cooking_orders_count; ?></p><?php } ?></li>
						<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=orders_page&amp;event=double_check">Double Check</a><?php if ($checking_orders_count > 0) { ?><p class="new_orders color"><?php echo $checking_orders_count; ?></p><?php } ?></li>
					</ul>
				</li>
				<li><a id="mcarry" href="http://localhost/web289/gregsgrub/emp/index.php?action=carry_out">Carry Out</a>
					<?php if ($new_carryout_count > 0) { ?><p class="new_orders"><?php echo $new_carryout_count; ?></p><?php } ?>
					<ul>
						<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=carry_out&amp;event=time">By Time</a></li>
						<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=carry_out&amp;event=name">By Name</a></li>
						<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=carry_out&amp;event=number">By Order #</a></li>
					</ul>
				</li>
				<li><a id="mdel" href="http://localhost/web289/gregsgrub/emp/index.php?action=delivery">Delivery</a>
					<?php if ($new_delivery_count > 0) { ?><p class="new_orders"><?php echo $new_delivery_count; ?></p><?php } ?>
					<ul>
			            <li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=delivery&amp;event=time">By Time</a></li>
						<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=delivery&amp;event=name">By Name</a></li>
						<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=delivery&amp;event=number">By Order #</a></li>
					</ul>
				</li>
			</ul>

		</div>
	</nav>
		
	<div id="main_content">