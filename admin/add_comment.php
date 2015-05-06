<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/add_comment.php
**** Description: Form for manager to respond to a comment
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = "Add Comment";
    
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

    <h1 class="headings1">Comment Reply</h1>
    <div id="add_admin" class="new_comment">
        <h2 class="new_comment">Enter Comment: </h2>
            <form action='index.php' method="POST">
                
                <textarea name="commentText" rows="3" cols="50" class="commentText2" required></textarea>
                
                <input type="hidden" name="action" value="add_comment_reply">
                <input type="hidden" name="commentID" value="<?php echo $commentID; ?>">
                <input type="submit" value="Add Comment" class="submit_button center">
            </form>
        </div>        
</div>

<?php include '../view/admin_footer.php';?>