<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: view/footer.php
**** Description: Footer
-->

<?php 

$categories2 = get_grub_menu();

?>
	<div id="footer_bar">
		<p class="copy">Matthew Battyanyi &copy;2015</p>
		<ul class="inline width-5">		
			<li class="bold-map"><a href="http://localhost/web289/gregsgrub/index.php?action=promotions">PROMOTIONS</a></li>
			<li class="bold-map"><a href="http://localhost/web289/gregsgrub/cust/index.php?action=view_cart">VIEW CART</a></li>
		</ul>
		<ul class="inline width-5">
			<li class="bold-map"><a href="http://localhost/web289/gregsgrub/index.php?action=menu_main">GRUB</a></li>
			<div class="center-2">
		<?php foreach ($categories2 as $category) : ?>
			<li class="inline width-2"><a href="http://localhost/web289/gregsgrub/index.php?action=menu_main&amp;categoryID=<?php echo $category['categoryID']; ?>"><?php echo $category['categoryName']; ?></a></li>
		<?php endforeach; ?>
		</div>
		</ul>
		<ul class="inline width-5">
			<li class="bold-map"><a href="http://localhost/web289/gregsgrub/index.php?action=merch">GRUB MERCH</a></li>
			<li><a href="http://localhost/web289/gregsgrub/index.php?action=merch&amp;categoryID=13">Accessories</a></li>
			<li><a href="http://localhost/web289/gregsgrub/index.php?action=merch&amp;categoryID=11">Clothing</a></li>
			<li><a href="http://localhost/web289/gregsgrub/index.php?action=merch&amp;categoryID=12">Gift Cards</a></li>
		</ul>
		<ul class="inline width-5">
			<li class="bold-map"><a href="http://localhost/web289/gregsgrub/index.php?action=about">ABOUT US</a></li>
			<li><a href="http://localhost/web289/gregsgrub/index.php?action=mission">Our Mission</a></li>
			<li><a href="http://localhost/web289/gregsgrub/index.php?action=directions_page">Directions</a></li>
			<li><a href="http://localhost/web289/gregsgrub/index.php?action=faq_page">FAQ</a></li>
		</ul>
		<ul class="inline width-5">
			<li class="bold-map"><a href="http://localhost/web289/gregsgrub/index.php?action=comments">COMMENTS</a></li>
			<li><a href="http://localhost/web289/gregsgrub/cust/index.php?action=prev_comments">Previous Comments</a></li>
			<li><a href="http://localhost/web289/gregsgrub/cust/index.php?action=new_comments">New Comment</a></li>
		</ul>
	</div>	
</div>
</body>
</html>