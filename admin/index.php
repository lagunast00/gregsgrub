<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/index.php
**** Description: Admin controller
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
	if ($userLevel == 'A'){
		$action = 'admin_main';
	} else {
		header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
	}	
}


if ($action == 'admin_main'){
	include('admin_main.php');
} else if ($action == 'manage_users'){
	include('manage_users.php');
} else if ($action == 'add_admin_form'){
	include('add_admin_form.php');
} else if ($action == 'add_admin'){
	add_user(enter($_POST['userEmail']), enter($_POST['userName']), enter(password_hash($_POST['userPassword'], PASSWORD_DEFAULT)), enter($_POST['userLevel']));
	$user = last_user();
	add_name(enter($_POST['fName']), enter($_POST['lName']), enter($_POST['phone']), enter($user['userID']));
	$name = last_name();
	add_admin(enter($name['nameID']));
	$event ='admin';
	include('manage_users.php');
} else if ($action == 'edit_admin_form'){
	$admin = get_admin_all($_POST['userID']);
	include('edit_admin_form.php');
} else if ($action =='edit_admin'){
	update_user(enter($_POST['userID']), enter($_POST['userEmail']), enter($_POST['userName']), enter($_POST['lName']), enter($_POST['fName']), enter($_POST['phone']));
	update_admin(enter($_POST['adminID']), enter($_POST['profile']));
	$event = 'admin';
	include('manage_users.php');
} else if ($action == 'change_password_form'){
	$results = get_user_all($_POST['userID']);
	include('change_password_form.php');
} else if ($action == 'change_password'){
	$userPassword = $_POST['userPassword'];
	$userID = $_POST['userID'];
	$userPassword = password_hash($userPassword, PASSWORD_DEFAULT);
	change_password(enter($userID), enter($userPassword));
	$msg = "<h2 class='center'>Password Updated</h2>";
	include('manage_users.php');
} else if ($action == 'add_employee_form'){
	include('add_employee_form.php');
} else if ($action == 'add_employee'){
	add_user(enter($_POST['userEmail']), enter($_POST['userName']), enter(password_hash($_POST['userPassword'], PASSWORD_DEFAULT)), enter($_POST['userLevel']));
	$user = last_user();
	add_name(enter($_POST['fName']), enter($_POST['lName']), enter($_POST['phone']), enter($user['userID']));
	$name = last_name();
	add_employee(enter($name['nameID']));
	$event = 'emp';
	include('manage_users.php');
} else if ($action == 'edit_employee_form'){
	$user = get_employee_all($_POST['userID']);
	include('edit_employee_form.php');
} else if ($action == 'edit_employee'){
	update_user(enter($_POST['userID']), enter($_POST['userEmail']), enter($_POST['userName']), enter($_POST['lName']), enter($_POST['fName']), enter($_POST['phone']));
	update_employee(enter($_POST['nameID']), enter($_POST['jobStatus']), enter($_POST['profile']));
	$event = 'emp';
	include('manage_users.php');
} else if ($action == 'add_customer_form'){
	$states = get_states();
	include('add_customer_form.php');
} else if ($action == 'add_customer'){
	add_user(enter($_POST['userEmail']), enter($_POST['userName']), enter(password_hash($_POST['userPassword'], PASSWORD_DEFAULT)), enter($_POST['userLevel']));
	$user = last_user();
	add_name(enter($_POST['fName']), enter($_POST['lName']), enter($_POST['phone']), enter($user['userID']));
	$name = last_name();
	add_customer(enter($name['nameID']), enter($_POST['address1']), enter($_POST['address2']), enter($_POST['city']), enter($_POST['stateCode']), enter($_POST['postalCode']));
	include('manage_users.php');
} else if ($action == 'edit_customer_form'){
	$user = get_customer_all($_POST['userID']);
	$states = get_states();
	$option = "";
	include('edit_customer_form.php');
} else if ($action == 'edit_customer'){
	update_user(enter($_POST['userID']), enter($_POST['userEmail']), enter($_POST['userName']), enter($_POST['lName']), enter($_POST['fName']), enter($_POST['phone']));
	update_customer(enter($_POST['customerID']), enter($_POST['address1']), enter($_POST['address2']), enter($_POST['city']), enter($_POST['stateCode']), enter($_POST['postalCode']));
	include('manage_users.php');
} else if ($action == 'manage_products'){
	include('manage_products.php');
} else if ($action =='add_product_form'){
	include('add_product_form.php');
} else if ($action == 'add_product'){
	if (isset($_POST['requireTemp']))
		$requireTemp = $_POST['requireTemp'];
	else
		$requireTemp = 0;
	add_product(enter($_POST['productName']), enter($_POST['categoryID']), enter($_POST['productDescription']), enter($_POST['productPrice']), $requireTemp);
	$event = $_POST['categoryID'];
	include('manage_products.php');
} else if ($action == 'edit_product_form'){
	$product = get_product($_POST['productID']);
	include('edit_product_form.php');
} else if ($action == 'update_product'){
	update_product(enter($_POST['productID']), enter($_POST['productName']), enter($_POST['categoryID']), enter($_POST['productDescription']), enter($_POST['productPrice']), enter($_POST['productPhotoURL']), $_POST['requireTemp']);
	$event = $_POST['categoryID'];
	$msg = '<h2 class="center">Product Updated!</h2>';
	include('manage_products.php');
} else if ($action == 'delete_product'){
	$product = get_product($_POST['productID']);
	delete_product($_POST['productID']);
	$msg = '<h2 class="center">Product Deleted</h2>';
	$event = $product['categoryID'];
	include('manage_products.php');
} else if ($action == 'add_image_form'){
	if (isset($_GET['productID'])){
		$product = get_product($_GET['productID']);
	} else {
		$product = get_product($_POST['productID']);
	}
	include('add_image_form.php');
} else if ($action == 'add_image'){
	$product = get_product($_POST['productID']);
	$oldImage = $product['productPhotoURL'];
	$oldImage = "../".$oldImage;
	if (file_exists($oldImage) && $oldImage != '../images/default2.jpg')
		unlink($oldImage);
	$file_name = sanitize_file_name($_FILES['productPhotoURL']['name']);

	$temp = explode(".", $_FILES["productPhotoURL"]["name"]);
	$ext = end($temp);
	upload_file('productPhotoURL');

	$name1 = "../images/products/".$file_name;
	$name2 = "../images/products/p".$_POST['productID'].".".$ext;
	rename($name1, $name2);
	
	$newImage = "p".$product['productID'].".".$ext;
	add_photo_URL(enter($newImage), enter($_POST['productID']));
	
	$location = "../images/products/p".$_POST['productID'].".".$ext;
	resize_crop_image(300, 300, $location, $location);
	$event = $product['categoryID'];
	include('manage_products.php');
} else if ($action == 'add_faq_form'){
	include('add_faq_form.php');
} else if ($action == 'add_faq'){
	add_faq(enter($_POST['infoName']), enter($_POST['infoText']), enter($_POST['infoFAQ']));
	$event = 'faqs';
	include('manage_info.php');
} else if ($action == 'edit_profile'){
	include('edit_profile.php');
} else if ($action == 'update_admin'){
	update_user(enter($_SESSION['userID']), enter($_POST['userEmail']), enter($_POST['userName']), enter($_POST['lName']), enter($_POST['fName']), enter($_POST['phone']));
	update_admin(enter($_POST['adminID']), enter($_POST['profile']));
	$msg = 'Profile has been updated!';
	include('admin_main.php');
} else if ($action == 'edit_image'){
	include('edit_image.php');
} else if ($action == 'add_image_profile'){
	$admin = get_admin_info($_SESSION['userID']);
	$nameID = $admin['nameIDadmin'];
	$oldImage = $admin['thumbnailURL'];
	$oldImage = "../".$oldImage;
	if (file_exists($oldImage) && $oldImage != '../images/default.jpg')
		unlink($oldImage);
	$file_name = sanitize_file_name($_FILES['thumbnailURL']['name']);
	$temp = explode(".", $_FILES["thumbnailURL"]["name"]);
	$ext = end($temp);
	upload_file('thumbnailURL');
	$newImage = "a".$_SESSION['userID'].".".$ext;
	add_photo_URL_admin(enter($newImage), enter($nameID));
	$location = "../images/profiles/a".$_SESSION['userID'].".".$ext;
	resize_crop_image(300, 300, $location, $location);
	$_SESSION['editAdmin'] = 'No';
	include('edit_profile.php');
} else if ($action == 'under_construction'){
	include('under_construction.php');
} else if ($action == 'manage_info'){
	include('manage_info.php');
} else if ($action == 'edit_faq'){
	$infoID = $_POST['infoID'];
	$info = get_info_all($infoID);
	include('edit_faq.php');
} else if ($action == 'update_faq'){
	$infoID = $_POST['infoID'];
	update_faq(enter($infoID), enter($_POST['infoFAQ']), enter($_POST['infoText']));
	$event = 'faqs';
	include('manage_info.php');
} else if ($action == 'delete_faq'){
	$infoID = $_POST['infoID'];
	$info = get_info_all($infoID);
	include('confirm_delete_faq.php');
} else if ($action == 'confirm_delete_faq'){
	$infoID = $_POST['infoID'];
	delete_info($infoID);
	$event = 'faqs';
	include('manage_info.php');
} else if ($action == 'update_mission') {
	update_mission(enter($_POST['infoFAQ']), enter($_POST['infoText']));
	$msg = '<h2 class="center">Mission Updated!</h2>';
	include('manage_info.php');
} else if ($action == 'update_promo') {
	update_promo(enter($_POST['infoFAQ']), enter($_POST['infoText']));
	$msg = '<h2 class="center">Promo Updated!</h2>';
	include('manage_info.php');
} else if($action == 'add_coupon_form'){
	include('add_coupon_form.php');
} else if ($action == 'add_coupon'){
	add_coupon(enter($_POST['couponCode']), enter($_POST['couponValue']), enter($_POST['couponDesc']));
	$event = 'coupons';
	include('manage_info.php');
} else if ($action == 'edit_coupon') {
	$coupon = get_coupon_all($_POST['couponID']);
	include('edit_coupon.php');
} else if($action == 'update_coupon'){
	update_coupon(enter($_POST['couponID']), enter($_POST['couponCode']), enter($_POST['couponValue']), enter($_POST['couponDesc']));
	$event = 'coupons';
	$msg = '<h2 class="center">Coupon Updated!</h2>';
	include('manage_info.php');
} else if ($action == 'delete_coupon'){
	$couponID = $_POST['couponID'];
	$coupon = get_coupon_all($couponID);
	include('confirm_delete_coupon.php');
} else if ($action == 'confirm_delete_coupon'){
	$couponID = $_POST['couponID'];
	delete_coupon($couponID);
	$event = 'coupons';
	include('manage_info.php');
} else if ($action == 'confirm_delete_product') {
	$productID = $_POST['productID'];
	$product = get_product($productID);
	$msg = '<h2 class="center">Product Deleted!</h2>';
	include('confirm_delete_product.php');
} else if ($action =='all_orders'){
	include('all_orders.php');
} else if ($action == 'order_details'){
	include('order_details.php');
} else if ($action == 'add_comment'){
	$commentID = $_POST['commentID'];
	include('add_comment.php');
} else if ($action == 'add_comment_reply'){
	add_comment_reply(enter($_SESSION['userID']), enter($_POST['commentID']), enter($_POST['commentText']), date('Y-m-d H:i:s'));
	$event = 'comments';
	include('manage_info.php');
} else if ($action == 'ban_comment'){
	$commentID = $_POST['commentID'];
	include('ban_comment.php');
} else if ($action == 'comment_banned'){
	$commentID = $_POST['commentID'];
	ban_comment($commentID);
	$event = 'comments';
	include('manage_info.php');
} else if ($action == 'unban_comment'){
	$commentID = $_POST['commentID'];
	unban_comment($commentID);
	$event = 'comments';
	include('manage_info.php');
}

?>