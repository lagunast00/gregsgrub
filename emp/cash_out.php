<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: emp/cash_out.php
**** Description: Form that allows employee to cash out an order
-->

<?php
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'E' || $_SESSION['jobStatus'] != 'Employed'){
            header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
            exit();
        }
    $title = "Process Payment";

    $order = get_all_order_info($orderID);

    if (isset($_GET['event']))
        $event = $_GET['event'];
    else if (isset($_POST['event']))
        $event = $_POST['event'];
    else if (isset($event)){

    }
    else
        $event = 'payment';

    $emp = get_employee_all($_SESSION['userID']);
    $empID = $emp['employeeID'];
    
    include '../view/emp_header.php'; 

?>

<div id="content_container">
	<h1 class="headings1">Process Payment</h1>
    
<?php if ($event == 'payment'){ ?>

    <p class="ord_num">Order #: <?php echo $order['orderID']; ?></p>

    <div id="process_payment">
        <h2><?php echo $order['fName']; ?> <?php echo $order['lName']; ?></h2>
        <p><span>Date: </span><?php 
                        $orderCompleteDate = strtotime($order['orderCompleteDate']);
                        $orderCompleteDate = date('M j, Y - g:i A', $orderCompleteDate);
                        echo $orderCompleteDate; ?></p>
        <p><span>Total: </span>$<?php echo money($order['orderTotal']); ?></p>
        <p><span>Comments: </span><?php echo $order['deliveryComments']; ?></p>

        <div id="cash_buttons" class="center">
            <a href="//localhost/web289/gregsgrub/emp/index.php?action=cash_out&amp;event=cash&amp;orderID=<?php echo $order['orderID']; ?>" class="buttons">Cash</a>
            <a href="//localhost/web289/gregsgrub/emp/index.php?action=cash_out&amp;event=credit&amp;orderID=<?php echo $order['orderID']; ?>" class="buttons">Credit</a>
        </div>
    </div>

<?php } else if ($event == 'cash') { ?>

    <div id="process_payment">
        <h2>Enter Amount Tendered</h2>
        <h3 class="center"><span>Total: </span>$<?php echo money($order['orderTotal']); ?></h3>

        <form action="." method="post">
            <input type="text" name="tender" placeholder="Amount Tendered" class="center" required pattern="[0-9]+\.[0-9]{2}([^0-9]|$)" title="Enter valid dollar amount">
            <input type="hidden" name="action" value="cash_out">
            <input type="hidden" name="event" value="change">
            <input type="hidden" name="orderID" value="<?php echo $order['orderID']; ?>">
            <input type="submit" value="Tender" class="submit_button center">
        </form>
    </div>

<?php } else if ($event == 'credit') { ?>

    <div id="process_payment">
        <h2>Enter Card Info</h2>
        <h3 class="center"><span>Total: </span>$<?php echo money($order['orderTotal']); ?></h3>
        <form action="." method="post">
            <label><span>Name on Card: </span><input type="text" id="cardName" name="cardName" required></label>

            <label><span>Card Type: </span><select name="cardType" required>
                <option value="Visa">Visa</option>
                <option value="Master Card">Master Card</option>
                <option value="Amemrican Express">American Express</option>
                <option value="Discover">Discover</option>
                <option value="Gift Card">Gift Card</option>
            </select></label>

            <label><span>Card Number: </span><input type="text" id="cardNumber" name="cardNumber" required pattern="^\d{16}$" title="Enter valid dollar amount"></label>
            
            <label><span>Card CVV Code: </span><input type="password" id="cardCw" name="cardCw" maxlength="3" required></label>

            <label><span>Card Expiration: </span><input type="text" id="datepicker" name="cardExpires" required></label>
            
            <input type="hidden" name="orderTotal" value="<?php echo $order['orderTotal']; ?>">
            <input type="hidden" name="action" value="credit_upload">
            <input type="hidden" name="orderID" value="<?php echo $order['orderID']; ?>">
            <input type="submit" value="Submit" class="submit_button center">
        </form>
    </div>

<?php } else if ($event == 'change') { ?>

    <div id="process_payment">
        <h2>Change Due</h2>
        <h3 class="center"><span>Total: </span>$<?php echo money($order['orderTotal']); ?></h3>
        <h3 class="center change"><span>Change Due: </span><?php 
            if ($_POST['tender'] > $order['orderTotal']){
                echo '$'.money($_POST['tender'] - $order['orderTotal']); 
                order_finished($order['orderID']);
                update_driver($order['orderID'], $empID);
                paid_order_cash($order['orderID'], '1');
            } else {
                echo 'Not Enough Tendered';
            }
             ?>
        </h3>            
        <a href="//localhost/web289/gregsgrub/emp/index.php?action=completed_orders" class="buttons center">Done</a>
    </div>

    <?php } ?>

</div>
	
<?php include '../view/emp_footer.php'; ?>