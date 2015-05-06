<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: emp/delivery.php
**** Description: File that shows all delivery orders that are assigned to the employee that is logged in
-->

<?php

	if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'E' || $_SESSION['jobStatus'] != 'Employed'){
	        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
	        exit();
	    }

	$title = 'Delivery Orders';
	
	include '../view/emp_header.php';

	if (isset($_GET['event']))
        $event = $_GET['event'];
    else if (isset($_POST['event']))
        $event = $_POST['event'];
    else if (isset($event)){

    }
    else
        $event = 'all';

    $employee = get_employee_all($_SESSION['userID']);
    $emp = $employee['employeeID'];

?>

<div id="content_container" class="fit2">

	<div id="sub_nav">
        <ul>
            <li><a id="time" href="http://localhost/web289/gregsgrub/emp/index.php?action=delivery&amp;event=time">By Time</a></li>
			<li><a id="name" href="http://localhost/web289/gregsgrub/emp/index.php?action=delivery&amp;event=name">By Name</a></li>
			<li><a id="num" href="http://localhost/web289/gregsgrub/emp/index.php?action=delivery&amp;event=number">By Order #</a></li>
        </ul>
    </div>
        <script type='text/javascript'>
            $('#mdel').addClass('textColor1');
        </script>

<?php if ($event == 'all') { ?>
	<?php $orders = get_delivery_orders($emp); ?>		
<?php } else if ($event == 'time') { ?>
    <?php $orders = get_delivery_orders_date($emp); ?> 
        <script type='text/javascript'>
            $('#time').addClass('pageMarker');
        </script>       
<?php } else if ($event == 'name') { ?>
        <script type='text/javascript'>
            $('#name').addClass('pageMarker');
        </script>
    <?php $orders = get_delivery_orders_name($emp); ?>
<?php } else if ($event == 'number') { ?>
        <script type='text/javascript'>
            $('#num').addClass('pageMarker');
        </script>
    <?php $orders = get_delivery_orders_number($emp); ?>
<?php } ?>

    <h1 class="headings1">Delivery Orders</h1>
    <div id="users_admin">
        <table>
            <tr class="special1">
                <th class="date">Date</th>
                <th class="number">Order #</th>
                <th class="name">Name</th>
                <th class="commments">Comments</th>
                <th class="total">Total</th>
                <th class="paid">Paid</th>
                <th>&nbsp;</th>
            </tr>
        
        <?php foreach ($orders as $order) : ?>
        
            <tr>
                <td><?php 
                    $orderCompleteDate = strtotime($order['orderCompleteDate']);
                    $orderCompleteDate = date('M j, Y - g:i A', $orderCompleteDate);
                    echo $orderCompleteDate;
                ?></td>
                <td><?php echo $order['orderID']; ?></td>
                <td><?php 
                    $details = get_all_order_info($order['orderID']);
                    echo $details['lName']; ?>, <?php echo $details['fName']; ?></td>
                <td><?php echo $order['deliveryComments']; ?></td>
                <td>$<?php echo money($order['orderTotal']); ?></td>
                <td><?php if ($order['paid'] == 'Y') { echo 'Yes'; } else { echo 'No'; } ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="order_details" />
                    <input type="hidden" name="cash_out" value="no" />
                    <input type="hidden" name="event" value="<?php echo $event; ?>" />
                    <input type="hidden" name="orderID"
                           value="<?php echo $order['orderID']; ?>" />
                    <input type="submit" value="Details" class="submit_button">
                </form></td>
            </tr>
        
        <?php endforeach; ?>

        </table>
        <hr>
    </div>
</div>

<?php include '../view/emp_footer.php'; ?>