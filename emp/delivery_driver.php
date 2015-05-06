<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: emp/delivery_driver.php
**** Description: Form that allows employee to assign a delivery driver to an order after it has been checked
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'E' || $_SESSION['jobStatus'] != 'Employed'){
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
        exit();
    }

    $title = "Choose Delivery Driver";

    $order = get_all_order_info($orderID);
    
    include '../view/emp_header.php'; 

?>

<div id="content_container">
	<h1 class="headings1">Choose Delivery Driver</h1>
    
    <div id="update_status">
        <form action="index.php" method="post">
            <h2><?php echo $order['fName']; ?> <?php echo $order['lName']; ?></h2>
            <p><span>Order #: </span><?php echo $order['orderID']; ?></p>
            <p><span>Total: </span>$<?php echo money($order['orderTotal']); ?></p>
            <p><span>Comments: </span><?php echo $order['deliveryComments']; ?></p>
            <label><span>Driver: </span>
                <select name="employeeID">
                <?php 
                    $emps = get_active_employees(); 
                    foreach ($emps as $emp) { ?>
                        <option value="<?php echo $emp['employeeID']; ?>"><?php echo $emp['fName']; ?> <?php echo $emp['lName']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <input type="hidden" name="action" value="update_driver">
            <input type="hidden" name="orderID" value="<?php echo $order['orderID']; ?>">
            <input type="submit" value="Update" class="submit_button center">
        </form>
    </div>
</div>
	
<?php include '../view/emp_footer.php'; ?>