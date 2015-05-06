<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/manage_users.php
**** Description: File that allows manager to view all users in the system
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }
    $title = 'Manage Users';
    if (isset($_GET['event']))
        $event = $_GET['event'];
    else if (isset($_POST['event']))
        $event = $_POST['event'];
    else if (isset($event)){
    }
    else
        $event = 'all';

    $admins = show_admins();
    $employees = show_employees();
    $customers = show_customers();

    include '../view/admin_header.php'; 

?>

<div id="content_container" class="fit8">
    <div id="sub_nav">
        <ul>
            <li><a id="admin" href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users&amp;event=admin">Managers</a></li>
            <li><a id="emp" href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users&amp;event=emp">Employees</a></li>
            <li><a id="cust" href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_users&amp;event=cust">Customers</a></li>
        </ul>
    </div>
    <script type='text/javascript'>
        // $('#sub_nav li a').removeClass('pageMarker');
        var page = "<?php echo $event; ?>";
        $('#sub_nav li a').each(function(){
            if ($(this).attr('id') == page){
                $(this).addClass('pageMarker');
            }
        });
        $('#mgrub').addClass('textColor1');
    </script>

	
<?php if ($event == 'all'){ ?>
    <h1 class="headings1">Manage Users</h1>
    
    <?php if (isset($msg)) { echo $msg; } ?>
    
    <div id="users_all">
        <h2>Attention!</h2>
        <p>You have reached the Manage Users page. From here you, as a manager, have access to all users. Any changes made will be permanent. Passwords can be changed without knowledge of current password.</p>
    </div>

<?php } else if ($event == 'admin') { ?>

    <h1 class="headings1">Manage Managers</h1>

    <div id="users_admin">
        <table>
            <tr class="special1">
                <th>&nbsp;</th>
                <th class="name">Name</th>
                <th class="user">User Name</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>

    	    </tr>
        
        <?php foreach ($admins as $admin) : ?>

            <tr>
                <td><img src="../<?php echo $admin['thumbnailURL']; ?>" alt="Profile Image"></td>
                <td><?php echo $admin['lName']; ?>, <?php echo $admin['fName']; ?></td>
                <td><?php echo $admin['userName']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="edit_admin_form" />
                    <input type="hidden" name="userID"
                           value="<?php echo $admin['userID']; ?>" />
                    <input type="submit" value="Edit" class="submit_button"/>
                </form></td>
                <td><form action="." method="post">
    				<input type="hidden" name="action" value="change_password_form" />
                    <input type="hidden" name="userID"
                           value="<?php echo $admin['userID']; ?>" />
                    <input type="submit" value="Change Password" class="submit_button width2" />
                </form></td>
            </tr>
            
            <?php endforeach; ?>

        </table>
        <a href="index.php?action=add_admin_form" class="buttons">Add Manager</a>
        <hr>
    </div>

<?php } else if ($event == 'emp') { ?>

    <h1 class="headings1">Manage Employees</h1>
    <div id="users_emp">
        <table>
            <tr class="special1">
                <th>&nbsp;</th>
                <th class="name">Name</th>
                <th class="user">User Name</th>
                <th>Job Status</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            
        <?php foreach ($employees as $employee) : ?>

            <tr>
                <td><img src="../<?php echo $employee['thumbnailURL']; ?>" alt="Profile Image"></td>
                <td><?php echo $employee['lName']; ?>, <?php echo $employee['fName']; ?></td>
                <td><?php echo $employee['userName']; ?></td>
                <td><?php echo $employee['jobStatus']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="edit_employee_form" />
                    <input type="hidden" name="userID"
                           value="<?php echo $employee['userID']; ?>" />
                    <input type="submit" value="Edit" class="submit_button">
                </form></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="change_password_form" />
                    <input type="hidden" name="userID"
                           value="<?php echo $employee['userID']; ?>" />
                    <input type="submit" value="Change Password" class="submit_button width2">
                </form></td>
            </tr>
            
            <?php endforeach; ?>

        </table>
        <a href="index.php?action=add_employee_form" class="buttons">Add Employee</a>
        <hr>
    </div>
<?php } else if($event == 'cust') { ?>
    
    <h1 class="headings1">Manage Customers</h1>
    <div id="users_emp">
        <table>
            <tr class="special1">
                <th>&nbsp;</th>
                <th class="name">Name</th>
                <th class="user">User Name</th>
                <th>Phone</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            
        <?php foreach ($customers as $customer) : ?>

            <tr>
                <td><img src="../<?php echo $customer['thumbnailURL']; ?>" alt="Profile Image"></td>
                <td><?php echo $customer['lName']; ?>, <?php echo $customer['fName']; ?></td>
                <td><?php echo $customer['userName']; ?></td>
                <td><?php echo $customer['phone']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="edit_customer_form" />
                    <input type="hidden" name="userID"
                           value="<?php echo $customer['userID']; ?>" />
                    <input type="submit" value="Edit" class="submit_button">
                </form></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="change_password_form" />
                    <input type="hidden" name="userID"
                           value="<?php echo $customer['userID']; ?>" />
                    <input type="submit" value="Change Password" class="submit_button width2">
                </form></td>
            </tr>

            <?php endforeach; ?>
            
        </table>    
        <a href="index.php?action=add_customer_form" class="buttons">Add Customer</a>
        <hr>
    </div>
    
<?php } ?>

</div>

<?php include '../view/admin_footer.php'; ?>