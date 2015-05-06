<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/process_order.php
**** Description: Form that allows user to choose payment method and enter any special order details
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'C') {
    	header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = "Process Order";

    include '../view/cust_header.php'; 

?>

<div id="content_container">	
	<h1 class="headings1">Process Order</h1>
    
    <div id="process_order">
        <h4>Order # <?php echo $_SESSION['orderID']; ?></h4>
	
    	<form action="index.php" method="post">
            <p>Would you like your order for Delivery or Carry Out?</p>
            <label><input type="radio" name="delivery" value="N" required>
            Carry Out</label><br>
            
            <label><input type="radio" name="delivery" value="Y" required>
            Delivery</label><br>

            <p>How would you like to pay?</p>
            <label><input type="radio" name="paymentID" value="1" required>
            Cash</label><br>

            <input type="radio" name="paymentID" value="2" id='creditcard' required>
            <label for="creditcard">Credit/Gift Card</label><br>
    
            <div id="credit_content">
                <h3 class="center">Enter Card Info</h3>
                <label>Name on Card:</label>
                <input type="text" id="cardName" name="cardName"><br>

                <label>Card Type:</label>
                <select name="cardType">
                    <option value="Visa">Visa</option>
                    <option value="Master Card">Master Card</option>
                    <option value="Amemrican Express">American Express</option>
                    <option value="Discover">Discover</option>
                    <option value="Gift Card">Gift Card</option>
                </select><br>

                <label>Card Number:</label>
                <input type="text" id="cardNumber" name="cardNumber"><br>
                
                <label>Card CVV Code:</label>
                <input type="password" id="cardCw" name="cardCw"><br>

                <label>Card Expiration:</label>
                <input type="text" id="datepicker" name="cardExpires">
            </div>

            <label><input type="radio" name="paymentID" value="3" required>
            On Pickup</label><br>

            <label><span class="center">Order Special Instructions</span><textarea name="deliveryComments" rows='4' cols='30' maxlength="100"></textarea></label>
            
            <input type="hidden" name="action" value="confirm_order">
            <input type="submit" value="Process Order" class="submit_button center">
        </form>
    </div>
</div>

<?php include '../view/footer.php';?>