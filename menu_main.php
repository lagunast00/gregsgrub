<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: menu_main.php
**** Description: File that displays the main menu either in entirety or by category
-->

<?php 

	$title = "Our Menu";
	include 'view/header.php'; 

?>
    
<div id="content_container" class="fit">
    <div id="sub_nav">
    	<ul>
			<?php foreach ($categories2 as $category) : ?>
				<li><a id="c<?php echo $category['categoryID']; ?>" href="http://localhost/web289/gregsgrub/index.php?action=menu_main&amp;categoryID=<?php echo $category['categoryID']; ?>"><?php echo $category['categoryName']; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<script type='text/javascript'>
		// $('#sub_nav li a').removeClass('pageMarker');
		var page = "c<?php echo $categoryID; ?>";
		$('#sub_nav li a').each(function(){
			if ($(this).attr('id') == page){
				$(this).addClass('pageMarker');
			}
		});
		$('#mgrub').addClass('textColor1');
	</script>

<?php

	if ($categoryID != '99'){

    $categoryName = get_category_name($categoryID); 
    $categoryName = $categoryName['categoryName'];
    $products = get_product_by_category($categoryID); 

	$rec_limit = 8;

	$rec_count = $products->rowCount();

	if( isset($_GET['page'] ) )
	{
	   $page = $_GET['page'] + 1;
	   $offset = $rec_limit * $page ;
	}
	else
	{
	   $page = 0;
	   $offset = 0;
	}
	$left_rec = $rec_count - ($page * $rec_limit);
	$products2 = get_product_by_category_limit($categoryID, $offset, $rec_limit);

   	
?>
	<h1 class="headings1"><?php echo $categoryName; ?></h1>

	<form class="search_form" action="index.php" method="post">
		<input id="search_input" type="text" name="search" placeholder="Search Grub Menu" required>
		<input type="hidden" name="action" value="search_results">
		<input type="submit" value="Search" class="submit_button">
	</form>

	<div id="main">

	<?php foreach ($products2 as $product) : ?>
	
		<div class="all_products">
			<h4><?php echo $product['productName']; ?></h4>
			<img src="<?php echo $product['productPhotoURL']; ?>" alt="<?php echo $product['productName']; ?>" class="all_thumbs">
			<p class="price">$<?php echo money($product['productPrice']); ?></p>
	
			<form class="order_button" action="cust/index.php" method="post">
                <input type="hidden" name="action" value="order_page" />
                <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>" />
                <input type="submit" value="Order" />
            </form>
    
            <form class="order_button2" action="index.php" method="post">
                <input type="hidden" name="action" value="product_details" />
                <input type="hidden" name="action_state" value="menu_main" />
                <input type="hidden" name="category_state" value="<?php echo $product['categoryID']; ?>" />
                <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>" />
                <input type="submit" value="Details">
            </form>
		</div>

	<?php endforeach; ?>

	</div>
<?php
	if ($products->rowCount() > 8 ) {
		$categoryID = $product['categoryID'];
		if( $left_rec < $rec_limit )
		{
		   $last = $page - 2;
		   echo "<a href=\"?action=menu_main&amp;categoryID=$categoryID&amp;page=$last\" class='buttons center'>Last 8 Items</a>";
		} else if( $page > 0 )
		{
		   $last = $page - 2;
		   echo "<a href=\"?action=menu_main&amp;categoryID=$categoryID&amp;page=$last\" class='buttons center'>Last 8 Items</a>";
		   echo "<a href=\"?action=menu_main&amp;categoryID=$categoryID&amp;page=$page\" class='buttons center'>Next 8 Items</a>";
		}
		else if( $page == 0 )
		{
		   echo "<a href=\"?action=menu_main&amp;categoryID=$categoryID&amp;page=$page\" class='buttons center'>Next 8 Items</a>";
		}
	?>
   <?php } 
} else if ($categoryID == '99'){
	$products = get_grub_products();

	$rec_limit = 8;

	$rec_count = $products->rowCount();

	if( isset($_GET['page'] ) )
	{
	   $page = $_GET['page'] + 1;
	   $offset = $rec_limit * $page ;
	}
	else
	{
	   $page = 0;
	   $offset = 0;
	}
	$left_rec = $rec_count - ($page * $rec_limit);

	$products2 = get_limit($offset, $rec_limit);

?>
	<h1 class="headings1">The Grub Menu</h1>

	<form class="search_form" action="index.php" method="post">
		<input id="search_input" type="text" name="search" placeholder="Search Grub Menu" required>
		<input type="hidden" name="action" value="search_results">
		<input type="submit" value="Search" class="submit_button">
	</form>

	<div id="main">

	<?php foreach ($products2 as $product) : ?>

		<div class="all_products">
			<h4><?php echo $product['productName']; ?></h4>
			<img src="<?php echo $product['productPhotoURL']; ?>" alt="<?php echo $product['productName']; ?>" class="all_thumbs">
			<p class="price">$<?php echo money($product['productPrice']); ?></p>

			<form class="order_button" action="cust/index.php" method="post">
                <input type="hidden" name="action" value="order_page" />
                <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>" />
                <input type="submit" value="Order" />
            </form>

            <form class="order_button2" action="index.php" method="post">
                <input type="hidden" name="action" value="product_details" />
                <input type="hidden" name="action_state" value="menu_main" />
                <input type="hidden" name="category_state" value="99" />
                <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>" />
                <input type="submit" value="Details">
            </form>
		</div>

	<?php endforeach;  ?>

	</div>
<?php
	if ($products->rowCount() > 8 ) {
		if( $left_rec < $rec_limit )
		{
		   $last = $page - 2;
		   echo "<a href=\"?action=menu_main&amp;page=$last\" class='buttons center'>Last 8 Items</a>";
		} else if( $page > 0 )
		{
		   $last = $page - 2;
		   echo "<a href=\"?action=menu_main&amp;page=$last\" class='buttons center'>Last 8 Items</a>";
		   echo "<a href=\"?action=menu_main&amp;page=$page\" class='buttons center'>Next 8 Items</a>";
		}
		else if( $page == 0 )
		{
		   echo "<a href=\"?action=menu_main&amp;page=$page\" class='buttons center'>Next 8 Items</a>";
		}
	} 
} ?>

</div>

<?php include 'view/footer.php'; ?>