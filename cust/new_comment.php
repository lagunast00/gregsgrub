<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/new_comment.php
**** Description: Form that allows customer to add a new comment
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'C') {
    	header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = "New Comment";
    
    include '../view/cust_header.php'; 

?>

<div id="content_container" class="fit8">

    <div id="sub_nav">
        <ul>
            <li><a href="http://localhost/web289/gregsgrub/index.php?action=comments">All Comments</a></li>         
            <li><a href="http://localhost/web289/gregsgrub/cust/index.php?action=prev_comments">Previous Comments</a></li>
            <li><a class="pageMarker" href="http://localhost/web289/gregsgrub/cust/index.php?action=new_comment">New Comment</a></li>          
        </ul>
    </div>


    <script type='text/javascript'>
        $('#mcomm').addClass('textColor1');
    </script>
	
	<h1 class="headings1">New Comment</h1>

    <div id="add_coupon" class="new_comment">
        <h2 class="new_comment">Enter Comment: </h2>
        <form action='index.php' method="POST">                
            <textarea name="commentText" rows="3" cols="20" required maxlength="300"></textarea>
            <label><span>Rating: </span><input type="number" name="commentRating" min="1" max="5" required></label>              
            <input type="hidden" name="action" value="add_new_comment">
            <input type="submit" value="Add Comment" class="submit_button center">
        </form>
    </div>        
</div>

<?php include '../view/footer.php';?>