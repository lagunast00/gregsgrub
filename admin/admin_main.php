<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/admin_main.php
**** Description: File allows manager to get reporting of sales, coupons, and employees on a selected date range
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    if (!isset($msg))
        $msg = '';
    
    if (isset($_GET['msg']))
        $msg = $_GET['msg'];
    else if (isset($_POST['msg']))
        $msg = $_POST['msg'];
    else if (isset($event)){

    }
    else if (!isset($msg))
        $msg = '';

    $title = 'Manager Reporting';

    if (isset($_GET['event']))
        $event = $_GET['event'];
    else if (isset($_POST['event']))
        $event = $_POST['event'];
    else if (isset($event)){
    }
    else
        $event = 'all';

    include '../view/admin_header.php'; 

?>

<div id="content_container" class="fit8">
	<div id="sub_nav">
        <ul>
            <li><a id="sales" href="http://localhost/web289/gregsgrub/admin/index.php?action=admin_main&amp;event=sales">Sales Reports</a></li>
            <li><a id="coupons" href="http://localhost/web289/gregsgrub/admin/index.php?action=admin_main&amp;event=coupons">Coupon Reports</a></li>
            <li><a id="employees" href="http://localhost/web289/gregsgrub/admin/index.php?action=admin_main&amp;event=employees">Employee Reports</a></li>
        </ul>
    </div>

    <script type='text/javascript'>
        $('#mreport').addClass('textColor1');
    </script>
	
