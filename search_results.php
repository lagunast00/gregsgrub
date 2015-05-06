<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: search_results.php
**** Description: File that displays the results of the product search
-->

<?php 

	$title = "Search Results";
	include 'view/header.php'; 

?>
    
<div id="content_container">
	<h1 class="headings1">Search Results</h1>

	<form class="search_form" action="index.php" method="post">
		<input id="search_input" type="text" name="search" placeholder="Search Grub Menu">
		<input type="hidden" name="action" value="search_results">
		<input type="submit" value="Search" class="submit_button">
	</form>

	<div id="search_results">

<?php 
	$count = $search_results->rowCount();
	if ($count > 0) { ?>
		<?php if ($count > 1) { ?>
			<p class="center">There are <span class="bold"><?php echo $count; ?></span> results matching "<span class="bold"><?php echo $search; ?></span>"</p>
		<?php } else { ?>
			<p class="center">There is <span class="bold"><?php echo $count; ?></span> result matching "<span class="bold"><?php echo $search; ?></span>"</p>
		<?php } ?>
		<?php foreach ($search_results as $product) : ?>

			<div class="all_products">
				<h4><?php echo $product['productName']; ?></h4>
				<img src="<?php echo $product['productPhotoURL']; ?>" alt="<?php echo $product['productName']; ?>" class="all_thumbs">
				<p class="price">$<?php echo money($product['productPrice']); ?></p>

				<form class="order_button" action="cust/index.php" method="post">
	                <input type="hidden" name="action" value="order_page" />
	                <input type="hidden" name="productID"
	                       value="<?php echo $product['productID']; ?>" />
	                <input type="submit" value="Order" />
	            </form>
			</div>

		<?php endforeach; ?>
	<?php } else { ?>
	
		<p class="center">There are <span class="bold">0</span> results matching "<span class="bold"><?php echo $search; ?></span>"</p>

	<?php }?>
	
	</div>
</div>

<?php include 'view/footer.php'; ?>