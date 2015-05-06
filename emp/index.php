<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: emp/index.php
**** Description: Employee controller
-->

<?php

session_start();

require('../model/database.php');
require('../model/login_functions.php');
require('../model/admin_functions.php');
require('../model/general_functions.php');
require('../model/employee_functions.php');
require('../model/image_upload_functions.php');

date_default_timezone_set( 'America/New_York' );

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else if (!isset($_SESSION['userID'])) {
	header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
} else if (isset($_SESSION['userID'])) {
	$userID = $_SESSION['userID'];
	$userLevel = get_user_level($userID);
	$employee = get_employee_all($userID);
    $jobStatus = $employee['jobStatus'];
	if ($userLevel == 'E' && $jobStatus == 'Employed'){
		$action = 'emp_main';
	} else {
		header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
	}
}

if ($action =='emp_main'){
	include('emp_main.php');
} else if ($action == 'orders_page'){
	include('orders_page.php');
} else if ($action == 'edit_profile'){
	include('edit_profile.php');
} else if ($action == 'edit_image'){
	include('edit_image.php');
} else if ($action == 'update_employee'){
	update_user(enter($_SESSION['userID']), enter($_POST['userEmail']), enter($_POST['userName']), enter($_POST['lName']), enter($_POST['fName']), enter($_POST['phone']));
	update_employee_profile(enter($_POST['employeeID']), enter($_POST['profile']));
	$msg = '<h2 class="center">Profile has been updated</h2>';
	include('edit_profile.php');
} else if ($action == 'add_image'){
	$employee = get_employee($_SESSION['userID']);
	$employee = $employee->fetch();
	$nameID = $employee['nameID'];
	$oldImage = $employee['thumbnailURL'];
	$oldImage = "../".$oldImage;
	if (file_exists($oldImage) && $oldImage != 'images/default.jpg')
		unlink($oldImage);
	$file_name = sanitize_file_name($_FILES['thumbnailURL']['name']);
	$temp = explode(".", $_FILES["thumbnailURL"]["name"]);
	$ext = end($temp);
	upload_file('thumbnailURL');
	
	$newImage = "e".$_SESSION['userID'].".".$ext;
	add_photo_URL_employee(enter($newImage), enter($nameID));
	$location = "../images/profiles/e".$_SESSION['userID'].".".$ext;
	resize_crop_image(300, 300, $location, $location);
	include('edit_profile.php');
} else if ($action == 'under_construction'){
	include ('under_construction.php');
} else if ($action == 'order_details'){
	$orderID = $_POST['orderID'];
	$event = $_POST['event'];
	include('order_details.php');
} else if ($action == 'update_status_form'){
	if (isset($_POST['orderID'])){
		$orderID = $_POST['orderID'];
	} else {
		$orderID = $_GET['orderID'];
	}
	include('update_status.php');
} else if ($action == 'update_status'){
	if (isset($_POST['orderID'])){
		$orderID = $_POST['orderID'];
		$orderStatus = $_POST['orderStatus'];
	} else {
		$orderID = $_GET['orderID'];
		$orderStatus = $_GET['orderStatus'];
	}
	update_status(enter($orderID), enter($orderStatus));
	if ($orderStatus == 'Order Sent')
		$event = 'new_orders';
	else if ($orderStatus == 'Order Cooking')
		$event = 'orders_cooking';
	else if ($orderStatus == 'Checking Order')
		$event = 'double_check';
	else if ($orderStatus == 'Ready For Pickup' || $orderStatus == 'Being Delivered'){
		complete_order($orderID, date('Y-m-d H:i:s'));
		if ($orderStatus == 'Ready For Pickup'){
			include('carry_out.php');
			exit();
		}
		else{
			include('delivery_driver.php');
			exit();
		}
	}
	include('orders_page.php');
} else if ($action == 'update_driver'){
	$employeeID = $_POST['employeeID'];
	$orderID = $_POST['orderID'];
	update_driver(enter($orderID), enter($employeeID));
	include('delivery.php');
} else if ($action == 'delivery'){
	include('delivery.php');
} else if ($action == 'carry_out'){
	include('carry_out.php');
} else if ($action =='delivered'){
	$orderID = $_GET['orderID'];
	order_finished($orderID);
	include('emp_main.php');
} else if ($action == 'completed_orders'){
	include('completed_orders.php');
} else if ($action == 'cash_out'){
	if (isset($_GET['orderID']))
		$orderID = $_GET['orderID'];
	else
		$orderID = $_POST['orderID'];
	include('cash_out.php');
} else if ($action == 'credit_upload'){
	$cardExpires = strtotime($_POST['cardExpires']);
	$cardExpires = date('Y-m-d', $cardExpires);
	credit_upload(enter($_POST['orderID']), enter($_POST['cardName']), enter($_POST['cardType']), enter($_POST['cardNumber']), enter($_POST['cardCw']), enter($cardExpires), enter($_POST['orderTotal']));
	paid_order_cash(enter($_POST['orderID']), enter('2'));
	order_finished(enter($_POST['orderID']));
	include('completed_orders.php');
}

?>