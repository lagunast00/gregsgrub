<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/edit_profile.php
**** Description: Form that allows manager to edit his/her profile information
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }


    $title = 'My Profile';
    $user = get_admin_info($_SESSION['userID']);

    $_SESSION['editAdmin'] = 'Yes';
    
    include '../view/admin_header.php'; 

?>

<div id="content_container">
    <h1 class="headings1">Edit Profile</h1>

    <?php if(isset($msg)) { echo $msg; } ?>
    
    <div id="edit_profile">
	    <h2><?php echo $user['fName']; ?> <?php echo $user['lName']; ?></h2>
	    <img src="../<?php echo $user['thumbnailURL']; ?>" alt="Profile Image" id="edit_profile_image">
    	
        <div class="profile_content margin2">
            
            <form action="index.php" method="post">
        	 	<label><span>First: </span><input type="text" name="fName" value="<?php echo $user['fName']; ?>" required></label>
                <label><span>Last: </span><input type="text" name="lName" value="<?php echo $user['lName']; ?>" required></label>
                <label><span>Email: </span><input type="email" name="userEmail" value="<?php echo $user['userEmail']; ?>" required></label>
                <label><span>User Name:</span><input type="text" name="userName" value="<?php echo $user['userName']; ?>" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least 6 characters, including UPPER/lowercase and numbers"></label>
                <label><span>Phone: </span><input type="text" name="phone" value="<?php echo $user['phone']; ?>" required></label><br>
            	<textarea name="profile" rows="5" cols="60" required maxlength="300"><?php echo $user['profile']; ?></textarea>
        
                <input type="hidden" name="adminID" value="<?php echo $user['adminID']; ?>" />
                <input type="hidden" name="action" value="update_admin" />
                <input type="submit" value="Save Changes" class="submit_button"/>
                <a class="buttons" href="http://localhost/web289/gregsgrub/admin/index.php?action=edit_image">Change Image</a>
            </form>	
        </div>
    </div>
</div>

<?php include '../view/admin_footer.php'; ?>