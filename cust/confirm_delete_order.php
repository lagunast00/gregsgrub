<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/confirm_delete_order.php
**** Description: Form that allows customer to confirm deletion of an unprocessed order before action
-->

<?php

   if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'C'){
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = "Comfirm Delete";
	
	include '../view/cust_header.php'; 

?>
<div id="content_container">
	<h1 class="headings1 center">Confirm Delete Order</h1>
	<h2 class="center">Are you sure you want to delete this order?</h2>
	<div id="order_page3">
		<h2>Order #<?php echo $orderID; ?></h2>
		<?php
			$order = get_current_order($orderID);
		?>
		
		<table>
			<tr>
				<th>Order Start Date:</th>
				<td><?php 
		                $orderStartDate = strtotime($order['orderStartDate']);
		                $orderStartDate = date('M j, Y - g:i A', $orderStartDate);
		                echo $orderStartDate;
		            ?></td>
         	</tr>
			
			<tr>
				<th>Number of Items: </th>
				<td><?php
		                $num_items = 0;
		                $items = get_order_details($orderID);
		                if ($items->rowCount() > 0){
		                    foreach ($items as $item){
		                        $num_items += $item['productQty'];
		                    }
		                }
		                echo $num_items;
		            ?></td>
		    </tr>

		    <tr>
		    	<th>Subtotal: </th>
		    	<td>$<?php echo money($order['orderSubTotal']); ?></td>
		    </tr>

		    <tr>
		    	<th>Tax: </th>
		    	<td>$<?php echo money($order['orderTax']); ?></td>
		    </tr>

		    <tr>
		    	<th>Total: </th>
		    	<td>$<?php echo money($order['orderTotal']); ?></td>
		    </tr>
		</table>

		<div id="button_group1">
			<a href="//localhost/web289/gregsgrub/cust/index.php?action=delete_order&amp;orderID=<?php echo $orderID; ?>" class="buttons">Yes</a>
			<a href="//localhost/web289/gregsgrub/cust/index.php?action=view_cart" class="buttons">No</a>
		</div>
	</div>
</div>
	
<?php include '../view/footer.php'; ?>