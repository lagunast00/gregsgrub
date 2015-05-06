<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: view/admin_footer.php
**** Description: Admin footer
-->

<?php 

$categories2 = get_categories();

?>
	<div id="footer_bar" class="fit7">
		<div id="admin_footer">
			<p class="copy">Matthew Battyanyi &copy;2015</p>
			<ul class="inline width-5">		
				<li class="bold-map"><a href="http://localhost/web289/gregsgrub/admin/index.php?action=admin_main">Reports</a></li>
				<li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=admin_main&amp;event=sales">Sales Reports</a></li>
	            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=admin_main&amp;event=coupons">Coupon Reports</a></li>
	            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=admin_main&amp;event=employees">Employee Reports</a></li>
			</ul>
			<ul class="inline width-5">
				<li class="bold-map"><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users&amp;event=all">Manage Users</a></li>
				<li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users&amp;event=admin">Managers</a></li>
	            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users&amp;event=emp">Employees</a></li>
	            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users&amp;event=cust">Customers</a></li>
			</ul>
			<ul id="footer1" class="inline width-5">
				<li class="bold-map"><a href="http://localhost/web289/gregsgrub/index.php?action=menu_main">All Products</a></li>

			<?php foreach ($categories2 as $category) : ?>
				<li class="inline width-2"><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_products&amp;event=<?php echo $category['categoryID']; ?>"><?php echo $category['categoryName']; ?></a></li>
			<?php endforeach; ?>

			</ul>
			<ul class="inline width-5">
				<li class="bold-map"><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=all">Manage Info</a></li>
				<li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=comments">Manage Comments</a></li>
	            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=faqs">Manage FAQs</a></li>
	            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=promos">Manage Promos</a></li>
	            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=mission">Manage Mission</a></li>
	            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=coupons">Manage Coupons</a></li>
			</ul>
			<ul class="inline width-5">
				<li class="bold-map"><a href="http://localhost/web289/gregsgrub/admin/index.php?action=all_orders">All Orders</a></li>
				<li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=all_orders&amp;event=date">By Date</a></li>
				<li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=all_orders&amp;event=customer">By Customer</a></li>
				<li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=all_orders&amp;event=number">By Order #</a></li>
			</ul>
		</div>
	</div>	
</div>
</body>
</html>