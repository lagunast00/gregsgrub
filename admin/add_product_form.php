<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/add_product_form.php
**** Description: Form that allows manager to add a product to the system
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }
    
    $title = 'Add Product';
    
    $categories = get_categories();

    include '../view/admin_header.php'; 

?>

<div id="content_container">
    
    <script type='text/javascript'>
        $('#mprod').addClass('textColor1');
    </script>

    <h1 class="headings1">Add Product</h1>
    <div id="add_admin"> 
        <h2>Enter Product Details</h2>    
    
        <form id="add_user_form" method="POST" action="index.php">    	
        	<label>
                <span>Category: </span><select name="categoryID" class="pd2" required>
        		<?php foreach($categories as $category) : ?>
        			<option value="<?php echo $category['categoryID']; ?>" <?php if(isset($_POST['categoryID'])){ if ($_POST['categoryID'] == $category['categoryID']) echo 'selected="selected"'; }?> ><?php echo $category['categoryName']; ?></option>
        		<?php endforeach; ?>
        	    </select>
            </label>

        	<label><span>Name: </span><input type="text" name="productName" value="<?php if (isset($_POST['productName'])) { echo $_POST['productName']; } ?>" required maxlength="21"></label>

        	<label><span>Description: </span><textarea rows="2" cols="17"  class="pd" name="productDescription" required maxlength="100"><?php if (isset($_POST['infoFAQ'])) { echo $_POST['infoFAQ']; } ?></textarea></label>

            <label class="chkbx"><span>Require Temp Field: </span><input type="checkbox" name="requireTemp" value="1" <?php if(isset($_POST['requireTemp'])){ if ($_POST['requireTemp'] == '1') echo 'checked="checked"'; }?> ></label>

            <label><span>Price: $</span><input type="text" name="productPrice" value="<?php if (isset($_POST['productPrice'])) { echo money($_POST['productPrice']); } ?>" required pattern="[0-9]+\.[0-9]{2}([^0-9]|$)" title="Enter valid dollar amount"></label>

            <input type="hidden" name="action" value="add_product">
        	<input type="submit" value="Submit" class="submit_button center">
        </form>
    </div>    
</div>

<?php include '../view/admin_footer.php'; ?>