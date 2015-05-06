<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: model/login_functions.php
**** Description: Login Functions
-->

<?php 
/*
**** Name: register_user()
**** Arguements: userEmail, userName, userPassword, userLevel
**** Return Data: none
**** Description: adds a new customer to the system
*/
function register_user($userEmail, $userName, $userPassword, $userLevel){
    global $db;
    $query = "INSERT INTO users
                 (userEmail, userName, userPassword, userLevel)
              VALUES
                 ('$userEmail', '$userName', '$userPassword', '$userLevel')";
    $db->exec($query);
}
/*
**** Name: check_user()
**** Arguements: userName
**** Return Data: results
**** Description: checks to make sure user exists in the system
*/
function check_user($userName){
	global $db;
	$query = "SELECT * FROM users WHERE userName = '$userName'";
	$results = $db->query($query);
	$results = $results->fetch();
	return $results;
}
/*
**** Name: get_user_level
**** Arguements: userID
**** Return Data: userLevel
**** Description: returns userLevel of user with matching userID
*/
function get_user_level($userID){
	global $db;
	$query = "SELECT * from users WHERE userID = '$userID'";
	$results = $db->query($query);
	$results = $results->fetch();	
	$userLevel = $results['userLevel'];
	return $userLevel;
}


 ?>