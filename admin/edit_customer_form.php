<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/edit_customer_form.php
**** Description: Form that allows manager to edit the information of any customer
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = 'Edit Customer';

    include '../view/admin_header.php'; 

?>

<div id="content_container">
	<h1 class="headings1">Edit Customer</h1>

    <script type='text/javascript'>
        $('#muser').addClass('textColor1');
    </script>

    <div id="edit_profile">
        <h2><?php echo $user['fName']; ?> <?php echo $user['lName']; ?></h2>
        <img id="edit_profile_image" src="../<?php echo $user['thumbnailURL']; ?>" alt="Profile Image">
    
        <div class="profile_content">     
            <form action="." method="post">
                <label><span>First: </span><input type="text" name="fName" value="<?php echo $user['fName']; ?>" required></label>
                <label><span>Last: </span><input type="text" name="lName" value="<?php echo $user['lName']; ?>" required></label>
                <label><span>Email: </span><input type="email" name="userEmail" value="<?php echo $user['userEmail']; ?>" required></label>
                <label><span>User Name:</span><input type="text" name="userName" value="<?php echo $user['userName']; ?>" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least 6 characters, including UPPER/lowercase and numbers"></label>
                <label><span>Phone: </span><input type="text" name="phone" value="<?php echo $user['phone']; ?>" required></label>
                <label><span>Address 1: </span><input type="text" name="address1" value="<?php echo $user['address1']; ?>" required></label>
                <label><span>Address 2: </span><input type="text" name="address2" value="<?php echo $user['address2']; ?>" required></label>
                <label><span>City: </span><input type="text" name="city" value="<?php echo $user['city']; ?>" required></label>
                <label><span>State: </span><select name="stateCode" required>
                    <?php foreach ($states as $state) : ?>
                        <?php 
                        $option = "";
                        $option .= "<option value='$state[stateCode];'";
                        if  ($user['stateCode']==$state['stateCode']) {$option.= "selected='selected'";}
                        $option .= ">" . $state['stateName'] . "</option>"; ?>
                        <?php echo $option; ?>
                    <?php endforeach; ?>
                </select></label>    
                <label><span>Zip Code: </span><input type="text" name="postalCode" value="<?php echo $user['postalCode']; ?>" required></label>
                <input type="hidden" name="customerID" value="<?php echo $user['customerID']; ?>" />
                <input type="hidden" name="userID" value="<?php echo $user['userID']; ?>" />
                <input type="hidden" name="action" value="edit_customer" />
                <input type="hidden" name="event" value="cust" />
                <input type="submit" value="Save Changes" class="submit_button edit_admin">                
            </form>
        </div>            
    </div>
</div>

<?php include '../view/admin_footer.php'; ?>
