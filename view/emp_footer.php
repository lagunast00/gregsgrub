<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: view/emp_footer.php
**** Description: Employee footer
-->

<?php 

$categories2 = get_grub_menu();

?>
	<div id="footer_bar">
		<div id="emp_footer">
			<p class="copy">Matthew Battyanyi &copy;2015</p>
			<ul class="inline width-5">		
				<li class="bold-map emp1"><a href="http://localhost/web289/gregsgrub/emp/">Employee Main</a></li>
			</ul>
			<ul class="inline width-5">
				<li class="bold-map"><a href="http://localhost/web289/gregsgrub/emp/index.php?action=completed_orders">Completed Orders</a></li>
				<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=completed_orders&amp;event=time">By Date</a></li>
				<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=completed_orders&amp;event=name">By Name</a></li>
				<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=completed_orders&amp;event=number">By Order #</a></li>
			</ul>
			<ul class="inline width-5">
				<li class="bold-map"><a href="http://localhost/web289/gregsgrub/emp/index.php?action=orders_page">Current Orders</a></li>
				<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=orders_page&amp;event=new_orders">New Orders</a></li>
				<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=orders_page&amp;event=orders_cooking">Orders Cooking</a></li>
				<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=orders_page&amp;event=double_check">Double Check</a></li>
			</ul>
			<ul class="inline width-5">
				<li class="bold-map"><a href="http://localhost/web289/gregsgrub/emp/index.php?action=carry_out">Carry Out</a></li>
				<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=carry_out&amp;event=time">By Time</a></li>
				<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=carry_out&amp;event=name">By Name</a></li>
				<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=carry_out&amp;event=number">By Order #</a></li>		
			</ul>
			<ul class="inline width-5">
				<li class="bold-map"><a href="http://localhost/web289/gregsgrub/emp/index.php?action=delivery">Delivery</a></li>
				<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=delivery&amp;event=time">By Time</a></li>
				<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=delivery&amp;event=name">By Name</a></li>
				<li><a href="http://localhost/web289/gregsgrub/emp/index.php?action=delivery&amp;event=number">By Order #</a></li>
			</ul>
		</div>
	</div>	
</div>
</body>
</html>