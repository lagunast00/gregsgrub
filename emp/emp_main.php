<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: emp/emp_main.php
**** Description: Employee main landing page
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'E' || $_SESSION['jobStatus'] != 'Employed'){
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
        exit();
    }

    if (!isset($msg))
    	$msg = '';

    $title = 'Employee Main';

    $start = date('Y-m-d');
	$finish = date('Y-m-d', strtotime('1 day'));

	$emp = get_employee($_SESSION['userID']);
	
	foreach ($emp as $e){
		$orders = reports_emp($e['employeeID'], $start, $finish);
		$orders_cash = reports_emp_cash($e['employeeID'], $start, $finish);
		$orders_count = $orders->rowCount();
		$total_cash = 0;
		foreach ($orders_cash as $order){
			$total_cash += $order['orderTotal'];
		}
	}
	
	include '../view/emp_header.php'; 

?>

<div id="content_container">
	<h1 class="headings1">Employee Main</h1>
	<script type='text/javascript'>
        $('#mmain').addClass('textColor1');
    </script>
	<h4><?php echo $msg; ?></h4>

	<div id="sales2">
		<h1 class="center"><span>Deliveries Made Today: </span><?php echo $orders_count; ?></h1>
		<h1 class="center"><span>Cash Taken In Today: </span>$<?php echo money($total_cash); ?></h1>
	</div>
</div>

<?php include '../view/emp_footer.php'; ?>