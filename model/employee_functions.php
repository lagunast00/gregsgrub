<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: model/employee_functions.php
**** Description: Employee functions
-->

<?php
/*
**** Name: update_employee_profile()
**** Arguements: employeeID, profile
**** Return Data: none
**** Description: updates employee profile with matching employeeID
*/
function update_employee_profile($employeeID, $profile){
	global $db;
	$query = "UPDATE employees SET 
		profile = '$profile'
		WHERE employeeID = '$employeeID'";
	$db->exec($query);
}
/*
**** Name: add_photo_URL_emplpoyee()
**** Arguements: file_name, nameID
**** Return Data: none
**** Description: adds profile photo to employee with matching nameID
*/
function add_photo_URL_employee($file_name, $nameID){
	global $db;
	$query = "UPDATE employees SET 
		thumbnailURL = 'images/profiles/$file_name'
		WHERE nameID = '$nameID'";
	$db->exec($query);
}
/*
**** Name: get_new_orders_count()
**** Arguements: none
**** Return Data: results
**** Description: returns all orders whose orderStatus is 'Order Sent'
*/
function get_new_orders_count(){
	global $db;
	$query = "SELECT * FROM orders WHERE orderStartDate IS NOT NULL AND orderSendDate IS NOT NULL AND orderCompleteDate IS NULL AND orderStatus = 'Order Sent' ORDER BY orderSendDate DESC";
	$results = $db->query($query);
	return $results;
}
/*
**** Name: get_delivery_orders()
**** Arguements: employeeID
**** Return Data: results
**** Description: returns all delivery orders with matching employeeID
*/
function get_delivery_orders($employeeID){
	global $db;
	$query = "SELECT * FROM orders WHERE orderCompleteDate IS NOT NULL AND delivery = 'Y' AND employeeID = '$employeeID' AND orderStatus != 'Order Completed' ORDER BY orderCompleteDate ASC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_delivery_orders_date()
**** Arguements: employeeID
**** Return Data: results
**** Description: returns all delivery orders that are completed organized by completion date
*/
function get_delivery_orders_date($employeeID){
	global $db;
	$query = "SELECT * FROM orders WHERE orderCompleteDate IS NOT NULL AND delivery = 'Y' AND employeeID = '$employeeID' AND orderStatus != 'Order Completed' ORDER BY orderCompleteDate DESC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_delivery_orders_name()
**** Arguements: employeeID
**** Return Data: results
**** Description: returns all delivery orders that are completed organized by name
*/
function get_delivery_orders_name($employeeID){
	global $db;
	$query = "SELECT * FROM orders JOIN customers ON orders.customerID = customers.customerID JOIN names ON customers.nameIDcust = names.nameID WHERE orders.orderCompleteDate IS NOT NULL AND orders.delivery = 'Y' AND orders.employeeID = '$employeeID' AND orders.orderStatus != 'Order Completed' ORDER BY names.lName ASC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_delivery_orders_number()
**** Arguements: employeeID
**** Return Data: results
**** Description: returns all delivery orders that are completed organized by orderID
*/
function get_delivery_orders_number($employeeID){
	global $db;
	$query = "SELECT * FROM orders WHERE orderCompleteDate IS NOT NULL AND delivery = 'Y' AND employeeID = '$employeeID' AND orderStatus != 'Order Completed' ORDER BY orderID ASC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_carryout_orders()
**** Arguements: none
**** Return Data: results
**** Description: returns all carryout orders that are completed organized by completion date ASC
*/
function get_carryout_orders(){
	global $db;
	$query = "SELECT * FROM orders WHERE orderCompleteDate IS NOT NULL AND delivery = 'N' AND orderStatus != 'Order Completed' ORDER BY orderCompleteDate ASC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_carryout_orders_date()
**** Arguements: none
**** Return Data: results
**** Description: returns all carryout orders that are completed organized by completion date DESC
*/
function get_carryout_orders_date(){
	global $db;
	$query = "SELECT * FROM orders WHERE orderCompleteDate IS NOT NULL AND delivery = 'N' AND orderStatus != 'Order Completed' ORDER BY orderCompleteDate DESC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_carryout_orders_name()
**** Arguements: none
**** Return Data: results
**** Description: returns all carryout orders that are completed organized by name
*/
function get_carryout_orders_name(){
	global $db;
	$query = "SELECT * FROM orders JOIN customers ON orders.customerID = customers.customerID JOIN names ON customers.nameIDcust = names.nameID WHERE orders.orderCompleteDate IS NOT NULL AND orders.delivery = 'N' AND orders.orderStatus != 'Order Completed' ORDER BY names.lName ASC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_carryout_orders_number()
**** Arguements: none
**** Return Data: results
**** Description: returns all carryout orders that are completed organized by orderID
*/
function get_carryout_orders_number(){
	global $db;
	$query = "SELECT * FROM orders WHERE orderCompleteDate IS NOT NULL AND delivery = 'N' AND orderStatus != 'Order Completed' ORDER BY orderID ASC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_completed_orders()
**** Arguements: none
**** Return Data: results
**** Description: returns all orders with orderStatus 'Order Completed'
*/
function get_completed_orders(){
	global $db;
	$query = "SELECT * FROM orders WHERE orderCompleteDate IS NOT NULL AND orderStatus = 'Order Completed' ORDER BY orderCompleteDate ASC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_completed_orders_date()
**** Arguements: none
**** Return Data: results
**** Description: returns all orders with orderStatus 'Order Completed' organized by completion date DESC
*/
function get_completed_orders_date(){
	global $db;
	$query = "SELECT * FROM orders WHERE orderCompleteDate IS NOT NULL AND orderStatus = 'Order Completed' ORDER BY orderCompleteDate DESC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_completed_orders_name()
**** Arguements: none
**** Return Data: results
**** Description: returns all orders with orderStatus 'Order Completed' organized by name
*/
function get_completed_orders_name(){
	global $db;
	$query = "SELECT * FROM orders JOIN customers ON orders.customerID = customers.customerID JOIN names ON customers.nameIDcust = names.nameID WHERE orders.orderCompleteDate IS NOT NULL AND orders.orderStatus = 'Order Completed' ORDER BY names.lName ASC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_completed_orders_number()
**** Arguements: none
**** Return Data: results
**** Description: returns all orders with orderStatus 'Order Completed' organized orderID
*/
function get_completed_orders_number(){
	global $db;
	$query = "SELECT * FROM orders WHERE orderCompleteDate IS NOT NULL AND orderStatus = 'Order Completed' ORDER BY orderID ASC";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_cooking_orders_count()
**** Arguements: none
**** Return Data: results
**** Description: returns all orders with orderStatus 'Order Cooking'
*/
function get_cooking_orders_count(){
	global $db;
	$query = "SELECT * FROM orders WHERE orderStartDate IS NOT NULL AND orderSendDate IS NOT NULL AND orderCompleteDate IS NULL AND orderStatus = 'Order Cooking' ORDER BY orderSendDate DESC";
	$results = $db->query($query);
	return $results;
}
/*
**** Name: get_check_orders_count()
**** Arguements: none
**** Return Data: results
**** Description: returns all orders with orderStatus 'Checking Order'
*/
function get_check_orders_count(){
	global $db;
	$query = "SELECT * FROM orders WHERE orderStartDate IS NOT NULL AND orderSendDate IS NOT NULL AND orderCompleteDate IS NULL AND orderStatus = 'Checking Order' ORDER BY orderSendDate DESC";
	$results = $db->query($query);
	return $results;
}
/*
**** Name: get_all_order_info()
**** Arguements: orderID
**** Return Data: results
**** Description: returns all customer and name data with matcing orderID
*/
function get_all_order_info($orderID){
	global $db;
	$query = "SELECT * FROM orders JOIN customers ON orders.customerID = customers.customerID JOIN names ON customers.nameIDcust = names.nameID WHERE orders.orderID = '$orderID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;	
}
/*
**** Name: get_coupon_value()
**** Arguements: couponID
**** Return Data: results
**** Description: returns all coupons with matching couponID
*/
function get_coupon_value($couponID){
	global $db;
	$query = "SELECT * FROM coupons WHERE couponID = '$couponID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;		
}
/*
**** Name: update_status()
**** Arguements: orderID, orderStatus
**** Return Data: none
**** Description: updates order status with matching orderID
*/
function update_status($orderID, $orderStatus){
	global $db;
	$query = "UPDATE orders SET orderStatus = '$orderStatus' WHERE orderID = '$orderID'";
	$db->exec($query);
}
/*
**** Name: update_driver()
**** Arguements: orderID, employeeID
**** Return Data: none
**** Description: updates order info with delivery driver (employeeID) with matching orderID
*/
function update_driver($orderID, $employeeID){
	global $db;
	$query = "UPDATE orders SET employeeID = '$employeeID' WHERE orderID = '$orderID'";
	$db->exec($query);
}
/*
**** Name: complete_order()
**** Arguements: orderID, orderCompleteDate
**** Return Data: none
**** Description: updates orderCompleteDate with matching orderID
*/
function complete_order($orderID, $orderCompleteDate){
	global $db;
	$query = "UPDATE orders SET orderCompleteDate = '$orderCompleteDate' WHERE orderID = '$orderID'";
	$db->exec($query);	
}
/*
**** Name: order_finished()
**** Arguements: orderID
**** Return Data: none
**** Description: updates orderStatus to 'Order Completed' with matching orderID
*/
function order_finished($orderID){
	global $db;
	$query = "UPDATE orders SET orderStatus = 'Order Completed' WHERE orderID = '$orderID'";
	$db->exec($query);		
}
/*
**** Name: get_current_orders()
**** Arguements: none
**** Return Data: results
**** Description: returns all orders that have been sent but not completed
*/
function get_current_orders(){
	global $db;
	$query = "SELECT * FROM orders WHERE orderSendDate IS NOT NULL AND orderCompleteDate IS NULL";
	$results = $db->query($query);
	return $results;			
}
/*
**** Name: paid_order_cash()
**** Arguements: orderID, paymentID
**** Return Data: none
**** Description: updates order payment as cash with matching orderID
*/
function paid_order_cash($orderID, $paymentID){
	global $db;
	$query = "UPDATE orders SET 
		paymentID = '$paymentID',
		paid = 'Y'
		WHERE orderID = '$orderID'";
	$db->exec($query);			
}
/*
**** Name: credit_upload()
**** Arguements: orderID, cardName, cardType, cardNumber, cardCw, cardExpires, cardTotal
**** Return Data: none
**** Description: adds new credit card info to the system
*/
function credit_upload($orderID, $cardName, $cardType, $cardNumber, $cardCw, $cardExpires, $orderTotal){
	global $db;
	$query = "INSERT INTO creditcards 
			(orderIDcredit, cardName, cardType, cardNumber, cardCw, cardExpires, cardChargeAmount)
				VALUES
			('$orderID', '$cardName', '$cardType', '$cardNumber', '$cardCw', '$cardExpires', '$orderTotal')";		
	$db->exec($query);		
}

?>