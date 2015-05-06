<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/add_coupon_form.php
**** Description: Form that allows manager to add coupon to system
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = 'Add Coupon';

    include '../view/admin_header.php'; 

?>

<div id="content_container" class="fit9">
    <div id="sub_nav">
        <ul>
            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=comments">Manage Comments</a></li>
            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=faqs">Manage FAQs</a></li>
            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=promos">Manage Promos</a></li>
            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=mission">Manage Mission</a></li>
            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=coupons">Manage Coupons</a></li>
        </ul>
    </div>
    
    <script type='text/javascript'>
        $('#minfo').addClass('textColor1');
    </script>

	<h1 class="headings1">Add Coupon</h1>
    <div id="add_admin">
        <h2>Enter Coupon Details</h2>

        <form id="add_user_form" method="POST" action="index.php"> 	
            <label><span>Code: </span><input type="text" name="couponCode" value="<?php if (isset($_POST['couponCode'])) { echo $_POST['couponCode']; } ?>" required maxlength="8"></label>

            <label><span>Value: </span><input type="number" min="1" max="5" name="couponValue" class="couponValue" value="<?php if (isset($_POST['couponValue'])) { echo $_POST['couponValue']; } ?>" required></label>

        	<label><span>Description: </span><input type="text" name="couponDesc" value="<?php if (isset($_POST['couponDesc'])) { echo $_POST['couponDesc']; } ?>" required maxlength="50"></label>

            <input type="hidden" name="action" value="add_coupon">
        	<input type="submit" value="Add Coupon" class="submit_button center">
        </form>
    </div>    
</div>

<?php include '../view/admin_footer.php'; ?>