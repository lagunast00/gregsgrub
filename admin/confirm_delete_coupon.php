<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/confirm_delete_coupon.php
**** Description: Form that allows manager to confirm deletion of coupon before action
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }
    
    $title = 'Delete Coupon';

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
    
	<h1 class="headings1">Confirm Delete Coupon</h1>
    <div id="add_admin">
        <h2>Delete this Coupon?</h2>

        <form method="POST" action="index.php">        	
            <p class="delete"><span class="bold">Code: </span><?php echo $coupon['couponCode']; ?></p>
            <p class="delete"><span class="bold">Value: </span><?php echo $coupon['couponValue']; ?></p>
        	<p class="delete"><span class="bold">Description: </span><?php echo $coupon['couponDesc']; ?></p>

            <input type="hidden" name="couponID" value="<?php echo $coupon['couponID']; ?>">
            <input type="hidden" name="action" value="confirm_delete_coupon">
        	<input type="submit" value="Delete" class="submit_button inline2">
            <a href="//localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=coupons" class="buttons inline2">Save</a>
        </form>
    </div>    
</div>

<?php include '../view/admin_footer.php'; ?>