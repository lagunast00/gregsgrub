<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/change_address.php
**** Description: Form that allows user to change delivery address
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'C') {
    	header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = "Change Delivery Address";

    $customer = get_all_customer_info($_SESSION['userID']);
    $states = get_states();
    
    include '../view/cust_header.php'; 

?>

<div id="content_container">	
	<h1 class="headings1">Change Delivery Address</h1>
    <div id="change_address">
        
        <form action='index.php' method="POST">
            <label><input type="checkbox" name="useHome" value="1" onclick="this.form.submit();">&nbsp;Use Home Address</label>
            <label>Address1<input type="text" name="daddress1" value="<?php echo $customer['daddress1']; ?>" required></label>
            <label>Address2<input type="text" name="daddress2" value="<?php echo $customer['daddress2']; ?>"></label>
            <label>City<input type="text" name="dcity" value="<?php echo $customer['dcity']; ?>" required></label>
            <label>State<select name="dstateCode" required>
                        <?php foreach ($states as $state) : ?>
                            <?php 
                            $option = "";
                            $option .= "<option value='$state[stateCode];'";
                            if  ($customer['stateCode']==$state['stateCode']) {$option.= "selected='selected'";}
                            $option .= ">" . $state['stateName'] . "</option>"; ?>
                            <?php echo $option; ?>
                        <?php endforeach; ?></select></label>
            <label>Zip Code<input type="text" name="dpostalCode" value="<?php echo $customer['dpostalCode']; ?>" required></label>

            <input type="hidden" name="action" value="update_delivery">
            <input type="submit" value="Update" class="submit_button center">
        </form>
    </div>        
</div>

<?php include '../view/footer.php';?>