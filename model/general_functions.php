<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: model/general_functions.php
**** Description: All users general functions
-->

<?php 
/*
**** Name: get_promos()
**** Arguements: none
**** Return Data: promos
**** Description: returns tha last 5 items added to database (promotional image slider)
*/
function get_promos(){
	global $db;
	$query = "SELECT * FROM products ORDER BY productID DESC LIMIT 5";
	$promos = $db->query($query);
	return $promos;
}
/*
**** Name: get_grub_menu()
**** Arguements: none
**** Return Data: results
**** Description: returns all food products (used for navigation)
*/
function get_grub_menu(){
	global $db;
	$query = "SELECT * FROM categories WHERE categoryID < 10 ORDER BY categoryName";
	$results = $db->query($query);
	return $results;
}
/*
**** Name: get_faqs()
**** Arguements: none
**** Return Data: results
**** Description: returns all FAQs
*/
function get_faqs(){
	global $db;
	$query = "SELECT * FROM information WHERE infoName = 'FAQ'";
	$results = $db->query($query);
	return $results;
}
/*
**** Name: get_name()
**** Arguements: userID
**** Return Data: results
**** Description: returns user and name data with matching userID
*/
function get_name($userID){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID WHERE users.userID = '$userID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: get_merch_menu()
**** Arguements: none
**** Return Data: results
**** Description: returns all merchandise
*/
function get_merch_menu(){
	global $db;
	$query = "SELECT * FROM categories WHERE categoryID > 10 ORDER BY categoryName";
	$results = $db->query($query);
	return $results;
}
/*
**** Name: get_about_text()
**** Arguements: none
**** Return Data: results
**** Description: returns all information where infoName and 'about'
*/
function get_about_text(){
	global $db;
	$query = "SELECT * FROM information WHERE infoName = 'about'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: get_mission_text()
**** Arguements: none
**** Return Data: results
**** Description: returns mission text and heading
*/
function get_mission_text(){
	global $db;
	$query = "SELECT * FROM information WHERE infoName = 'mission'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: add_to_order()
**** Arguements: orderID, productID, productQty, productTotal, productSpecial, productTemp
**** Return Data: none
**** Description: adds a product to an order
*/
function add_to_order($orderID, $productID, $productQty, $productTotal, $productSpecial, $productTemp){
	global $db;
    $query = "INSERT INTO orderdetails
                 (orderID, productID, productQty, productTotal, productSpecial, productTemp)
              VALUES
                 ('$orderID', '$productID', '$productQty', '$productTotal', '$productSpecial', '$productTemp')";
    $db->exec($query);
}
/*
**** Name: add_new_order()
**** Arguements: orderStartDate, customerID
**** Return Data: none
**** Description: adds a new order to the database
*/
function add_new_order($orderStartDate, $customerID){
	global $db;
    $query = "INSERT INTO orders
                 (orderStartDate, customerID)
              VALUES
                 ('$orderStartDate', '$customerID')";
    $db->exec($query);
}
/*
**** Name: get_payment_type()
**** Arguements: payment
**** Return Data: results
**** Description: returns paymentMethod matching payment
*/
function get_payment_type($payment){
	global $db;
	$query = "SELECT * FROM payment WHERE paymentMethod = '$payment'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;	
}
/*
**** Name: get_new_order()
**** Arguements: none
**** Return Data: results
**** Description: returns the last order added to the system
*/
function get_new_order(){
	global $db;
	$query = "SELECT * FROM orders ORDER BY orderID DESC";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: get_customer()
**** Arguements: userID
**** Return Data: result
**** Description: returns user, name, and customer data with matching userID
*/
function get_customer($userID){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID JOIN customers ON names.nameID = customers.nameIDcust WHERE users.userID = '$userID'";
	$results = $db->query($query);
	$results = $results->fetch();
	$result = $results['customerID'];
	return $result;
}
/*
**** Name: get_customer_orders
**** Arguements: customerID
**** Return Data: results
**** Description: returns all orders matching customerID
*/
function get_customer_orders($customerID){
	global $db;
	$query = "SELECT * FROM orders WHERE customerID = '$customerID' AND orderSendDate != 'NULL' ORDER BY orderSendDate DESC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_unsent_orders()
**** Arguements: customerID
**** Return Data: results
**** Description: returns all orders that haven't been sent with matching customerID
*/
function get_unsent_orders($customerID){
	global $db;
	$query = "SELECT * FROM orders WHERE customerID = '$customerID' AND orderSendDate IS NULL";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_order_details()
**** Arguements: orderID
**** Return Data: results
**** Description: returns all orders with matching orderID
*/
function get_order_details($orderID){
	global $db;
	$query = "SELECT * FROM orderdetails WHERE orderID = '$orderID'";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_current_order()
**** Arguements: orderID
**** Return Data: results
**** Description: returns all orders with matching orderID
*/
function get_current_order($orderID){
	global $db;
	$query = "SELECT * FROM orders WHERE orderID = '$orderID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;	
}
/*
**** Name: update_total()
**** Arguements: orderID, orderSubTotal, orderTax, orderTotal
**** Return Data: none
**** Description: updates all orders with matching orderID
*/
function update_total($orderID, $orderSubTotal, $orderTax, $orderTotal){
	global $db;
	$query = "UPDATE orders SET 
		orderSubTotal = '$orderSubTotal',
		orderTax = '$orderTax',
		orderTotal = '$orderTotal'
		WHERE orderID = '$orderID'";
	$db->exec($query);
}
/*
**** Name: delete_all_items()
**** Arguements: orderID
**** Return Data: none
**** Description: deletes all order items with matching orderID
*/
function delete_all_items($orderID){
	global $db;
	$query = "DELETE from orderdetails WHERE orderID = '$orderID'";
	$db->exec($query);
}
/*
**** Name: delete_order()
**** Arguements: orderID
**** Return Data: none
**** Description: deletes an order with matching orderID
*/
function delete_order($orderID){
	global $db;
	$query = "DELETE from orders WHERE orderID = '$orderID'";
	$db->exec($query);
}
/*
**** Name: get_details()
**** Arguements: orderDetailsID
**** Return Data: results
**** Description: returns all orderdetails with matchingn orderDetailsID
*/
function get_details($orderDetailsID){
	global $db;
	$query = "SELECT * FROM orderdetails WHERE orderDetailsID = '$orderDetailsID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;		
}
/*
**** Name: update_item_order()
**** Arguements: productQty, productTotal, $productSpecial, $productTemp, orderDetailsID
**** Return Data: none
**** Description: updates order item with matching orderDetailsID
*/
function update_item_order($productQty, $productTotal, $productSpecial, $productTemp, $orderDetailsID){
	global $db;
	$query = "UPDATE orderdetails SET 
		productQty = '$productQty',
		productTotal = '$productTotal',
		productSpecial = '$productSpecial',
		productTemp = '$productTemp'
		WHERE orderDetailsID = '$orderDetailsID'";
	$db->exec($query);
}
/*
**** Name: delete_item()
**** Arguements: orderDetailsID
**** Return Data: none
**** Description: deletes an order item with matching orderDetailsID
*/
function delete_item($orderDetailsID){
	global $db;
	$query = "DELETE from orderdetails WHERE orderDetailsID = '$orderDetailsID'";
	$db->exec($query);
}
/*
**** Name: get_new_orders()
**** Arguements: none
**** Return Data: results
**** Description: returns all orders that havent been sent to system
*/
function get_new_orders(){
	global $db;
	$query = "SELECT * FROM orders WHERE orderDate != 'NULL' AND orderStatus = 'Order Sent' ORDER BY orderDate DESC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_all_customer_info()
**** Arguements: userID
**** Return Data: none
**** Description: returns all customer, name, and user data with matching userID
*/
function get_all_customer_info($userID){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID JOIN customers ON names.nameID = customers.nameIDcust JOIN state ON state.stateCode = customers.stateCode WHERE users.userID = '$userID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: add_photo_URL_customer()
**** Arguements: file_name, nameID
**** Return Data: none
**** Description: updates customer profile image
*/
function add_photo_URL_customer($file_name, $nameID){
	global $db;
	$query = "UPDATE customers SET 
		thumbnailURL = 'images/profiles/$file_name'
		WHERE nameIDcust = '$nameID'";
	$db->exec($query);
}
/*
**** Name: get_active_employees()
**** Arguements: none
**** Return Data: employees
**** Description: returns all employees that are currently employed
*/
function get_active_employees(){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID JOIN employees ON names.nameID = employees.nameID WHERE users.userLevel = 'E' AND jobStatus = 'Employed' ORDER BY lName";
	$employees = $db->query($query);
	return $employees;
}
/*
**** Name: money()
**** Arguements: num
**** Return Data: num
**** Description: returns formated number with 2 decimal places
*/
function money($num){
	$num = round($num, 2);
	$num = number_format((float)$num, 2, '.', '');
	return $num;
}
/*
**** Name: get_current_promo()
**** Arguements: none
**** Return Data: results
**** Description: returns current promo statement
*/
function get_current_promo(){
	global $db;
	$query = "SELECT * FROM information WHERE infoName = 'promo'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;	
}
/*
**** Name: order_payment()
**** Arguements: delivery, paymentID, orderID
**** Return Data: none
**** Description: updates orders with delivery and payment method with matching orderID
*/
function order_payment($delivery, $paymentID, $orderID){
	global $db;
	$query = "UPDATE orders SET 
		delivery = '$delivery',
		paymentID = '$paymentID'
		WHERE orderID = '$orderID'";
	$db->exec($query);	
}
/*
**** Name: order_payment_credit()
**** Arguements: delivery, orderID, cardName, cardType, cardNumber, cardCw, cardExpires
**** Return Data: none
**** Description: updates oder payment as credt and enters credit card info into system
*/
function order_payment_credit($delivery, $orderID, $cardName, $cardType, $cardNumber, $cardCw, $cardExpires){
	order_payment($delivery, '2', $orderID);
	global $db;
	$query = "INSERT INTO creditcards 
			(orderIDcredit, cardName, cardType, cardNumber, cardCw, cardExpires)
				VALUES
			('$orderID', '$cardName', '$cardType', '$cardNumber', '$cardCw', '$cardExpires')";		
	$db->exec($query);		
}
/*
**** Name: get_card_info()
**** Arguements: orderID
**** Return Data: results
**** Description: returns all credit card info with matching orderID
*/
function get_card_info($orderID){
	global $db;
	$query = "SELECT * FROM creditcards WHERE orderIDcredit = '$orderID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;		
}
/*
**** Name: add_delivery()
**** Arguements: orderID, orderTotal
**** Return Data: none
**** Description: updates order total when order is sent for delivery
*/
function add_delivery($orderID, $orderTotal){
	global $db;
	$query = "UPDATE orders SET 
		orderDeliveryCharge = 5,
		orderTotal = '$orderTotal'
		WHERE orderID = '$orderID'";
	$db->exec($query);		
}
/*
**** Name: send_order()
**** Arguements: orderID, orderSendDate
**** Return Data: none
**** Description: updates orderSendDate with matching orderID
*/
function send_order($orderID, $orderSendDate){
	global $db;
	$query = "UPDATE orders SET 
		orderSendDate = '$orderSendDate'
		WHERE orderID = '$orderID'";
	$db->exec($query);			
}
/*
**** Name: reset_order()
**** Arguements: orderID, orderSubTotal, orderTax, orderTotal
**** Return Data: none
**** Description: resets order total and tax with matching orderID
*/
function reset_order($orderID, $orderSubTotal, $orderTax, $orderTotal){
	global $db;
	$query = "UPDATE orders SET 
		orderSubTotal = '$orderSubTotal',
		orderTax = '$orderTax', 
		orderTotal = '$orderTotal', 
		couponID = NULL, 
		orderDeliveryCharge = '0'
		WHERE orderID = '$orderID'";
	$db->exec($query);		
}
/*
**** Name: change_address()
**** Arguements: customerID, daddress1, daddress2, dcity, dstateCode, dpostalCode
**** Return Data: none
**** Description: updates customer delivery address with matching customerID
*/
function change_address($customerID, $daddress1, $daddress2, $dcity, $dstateCode, $dpostalCode){
	global $db;
	$query = "UPDATE customers SET 
		daddress1 = '$daddress1',
		daddress2 = '$daddress2',
		dcity = '$dcity',
		dstateCode = '$dstateCode',
		dpostalCode = '$dpostalCode'
		WHERE customerID = '$customerID'";
	$db->exec($query);				
}
/*
**** Name: get_discount_amount()
**** Arguements: couponID
**** Return Data: results
**** Description: returns coupon value with matching couponID
*/
function get_discount_amount($couponID){
	global $db;
	$query = "SELECT * FROM coupons WHERE couponID = '$couponID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: get_coupon_info()
**** Arguements: couponCode
**** Return Data: results
**** Description: returns coupon with matching couponCode
*/
function get_coupon_info($couponCode){
	global $db;
	$query = "SELECT * FROM coupons WHERE couponCode = '$couponCode'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;	
}
/*
**** Name: add_discount()
**** Arguements: orderID, couponID
**** Return Data: none
**** Description: adds a coupon to an order with matchingn orderID
*/
function add_discount($orderID, $couponID){
	global $db;
	$query = "UPDATE orders SET 
		couponID = '$couponID'
		WHERE orderID = '$orderID'";
	$db->exec($query);					
}
/*
**** Name: reset_credit()
**** Arguements: orderID
**** Return Data: none
**** Description: deletes credit card with matching orderID
*/
function reset_credit($orderID){
	global $db;
	$query = "DELETE FROM creditcards 
		WHERE orderIDcredit = '$orderID'";
	$db->exec($query);						
}
/*
**** Name: close_credit()
**** Arguements: orderID, orderTotal
**** Return Data: none
**** Description: updates credit card info with orderTotal with matching orderID
*/
function close_credit($orderID, $orderTotal){
	global $db;
	$query = "UPDATE creditcards SET 
		cardChargeAmount = '$orderTotal'
		WHERE orderIDcredit = '$orderID'";
	$db->exec($query);					
}
/*
**** Name: paid_order()
**** Arguements: orderID
**** Return Data: none
**** Description: updates order payment with matching orderID
*/
function paid_order($orderID){
	global $db;
	$query = "UPDATE orders SET 
		paid = 'Y'
		WHERE orderID = '$orderID'";
	$db->exec($query);					
}
/*
**** Name: add_instructions()
**** Arguements: orderID, deliveryComments
**** Return Data: none
**** Description: updates order deliveryComments with matching orderID
*/
function add_instructions($orderID, $deliveryComments){
	global $db;
	$query = "UPDATE orders SET 
		deliveryComments = '$deliveryComments'
		WHERE orderID = '$orderID'";
	$db->exec($query);						
}
/*
**** Name: search_menu()
**** Arguements: search
**** Return Data: results
**** Description: returns all products that have a productName LIKE search
*/
function search_menu($search){
	global $db;
	$query = "SELECT * FROM products WHERE productName LIKE '%$search%'";
	$results = $db->query($query);
	return $results;		
}
/*
**** Name: get_employee_info()
**** Arguements: employeeID
**** Return Data: results
**** Description: returns name and employee info with matching employeeID
*/
function get_employee_info($employeeID){
	global $db;
	$query = "SELECT * FROM employees JOIN names ON employees.nameID = names.nameID WHERE employeeID = '$employeeID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;		
}
/*
**** Name: get_all_comments()
**** Arguements: none
**** Return Data: results
**** Description: returns all comments that haven't been banned and are the first in a comment block
*/
function get_all_comments(){
	global $db;
	$query = "SELECT * FROM comments WHERE postID = 0 AND approved = 1 ORDER BY commentDate DESC";
	$results = $db->query($query);
	return $results;		
}
/*
**** Name: get_my_comments()
**** Arguements: userID
**** Return Data: results
**** Description: returns all comments with matching userID
*/
function get_my_comments($userID){
	global $db;
	$query = "SELECT * FROM comments WHERE postID = 0 AND approved = 1 AND userIDcomm = '$userID' ORDER BY commentDate DESC";
	$results = $db->query($query);
	return $results;		
}
/*
**** Name: get_other_comments()
**** Arguements: postID
**** Return Data: results
**** Description: returns all comments that have same postID
*/
function get_other_comments($postID){
	global $db;
	$query = "SELECT * FROM comments WHERE postID = $postID AND approved = 1 ORDER BY commentDate DESC";
	$results = $db->query($query);
	return $results;		
}
/*
**** Name: add_new_comment()
**** Arguements: userIDcomm, commentsRating, commentText, commentDate
**** Return Data: none
**** Description: adds a new comment to the system
*/
function add_new_comment($userIDcomm, $commentRating, $commentText, $commentDate){
	global $db;
    $query = "INSERT INTO comments
                 (userIDcomm, commentRating, commentText, postID, commentDate)
              VALUES
                 ('$userIDcomm', '$commentRating', '$commentText', 0, '$commentDate')";
    $db->exec($query);
}
/*
**** Name: add_comment_reply()
**** Arguements: userIDcomm, postID, commentText, commentDate
**** Return Data: none
**** Description: adds a comment reply to the system
*/
function add_comment_reply($userIDcomm, $postID, $commentText, $commentDate){
	global $db;
    $query = "INSERT INTO comments
                 (userIDcomm, commentText, postID, commentDate)
              VALUES
                 ('$userIDcomm', '$commentText', $postID , '$commentDate')";
    $db->exec($query);	
}
/*
**** Name: resize_crop_image()
**** Arguements: max_width, max_height, source_file, dst_dir, quality
**** Return Data: none
**** Description: Crops source_file from center to max_height and max_width and stores in dst_dir
*/
function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
    $imgsize = getimagesize($source_file);
    $width = $imgsize[0];
    $height = $imgsize[1];
    $mime = $imgsize['mime'];
 
    switch($mime){
        case 'image/gif':
            $image_create = "imagecreatefromgif";
            $image = "imagegif";
            break;
 
        case 'image/png':
            $image_create = "imagecreatefrompng";
            $image = "imagepng";
            $quality = 7;
            break;
 
        case 'image/jpeg':
            $image_create = "imagecreatefromjpeg";
            $image = "imagejpeg";
            $quality = 80;
            break;
 
        case 'image/jpg':
            $image_create = "imagecreatefromjpg";
            $image = "imagejpg";
            $quality = 80;
            break;
 
        default:
            return false;
            break;
    }
     
    $dst_img = imagecreatetruecolor($max_width, $max_height);
    $src_img = $image_create($source_file);
     
    $width_new = $height * $max_width / $max_height;
    $height_new = $width * $max_height / $max_width;
    //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
    if($width_new > $width){
        //cut point by height
        $h_point = (($height - $height_new) / 2);
        //copy image
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    }else{
        //cut point by width
        $w_point = (($width - $width_new) / 2);
        imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    }
     
    $image($dst_img, $dst_dir, $quality);
 
    if($dst_img)imagedestroy($dst_img);
    if($src_img)imagedestroy($src_img);
}

?>