<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/confirm_order.php
**** Description: Form that allows user to view and then confirm order before it is sent
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'C'){
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = "Confirm Order";

	$order = get_current_order($_SESSION['orderID']);
	$customer = get_all_customer_info($_SESSION['userID']);
	$credit = get_card_info($order['orderID']);
	$details = get_order_details($_SESSION['orderID']);
    $ticket = get_current_order($_SESSION['orderID']);
    
    include '../view/cust_header.php'; 

?>

<div id="content_container">
	<h1 class="headings1">Confirm Order</h1>

<?php if ($msg != ''){ echo $msg; } ?>

	<a id="change_order" href="//localhost/web289/gregsgrub/cust/index.php?action=change_order" class="buttons">Edit Order</a>

	<div id="confirm_order">
		<h4>Order #<?php echo $order['orderID']; ?></h4>
        <p class="delivery_comments"><span class="bold">Order Comments: </span><?php if ($order['deliveryComments']) { echo $order['deliveryComments']; } else { echo "No Special Comments"; } ?></p>
		<table class="confirmT">
            <tr class='special1'>
                <td>Item</td>
                <td>Temperature</td>
                <td class="center1">Special Instructions</td>
                <td>Qty</td>
                <td class="right padr2">Total</td>
                
            </tr>
    	
        <?php foreach ($details as $detail) : ?>
        
            <tr>
                <td class="name"><?php 
                	$product = get_product($detail['productID']);
                	echo $product['productName'];  
                	?>
                </td>
                <td class="temp"><?php echo $detail['productTemp']; ?></td>
                <td class="special"><?php echo $detail['productSpecial']; ?></td>
                <td class="qty"><?php echo $detail['productQty']; ?></td>
                <td class="total">$<?php echo money($detail['productTotal']); ?></td>
            </tr>

        <?php endforeach; ?>

        </table>
        <hr>
        <table id="prices">
            <tr>
                <td class="name">&nbsp;</td>
                <td class="temp">&nbsp;</td>
                <th class="tableH">Subtotal:</th>
                <td class="stretch">$<?php echo money($ticket['orderSubTotal']); ?></td>
                <td class="table_filler">&nbsp;</td>
            </tr>
            <tr>
                <td class="name">&nbsp;</td>
                <td class="temp">&nbsp;</td>
                <th class="tableH">Discount:</th>
                <td class="stretch">$<?php 
                	if (isset($ticket['couponID'])){ 
                		$discount = get_discount_amount($ticket['couponID']);
                		echo money($discount['couponValue']);
                	}else {
                		echo 0;
                	} ?></td>
                <td class="table_filler">&nbsp;</td>
            </tr>
            <tr>
                <td class="name">&nbsp;</td>
                <td class="temp">&nbsp;</td>
                <th class="tableH">Tax:</th>
                <td class="stretch">$<?php echo money($ticket['orderTax']); ?></td>
                <td class="table_filler">&nbsp;</td>
            </tr>
            <tr>
                <td class="name">&nbsp;</td>
                <td class="temp">&nbsp;</td>
                <th class="tableH">Delivery:</th>
                <td class="stretch">$<?php echo money($ticket['orderDeliveryCharge']); ?></td>
                <td class="table_filler">&nbsp;</td>
            </tr>
            <tr>
                <td class="name">&nbsp;</td>
                <td class="temp">&nbsp;</td>
                <th class="tableH">Total:</th>
                <td class="stretch">$<?php echo money($ticket['orderTotal']); ?></td>
                <td class="table_filler">&nbsp;</td>
            </tr>
        </table>
    </div>

<?php if ($order['paymentID'] == 2 || $order['delivery'] == 'Y'){ ?>

	<div id="confirm_info">

		<?php if ($order['paymentID'] == 2) { ?>

		<div id="card_info">
			<h4><u>Card Info</u></h4>
			<p><span>Name:</span><?php echo $credit['cardName']; ?></p>
			<p><span>Card:</span><?php echo $credit['cardType']; ?></p>
			<p><span>Number:</span><?php echo $credit['cardNumber']; ?></p>
			<p><span>Expires:</span>
			<?php 
				$exp = strtotime($credit['cardExpires']);
				$exp = date('m-d-Y');
				echo $exp;
			?></p>
		</div>

	<?php } if ($order['delivery'] == 'Y'){	?>

		<div id="delivery_info">
			<h4><u>Delivery Address</u></h4>
			<p><?php echo $customer['daddress1']; ?></p>
			<?php if ($customer['daddress2'] != '') { ?><p><?php echo $customer['daddress2']; ?></p><?php } ?>
			<p><?php echo $customer['dcity']; ?>, <?php echo $customer['dstateCode']; ?> <?php echo $customer['dpostalCode']; ?></p>
		</div>

	<?php } ?>

		<div class="clear">
		</div>
	</div>

<?php } ?>

    <div id="confirm_order_button">

    <?php if ($order['couponID'] == NULL){	?>

        <a href="//localhost/web289/gregsgrub/cust/index.php?action=add_coupon" class="buttons">Add Coupon</a><br>

    <?php } ?>

        <a href="//localhost/web289/gregsgrub/cust/index.php?action=send_order" class="buttons">Confirm</a><br>

    <?php if ($order['delivery'] == 'Y'){	?>

    <a href="//localhost/web289/gregsgrub/cust/index.php?action=change_address" class="buttons small">Change Address</a>

    <?php } ?>
    
    </div>
</div>
	
<?php include '../view/footer.php'; ?>