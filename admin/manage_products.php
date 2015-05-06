<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/manage_products.php
**** Description: File that allows manager to view all the products in the system
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }
    $title = 'Manage Products';
    if (isset($_GET['event']))
        $event = $_GET['event'];
    else if (isset($_POST['event']))
        $event = $_POST['event'];
    else if (isset($event)){
    }
    else
        $event = 'all';

    $categories2 = get_categories();
	
	include '../view/admin_header.php'; 

?>

<div id="content_container" class="fit10">
    <div id="sub_nav">
        <ul>
        <?php foreach ($categories2 as $category) : ?>
			<li><a id="c<?php echo $category['categoryID']; ?>" href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_products&amp;event=<?php echo $category['categoryID']; ?>"><?php echo $category['categoryName']; ?></a></li>
		<?php endforeach; ?>
        </ul>
    </div>
    <script type='text/javascript'>
		// $('#sub_nav li a').removeClass('pageMarker');
		var page = "c<?php echo $event; ?>";
		$('#sub_nav li a').each(function(){
			if ($(this).attr('id') == page){
				$(this).addClass('pageMarker');
			}
		});
		$('#mprod').addClass('textColor1');
	</script>

    
<?php 
	if ($event != 'all'){ 
	    $categoryID = $event;
	    $categoryName = get_category_name($categoryID); 
	    $categoryName = $categoryName['categoryName'];
	    $products = get_product_by_category($categoryID); 
?>
	<div id="users_admin" class="prod">
		<h1 class="headings1"><?php echo $categoryName; ?></h1>
		
		<?php if (isset($msg)) { echo $msg; } ?>
		
		<table>
	        <tr class="special1">
	            <th>&nbsp;</th>
	            <th class="prod_name">Name</th>
	            <th class="prod_name">Description</th>
	            <th class="prod_price">Price</th>
	            <th>&nbsp;</th>
	            <th>&nbsp;</th>
	            <th>&nbsp;</th>
	        </tr>
	    
	    <?php foreach ($products as $product) : ?>
	    
	        <tr>
	        	<td><img src="../<?php echo $product['productPhotoURL']; ?>" alt="<?php echo $product['productName']; ?>" class="thumbs"></td>
	            <td><?php echo $product['productName']; ?></td>
	            <td><?php echo $product['productDescription']; ?></td>
	            <td>$<?php echo money($product['productPrice']); ?></td>
	            <td><form action="." method="post">
	                <input type="hidden" name="action" value="add_image_form" />
	                <input type="hidden" name="productID"
	                       value="<?php echo $product['productID']; ?>" />
	                <input type="submit" value="Edit Image" class="submit_button">
	            </form></td>
	            <td><form action="." method="post">
	                <input type="hidden" name="action" value="edit_product_form" />
	                <input type="hidden" name="productID"
	                       value="<?php echo $product['productID']; ?>" />
	                <input type="submit" value="Edit Details" class="submit_button">
	            </form></td>
	            <td><form action="." method="post">
	                <input type="hidden" name="action" value="confirm_delete_product" />
	                <input type="hidden" name="productID"
	                       value="<?php echo $product['productID']; ?>" />
	                <input type="submit" value="Delete" class="submit_button">
	            </form></td>
	        </tr>

	        <?php endforeach; ?>

	    </table>
	    <hr>
		<a href="index.php?action=add_product_form" class="buttons">Add Product</a><br>
    </div>

<?php } else if ($event == 'all') { ?>

	<h1 class="headings1">Manage Products</h1>
    
    <div id="users_all">
        <h2>Attention!</h2>
        <p>You have reached the Manage Products page. From here you, as a manager, have access to all the products. Any changes made will be permanent. Please make sure spelling and grammer is correct. Check formatting when finished to make sure it still displays correctly.</p>
    </div>

<?php } ?>    

</div>

<?php include '../view/admin_footer.php'; ?>