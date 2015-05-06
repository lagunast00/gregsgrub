<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: emp/order_details.php
**** Description: Form that allows employee to view the details of order selected
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'E' || $_SESSION['jobStatus'] != 'Employed'){
            header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
            exit();
        }
    $title = "Order Details";

    if (isset($_POST['orderID'])) {
        $orderID = $_POST['orderID'];
    } else if (isset($_GET['orderID'])) {
        $orderID = $_GET['orderID'];
    }

    $order = get_all_order_info($orderID);
    $details = get_order_details($orderID);
    $credit = get_card_info($orderID);
    
    include '../view/emp_header.php'; 

?>

<div id="content_container">
	<h1 class="headings1">Order Details</h1>

    <div id="emp_buttons">

    <?php if ($order['orderStatus'] == 'Order Completed') { ?>

        <a href="//localhost/web289/gregsgrub/emp/index.php?action=completed_orders&amp;event=<?php echo $event; ?>" class="buttons">Back</a>

    <?php } else { ?>

        <?php if (isset($_POST['cash_out'])) { ?>

            <a href="//localhost/web289/gregsgrub/emp/index.php?action=delivery&amp;event=<?php echo $event; ?>" class="buttons">Back</a>

            <?php if ($order['paid'] == NULL) { ?>

                <a href="//localhost/web289/gregsgrub/emp/index.php?action=cash_out&amp;orderID=<?php echo $order['orderID']; ?>" class="buttons">Cash Out</a>

            <?php } else { ?>

                <a href="//localhost/web289/gregsgrub/emp/index.php?action=delivered&amp;orderID=<?php echo $order['orderID']; ?>" class="buttons">Received</a>

            <?php }
        } else { ?>

            <a href="//localhost/web289/gregsgrub/emp/index.php?action=orders_page&amp;event=<?php echo $event; ?>" class="buttons">Back</a>
            <a href="//localhost/web289/gregsgrub/emp/index.php?action=update_status_form&amp;orderID=<?php echo $order['orderID']; ?>" class="buttons">Update Status</a>
        <?php } 
    } ?>
        
    </div>
    
    <div id="order_details">
        <h2><?php echo $order['fName']; ?> <?php echo $order['lName']; ?></h2>
        <h4 class="numbers">Order #: <?php echo $order['orderID']; ?> - <?php echo $order['orderStatus']; ?></h4>
        <table>
            <tr class='special1'>
                <th>Item</th>
                <th>Temperature</th>
                <th class="center1">Special Instructions</th>
                <th class="center1">Qty</th>
                <th class="right padr2">Total</th>
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
                <td class="qty center1"><?php echo $detail['productQty']; ?></td>
                <td class="total right padr2">$<?php echo money($detail['productTotal']); ?></td>
            </tr>
        
        <?php endforeach; ?>
        
        </table>
        <hr>
        <table id="prices">
            <tr>
                <td class="name">&nbsp;</td>
                <td class="temp">&nbsp;</td>
                <td class="table_filler">&nbsp;</td>
                <th class="tableH">Subtotal:</th>
                <td class="stretch">$<?php echo money($order['orderSubTotal']); ?></td>
                
            </tr>
            <tr>
                <td class="name">&nbsp;</td>
                <td class="temp">&nbsp;</td>
                <td class="table_filler">&nbsp;</td>
                <th class="tableH">Discount:</th>
                <td class="stretch">$<?php if ($order['couponID'] == NULL) { echo '0.00'; } else { $coupon = get_coupon_value($order['couponID']); echo money($coupon['couponValue']);} ?></td>
            </tr>
            <tr>
                <td class="name">&nbsp;</td>
                <td class="temp">&nbsp;</td>
                <td class="table_filler">&nbsp;</td>
                <th class="tableH">Tax:</th>
                <td class="stretch">$<?php echo money($order['orderTax']); ?></td>
            </tr>
            <tr>
                <td class="name">&nbsp;</td>
                <td class="temp">&nbsp;</td>
                <td class="table_filler">&nbsp;</td>
                <th class="tableH">Delivery:</th>
                <td class="stretch">$<?php echo money($order['orderDeliveryCharge']); ?></td>
            </tr>
            <tr>
                <td class="name">&nbsp;</td>
                <td class="temp">&nbsp;</td>
                <td class="table_filler">&nbsp;</td>
                <th class="tableH">Total:</th>
                <td class="stretch">$<?php echo money($order['orderTotal']); ?></td>
            </tr>
        </table>
        
        <?php if ($order['paymentID'] == 2 || $order['delivery'] == 'Y' || $order['deliveryComments'] != ''){ ?>
    
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
        
        <?php } if ($order['delivery'] == 'Y'){ ?>
        
            <div id="delivery_info">
                <h4><u>Delivery Address</u></h4>
                <p><?php echo $order['daddress1']; ?></p>
                <?php if ($order['daddress2'] != '') { ?><p><?php echo $order['daddress2']; ?></p><?php } ?>
                <p><?php echo $order['dcity']; ?>, <?php echo $order['dstateCode']; ?> <?php echo $order['dpostalCode']; ?></p>
            </div>
            
        <?php } 
            if ($order['deliveryComments'] != '') { ?>
            
            <div id="delivery_info">
                <h4><u>Special Instructions</u></h4>
                <p><?php echo $order['deliveryComments']; ?></p>
            </div>
            
        <?php } ?>
            
            <div class="clear">
            </div>
        </div>

    <?php } ?>

	</div>
</div>

<?php include '../view/emp_footer.php'; ?>