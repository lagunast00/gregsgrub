<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/new_order.php
**** Description: Form that allows customer to start a new order
-->

<?php

    if (!isset($_SESSION["userID"])) {
        if (isset($_POST['productID'])){
            $productID = $_POST['productID'];
            header("Location: //localhost/web289/gregsgrub/index.php?productID=$productID&action=login_page");
            exit();
        }
        if (isset($_GET['productID'])){
            $productID = $_GET['productID'];
            header("Location: //localhost/web289/gregsgrub/index.php?productID=$productID&action=login_page");
            exit();
        }
        
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
        exit();
    }
    if ($_SESSION['userLevel'] != 'C') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
        exit();
    }

    $product = get_product($productID);
    $title = "New Order?";
    
    include '../view/cust_header.php'; 

?>

<div id="content_container">
	<h1 class="headings1">New Order Page</h1>
    <h2 class="center">Would you like to start a new order?</h2>
	
    <div class="center">
        <a href="//localhost/web289/gregsgrub/cust/index.php?action=add_new_order&amp;productID=<?php echo $product['productID']; ?>" class="buttons inline">Yes</a>
		<a href="//localhost/web289/gregsgrub/cust/index.php?action=view_cart" class="buttons inline">No</a>
    </div>
</div>
	
<?php include '../view/footer.php'; ?>