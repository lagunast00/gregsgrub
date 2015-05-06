<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/edit_employee_form.php
**** Description: Form that allows manager to edit the information of any employee
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = 'Edit Employee';
    
    include '../view/admin_header.php'; 

?>
<div id="content_container">
   	<h1 class="headings1">Edit Employee</h1>
    
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
                <label><span>Job Status: </span><select name="jobStatus">
                    <option value="Employed" <?php if  ($user['jobStatus']=='Employed'){?>selected='selected'<?php } ?>>Employed</option>
                    <option value="Suspended" <?php if  ($user['jobStatus']=='Suspended'){?>selected='selected'<?php } ?>>Suspended</option>
                    <option value="Terminated" <?php if  ($user['jobStatus']=='Terminated'){?>selected='selected'<?php } ?>>Terminated</option>
                </select></label>
                <textarea name="profile" rows="4" cols="30" required maxlength="250"><?php echo $user['profile']; ?></textarea>
                <input type="hidden" name="nameID" value="<?php echo $user['nameID']; ?>" />
                    <input type="hidden" name="userID" value="<?php echo $user['userID']; ?>" />
                    <input type="hidden" name="action" value="edit_employee" />
                    <input type="submit" value="Save Changes" class="submit_button edit_admin2">
            </form>
        </div>            
    </div>
</div>
<?php include '../view/admin_footer.php'; ?>