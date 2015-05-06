<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/all_orders.php
**** Description: File allows manager to view any order that the customer has sent to the system
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }
    
    $title = 'All Orders';

    if (isset($_GET['event']))
        $event = $_GET['event'];
    else if (isset($_POST['event']))
        $event = $_POST['event'];
    else if (isset($event)){

    }
    else
        $event = 'all';

    include '../view/admin_header.php'; 

?>

<div id="content_container">
    <div id="sub_nav">
        <ul>
            <li><a id="mdate" href="http://localhost/web289/gregsgrub/admin/index.php?action=all_orders&amp;event=date">By Date</a></li>
            <li><a id="mname" href="http://localhost/web289/gregsgrub/admin/index.php?action=all_orders&amp;event=name">By Name</a></li>
            <li><a id="mnum" href="http://localhost/web289/gregsgrub/admin/index.php?action=all_orders&amp;event=number">By Order #</a></li>
        </ul>
    </div>

    <script type='text/javascript'>
        $('#morder').addClass('textColor1');
    </script>

<?php if ($event == 'all') { ?>
    <?php $orders = get_every_order(); ?>       
<?php } else if ($event == 'date') { ?>
    
    <script type='text/javascript'>
        $('#mdate').addClass('pageMarker');
    </script>
    <?php $orders = get_every_order_date(); ?>        
<?php } else if ($event == 'name') { ?>

    <script type='text/javascript'>
        $('#mname').addClass('pageMarker');
    </script>
    <?php $orders = get_every_order_name(); ?>
<?php } else if ($event == 'number') { ?>
    
    <script type='text/javascript'>
        $('#mnum').addClass('pageMarker');
    </script>
    <?php $orders = get_every_order_number(); ?>
<?php } ?>

    <h1 class="headings1">All Orders</h1>
    <div id="users_admin">
        <table>
            <tr class="special1">
                <th class="date">Date</th>
                <th class="number">Order #</th>
                <th class="name">Name</th>
                <th class="total">Total</th>
                <th class="status">Status</th>
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
                <td>$<?php echo money($order['orderTotal']); ?></td>
                <td><?php echo $order['orderStatus'] ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="order_details" />
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

<?php include '../view/admin_footer.php'; ?>