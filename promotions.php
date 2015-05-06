<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: promotions.php
**** Description: File that displays current promotions as defined by manager
-->

<?php 

	$title = 'Promotions';
	include 'view/header.php'; 

	$promotions = get_current_promo();

?>

<div id="content_container" class="fit5">
    <h3 class="headings1">PROMOTIONS</h3>

    <div id="promotions_container">
		<h2><?php echo $promotions['infoFAQ']; ?></h2>
		<p><?php echo $promotions['infoText']; ?></p>
    </div>

    <script type='text/javascript'>
		$('#mpromo').addClass('textColor1');
	</script>

    <div id="social_media_container">
		<p>Follow us through social media for coupons, promotions, news, and more!</p>

        <div id="social_media">
			<a href="https://www.facebook.com/pages/Gregs-Grub/364436600411024" target="_blank"><img class="facebook" src="images/facebook.jpg" alt="Facebook Logo"></a>
			<a href="https://twitter.com/gregsgrub" target="_blank"><img class="twitter" src="images/Twitter.png" alt="Twitter Logo"></a>
			<a href="https://plus.google.com/u/0/b/110904064100700795623/110904064100700795623/about" target="_blank"><img class="google" src="images/google.jpg" alt="Google Logo"></a>
		</div>
    </div>

    <div id="photoShow">

        <div id="photoShow_container">
        	<ul class="bjqs">
			<?php foreach($promos as $promo) : ?>
				<li><a href="//localhost/web289/gregsgrub/cust/index.php?action=order_page&amp;productID=<?php echo $promo['productID']; ?>"><img class="slider" src="<?php echo $promo['productPhotoURL']; ?>" alt="<?php echo $promo['productDescription']; ?><br><span class='price'>Only $<?php echo $promo['productPrice']; ?></span>" title="<?php echo $promo['productName']; ?>"></a></li>
			<?php endforeach; ?>
			</ul>			
		</div>
    </div>
</div>


<?php include 'view/footer.php'; ?>