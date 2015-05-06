<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: index.php
**** Description: Sites main controller
-->

<?php
require('model/database.php');
require('model/login_functions.php');
require('model/general_functions.php');
require('model/admin_functions.php');

$lifetime = 60 * 60 * 3; // 3 hour session lifetime
session_set_cookie_params($lifetime, '/');
session_start();

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else if (!isset($_SESSION['userID'])) {
	$action = 'promotions';
} else if (isset($_SESSION['userID'])) {
	$userID = $_SESSION['userID'];
	$action = 'promotions';
}

if ($action == 'promotions'){
    $promos = get_promos();
    include('promotions.php');
} else if ($action == 'menu_main'){
    $categories2 = get_grub_menu();
    if (isset($_GET['categoryID']))
        $categoryID = $_GET['categoryID'];
    else
        $categoryID = 99;
    include ('menu_main.php');
} else if ($action == 'about'){
    include ('about.php');
} else if ($action == 'merch'){
    $merch_menu = get_merch_menu();
    if (isset($_GET['categoryID']))
        $categoryID = $_GET['categoryID'];
    else
        $categoryID = 99;
    include ('merch.php');    
} else if($action == 'register'){
    include ('register.php');
} else if ($action == 'comments'){
    include('comments.php');
} else if ($action == 'register_users') {
    if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
    }
    if(!$captcha){
        $msg = '<p class="error">Please check the the captcha form.</p>';
        include('register.php');
        
    } else {
        add_user(enter($_POST['userEmail']), enter($_POST['userName']), enter(password_hash($_POST['userPassword'], PASSWORD_DEFAULT)), enter($_POST['userLevel']));
        $user = last_user();
        add_name(enter($_POST['fName']), enter($_POST['lName']), enter($_POST['phone']), enter($user['userID']));
        $name = last_name();
        add_customer(enter($name['nameID']), enter($_POST['address1']), enter($_POST['address2']), enter($_POST['city']), enter($_POST['stateCode']), enter($_POST['postalCode']));
        $productID = '';
        include('login_page.php');
    }
} else if ($action == 'faq_page'){
    $faqs = get_faqs();
    include('faq_page.php');
} else if ($action =="search_results"){
    $search = $_POST['search'];
    $search_results = search_menu(enter($search));
    include('search_results.php');
} else if ($action == 'directions_page'){
    include('directions_page.php');
} else if ($action == 'product_details'){
    include('product_details.php');
} else if ($action == 'mission'){
    include('mission.php');
} else if ($action == 'under_construction'){
    include('under_construction.php');
} else if ($action == 'logout'){
    session_unset();
    session_destroy();
    include('logout.php');
} else if ($action == 'login_page'){
    if (isset($_GET['productID']))
        $productID = $_GET['productID'];
    else
        $productID = '';
    include('login_page.php');
} else if ($action == 'login'){
    $error = "";
    $userName = $_POST['userName'];
    $userPassword = $_POST['userPassword'];
    $productID = $_POST['productID'];
    
    $results = check_user($userName);

    $pass = $results['userPassword'];
    $userID = $results['userID'];
    $userLevel = $results['userLevel'];

    $verified = password_verify($userPassword, $pass);
    
    $employee = get_employee_all($userID);
    $jobStatus = $employee['jobStatus'];
    
    $names = get_name($userID);
    $fName = $names['fName'];
    $lName = $names['lName'];

    session_regenerate_id();
    $_SESSION['jobStatus'] = $jobStatus;
    $_SESSION['userID'] = $userID;
    $_SESSION['userLevel'] = $userLevel;
    $_SESSION['fName'] = $fName;
    $_SESSION['lName'] = $lName;

    if ($verified){
    	if ($userLevel == 'A') {
            $_SESSION['editAdmin'] = 'No';
    		header('Location: http://localhost/web289/gregsgrub/admin/');
            exit();
        }
        else if ($userLevel == 'E' && $jobStatus == 'Employed'){
            header('Location: http://localhost/web289/gregsgrub/emp/');
            exit();
        }
        else if ($userLevel == 'C'){
            if ($productID != ''){
                header("Location: http://localhost/web289/gregsgrub/cust/index.php?action=order_page&productID=$productID");
                exit();
            }
            header('Location: http://localhost/web289/gregsgrub/cust/');
            exit();
        }
        else if ($userLevel == 'E'){
            include('not_empl.php');
        } else {
    		include('non_user.php');
        }
    }
    else {
        $error = "Login Failure";
        include('login_page.php');
    }
} else if ($action =='404page'){
    include('404page.php');
}

?>