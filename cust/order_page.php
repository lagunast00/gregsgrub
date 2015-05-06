<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/order_page.php
**** Description: Form that allows customer to add items to cart
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'C'){
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }
    if (isset($order)){
    	$productSpecial = $order['productSpecial'];
    	$productQty = $order['productQty'];
    	$productTemp = $order['productTemp'];
    	$productID = $order['productID'];
    	$productTotal = $order['productTotal'];
    	$orderDetailsID = $order['orderDetailsID'];
    } else {
    	$productSpecial = "";
    	$productQty = "";
    	$productTemp = "";
    	$orderDetailsID = "";
    }

    $product = get_product($productID);
    $title = "Order Page";
 	
 	include '../view/cust_header.php'; 

 ?>

<div id="content_container">
	<h2 class="headings1">Order Page</h2>
	
	<div id="order_page">
		<form action="." method="post" id="orderForm">			
			<img src="../<?php echo $product['productPhotoURL']; ?>" alt="<?php echo $product['productName']; ?>">			
			<h2><?php echo $product['productName']; ?>&nbsp;$<?php echo $product['productPrice']; ?></h2>
			
			<div id="order_page_content">
				<p><?php echo $product['productDescription']; ?></p>

			<?php if ($product['requireTemp'] == "1") { ?>
			
				<label id="temp">Temperature:
				<select name="productTemp" required>
					<option value="">Select Temp</option>
					<option value="Rare" <?php if  ($productTemp =='Rare'){?>selected='selected'<?php } ?>>Rare</option>
					<option value="Medium Rare" <?php if  ($productTemp ==' Medium Rare'){?>selected='selected'<?php } ?>>Medium Rare</option>
					<option value="Medium" <?php if  ($productTemp =='Medium'){?>selected='selected'<?php } ?>>Medium</option>
					<option value="Medium Well" <?php if  ($productTemp =='Medium Well'){?>selected='selected'<?php } ?>>Medium Well</option>
					<option value="Well" <?php if  ($productTemp =='Well'){?>selected='selected'<?php } ?>>Well</option>
				</select></label>
			
			<?php } ?>

				<label><p class="special">Special Instructions: <br><textarea name="productSpecial" rows="7" cols="40" maxlength="200" class="specialP"><?php echo $productSpecial; ?></textarea></p></label><br>
				<label id="qty">Quantity: <input type="number" id="qty1" name="productQty" min="1" max="10" value="<?php if ($productQty == '') echo '1'; else echo $productQty; ?>" required><span> (Limit 10 per order)</span></label>
				<input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">
				<input type="hidden" name="productPrice" value="<?php echo $product['productPrice']; ?>">
			
			<?php if (isset($order)) { ?>
		
				<input type="hidden" name="oldTotal" value="<?php echo $productTotal; ?>">
				<input type="hidden" name="orderDetailsID" value="<?php echo $orderDetailsID ?>">
				<input type="hidden" name="action" value="update_order_item">
				
			<?php } else { ?>
	
				<input type="hidden" name="action" value="add_order_item">
	
			<?php } ?>

				<input type="submit" value="Add to Order" class="submit_button center">
			</div>
		</form>
	</div>
</div>
	
<?php include '../view/footer.php'; ?>