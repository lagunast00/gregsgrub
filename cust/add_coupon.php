<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/add_coupon.php
**** Description: Form that allows customer to add a discount to an order
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'C') {
    	header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = "Add Discount";

    $customer = get_all_customer_info($_SESSION['userID']);

    include '../view/cust_header.php'; 

?>

<div id="content_container">
	<h1 class="headings1">Add Discount</h1>
    <div id="add_coupon">
        <form action='index.php' method="POST">
            <label>Enter Coupon Code: <input type="text" name="couponCode" value="" required maxlength="7"></label>
            
            <input type="hidden" name="action" value="update_coupon">
            <input type="submit" value="Add Discount" class="submit_button center">
        </form>
    </div>        
</div>

<?php include '../view/footer.php';?>