<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/ban_comment.php
**** Description: Form allows manger to ban a comment from the view
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }


    $title = "Ban Comment";

    $comment = get_comment_details($commentID);
    $userID = $comment['userIDcomm'];
    $name = get_name_info($userID);

?>


<?php include '../view/admin_header.php'; ?>

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
    
	<h1 class="headings1">Ban Comment</h1>
        <div id="ban_comment">
            <h2><?php echo $name['fName']; ?> <?php echo $name['lName']; ?></h2>
                <form id="ban_comment_form" action='index.php' method="POST">                    
                    <p><span>Date: </span><?php 
                        $commentDate = strtotime($comment['commentDate']);
                        $commentDate = date('M j, Y - g:i A', $commentDate);
                        echo $commentDate; ?>
                    </p>
                    <p><span>Comment: </span><?php echo $comment['commentText']; ?></p>
                    
                    <input type="hidden" name="action" value="comment_banned">
                    <input type="hidden" name="commentID" value="<?php echo $commentID; ?>">
                    <input type="submit" value="Ban Comment" class="submit_button center">
                </form>
        </div>        
</div>

<?php include '../view/admin_footer.php';?>