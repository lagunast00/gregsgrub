<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: emp/update_status.php
**** Description: Form that allows employee to update the status of selected order
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'E' || $_SESSION['jobStatus'] != 'Employed'){
            header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
            exit();
        }
    $title = "Update Order Status";

    $order = get_all_order_info($orderID);
    
    include '../view/emp_header.php'; 

?>

<div id="content_container">
	<h1 class="headings1">Update Order Status</h1>

    <div id="update_status">
        <form action="index.php" method="post">
            <h2><?php echo $order['fName']; ?> <?php echo $order['lName']; ?></h2>
            <p><span>Order #: </span><?php echo $order['orderID']; ?></p>
            <p><span>Total: </span>$<?php echo money($order['orderTotal']); ?></p>
            <p><span>Comments: </span><?php echo $order['deliveryComments']; ?></p>
            <label><span>Status: </span>
                <select name="orderStatus">
                    <?php if ($order['orderStatus'] == 'Order Sent') { ?><option value="Order Sent">Order Sent</option><?php } ?>
                    
                    <?php if ($order['orderStatus'] == 'Order Sent' || $order['orderStatus'] == 'Order Cooking') { ?><option value="Order Cooking">Order Cooking</option><?php } ?>
                    
                    <?php if ($order['orderStatus'] == 'Order Cooking' || $order['orderStatus'] == 'Checking Order') { ?><option value="Checking Order">Checking Order</option><?php } ?>
                    
                    <?php if ($order['orderStatus'] == 'Checking Order' && $order['delivery'] == 'Y') { ?><option value="Being Delivered">Being Delivered</option><?php } ?>
                    
                    <?php if ($order['orderStatus'] == 'Checking Order' && $order['delivery'] == 'N') { ?><option value="Ready For Pickup">Ready for Pickup</option><?php } ?>
                </select>
            </label>
            <input type="hidden" name="action" value="update_status">
            <input type="hidden" name="orderID" value="<?php echo $order['orderID']; ?>">
            <input type="submit" value="Update" class="submit_button center">
        </form>
    </div>
</div>

<?php include '../view/emp_footer.php'; ?>