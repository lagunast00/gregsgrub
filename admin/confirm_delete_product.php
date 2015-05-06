<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/confirm_delete_product.php
**** Description: Form that allows manager to confirm the deletion of a product before action
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = 'Delete Product';

    include '../view/admin_header.php'; 

?>

<div id="content_container">
    
    <script type='text/javascript'>
        $('#mprod').addClass('textColor1');
    </script>
	<h1 class="headings1">Confirm Delete Product</h1>
    <div id="add_admin">
        <h2>Delete this Product?</h2>
        <img src="../<?php echo $product['productPhotoURL']; ?>" alt="<?php echo $product['productPhotoURL']; ?> Image">

        <form method="POST" action="index.php">        	
            <p class="delete"><span class="bold">Name: </span><?php echo $product['productName']; ?></p>
            <p class="delete"><span class="bold">Price: </span><?php echo $product['productPrice']; ?></p>
            <p class="delete"><span class="bold">Description </span><?php echo $product['productDescription']; ?></p>

            <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">
            <input type="hidden" name="action" value="delete_product">
        	<input type="submit" value="Delete" class="submit_button inline2">
            <a href="//localhost/web289/gregsgrub/admin/index.php?action=manage_products&amp;event=<?php echo $product['categoryID']; ?>" class="buttons inline2">Save</a>
        </form>
    </div>    
</div>

<?php include '../view/admin_footer.php'; ?>