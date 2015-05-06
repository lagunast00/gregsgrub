<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/add_customer_form.php
**** Description: Form that allows manager to add customer to system
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }
    
    $title = 'Add Customer';

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

	<h1 class="headings1">Add Customer</h1>
    <div id="add_admin">
        <h2>Enter Customer Details</h2>      
        <form id="add_user_form" method="POST" action="index.php">
        	<input type="hidden" name="action" value="register_user">
        
        	<label><span>User Name: </span><input type="text" name="userName" value="<?php if (isset($_POST['userName'])) { echo $_POST['userName']; } ?>" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least 6 characters, including UPPER/lowercase and numbers"></label>
            
            <label><span>Password: </span><input title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="userPassword" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); if(this.checkValidity()) form.pwd2.pattern = this.value;"value="<?php if (isset($_POST['password'])) { echo $_POST['password']; } ?>"></label>
            
            <label><span>Password Again: </span><input title="Please enter the same Password as above" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd2" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" value="<?php if (isset($_POST['password2'])) { echo $_POST['password2']; } ?>"></label>

            <label><span>First: </span><input type="text" name="fName" value="<?php if (isset($_POST['fName'])) { echo $_POST['fName']; } ?>" required></label>

            <label><span>Last: </span><input type="text" name="lName" value="<?php if (isset($_POST['lName'])) { echo $_POST['lName']; } ?>" required></label>

            <label><span>Email: </span><input type="email" name="userEmail" value="<?php if (isset($_POST['userEmail'])) { echo $_POST['userEmail']; } ?>" required></label>

            <label><span>Phone: </span><input type="text" name="phone" value="<?php if (isset($_POST['phone'])) { echo $_POST['phone']; } ?>" required></label>
    
            <label><span>Address1: </span><input type="text" name="address1" value="<?php if (isset($_POST['address1'])) { echo $_POST['address1']; } ?>" required></label>

            <label><span>Address2: </span><input type="text" name="address2" value="<?php if (isset($_POST['address2'])) { echo $_POST['address2']; } ?>"></label>

            <label><span>City: </span><input type="text" name="city" value="<?php if (isset($_POST['city'])) { echo $_POST['city']; } ?>" required></label>

            <label><span>State: </span>
                <select name="stateCode" required>
                    <?php foreach($states as $state) : ?>
                        <option value="<?php echo $state['stateCode']; ?>" <?php if(isset($_POST['stateCode'])){ if ($_POST['stateCode'] == $state['stateCode']) echo 'selected="selected"'; }?> ><?php echo $state['stateName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
    
            <label><span>Zip Code: </span><input type="text" name="postalCode" value="<?php if (isset($_POST['postalCode'])) { echo $_POST['postalCode']; } ?>" required></label>
    
            <input type="hidden" name="userLevel" value="C">
            <input type="hidden" name="action" value="add_customer">
        	<input type="submit" value="Add Customer" class="submit_button center">
        </form>
    </div>
</div>
    
<?php include '../view/admin_footer.php'; ?>