<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: product_details.php
**** Description: Form that displays selected product details
-->

<?php 

	$title = "Product Details";
	include 'view/header.php'; 

	$product = get_product($_POST['productID']);

	$action = $_POST['action_state'];
	$categoryID = $_POST['category_state'];

?>

<div id="content_container">
	<h1 class="headings1">Product Details</h1>
	
	<div id="product_details">
		<h2><?php echo $product['productName']; ?>&nbsp;$<?php echo $product['productPrice']; ?></h2>
		<img src="<?php echo $product['productPhotoURL']; ?>" alt="<?php echo $product['productName']; ?>">		
		<p><span>Description:</span><?php echo $product['productDescription']; ?></p>
		
		<div id="product_details_buttons">
			<a href="//localhost/web289/gregsgrub/index.php?action=<?php echo $action; ?>&amp;categoryID=<?php echo $categoryID; ?>" class="buttons">Back</a>

			<form action="cust/index.php" method="post">
                <input type="hidden" name="action" value="order_page" />
                <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>" />
                <input type="submit" value="Order" class="submit_button">
            </form>
		</div>
	</div>
</div>

<?php include 'view/footer.php'; ?>