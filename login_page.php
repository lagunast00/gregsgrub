<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: login_page.php
**** Description: Form that allows user to login to site
-->

<?php 

    $title = "Login Page";

    session_unset();
    session_destroy();

    include 'view/header.php';

?>

<div id="content_container">
    <h3 class="headings1">Login Page</h3>

    <?php if (isset($error)) { ?>
        <h2 class="center">Login Failure - Please Try Again</h2>
    <?php } ?>

    <div id="container_login">        
    	<form method="POST" action="index.php" class="content" id="loginForm">
        	<input type="hidden" name="action" value="login">        	
            <table>
                <tr>
                    <td class="right">
                        <label>User Name:</label>
                    </td>
                    <td class="left"><input type="text" id="userName" name="userName" value="" placeholder="Enter User Name" required>
                    </td>
                </tr>
                <tr>
                    <td class="right"><label>Password: </label></td>
                    <td class="left"><input type="password" id="password" name="userPassword" placeholder="Enter Password" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="productID" value="<?php echo $productID; ?>">
                        <input id="loginSubmit" type="submit" value="Login" class="submit_button">
                    </td>
                </tr>
            </table>                
        </form>
    </div>
    <p class="register">Don't have an account? <a href="http://localhost/web289/gregsgrub/index.php?action=register" class="buttons">Register Now!</a></p>
</div>

<?php include 'view/footer.php'; ?>		