<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/add_faq_form.php
**** Description: Form that allows a manager to add a FAQ to the system
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = 'Add FAQ';

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

	<h1 class="headings1">Add FAQ</h1>
    <div id="add_admin">
        <h2>Enter FAQ Details</h2>

        <form id="add_user_form" method="POST" action="index.php"> 	
        	<label><span>Question: </span><input type="text" name="infoFAQ" class="width3" value="<?php if (isset($_POST['infoFAQ'])) { echo $_POST['infoFAQ']; } ?>" required maxlength="100"></label>
        	
            <label><span>Answer: </span><textarea name="infoText" rows="3" cols="30" class="width3" required maxlength="200"><?php if (isset($_POST['infoText'])) { echo $_POST['infoText']; } ?></textarea></label>

            <input type="hidden" name="infoName" value="FAQ">
            <input type="hidden" name="action" value="add_faq">
        	<input type="submit" value="Add FAQ" class="submit_button center">
        </form>
    </div>    
</div>

<?php include '../view/admin_footer.php'; ?>