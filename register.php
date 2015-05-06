<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: register.php
**** Description: Form to register new customers into the system
-->

<?php

    $title = 'Register New User';
    $states = get_states();
    include 'view/header.php';

?>

<div id="content_container">
    <h3 class="headings1">Register New User</h3>

    <div id="container_register">
        <form method="POST" action="index.php" class="content">            
            <table>
                <tr>
                    <td class="right"><label>User Email: <input type="email" name="userEmail" value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>" required></label></td>
                    <td></td>
                    <td class="right"><label>Phone: <input type="text" name="phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>" required pattern="^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]‌​)\s*)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-‌​9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})$"></label></td>
                </tr>
                <tr>
                    <td class="right"><label>User Name: <input type="text" name="userName" value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least 6 characters, including UPPER/lowercase and numbers"></label></td>
                    <td></td>
                    <td class="right"><label>Address1: <input type="text" name="address1" value="<?php if(isset($_POST['address1'])) echo $_POST['address1']; ?>" required></label></td>
                </tr>
                <tr>
                    <td class="right"><label><span>Password: </span><input title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="userPassword" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); if(this.checkValidity()) form.pwd2.pattern = this.value;"value="<?php if (isset($_POST['password'])) { echo $_POST['password']; } ?>"></label></td>
                    <td></td>
                    <td class="right"><label>Address2: <input type="text" name="address2" value="<?php if(isset($_POST['address2'])) echo $_POST['address2']; ?>"></label></td>
                </tr>
                <tr>
                    <td class="right"><label><span>Password Again: </span><input title="Please enter the same Password as above" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd2" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" value="<?php if (isset($_POST['password2'])) { echo $_POST['password2']; } ?>"></label></td>
                    <td></td>
                    <td class="right"><label>City: <input type="text" name="city" value="<?php if(isset($_POST['city'])) echo $_POST['city']; ?>" required></label></td>
                </tr>
                <tr>
                    <td class="right"><label>First Name: <input type="text" name="fName" value="<?php if(isset($_POST['fName'])) echo $_POST['fName']; ?>" required></label></td>
                    <td></td>
                    <td class="right"><label>State: <select name="stateCode" required>
                                <option value=""> -Choose State- </option>
                            <?php foreach($states as $state) : ?>
                                <option value="<?php echo $state['stateCode']; ?>" <?php if(isset($_POST['stateCode'])){ if ($_POST['stateCode'] == $state['stateCode']) echo 'selected="selected"'; }?> ><?php echo $state['stateName']; ?></option>
                            <?php endforeach; ?>
                        </select></label>
                    </td>
                </tr>
                <tr>
                    <td class="right"><label>Last Name: <input type="text" name="lName" value="<?php if(isset($_POST['lName'])) echo $_POST['lName']; ?>" required></label></td>
                    <td></td>
                    <td class="right"><label>Zip Code: <input type="text" name="postalCode" value="<?php if(isset($_POST['postalCode'])) echo $_POST['postalCode']; ?>" required></label>
                    </td>                    
                </tr>
                <tr>
                    <td colspan="3"><div class="g-recaptcha" data-sitekey="6LcAMAUTAAAAAKaUJFBoBFw9E2EgjdjETLNgYR4r" data-theme="light" data-type="image"></div><?php if (isset($msg)){ echo $msg; } ?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="hidden" name="userLevel" value="C">
                        <input type="hidden" name="action" value="register_users">
                        <input type="submit" value="Register" class="submit_button">
                    </td>
                </tr>
            </table>            
        </form>
    </div>
</div>

<?php include 'view/footer.php'; ?>     