<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: comments.php
**** Description: Shows all non banned comments on the site
-->

<?php 

	$title = "Comments";
	include 'view/header.php'; 

	$comments = get_all_comments();


	$comments2 = get_all_comments();
	$count = $comments2->rowCount();

	$total = 0;
	foreach($comments2 as $comment2) {
		$total += $comment2['commentRating'];
	}



	if ($count > 0)
		$avg_rating = $total / $count;
	else
		$avg_rating = 0;

?>

<div id="content_container" class="fit8">

    <div id="sub_nav">
    	<ul>
			<li><a class="pageMarker" href="http://localhost/web289/gregsgrub/index.php?action=comments">All Comments</a></li>			
			<li><a href="http://localhost/web289/gregsgrub/cust/index.php?action=prev_comments">Previous Comments</a></li>
			<li><a href="http://localhost/web289/gregsgrub/cust/index.php?action=new_comment">New Comment</a></li>			
		</ul>
	</div>

    <script type='text/javascript'>
        $('#mcomm').addClass('textColor1');
    </script>

	<h1 class="headings1">All Comments</h1>
	<h3 class="center">Average Rating: <?php echo money($avg_rating); ?> / 5</h3>

<?php foreach($comments as $comment) : ?>
	
	<div id="comment">
	
		<?php $Rating = $comment['commentRating']; ?>
	
		<div class="star-rating" style="width: <?php echo htmlspecialchars(80 * ($Rating / 5)) ?>px">
		    Rating: <?php echo htmlspecialchars($Rating) ?>
		</div>
	
		<?php $user = get_name_info($comment['userIDcomm']); ?>
	
		<h2><?php echo $user['fName']; ?> <?php echo $user['lName']; ?></h2>
		<p><?php 
			$date = strtotime($comment['commentDate']);
	        $date = date('M-d-Y g:i A', $date);
	        echo $date; ?></p>
		<p><span>Comment: </span><?php echo $comment['commentText']; ?></p>
		<a href="http://localhost/web289/gregsgrub/cust/index.php?action=comment_reply&amp;commentID=<?php echo $comment['commentID']; ?>" class="buttons center">Reply</a>	
	
		<?php 
			$comments2 = get_other_comments($comment['commentID']);

			foreach($comments2 as $comment) : ?>
			
			<?php $user2 = get_name_info($comment['userIDcomm']); ?>
			
			<h3><?php echo $user2['fName']; ?> <?php echo $user2['lName']; ?></h3>
			<p><?php 
			$date = strtotime($comment['commentDate']);
	        $date = date('M-d-Y g:i A', $date);
	        echo $date; ?></p>
			<p><span>Comment: </span><?php echo $comment['commentText']; ?></p>
		
		<?php endforeach; ?>

	</div>

	<?php endforeach; ?>

	<a href="http://localhost/web289/gregsgrub/cust/index.php?action=new_comment" class="buttons new_comment">New Comment</a>
</div>

<?php include 'view/footer.php'; ?>