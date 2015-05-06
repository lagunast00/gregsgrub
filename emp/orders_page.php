<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: emp/orders_page.php
**** Description: File that shows employee all orders that are currently being prepared
-->

<?php

	if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'E' || $_SESSION['jobStatus'] != 'Employed'){
	        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
	        exit();
	    }

	$title = 'Current Orders';
	
	include '../view/emp_header.php';

	if (isset($_GET['event']))
        $event = $_GET['event'];
    else if (isset($_POST['event']))
        $event = $_POST['event'];
    else if (isset($event)){

    }
    else
        $event = 'all';

?>

<div id="content_container" class="fit2">

	<div id="sub_nav">
        <ul>
            <li><a id="mnew" href="http://localhost/web289/gregsgrub/emp/index.php?action=orders_page&amp;event=new_orders">New Orders</a></li>
			<li><a id="mcook" href="http://localhost/web289/gregsgrub/emp/index.php?action=orders_page&amp;event=orders_cooking">Orders Cooking</a></li>
			<li><a id="mcheck" href="http://localhost/web289/gregsgrub/emp/index.php?action=orders_page&amp;event=double_check">Double Check</a></li>
        </ul>
    </div>
    <script type='text/javascript'>
        $('#mcurr').addClass('textColor1');
    </script>

<?php if ($event == 'all') { 
    $orders = get_current_orders();
    ?>

	<h1 class="headings1">Current Orders</h1>

<?php } else if ($event == 'new_orders') { 
    $orders = get_new_orders_count();
    ?>
    <script type='text/javascript'>
        $('#mnew').addClass('pageMarker');
    </script>

	<h1 class="headings1">New Orders</h1>

<?php } else if ($event == 'orders_cooking') { 
    $orders = get_cooking_orders_count();
    ?>
    <script type='text/javascript'>
        $('#mcook').addClass('pageMarker');
    </script>

    <h1 class="headings1">Orders Cooking</h1>

<?php } else if ($event == 'double_check') {
    $orders = get_check_orders_count();
    ?>
    <script type='text/javascript'>
        $('#mcheck').addClass('pageMarker');
    </script>

    <h1 class="headings1">Order Double Check</h1>

<?php } ?>

    <div id="users_admin">
        <table>
            <tr class="special1">
                <th class="date">Date</th>
                <th class="number">Order #</th>
                <th class="name">Name</th>
                <th class="comments">Comments</th>
                <th class="total">Total</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        
        <?php foreach ($orders as $order) : ?>
        
            <tr>
                <td><?php 
                    $orderSendDate = strtotime($order['orderSendDate']);
                    $orderSendDate = date('M j, Y - g:i A', $orderSendDate);
                    echo $orderSendDate;
                ?></td>
                <td><?php echo $order['orderID']; ?></td>
                <td><?php 
                    $details = get_all_order_info($order['orderID']);
                    echo $details['lName']; ?>, <?php echo $details['fName']; ?></td>
                <td><?php echo $order['deliveryComments']; ?></td>
                <td>$<?php echo money($order['orderTotal']); ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="order_details" />
                    <input type="hidden" name="event" value="<?php echo $event; ?>" />
                    <input type="hidden" name="orderID"
                           value="<?php echo $order['orderID']; ?>" />
                    <input type="submit" value="Details" class="submit_button">
                </form></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="update_status_form" />
                    <input type="hidden" name="orderID"
                           value="<?php echo $order['orderID']; ?>" />
                    <input type="submit" value="Update Status" class="submit_button">
                </form></td>
            </tr>
    
        <?php endforeach; ?>
    
        </table>
        <hr>
    </div>
</div>

<?php include '../view/emp_footer.php'; ?>