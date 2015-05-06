<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: model/admin_functions
**** Description: Admin/Manager Functions
-->

<?php
/*
**** Name: show_admins()
**** Arguements: none
**** Return Data: admins
**** Description: returns all admins with name data
*/
function show_admins(){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID JOIN admins ON names.nameID = admins.nameIDadmin WHERE userLevel = 'A' ORDER BY lName";
	$admins = $db->query($query);
	return $admins;
}
/*
**** Name: show_employees()
**** Arguements: none
**** Return Data: employees
**** Description: returns all employees with name data
*/
function show_employees(){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID JOIN employees ON names.nameID = employees.nameID WHERE users.userLevel = 'E' ORDER BY lName";
	$employees = $db->query($query);
	return $employees;
}
/*
**** Name: get_employee()
**** Arguements: userID
**** Return Data: employee
**** Description: returns employee and name data with matching userID
*/
function get_employee($userID){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID JOIN employees ON names.nameID = employees.nameID WHERE users.userID = '$userID'";
	$employees = $db->query($query);
	return $employees;
}
/*
**** Name: show_customers()
**** Arguements: none
**** Return Data: customers
**** Description: returns all customers with name and state data
*/
function show_customers(){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID JOIN customers ON names.nameID = customers.nameIDcust JOIN state ON state.stateCode = customers.stateCode WHERE userLevel = 'C' ORDER BY lName";
	$customers = $db->query($query);
	return $customers;
}
/*
**** Name: get_user()
**** Arguements: userID
**** Return Data: results
**** Description: returns user data for matching userID
*/
function get_user($userID){
	global $db;
	$query = "SELECT * from users WHERE userID = '$userID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: update_user()
**** Arguements: userID, userEmail, userName, lName, fName, phone
**** Return Data: none
**** Description: updates name and user info with matching userID
*/
function update_user($userID, $userEmail, $userName, $lName, $fName, $phone){
	global $db;
	$query = "UPDATE users SET userEmail = '$userEmail', userName = '$userName' WHERE userID = '$userID'";
	$db->exec($query);
	$query = "UPDATE names SET lName = '$lName', fName = '$fName', phone = '$phone' WHERE userID = '$userID'";
	$db->exec($query);
}
/*
**** Name: update_employee()
**** Arguements: nameID, jobStatus, profile
**** Return Data: none
**** Description: updates employee info with matching nameID
*/
function update_employee($nameID, $jobStatus, $profile){
	global $db;
	$query = "UPDATE employees SET 
		jobStatus = '$jobStatus',
		profile = '$profile'
		WHERE nameID = '$nameID'";
	$db->exec($query);
}
/*
**** Name: update_customer()
**** Arguements: customerID, address1, address2, city, stateCode, postalCode
**** Return Data: none
**** Description: updates customer info with matching customerID
*/
function update_customer($customerID, $address1, $address2, $city, $stateCode, $postalCode){
	global $db;
	$query = "UPDATE customers SET address1 = '$address1', address2 = '$address2', city = '$city', stateCode = '$stateCode', postalCode = '$postalCode' WHERE customerID = '$customerID'";
	$db->exec($query);
}
/*
**** Name: add_user()
**** Arguements: userEmail, userName, userPassword, userLevel
**** Return Data: none
**** Description: adds new user info to system
*/
function add_user($userEmail, $userName, $userPassword, $userLevel){
    global $db;
    $query = "INSERT INTO users
                 (userEmail, userName, userPassword, userLevel)
              VALUES
                 ('$userEmail', '$userName', '$userPassword', '$userLevel')";
    $db->exec($query);
}
/*
**** Name: add_admin()
**** Arguements: nameID
**** Return Data: none
**** Description: adds new admin info to system
*/
function add_admin($nameID){
 	global $db;
    $query = "INSERT INTO admins
                 (nameIDadmin)
              VALUES
                 ('$nameID')";
    $db->exec($query);
}
/*
**** Name: get_all_admin_info()
**** Arguements: userID
**** Return Data: results
**** Description: returns all admin and name info with matching userID
*/
function get_all_admin_info($userID){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID JOIN admins ON names.nameID = admins.nameIDadmin WHERE users.userID = '$userID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: delete_user()
**** Arguements: userID
**** Return Data: none
**** Description: deletes user info with matching userID
*/
function delete_user($userID){
	global $db;
	$query = "DELETE from users WHERE userID = '$userID'";
	$db->exec($query);
	$query = "DELETE from names WHERE userID = '$userID'";
	$db->exec($query);
}
/*
**** Name: change_password()
**** Arguements: userID, userPassword
**** Return Data: none
**** Description: updates password with matching userID
*/
function change_password($userID, $userPassword){
	global $db;
	$query = "UPDATE users SET userPassword = '$userPassword' WHERE userID = '$userID'";
	$db->exec($query);
}
/*
**** Name: add_name()
**** Arguements: fName, lName, phone, userID
**** Return Data: none
**** Description: adds name data to the system
*/
function add_name($fName, $lName, $phone, $userID){
	global $db;
	$query = "INSERT INTO names
				(fName, lName, phone, userID)
			  VALUES
			  	('$fName', '$lName', '$phone', '$userID')";
	$db->exec($query);
}
/*
**** Name: last_user()
**** Arguements: none
**** Return Data: results
**** Description: returns the last user added to the system
*/
function last_user(){
	global $db;
	$query = "SELECT * from users ORDER BY userID DESC";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: last_name()
**** Arguements: none
**** Return Data: results
**** Description: returns the last name data added to the system
*/
function last_name(){
	global $db;
	$query = "SELECT * from names ORDER BY nameID DESC";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: add_employee()
**** Arguements: nameID
**** Return Data: none
**** Description: adds new employee data to the system
*/
function add_employee($nameID){
	global $db;
	$query = "INSERT INTO employees
				(nameID, jobStatus, profile)
			  VALUES
			  	('$nameID', 'Employed', 'I am a new employee and will have a profile shorty.')";
	$db->exec($query);
}
/*
**** Name: add_customer()
**** Arguements: nameID, address1, address2, city, stateCode, postalCode
**** Return Data: none
**** Description: adds new customer data to the system
*/
function add_customer($nameID, $address1, $address2, $city, $stateCode, $postalCode){
	global $db;
	$query = "INSERT INTO customers
				(nameIDcust, address1, address2, city, stateCode, postalCode, daddress1, daddress2, dcity, dstateCode, dpostalCode)
			  VALUES
			  	('$nameID', '$address1', '$address2', '$city', '$stateCode', '$postalCode', '$address1', '$address2', '$city', '$stateCode', '$postalCode')";
	$db->exec($query);
}
/*
**** Name: get_user_all()
**** Arguements: userID
**** Return Data: results
**** Description: returns all users and name data with matching userID
*/
function get_user_all($userID){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID WHERE users.userID = '$userID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;	
}
/*
**** Name: get_employee_all()
**** Arguements: userID
**** Return Data: results
**** Description: returns all employee data with matching userID
*/
function get_employee_all($userID){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID JOIN employees ON names.nameID = employees.nameID WHERE users.userID = '$userID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;	
}
/*
**** Name: get_customer_all()
**** Arguements: userID
**** Return Data: results
**** Description: returns all customer and name data with matching userID
*/
function get_customer_all($userID){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID JOIN customers ON names.nameID = customers.nameIDcust WHERE users.userID = '$userID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;	
}
/*
**** Name: get_states()
**** Arguements: none
**** Return Data: results
**** Description: returns all states in the system
*/
function get_states(){
	global $db;
	$query = "SELECT * FROM state ORDER BY stateName";
	$results = $db->query($query);
	return $results;
}
/*
**** Name: get_categories()
**** Arguements: none
**** Return Data: results
**** Description: returns all data in the categories table
*/
function get_categories(){
	global $db;
	$query = "SELECT * FROM categories ORDER BY categoryName";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: get_product_by_category()
**** Arguements: categoryID
**** Return Data: results
**** Description: returns all products with matching categoryID
*/
function get_product_by_category($categoryID){
	global $db;
	$query = "SELECT * FROM products WHERE categoryID = '$categoryID' ORDER BY productName";
	$results = $db->query($query);
	return $results;		
}
/*
**** Name: get_product_by_category_limit()
**** Arguements: categoryID, offset, rec_limit
**** Return Data: results
**** Description: pagination function to return products with matching categoryID
*/
function get_product_by_category_limit($categoryID, $offset, $rec_limit){
	global $db;
	$query = "SELECT * FROM products WHERE categoryID = '$categoryID' ORDER BY productName LIMIT $offset, $rec_limit";
	$results = $db->query($query);
	return $results;		
}
/*
**** Name: get_category_name()
**** Arguements: categoryID
**** Return Data: results
**** Description: returns the category info with matching categoryID
*/
function get_category_name($categoryID){
	global $db;
	$query = "SELECT * FROM categories WHERE categoryID = '$categoryID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;		
}
/*
**** Name: get_all_products()
**** Arguements: none
**** Return Data: results
**** Description: returns all products and matching category info
*/
function get_all_products(){
	global $db;
	$query = "SELECT * FROM products JOIN categories ON categories.categoryID = products.categoryID ORDER BY categoryName, productName";
	$results = $db->query($query);
	return $results;			
}
/*
**** Name: get_grub_products()
**** Arguements: none
**** Return Data: results
**** Description: returns all products that are food
*/
function get_grub_products(){
	global $db;
	$query = "SELECT * FROM products JOIN categories ON categories.categoryID = products.categoryID WHERE products.categoryID < 10 ORDER BY categoryName, productName";
	$results = $db->query($query);
	return $results;			
}
/*
**** Name: get_limit()
**** Arguements: offset, rec_limit
**** Return Data: results
**** Description: pagination function to return all products with matching categoryID
*/
function get_limit($offset, $rec_limit){
	global $db;
	$query = "SELECT * FROM products JOIN categories ON categories.categoryID = products.categoryID WHERE products.categoryID < 10 ORDER BY categoryName, productName LIMIT $offset, $rec_limit";
	$results = $db->query($query);
	return $results;			
}
/*
**** Name: get_all_merch()
**** Arguements: none
**** Return Data: results
**** Description: returns all merchandise products
*/
function get_all_merch(){
	global $db;
	$query = "SELECT * FROM products JOIN categories ON categories.categoryID = products.categoryID WHERE products.categoryID > 10 ORDER BY categoryName, productName";
	$results = $db->query($query);
	return $results;			
}
/*
**** Name: get_all_merch_limit()
**** Arguements: offset, rec_limit
**** Return Data: results
**** Description: pagination function that returns all merchandise products
*/
function get_all_merch_limit($offset, $rec_limit){
	global $db;
	$query = "SELECT * FROM products JOIN categories ON categories.categoryID = products.categoryID WHERE products.categoryID > 10 ORDER BY categoryName, productName LIMIT $offset, $rec_limit";
	$results = $db->query($query);
	return $results;			
}
/*
**** Name: add_product()
**** Arguements: productName, categoryID, productDescription, productProce, requireTemp
**** Return Data: none
**** Description: adds a new product to the system
*/
function add_product($productName, $categoryID, $productDescription, $productPrice, $requireTemp){
	global $db;
	$query = "INSERT INTO products
				(productName, categoryID, productDescription, productPrice, productPhotoURL, requireTemp)
			  VALUES
			  	('$productName', '$categoryID', '$productDescription', '$productPrice', 'images/default2.jpg', '$requireTemp')";
	$db->exec($query);	
}
/*
**** Name: get_product()
**** Arguements: productID
**** Return Data: results
**** Description: returns all products with matching productID
*/
function get_product($productID){
	global $db;
	$query = "SELECT * FROM products WHERE productID = '$productID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;			
}
/*
**** Name: update_product()
**** Arguements: productID, productName, categoryID, productDescription, productPrice, productPhotoURL, requireTemp
**** Return Data: none
**** Description: updates product info with matching productID
*/
function update_product($productID, $productName, $categoryID, $productDescription, $productPrice, $productPhotoURL, $requireTemp){
	global $db;
	$query = "UPDATE products SET productName = '$productName', categoryID = '$categoryID', productDescription = '$productDescription', productPrice = '$productPrice', productPhotoURL = '$productPhotoURL', requireTemp = '$requireTemp' WHERE productID = '$productID'";
	$db->exec($query);
}
/*
**** Name: delete_product()
**** Arguements: productID
**** Return Data: none
**** Description: deletes a product with matching productID
*/
function delete_product($productID){
	global $db;
	$query = "DELETE from products WHERE productID = '$productID'";
	$db->exec($query);
}
/*
**** Name: add_photo_URL()
**** Arguements: filename, productID
**** Return Data: none
**** Description: adds product image URL to product with matching productID
*/
function add_photo_URL($filename, $productID){
	global $db;
	$query = "UPDATE products SET productPhotoURL = 'images/products/$filename' WHERE productID = '$productID'";
	$db->exec($query);
}
/*
**** Name: add_faq()
**** Arguements: infoName, infoText, infoFAQ
**** Return Data: none
**** Description: adds a new FAQ to the system
*/
function add_faq($infoName, $infoText, $infoFAQ){
	global $db;
	$query = "INSERT INTO information
				(infoName, infoText, infoFAQ)
			  VALUES
			  	('$infoName', '$infoText', '$infoFAQ')";
	$db->exec($query);		
}
/*
**** Name: get_admin_info()
**** Arguements: userID
**** Return Data: results
**** Description: returns admin info and name info with matching userID
*/
function get_admin_info($userID){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID JOIN admins ON names.nameID = admins.nameIDadmin WHERE users.userID = '$userID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;				
}
/*
**** Name: add_photo_URL_admin()
**** Arguements: file_name, nameID
**** Return Data: none
**** Description: adds thumbnail URL to admin with matching nameID
*/
function add_photo_URL_admin($file_name, $nameID){
	global $db;
	$query = "UPDATE admins SET 
		thumbnailURL = 'images/profiles/$file_name'
		WHERE nameIDadmin = '$nameID'";
	$db->exec($query);
}
/*
**** Name: update_admin()
**** Arguements: adminID, profile
**** Return Data: none
**** Description: updates admin profile info with matchin adminID
*/
function update_admin($adminID, $profile){
	global $db;
	$query = "UPDATE admins SET 
		profile = '$profile'
		WHERE adminID = '$adminID'";
	$db->exec($query);	
}
/*
**** Name: enter()
**** Arguements: str
**** Return Data: str
**** Description: returns string data that has been sanitized to prevent SQL injection
*/
function enter($str){
	$str = mysql_real_escape_string($str);
	return $str;
}
/*
**** Name: get_admin_all()
**** Arguements: userID
**** Return Data: results
**** Description: returns all admin and name data with matching userID
*/
function get_admin_all($userID){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID JOIN admins ON names.nameID = admins.nameIDadmin WHERE users.userID = '$userID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: get_info_all()
**** Arguements: infoID
**** Return Data: results
**** Description: returns all info with matching infoID
*/
function get_info_all($infoID){
	global $db;
	$query = "SELECT * FROM information WHERE infoID = '$infoID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;	
}
/*
**** Name: update_faq()
**** Arguements: infoID, infoFAQ, infoText
**** Return Data: none
**** Description: updates information with matching infoID
*/
function update_faq($infoID, $infoFAQ, $infoText){
	global $db;
	$query = "UPDATE information SET 
		infoFAQ = '$infoFAQ',
		infoText = '$infoText'
		WHERE infoID = '$infoID'";
	$db->exec($query);		
}
/*
**** Name: delete_info()
**** Arguements: infoID
**** Return Data: none
**** Description: deletes info with matching infoID
*/
function delete_info($infoID){
	global $db;
	$query = "DELETE FROM information WHERE infoID = '$infoID'";
	$db->exec($query);		
}
/*
**** Name: get_mission()
**** Arguements: none
**** Return Data: results
**** Description: returns mission statement
*/
function get_mission(){
	global $db;
	$query = "SELECT * FROM information WHERE infoName = 'mission'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: update_mission()
**** Arguements: infoFAQ, infoText
**** Return Data: none
**** Description: updates mission statement
*/
function update_mission($infoFAQ, $infoText){
	global $db;
	$query = "UPDATE information SET 
		infoFAQ = '$infoFAQ',
		infoText = '$infoText'
		WHERE infoName = 'mission'";
	$db->exec($query);			
}
/*
**** Name: get_promo()
**** Arguements: none
**** Return Data: results
**** Description: returns the promotional info
*/
function get_promo(){
	global $db;
	$query = "SELECT * FROM information WHERE infoName = 'promo'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: update_promo()
**** Arguements: infoFAW, infoText
**** Return Data: none
**** Description: updates promotional information
*/
function update_promo($infoFAQ, $infoText){
	global $db;
	$query = "UPDATE information SET 
		infoFAQ = '$infoFAQ',
		infoText = '$infoText'
		WHERE infoName = 'promo'";
	$db->exec($query);			
}
/*
**** Name: get_coupons()
**** Arguements: none
**** Return Data: results
**** Description: returns all coupons and coupon info
*/
function get_coupons(){
	global $db;
	$query = "SELECT * FROM coupons";
	$results = $db->query($query);
	return $results;
}
/*
**** Name: add_coupon()
**** Arguements: couponCode, couponValue, couponDesc
**** Return Data: none
**** Description: adds a new coupon to the system
*/
function add_coupon($couponCode, $couponValue, $couponDesc){
	global $db;
	$query = "INSERT INTO coupons
				(couponCode, couponValue, couponDesc)
			  VALUES
			  	('$couponCode', '$couponValue', '$couponDesc')";
	$db->exec($query);		
}
/*
**** Name: update_coupon()
**** Arguements: couponID, couuponCode, couponValue, couponDesc
**** Return Data: none
**** Description: updates coupon info with matching couponID
*/
function update_coupon($couponID, $couponCode, $couponValue, $couponDesc){
	global $db;
	$query = "UPDATE coupons SET 
		couponCode = '$couponCode',
		couponValue = '$couponValue',
		couponDesc = '$couponDesc'
		WHERE couponID = '$couponID'";
	$db->exec($query);				
}
/*
**** Name: get_coupon_all()
**** Arguements: couponID
**** Return Data: results
**** Description: returns all coupon data with matching couponID
*/
function get_coupon_all($couponID){
	global $db;
	$query = "SELECT * FROM coupons WHERE couponID = '$couponID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;	
}
/*
**** Name: delete_coupon
**** Arguements: couponID
**** Return Data: none
**** Description: deletes coupon from system with matching couponID
*/
function delete_coupon($couponID){
	global $db;
	$query = "DELETE FROM coupons WHERE couponID = '$couponID'";
	$db->exec($query);		
}
/*
**** Name: get_every_order()
**** Arguements: none
**** Return Data: results
**** Description: returns all orders that have been sent into the system
*/
function get_every_order(){
	global $db;
	$query = "SELECT * FROM orders JOIN customers ON orders.customerID = customers.customerID JOIN names ON customers.nameIDcust = names.nameID WHERE orders.orderSendDate IS NOT NULL ORDER BY orders.orderSendDate ASC, names.lName";
	$results = $db->query($query);
	return $results;		
}
/*
**** Name: get_every_order_date()
**** Arguements: none
**** Return Data: results
**** Description: returns all orders that have been sent into the system by date DESC
*/
function get_every_order_date(){
	global $db;
	$query = "SELECT * FROM orders JOIN customers ON orders.customerID = customers.customerID JOIN names ON customers.nameIDcust = names.nameID WHERE orders.orderSendDate IS NOT NULL ORDER BY orders.orderSendDate DESC, names.lName";
	$results = $db->query($query);
	return $results;		
}
/*
**** Name: get_every_order_name()
**** Arguements: none
**** Return Data: results
**** Description: returns all orders that have been sent into the system by name
*/
function get_every_order_name(){
	global $db;
	$query = "SELECT * FROM orders JOIN customers ON orders.customerID = customers.customerID JOIN names ON customers.nameIDcust = names.nameID WHERE orders.orderSendDate IS NOT NULL ORDER BY names.lName, orders.orderSendDate, orders.orderID";
	$results = $db->query($query);
	return $results;		
}
/*
**** Name: get_every_order_number()
**** Arguements: none
**** Return Data: results
**** Description: returns all orders that have been sent into the system by orderID
*/
function get_every_order_number(){
	global $db;
	$query = "SELECT * FROM orders JOIN customers ON orders.customerID = customers.customerID JOIN names ON customers.nameIDcust = names.nameID WHERE orders.orderSendDate IS NOT NULL ORDER BY orders.orderID";
	$results = $db->query($query);
	return $results;		
}
/*
**** Name: get_all_customer_details()
**** Arguements: customerID
**** Return Data: results
**** Description: returns all customer data including name info, user info, and state info with matching customerID
*/
function get_all_customer_details($customerID){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID JOIN customers ON names.nameID = customers.nameIDcust JOIN state ON state.stateCode = customers.stateCode WHERE customers.customerID = '$customerID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;	
}
/*
**** Name: get_every_comment()
**** Arguements: none
**** Return Data: results
**** Description: resturns every comment in the system
*/
function get_every_comment(){
	global $db;
	$query = "SELECT * FROM comments ORDER BY commentDate DESC";
	$results = $db->query($query);
	return $results;			
}
/*
**** Name: get_comment_details()
**** Arguements: commentID
**** Return Data: results
**** Description: returns comment with matching commentID
*/
function get_comment_details($commentID){
	global $db;
	$query = "SELECT * FROM comments WHERE commentID = '$commentID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;	
}
/*
**** Name: get_name_info()
**** Arguements: userID
**** Return Data: results
**** Description: returns all name info with matching userID
*/
function get_name_info($userID){
	global $db;
	$query = "SELECT * FROM users JOIN names ON users.userID = names.userID WHERE users.userID = '$userID'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;		
}
/*
**** Name: ban_comment()
**** Arguements: commentID
**** Return Data: none
**** Description: bans a comment that has matching commentID
*/
function ban_comment($commentID){
	global $db;
	$query = "UPDATE comments SET 
		approved = 0
		WHERE commentID = '$commentID'";
	$db->exec($query);				
}
/*
**** Name: unban_comment()
**** Arguements: commentID
**** Return Data: none
**** Description: unbans a comment with matching commentID
*/
function unban_comment($commentID){
	global $db;
	$query = "UPDATE comments SET 
		approved = 1
		WHERE commentID = '$commentID'";
	$db->exec($query);				
}
/*
**** Name: report_credit_sales()
**** Arguements: start, finish
**** Return Data: results
**** Description: returns all credit card sales within given date range
*/
function report_credit_sales($start, $finish){
	global $db;
	$query = "SELECT * FROM orders WHERE paymentID = 2 AND orderCompleteDate IS NOT NULL AND orderCompleteDate BETWEEN '$start' AND '$finish'";
	$results = $db->query($query);
	return $results;
}
/*
**** Name: report_cash_sales()
**** Arguements: start, finish
**** Return Data: results
**** Description: returns all cash sales within given date range
*/
function report_cash_sales($start, $finish){
	global $db;
	$query = "SELECT * FROM orders WHERE paymentID = 1 AND orderCompleteDate IS NOT NULL AND orderCompleteDate BETWEEN '$start' AND '$finish'";
	$results = $db->query($query);
	return $results;
}
/*
**** Name: report_deliveries()
**** Arguements: start, finish
**** Return Data: results
**** Description: returns all delivery sales within given date range
*/
function report_deliveries($start, $finish){
	global $db;
	$query = "SELECT * FROM orders WHERE delivery = 'Y' AND orderCompleteDate IS NOT NULL AND orderCompleteDate BETWEEN '$start' AND '$finish'";
	$results = $db->query($query);
	return $results;
}
/*
**** Name: report_carryouts()
**** Arguements: start, finish
**** Return Data: results
**** Description: returns all carryout sales within given date range
*/
function report_carryouts($start, $finish){
	global $db;
	$query = "SELECT * FROM orders WHERE delivery = 'N' AND orderCompleteDate IS NOT NULL AND orderCompleteDate BETWEEN '$start' AND '$finish'";
	$results = $db->query($query);
	return $results;
}
/*
**** Name: report_coupons()
**** Arguements: start, finish
**** Return Data: results
**** Description: returns all coupon sales within given date range
*/
function reports_coupons($couponID, $start, $finish){
	global $db;
	$query = "SELECT * FROM orders JOIN coupons ON orders.couponID = coupons.couponID WHERE orders.couponID = '$couponID' AND orderCompleteDate IS NOT NULL AND orderCompleteDate BETWEEN '$start' AND '$finish'";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: report_emp()
**** Arguements: start, finish
**** Return Data: results
**** Description: returns all employee sales within given date range
*/
function reports_emp($empID, $start, $finish){
	global $db;
	$query = "SELECT * FROM orders WHERE employeeID = '$empID' AND delivery = 'Y' AND orderCompleteDate IS NOT NULL AND orderCompleteDate BETWEEN '$start' AND '$finish'";
	$results = $db->query($query);
	return $results;	
}
/*
**** Name: report_emp_cash()
**** Arguements: start, finish
**** Return Data: results
**** Description: returns all employee sales paid with cash within given date range
*/
function reports_emp_cash($empID, $start, $finish){
	global $db;
	$query = "SELECT * FROM orders WHERE employeeID = '$empID' AND paymentID = 1 AND delivery = 'Y' AND orderCompleteDate IS NOT NULL AND orderCompleteDate BETWEEN '$start' AND '$finish'";
	$results = $db->query($query);
	return $results;	
}

?>