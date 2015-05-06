<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/edit_admin_form.php
**** Description: Form that allows manager to edit the information of any manager
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }
    
    $title = 'Edit Admin';

    include '../view/admin_header.php'; 

?>

<div id="content_container">
    
    <script type='text/javascript'>
        $('#muser').addClass('textColor1');
    </script>
	<h1 class="headings1">Edit Manager</h1>
    <div id="edit_profile">
        <h2><?php echo $admin['fName']; ?> <?php echo $admin['lName']; ?></h2>
        <img id="edit_profile_image" src="../<?php echo $admin['thumbnailURL']; ?>" alt="Profile Image">
        
        <div class="profile_content"> 
            <form action="." method="post">
                <label><span>First: </span><input type="text" name="fName" value="<?php echo $admin['fName']; ?>" required></label>
                <label><span>Last: </span><input type="text" name="lName" value="<?php echo $admin['lName']; ?>" required></label>
                <label><span>Email: </span><input type="email" name="userEmail" value="<?php echo $admin['userEmail']; ?>" required></label>
                <label><span>User Name:</span><input type="text" name="userName" value="<?php echo $admin['userName']; ?>" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least 6 characters, including UPPER/lowercase and numbers"></label>
                <label><span>Phone: </span><input type="text" name="phone" value="<?php echo $admin['phone']; ?>" required></label>
                <textarea name="profile" rows="4" cols="30"><?php echo $admin['profile']; ?></textarea>
             
                <input type="hidden" name="userID" value="<?php echo $admin['userID']; ?>" />
                <input type="hidden" name="adminID" value="<?php echo $admin['adminID']; ?>" />
                <input type="hidden" name="action" value="edit_admin" />
                <input type="hidden" name="event" value="admin" />
                <input type="submit" value="Save Changes" class="submit_button edit_admin2">
            </form>
        </div>
    </div>
</div>

<?php include '../view/admin_footer.php'; ?>