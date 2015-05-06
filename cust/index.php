<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/index.php
**** Description: Customer controller
-->

<?php
session_start();

require('../model/database.php');
require('../model/login_functions.php');
require('../model/admin_functions.php');
require('../model/general_functions.php');
require('../model/image_upload_functions.php');

date_default_timezone_set( 'America/New_York' );

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else if (!isset($_SESSION['userID'])) {
	header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
	exit();
} else if (isset($_SESSION['userID'])) {
	$userID = $_SESSION['userID'];
	$userLevel = get_user_level($userID);
	if ($userLevel == 'C'){
		$action = 'view_cart';
	} else {
		header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
		exit();
	}
}

if ($action == 'view_cart') {
	if (isset($_GET['event']))
		$event = $_GET['event'];
	else if (!isset($_SESSION['orderID']))
		$event = 'unsent_cart';
	else
		$event = 'current_cart';
	include('view_cart.php');
} else if ($action == 'under_construction'){
	include('../under_construction.php');
} else if ($action =='order_page') {
	if (isset($_POST['productID']))
		$productID = $_POST['productID'];
	if (isset($_GET['productID']))
		$productID = $_GET['productID'];
	if (!isset($_SESSION['orderID']))
		include('new_order.php');
	else
		include('order_page.php');
} else if ($action === 'add_order_item'){
	$orderID = $_SESSION['orderID'];
	$productID = $_POST['productID'];
	$productQty = $_POST['productQty'];
	$productTotal = $productQty * $_POST['productPrice'];
	$productSpecial = $_POST['productSpecial'];
	$order = get_current_order($orderID);
	$orderSubTotal = $order['orderSubTotal'];
	$orderSubTotal += $productTotal;
	$orderTax = money($orderSubTotal * .075);
	$orderTotal = money($orderSubTotal + $orderTax);
	
	if (isset($_POST['productTemp']))
		$productTemp = $_POST['productTemp'];
	else
		$productTemp = "";
	add_to_order(enter($orderID), enter($productID), enter($productQty), enter($productTotal), enter($productSpecial), enter($productTemp));
	update_total(enter($orderID), enter($orderSubTotal), enter($orderTax), enter($orderTotal));
	header('Location: //localhost/web289/gregsgrub/index.php?action=menu_main');
	exit();
} else if ($action == 'add_new_order'){
	$customerID = get_customer($_SESSION['userID']);
	add_new_order(enter(date('Y-m-d H:i:s')), enter($customerID));
	$orders = get_new_order();
	$_SESSION['orderID'] = $orders['orderID'];
	if (isset($_GET['productID'])){
		$productID = $_GET['productID'];
		include('order_page.php');
	} else
	header('Location: //localhost/web289/gregsgrub/index.php?action=menu_main');
	exit();
} else if ($action == 'select_order'){
	$orderID = $_GET['orderID'];
	$_SESSION['orderID'] = $orderID;
	$event = 'current_cart';
	include('view_cart.php');
} else if ($action == 'delete_order'){
	$orderID = $_GET['orderID'];
	delete_all_items($orderID);
	delete_order($orderID);
	if (isset($_SESSION['orderID'])){
		if ($orderID == $_SESSION['orderID'])
			unset($_SESSION['orderID']);
	}
	$event = 'unsent_cart';
	include('view_cart.php');
} else if ($action =='confirm_delete_order'){
	$orderID = $_GET['orderID'];
	include('confirm_delete_order.php');
} else if ($action == 'edit_item'){
	$orderDetailsID = $_GET['orderDetailsID'];
	$order = get_details($orderDetailsID);
	include('order_page.php');
} else if ($action == 'update_order_item'){
	$orderDetailsID = $_POST['orderDetailsID'];
	$oldTotal = $_POST['oldTotal'];
	$productQty = $_POST['productQty'];
	$productTotal = $productQty * $_POST['productPrice'];
	$productSpecial = $_POST['productSpecial'];
	$orderID = $_SESSION['orderID'];
	$order = get_current_order($orderID);
	$orderSubTotal = $order['orderSubTotal'];
	$orderSubTotal -= $oldTotal;
	$orderSubTotal += $productTotal;
	$orderTax = money($orderSubTotal * .075);
	$orderTotal = money($orderSubTotal + $orderTax);

	if (isset($_POST['productTemp']))
		$productTemp = $_POST['productTemp'];
	else
		$productTemp = "";

	update_item_order(enter($productQty), enter($productTotal), enter($productSpecial), enter($productTemp), enter($orderDetailsID));
	update_total(enter($orderID), enter($orderSubTotal), enter($orderTax), enter($orderTotal));

	header('Location: //localhost/web289/gregsgrub/index.php?action=menu_main');
	exit();
} else if ($action == 'confirm_delete_item'){
	$orderDetailsID = $_GET['orderDetailsID'];
	include('confirm_delete_item.php');
} else if ($action == 'delete_item'){
	$orderDetailsID = $_GET['orderDetailsID'];
	$order = get_details($orderDetailsID);
	$productTotal = $order['productTotal'];
	$orderID = $_SESSION['orderID'];
	$order = get_current_order($orderID);
	$orderSubTotal = $order['orderSubTotal'];
	$orderSubTotal -= $productTotal;
	$orderTax = money($orderSubTotal * .075);
	$orderTotal = money($orderSubTotal + $orderTax);

	delete_item($orderDetailsID);
	update_total(enter($orderID), enter($orderSubTotal), enter($orderTax), enter($orderTotal));
	$event = 'current_cart';
	include('view_cart.php');
} else if ($action == 'process_order'){
	include('process_order.php');
} else if ($action == 'edit_profile'){
	include('edit_profile.php');
} else if ($action == 'update_customer'){
	update_user(enter($_POST['userID']), enter($_POST['userEmail']), enter($_POST['userName']), enter($_POST['lName']), enter($_POST['fName']), enter($_POST['phone']));
	update_customer(enter($_POST['customerID']), enter($_POST['address1']), enter($_POST['address2']), enter($_POST['city']), enter($_POST['stateCode']), enter($_POST['postalCode']));
	$msg = 'Profile has been updated!';
	$event = 'current_cart';
	include('view_cart.php');
} else if ($action == 'edit_image'){
	include('edit_image.php');
} else if ($action == 'add_image'){
	$customer = get_all_customer_info($_SESSION['userID']);
	$nameID = $customer['nameIDcust'];
	$oldImage = $customer['thumbnailURL'];
	$oldImage = "../".$oldImage;
	if (file_exists($oldImage) && $oldImage != '../images/default.jpg')
		unlink($oldImage);
	$file_name = sanitize_file_name($_FILES['thumbnailURL']['name']);
	$temp = explode(".", $_FILES["thumbnailURL"]["name"]);
	$ext = end($temp);
	upload_file('thumbnailURL');
	
	$newImage = "c".$_SESSION['userID'].".".$ext;
	add_photo_URL_customer(enter($newImage), enter($nameID));
	$location = "../images/profiles/c".$_SESSION['userID'].".".$ext;
	resize_crop_image(300, 300, $location, $location);
	include('edit_profile.php');
} else if ($action == 'confirm_order'){
	$delivery = $_POST['delivery'];
	$paymentID = $_POST['paymentID'];
	$orderID = $_SESSION['orderID'];
	if (isset($_POST['cardExpires'])){
		$cardExpires = strtotime($_POST['cardExpires']);
		$cardExpires = date('Y-m-d', $cardExpires);
	}

	// if cash payment or paying on pickup
	if ($paymentID == '1' || $paymentID == '3'){
		order_payment(enter($delivery), enter($paymentID), enter($orderID));
	} else { // if paying with credit card
		if ($delivery == '' || $_POST['cardName'] == '' || $_POST['cardNumber'] == '' || $_POST['cardCw'] == '' || $cardExpires == ''){
			$msg = 'Invalid Card Info';
			$event = 'current_cart';
			include('view_cart.php');
			exit();
		}
		order_payment_credit(enter($delivery), enter($orderID), enter($_POST['cardName']), enter($_POST['cardType']), enter($_POST['cardNumber']), enter($_POST['cardCw']), enter($cardExpires));
	}

	if ($delivery == 'Y'){
		$order = get_current_order($orderID);
		$orderTotal = $order['orderTotal'] + 5;
		add_delivery(enter($orderID), enter($orderTotal));
	}
	add_instructions(enter($orderID), enter($_POST['deliveryComments']));
	$msg = '';
	include ('confirm_order.php');
} else if ($action == 'send_order'){
	send_order($_SESSION['orderID'], date('Y-m-d H:i:s'));
	$card = get_card_info($_SESSION['orderID']);
	if (isset($card['cardID'])){
		$order = get_current_order($_SESSION['orderID']);
		close_credit(enter($_SESSION['orderID']), enter($order['orderTotal']));
		paid_order(enter($_SESSION['orderID']));
	}
	$_SESSION['orderID'] = NULL;
	$event = 'old_cart';
	include('view_cart.php');
} else if ($action == 'change_order'){
	$order = get_current_order($_SESSION['orderID']);
	$orderSubTotal = $order['orderSubTotal'];
	$orderTax = money($orderSubTotal * .075);
	$orderTotal = money($orderSubTotal + $orderTax);
	reset_order(enter($_SESSION['orderID']), enter($orderSubTotal), enter($orderTax), enter($orderTotal));
	reset_credit(enter($_SESSION['orderID']));
	$event = 'current_cart';
	include('view_cart.php');
} else if ($action == 'change_address'){
	include('change_address.php');
} else if ($action == 'update_delivery'){
	if (isset($_POST['useHome'])){
		$customer = get_all_customer_info($_SESSION['userID']);
		change_address(enter($customer['customerID']), enter($customer['address1']), enter($customer['address2']), enter($customer['city']), enter($customer['stateCode']), enter($customer['postalCode']));
		$msg = '';
		include('confirm_order.php');	
	} else {
		if (isset($_POST['daddress2'])){
			$daddress2 = $_POST['daddress2'];
		} else {
			$daddress2 = '';
		}
		$customer = get_all_customer_info($_SESSION['userID']);
		change_address(enter($customer['customerID']), enter($_POST['daddress1']), enter($daddress2), enter($_POST['dcity']), enter($_POST['dstateCode']), enter($_POST['dpostalCode']));
		$msg = '';
		include('confirm_order.php');
	}
} else if ($action == 'add_coupon'){
	include('add_coupon.php');
} else if ($action == 'update_coupon'){
	$coupon = get_coupon_info($_POST['couponCode']);
	if (isset($coupon['couponID'])){		
		$order = get_current_order($_SESSION['orderID']);
		$orderSubTotal = $order['orderSubTotal'];
		if ($orderSubTotal > 9.99){
			add_discount(enter($_SESSION['orderID']), enter($coupon['couponID']));
			$orderSubTotal2 = $orderSubTotal - $coupon['couponValue'];
			$orderTax = money($orderSubTotal2 * .075);
			$orderTotal = money($orderSubTotal2 + $orderTax);
			$orderTotal = $orderTotal + $order['orderDeliveryCharge'];
			update_total(enter($_SESSION['orderID']), enter($orderSubTotal), enter($orderTax), enter($orderTotal));
			$msg = '';
			include('confirm_order.php');
		} else {
			$msg = '<h4 class="error2">Order SubTotal must be greater than $10</h4>';
			include('confirm_order.php');	
		}
	} else {
		$msg = '<h4 class="error2">Bad Coupon Code</h4>';
		include('confirm_order.php');
	}
} else if ($action == 'order_details'){
	$orderID = $_GET['orderID'];
	include('order_details.php');
} else if ($action == 'new_comment'){
	include('new_comment.php');
} else if ($action == 'add_new_comment'){
	add_new_comment(enter($_SESSION['userID']), enter($_POST['commentRating']), enter($_POST['commentText']), enter(date('Y-m-d H:i:s')));
	header('Location: //localhost/web289/gregsgrub/index.php?action=comments');
	exit();
} else if ($action == 'comment_reply'){
	$commentID = $_GET['commentID'];
	include('comment_reply.php');
} else if ($action == 'add_comment_reply'){
	add_comment_reply(enter($_SESSION['userID']), enter($_POST['commentID']), enter($_POST['commentText']), enter(date('Y-m-d H:i:s')));
	header('Location: //localhost/web289/gregsgrub/index.php?action=comments');
	exit();
} else if($action == 'prev_comments'){
	include('prev_comments.php');
}

?>