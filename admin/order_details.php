<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/order_details.php
**** Description: File that shows manager the details of any particular order
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }
    
    $title = 'Order Details';

    if (isset($_POST['orderID'])) {
        $orderID = $_POST['orderID'];
        $event = $_POST['event'];
    } else if (isset($_GET['orderID'])) {
        $orderID = $_GET['orderID'];
        $event = $_GET['event'];
    }

    $order = get_current_order($orderID);
    $customer = get_all_customer_details($order['customerID']);
    $credit = get_card_info($orderID);
    $details = get_order_details($orderID);
    $ticket = get_current_order($orderID);
    $employeeID = $order['employeeID'];
    $employee = get_employee_info($employeeID);
    
    include '../view/admin_header.php'; 

?>

<div id="content_container" class="fit11">
    <h1 class="headings1">Order Details</h1>
    <script type='text/javascript'>
        $('#morder').addClass('textColor1');
    </script>

    
    <div id="confirm_order">
        <h5 class="order_status">Order Status:<span><?php echo $order['orderStatus']; ?></span></h5>
        
    <?php if ($order['delivery'] == 'Y') { ?>
        <?php if ($order['employeeID'] != NULL) { ?>
    
            <div id="delivery_driver">
                <h5>Delivery Driver: <?php echo $employee['fName']; ?> <?php echo $employee['lName']; ?></h5>
                <img src="../<?php echo $employee['thumbnailURL']; ?>" alt="Delivery Driver Image">
            </div>
    
        <?php } 
    } ?>
        <a href="//localhost/web289/gregsgrub/admin/index.php?action=all_orders&amp;event=<?php echo $event; ?>" class="buttons status">Back</a>
        <h4>Order #<?php echo $order['orderID']; ?></h4>
        <p class="delivery_comments1"><span class="bold">Order Comments: </span><?php if ($order['deliveryComments']) { echo $order['deliveryComments']; } else { echo "No Special Comments"; } ?></p>
        <table class="confirmT tableN">
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
                
            <?php endforeach; ?>
    
        </table>
            
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
                        echo $discount['couponValue'];
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
            <h4>Card Info</h4>
            <p><span>Name:</span><?php echo $credit['cardName']; ?></p>
            <p><span>Card:</span><?php echo $credit['cardType']; ?></p>
            <p><span>Number:</span><?php echo $credit['cardNumber']; ?></p>
            <p><span>Expires:</span><?php 
                $exp = strtotime($credit['cardExpires']);
                $exp = date('m-d-Y');
                echo $exp; ?>
            </p>
        </div>

    <?php } if ($order['delivery'] == 'Y'){ ?>
    
        <div id="delivery_info">
            <h4>Delivery Address</h4>
            <p><?php echo $customer['daddress1']; ?></p>
            <?php if ($customer['daddress2'] != '') { ?><p><?php echo $customer['daddress2']; ?></p><?php } ?>
            <p><?php echo $customer['dcity']; ?>, <?php echo $customer['dstateCode']; ?> <?php echo $customer['dpostalCode']; ?></p>
        </div>
    
    <?php } ?>

        <div class="clear">
        </div>
    </div>

<?php } ?>

</div>

<?php include '../view/admin_footer.php'; ?>