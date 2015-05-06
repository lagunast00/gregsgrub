<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/change_password_form.php
**** Description: Form that allows manager to override and change any user's password in the system
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = 'Change Password';

    include '../view/admin_header.php'; 

?>

<div id="content_container" class="fit8">
    <div id="sub_nav">
        <ul>
            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users&amp;event=admin">Managers</a></li>
            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users&amp;event=emp">Employees</a></li>
            <li><a href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users&amp;event=cust">Customers</a></li>
        </ul>
    </div>

    <script type='text/javascript'>
        $('#muser').addClass('textColor1');
    </script>

	<h1 class="headings1">Change Password</h2>
	<div id="change_password">
        <h2><?php echo $results['fName']; ?> <?php echo $results['lName']; ?></h2>
        <p><span>User Name: </span><?php echo $results['userName']; ?></p>
        <p><span>Email: </span><?php echo $results['userEmail']; ?></p>
        
		<form action="." method="post">
            <p><span>New Password: </span><input type="password" name="userPassword" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"></p>
            
            <input type="hidden" name="action" value="change_password">
            <input type="hidden" name="userID" value="<?php echo $results['userID']; ?>">
            <input type="submit" value="Update" class="submit_button center">            
        </form>
    </div>    
</div>

<?php include '../view/admin_footer.php'; ?>