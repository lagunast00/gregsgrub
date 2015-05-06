<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/edit_profile.php
**** Description: Form that allows customer to edit his/her profile information
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'C'){
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = 'My Profile';
    $user = get_all_customer_info($_SESSION['userID']);
    $states = get_states();
    
    include '../view/cust_header.php'; 

?>

<div id="content_container">
    <h1 class="headings1">Edit Profile</h1>

    <div id="edit_profile">
    	<h2><?php echo $user['fName']; ?> <?php echo $user['lName']; ?>'s Profile</h2>
    	<img id="edit_profile_image" src="../<?php echo $user['thumbnailURL']; ?>" alt="Profile Image">

   	    <div class="profile_content">
            
            <form action="index.php" method="post">            
	            <label><span>First Name: </span><input type="text" name="fName" value="<?php echo $user['fName']; ?>" required></label>
                <label><span>Last Name: </span><input type="text" name="lName" value="<?php echo $user['lName']; ?>" required></label>   
                <label><span>Email: </span><input type="email" name="userEmail" value="<?php echo $user['userEmail']; ?>" required></label>
                <label><span>User Name: </span><input type="text" name="userName" value="<?php echo $user['userName']; ?>" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least 6 characters, including UPPER/lowercase and numbers"></label>
                <label><span>Phone: </span><input type="text" name="phone" value="<?php echo $user['phone']; ?>" required></label>
                <label><span>Address 1: </span><input type="text" name="address1" value="<?php echo $user['address1']; ?>" required></label>
                <label><span>Address 2: </span><input type="text" name="address2" value="<?php echo $user['address2']; ?>"></label>
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
                <input type="hidden" name="action" value="update_customer" />
                <input type="submit" value="Save Changes" class="submit_button"/>
                <a class="buttons" href="http://localhost/web289/gregsgrub/cust/index.php?action=edit_image">Change Image</a>
            </form>    	
        </div>
    </div>
</div>

<?php include '../view/footer.php'; ?>