<?php  if ($event == 'all') { ?>
	<h1 class="headings1">Manager Reporting</h1>
    <h2 class="center"><?php echo $msg; ?></h2>
    <div id="users_all">
        <h2>Attention!</h2>
        <p>You have reached the business Reporting page. From here you, as a manager, have access to sales reports, coupon reports, and employee reports. To obtain any report, please make sure you enter a valid beginning and end date. Otherwise, the current date will be used for data results.</p>
    </div>

<?php } else if ($event == 'sales'){ ?>
	<h1 class="headings1">Sales Report</h1>
	<form id="sales_report" action="." method="post">
		<input type="text" class="datepicker" id="sales_start" name="start" placeholder="Start Date" required>
		<input type="text" class="datepicker" id="sales_finish" placeholder="Finish Date" name="finish" required>
		<input type="hidden" name="action" value="admin_main">
		<input type="hidden" name="event" value="sales">
		<input type="submit" value="Get Report" class="submit_button">
    </form>

    <script type='text/javascript'>
        $('#sales').addClass('pageMarker');
    </script>

<?php
	if (isset($_POST['start'])){
		$start = strtotime($_POST['start']);
		$start = date('Y-m-d', $start);
		$finish = strtotime($_POST['finish']);
		$finish = date('Y-m-d', $finish);
	} else {
		$start = date('Y-m-d');
		$finish = date('Y-m-d', strtotime('1 day'));
	}
	$credit_sales = report_credit_sales($start, $finish);
	$cash_sales = report_cash_sales($start, $finish);

	$ccCount = $credit_sales->rowCount();
	$chCount = $cash_sales->rowCount();

	$total_cash = 0;
	$total_credit = 0;

	if ($ccCount > 0) {
    	foreach($credit_sales as $cc_sales){
    		$total_credit += $cc_sales['orderSubTotal'];
    	}
    } 
    if ($chCount > 0) {
    	foreach($cash_sales as $ch_sales){
    		$total_cash += $ch_sales['orderSubTotal'];
    	}
    }

    $total_sales = $total_cash + $total_credit;
    
    $deliveries = report_deliveries($start, $finish);
    $carryouts = report_carryouts($start, $finish);

    $dyCount = $deliveries->rowCount();
    $cyCount = $carryouts->rowCount();
    $total_orders = $dyCount + $cyCount;
    
    if ($total_orders > 0) {
	    $average_total = $total_sales / $total_orders;

	    $total_del = 0;
		$total_carry = 0;

		if ($dyCount > 0) {
	    	foreach($deliveries as $del){
	    		$total_del += $del['orderSubTotal'];
	    	}
	    } 
	    if ($cyCount > 0) {
	    	foreach($carryouts as $carry){
	    		$total_carry += $carry['orderSubTotal'];
	    	}
	    }
	    if ($dyCount > 0) {
			$average_delivery = $total_del / $dyCount;
		} else {
			$average_delivery = 0;
		}
		if ($cyCount > 0) {
			$average_carry = $total_carry / $cyCount;
		} else {
			$average_carry = 0;
		}

?>
    	<p class="center"><span class="bold"><?php echo $start; ?></span> to <span class="bold"><?php echo $finish; ?></span></p>
    	
    	<div id="sales">	    	
    		<h2 class="center">Sales Info</h2>
	    	<p><span>Total: </span><?php echo $total_orders; ?> orders</p>
	    	<p><span>Total Sales: </span>$<?php echo money($total_sales); ?></p>
	    	<p><span>Avg Order Subtotal: </span>$<?php echo money($average_total); ?></p>
	    	<p><span>Credit Sales: </span>$<?php echo money($total_credit); ?></p>
	    	<p><span>Cash Sales: </span>$<?php echo money($total_cash); ?></p>
	    	
	    	<h2 class="center">Delivery</h2>
	    	<p><span>Orders: </span><?php echo $dyCount; ?></p>
	    	<p><span>Sales: </span>$<?php echo money($total_del); ?></p>
			<p><span>Avg Subtotal: </span>$<?php echo money($average_delivery); ?></p>

			<h2 class="center">Carry Out</h2>
	    	<p><span>Orders: </span><?php echo $cyCount; ?></p>
	    	<p><span>Sales: </span>$<?php echo money($total_carry); ?></p>    	
	    	<p><span>Avg Subtotal: </span>$<?php echo money($average_carry); ?></p>	    	
		</div>

		<div id="chart_div"></div>

		<script>
			google.load('visualization', '1.0', {'packages':['corechart']});

			google.setOnLoadCallback(drawChart);  

			function drawChart() {
			    // Create the data table.
			    var data = new google.visualization.DataTable();
			    var carry = <?php echo money($total_del); ?>;
			    var del = <?php echo money($total_carry); ?>;

			    data.addColumn('string', '');
			    data.addColumn('number', '');
			    data.addRows([
			      ['Delivery \n$' + del, del],
			      ['Carry Out \n$' + carry, carry]
			    ]);

			    // Set chart options
			    var options = {'title':'Carry Out vs. Delivery Sales',
			    				is3D: true,
			    				'colors':['#1394F0', '#FF523D'],
			    				fontSize:12,
			    				fontName:'inglobal',
			                   'width':400,
			                   'height':300};

			    // Instantiate and draw our chart, passing in some options.
			    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
			    chart.draw(data, options);
			}
		</script>
	<?php } else { ?>
		<h2 class="center">No Data in Date Range</h2>
	<?php } ?>
<?php } else if ($event == 'coupons') { ?>
	<h1 class="headings1">Coupon Report</h1>
	<form id="coupon_report" action="." method="post">
		<input type="text" class="datepicker" id="coupon_start" name="start" placeholder="Start Date" required>
		<input type="text" class="datepicker" id="coupon_finish" placeholder="Finish Date" name="finish" required>
		<input type="hidden" name="action" value="admin_main">
		<input type="hidden" name="event" value="coupons">
		<input type="submit" value="Get Report" class="submit_button">
    </form>
	
    <script type='text/javascript'>
        $('#coupons').addClass('pageMarker');
    </script>

<?php
	if (isset($_POST['start'])){
		$start = strtotime($_POST['start']);
		$start = date('Y-m-d', $start);
		$finish = strtotime($_POST['finish']);
		$finish = date('Y-m-d', $finish);
	} else {
		$start = date('Y-m-d');
		$finish = date('Y-m-d', strtotime('1 day'));
	}
	$totalfb = 0;
	$totaltw = 0;
	$totalgp = 0;

	$cpFb = reports_coupons(1, $start, $finish);
	$cpFbCount = $cpFb->rowCount();

	if ($cpFbCount > 0) {
    	foreach($cpFb as $sales){
    		$totalfb += $sales['orderSubTotal'];
    	}
    } 
	
	$cpTw = reports_coupons(2, $start, $finish);
	$cpTwCount = $cpTw->rowCount();

	if ($cpTwCount > 0) {
    	foreach($cpTw as $sales){
    		$totaltw += $sales['orderSubTotal'];
    	}
    }
	
	$cpGp = reports_coupons(3, $start, $finish);
	$cpGpCount = $cpGp->rowCount();

	if ($cpGpCount > 0) {
    	foreach($cpGp as $sales){
    		$totalgp += $sales['orderSubTotal'];
    	}
    }

    $total_sales = $totalfb + $totaltw + $totalgp;
	$total_orders = $cpFbCount + $cpTwCount + $cpGpCount;

	if ($total_orders > 0) {
	    $average_total = $total_sales / $total_orders;

	    if ($cpFbCount > 0) {
			$average_fb = $totalfb / $cpFbCount;
		} else {
			$average_fb = 0;
		}
		
		if ($cpTwCount > 0) {
			$average_tw = $totaltw / $cpTwCount;
		} else {
			$average_tw = 0;
		}
		
		if ($cpGpCount > 0) {
			$average_gp = $totalgp / $cpGpCount;
		} else {
			$average_gp = 0;
		}

?>
	    <p class="center"><span class="bold"><?php echo $start; ?></span> to <span class="bold"><?php echo $finish; ?></span></p>
		
		<div id="sales">
			<h2 class="center">Total Coupons</h2>
			<p><span>Orders: </span><?php echo $total_orders; ?></p>
			<p><span>Sales: </span>$<?php echo money($total_sales); ?></p>
			<p><span>Avg Subtotal: </span>$<?php echo money($average_total); ?></p>

			<h2 class="center">Facebook</h2>
			<p><span>Orders: </span><?php echo $cpFbCount; ?></p>
			<p><span>Sales: </span>$<?php echo money($totalfb); ?></p>
			<p><span>Avg Subtotal: </span>$<?php echo money($average_fb); ?></p>

			<h2 class="center">Twitter</h2>
			<p><span>Orders: </span><?php echo $cpTwCount; ?></p>
			<p><span>Sales: </span>$<?php echo money($totaltw); ?></p>
			<p><span>Avg Subtotal: </span>$<?php echo money($average_tw); ?></p>

			<h2 class="center">Google+</h2>
			<p><span>Orders: </span><?php echo $cpGpCount; ?></p>
			<p><span>Sales: </span>$<?php echo money($totalgp); ?></p>
			<p><span>Avg Subtotal: </span>$<?php echo money($average_gp); ?></p>
		</div>

		<div id="chart_div"></div>

		<script>
			google.load('visualization', '1.0', {'packages':['corechart']});

			google.setOnLoadCallback(drawChart);  

			function drawChart() {
			    // Create the data table.
			    var data = new google.visualization.DataTable();
			    var fb = <?php echo $cpFbCount; ?>;
			    var tw = <?php echo $cpTwCount; ?>;
			    var gp = <?php echo $cpGpCount; ?>;
			    
			    data.addColumn('string', '');
			    data.addColumn('number', '');
			    data.addRows([
			      ['Facebook \n' + fb + ' coupons', fb],
			      ['Twitter \n' + tw + ' coupons', tw],
			      ['Google+ \n' + gp + ' coupons', gp]
			    ]);

			    // Set chart options
			    var options = {'title':'Total Coupons',
			    				is3D: true,
			    				fontSize:12,
			    				fontName:'inglobal',
			                   'width':400,
			                   'height':300};

			    // Instantiate and draw our chart, passing in some options.
			    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
			    chart.draw(data, options);
			}
		</script>

	<?php } else { ?>
	
		<h2 class="center">No Data in Date Range</h2>
		
	<?php } ?>
<?php } else if ($event == 'employees') { ?>
	<h1 class="headings1">Employee Report&nbsp;</h1>
	<form id="coupon_report" action="." method="post">
		<input type="text" class="datepicker" id="coupon_start" name="start" placeholder="Start Date" required>
		<input type="text" class="datepicker" id="coupon_finish" placeholder="Finish Date" name="finish" required>
		<input type="hidden" name="action" value="admin_main">
		<input type="hidden" name="event" value="employees">
		<input type="submit" value="Get Report" class="submit_button">
    </form>


    <script type='text/javascript'>
        $('#employees').addClass('pageMarker');
    </script>

<?php
	if (isset($_POST['start'])){
		$start = strtotime($_POST['start']);
		$start = date('Y-m-d', $start);
		$finish = strtotime($_POST['finish']);
		$finish = date('Y-m-d', $finish);
	} else {
		$start = date('Y-m-d');
		$finish = date('Y-m-d', strtotime('1 day'));
	}
?>
    <p class="center"><span class="bold"><?php echo $start; ?></span> to <span class="bold"><?php echo $finish; ?></span></p>
	<div id="sales2">

<?php
	$emp = get_active_employees();
	foreach ($emp as $e){ ?>
    	<div class="emp_report">
			<h2><?php echo $e['fName']; ?> <?php echo $e['lName']; ?></h2>
			<?php 
				$orders = reports_emp($e['employeeID'], $start, $finish);
				$orders_cash = reports_emp_cash($e['employeeID'], $start, $finish);
				$orders_count = $orders->rowCount();
				$total_cash = 0;

				foreach ($orders_cash as $order){
					$total_cash += $order['orderTotal'];
				}
			?>
			<p><span>Deliveries Made: </span><?php echo $orders_count; ?></p>
			<p><span>Cash Taken In: </span>$<?php echo money($total_cash); ?></p>
		</div>
   	<?php } ?>
	
	</div>
<?php } ?>

</div>

<?php include '../view/admin_footer.php'; ?>



