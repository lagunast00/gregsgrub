<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/comment_reply.php
**** Description: Form that allows a customer to reply to another customers comment
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'C') {
    	header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = "Comment Reply";
    
    include '../view/cust_header.php'; 

?>

<div id="content_container" class="fit8">
    <div id="sub_nav">
        <ul>
            <li><a href="http://localhost/web289/gregsgrub/index.php?action=comments">All Comments</a></li>         
            <li><a href="http://localhost/web289/gregsgrub/cust/index.php?action=prev_comments">Previous Comments</a></li>
            <li><a href="http://localhost/web289/gregsgrub/cust/index.php?action=new_comment">New Comment</a></li>          
        </ul>
    </div>
	
	<h1 class="headings1">Comment Reply</h1>
    <div id="add_coupon" class="new_comment">
        <h2 class="new_comment">Enter Comment: </h2>
        <form action='index.php' method="POST">                
            <textarea name="commentText" rows="3" cols="20" required maxlength="300"></textarea>                
            <input type="hidden" name="action" value="add_comment_reply">
            <input type="hidden" name="commentID" value="<?php echo $commentID; ?>">
            <input type="submit" value="Add Comment" class="submit_button center">
        </form>
    </div>        
</div>

<?php include '../view/footer.php';?>