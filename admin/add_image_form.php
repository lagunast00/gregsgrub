<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/add_image_form.php
**** Description: Form that allows manager to change the image of a product
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }
    
    $title = 'Add Product Image';

    include '../view/admin_header.php'; 

?>

<div id="content_container">
    <h1 class="headings1">Add Product Image</h1>
    <div id="edit_image">
        <h3><?php echo $product['productName']; ?>&nbsp;&nbsp;$<?php echo money($product['productPrice']); ?></h3>
    
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <img id="blah" src="../<?php echo $product['productPhotoURL']; ?>" alt="No Image">
            
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
            <div class="buttons">
                <span>Browse</span>
                <input type="file" name="productPhotoURL" class="upload" onchange="$('#blah')[0].src = window.URL.createObjectURL(this.files[0])" required><br />
            </div>
            
            <input type="hidden" name="action" value="add_image">
            <input type="hidden" name="categoryID" value="<?php echo $product['categoryID']; ?>">
            <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">
            <input type="submit" name="submit" value="Upload Image" class="submit_button"/>
        </form>
    </div>
</div>

<?php include '../view/admin_footer.php'; ?>