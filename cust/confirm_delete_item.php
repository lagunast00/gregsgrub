<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/confirm_delete_item.php
**** Description: Form that allows customer to confirm deletion of a product before action
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'C'){
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = "Confirm Delete";

    $order = get_details($orderDetailsID);
    $product = get_product($order['productID']);
    
    include '../view/cust_header.php'; 

?>
<div id="content_container">
    <h1 class="headings1 center">Confirm Delete</h1>
    <h2 class="center">Are you sure you want to delete this Item?</h2>
    <div id="order_page2">
        <h2><?php echo $product['productName']; ?><span>$<?php echo money($order['productTotal']); ?></span></h2>
        <img src="../<?php echo $product['productPhotoURL']; ?>" alt="<?php echo $product['productName']; ?>">
        <p id="qty"><span class="bold"><?php echo $order['productQty']; ?></span> order(s)</p>
        <p id="each"><span class="bold">$<?php echo money($product['productPrice']); ?></span> each</p>

    <?php if ($order['productTemp'] != '') { ?>

        <p id="cooked"><span>Cooked: </span><?php echo $order['productTemp'];?></p>

    <?php } if ($order['productSpecial'] != '') { ?>

        <p id="descr1">Product Description:</p>            
        <p id="descr"><?php echo $order['productSpecial']; ?></p>

    <?php } ?>

        <div id="button_group1">
            <a href="//localhost/web289/gregsgrub/cust/index.php?action=delete_item&amp;orderDetailsID=<?php echo $order['orderDetailsID']; ?>" class="buttons">Delete</a>
            <a href="//localhost/web289/gregsgrub/cust/index.php?action=view_cart" class="buttons">Save</a>
        </div>
    </div>
</div>

<?php include '../view/footer.php'; ?>