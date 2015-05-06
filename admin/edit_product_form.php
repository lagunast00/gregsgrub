<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }
    $title = 'Edit Product';
    $categories = get_categories();
?>
<?php include '../view/admin_header.php'; ?>
    <div id="content_container">

    <script type='text/javascript'>
        $('#mprod').addClass('textColor1');
    </script>
        <h1 class="headings1">Edit Product</h1>
        <?php if(isset($msg)) { echo $msg; } ?>
        <div id="edit_profile">
            <h2><?php echo $product['productName']; ?></h2>
            <img src="../<?php echo $product['productPhotoURL']; ?>" alt="<?php echo $product['productName']; ?> Image" id="edit_profile_image">
            <div class="profile_content margin1">
                <form action="index.php" method="post">
                        <label><span>Name: </span><input type="text" name="productName" value="<?php echo $product['productName']; ?>" required maxlength="21"></label>
                        <label><span>Price: $</span><input type="text" name="productPrice" value="<?php echo money($product['productPrice']); ?>" required pattern="[0-9]+\.[0-9]{2}([^0-9]|$)" title="Enter valid dollar amount"></label>
                        <label><span>Category: </span><select name="categoryID" required>
                    <?php foreach($categories as $category) : ?>
                        <option value="<?php echo $category['categoryID']; ?>" <?php if ($product['categoryID'] == $category['categoryID']) echo 'selected="selected"'; ?> ><?php echo $category['categoryName']; ?></option>
                    <?php endforeach; ?>
                </select></label>
                        <label><input type="checkbox" name="requireTemp" value="1" <?php if ($product['requireTemp'] == 1) {echo 'checked="checked"'; }?>class="width4" ><span class="width2"> Require Temp</span></label>
                        <textarea name="productDescription" rows="5" cols="60" maxlength="100" required><?php echo $product['productDescription']; ?></textarea>
                    <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>" />
                    <input type="hidden" name="productPhotoURL" value="<?php echo $product['productPhotoURL']; ?>" />
                    <input type="hidden" name="action" value="update_product" />
                    <input type="submit" value="Save Changes" class="submit_button"/>
                    <a class="buttons" href="http://localhost/web289/gregsgrub/admin/index.php?action=add_image_form&amp;productID=<?php echo $product['productID']; ?>">Change Image</a>
                </form>            
            </div>
        </div>
</div>
<?php include '../view/admin_footer.php'; ?>