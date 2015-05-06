<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/view_cart.php
**** Description: File that shows customers orders (Previous orders, unprocessed orders, and current order)
-->

<?php

    if (isset($_SESSION['orderID'])){
        $details = get_order_details($_SESSION['orderID']);
        $ticket = get_current_order($_SESSION['orderID']);
    }

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'C'){
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $customerID = get_customer($_SESSION['userID']);
    $orders = get_customer_orders($customerID);
    $unsentOrders = get_unsent_orders($customerID);
    
    $title = "My Cart";
    
    include '../view/cust_header.php'; 

    if (isset($msg)) {
        echo "<h4 class='msg'>".$msg."</h4>";
    } 

?>

<div id="content_container" class="fit2">
       
    <div id="sub_nav" class="sub_nav_fit">
        <ul>
            <li><a href="http://localhost/web289/gregsgrub/cust/index.php?action=view_cart&amp;event=old_cart">Previous Orders</a></li>
            <li><a href="http://localhost/web289/gregsgrub/cust/index.php?action=view_cart&amp;event=unsent_cart">Unprocessed Orders</a></li>
            <li><a href="http://localhost/web289/gregsgrub/cust/index.php?action=view_cart&amp;event=current_cart">Current Order</a></li>
        </ul>
    </div>
            
<?php if ($event == 'old_cart') { ?>

    <h2 class="headings1">Previous Orders</h2>

    <div id="main" class="fit2">

	<?php if (($orders->rowCount()) > 0 ){ ?>

    	<table id="old_cart">
            <tr class="special1">
                <th class="date">Order Date</th>
                <th class="delivery">Delivery</th>
                <th class="comments">Comments</th>
                <th>Total</th>
                <th>Paid</th>
                <th class="bt">&nbsp;</th>
            </tr>

            <?php foreach ($orders as $order) : ?>

            <tr>

            <?php $orderID = $order['orderID']; ?>

                <td class="left"><?php 
                    $orderSendDate = strtotime($order['orderSendDate']);
                    $orderSendDate = date('M j, Y - g:i A', $orderSendDate);
                    echo $orderSendDate;
                 ?></td>
                <td><?php if ($order['delivery'] == 'Y') { echo "Delivery"; } else { echo "Carry Out"; } ?></td>
                <td class="left comments1"><?php if ($order['deliveryComments']) { echo $order['deliveryComments']; } else { echo "No Special Comments"; } ?></td>
                <td>$<?php echo money($order['orderTotal']); ?></td>
                <td><?php if ($order['paid'] == NULL) { echo "No"; } else { echo "Yes"; } ?></td>
                <td><a href="//localhost/web289/gregsgrub/cust/index.php?action=order_details&amp;orderID=<?php echo $orderID; ?>" class="buttons">Details</a></td>
           	</tr>

            <?php endforeach; ?>

        </table>
        <hr class="fit4">

	<?php } else { ?>

    <p class="center">You have no Previous Orders!</p>
    <div id="main" class="fit3">

    <?php } ?>

        <a href="//localhost/web289/gregsgrub/cust/index.php?action=add_new_order" class="buttons center adjust">New Order</a>
    </div>
	
<?php } else if ($event == 'unsent_cart') { ?>
    
    <h1 class="headings1">Unprocessed Orders</h1>
    
    <?php if (($unsentOrders->rowCount()) > 0 ){ ?>
    <div id="main" class="fit3">
        <table id="unsent_cart">
            <tr class="special2">
                <th class="center1">Order #</th>
                <th class="center1">Date Started</th>
                <th class="center1"># of Items</th>
                <th class="center1">Subtotal</th>
                <th class="center1">Tax</th>
                <th class="center1">Total</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
      
            <?php foreach ($unsentOrders as $order) : ?>
      
            <tr>
      
            <?php $orderID = $order['orderID']; ?>
      
                <td class="center1"><?php echo $orderID; ?></td>
                <td class="center1"><?php 
                    $orderStartDate = strtotime($order['orderStartDate']);
                    $orderStartDate = date('M j, Y - g:i A', $orderStartDate);
                    echo $orderStartDate;
                 ?></td>
                <?php
                    $num_items = 0;
                    $items = get_order_details($orderID);
                    if ($items->rowCount() > 0){
                        foreach ($items as $item){
                            $num_items += $item['productQty'];
                        }
                    }
                ?>
      
                <td class="center1"><?php echo $num_items; ?></td>
                <td class="center1">$<?php echo money($order['orderSubTotal']); ?></td>
                <td class="center1">$<?php echo money($order['orderTax']); ?></td>
                <td class="center1">$<?php echo money($order['orderTotal']); ?></td>
                <td class="edit"><a href="//localhost/web289/gregsgrub/cust/index.php?action=select_order&amp;orderID=<?php echo $orderID; ?>" class="buttons">Edit</a></td>
                <td class="delete"><a href="//localhost/web289/gregsgrub/cust/index.php?action=confirm_delete_order&amp;orderID=<?php echo $orderID; ?>" class="buttons">Delete</a></td>
            </tr>
        
        <?php endforeach; ?>
        
        </table>
        <hr class="fit4">
        <a href="//localhost/web289/gregsgrub/cust/index.php?action=add_new_order" class="buttons adjust">New Order</a>
    </div>

    <?php } else { ?>

        <p class="center">You have no unprocessed orders</p>
        <a href="//localhost/web289/gregsgrub/cust/index.php?action=add_new_order" class="buttons center">New Order</a>

        <div id="main" class="fit3">
        </div>

    <?php } 
} else if ($event == 'current_cart') { ?>

    <h1 class="headings1">Current Order</h1>

    <?php if (isset($msg)){ ?>

        <h2 class="center" style="color: red"><?php echo $msg; ?></h2>

    <?php } ?>
    
    <?php if (isset($details)){ ?>
        <?php if (($details->rowCount()) == 0){ ?>
        
        <p class="center">Your cart is empty!</p>
    
        <div id="main" class="fit3">
        </div>
    
        <?php } else { ?>
    
        <div id="main" class="fit3">
    
            <div id="current_cart">
                <h4>Order # <?php echo $_SESSION['orderID']; ?></h4>
                <table>
                    <tr class='special1'>
                        <td>Item</td>
                        <td>Temperature</td>
                        <td class="center1">Special Instructions</td>
                        <td>Qty</td>
                        <td class="right padr2">Total</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
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
                        <td class="edit"><a href="//localhost/web289/gregsgrub/cust/index.php?action=edit_item&amp;orderDetailsID=<?php echo $detail['orderDetailsID']; ?>" class="buttons">Edit</a></td>
                        <td class="delete"><a href="//localhost/web289/gregsgrub/cust/index.php?action=confirm_delete_item&amp;orderDetailsID=<?php echo $detail['orderDetailsID']; ?>" class="buttons">Delete</a></td>
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
                        <td colspan="2" class="table_filler2">Add discount during checkout</td>
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
                        <td colspan="2" class="table_filler2">Process order to add delivery</td>
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
        
            <a href="http://localhost/web289/gregsgrub/cust/index.php?action=process_order" class="buttons process">Process Order</a>
            <a href="//localhost/web289/gregsgrub/cust/index.php?action=confirm_delete_order&amp;orderID=<?php echo $_SESSION['orderID']; ?>" class="buttons delete_cart">Delete Order</a>
        </div>

        <?php } ?>        
    <?php } else { ?>

        <p class="center">No Order Selected</p>
        <a href="//localhost/web289/gregsgrub/cust/index.php?action=add_new_order" class="buttons center">New Order</a>
    
        <div id="main" class="fit3"> 
        </div>
    
    <?php }
    } ?>

</div>

<?php include '../view/footer.php'; ?>