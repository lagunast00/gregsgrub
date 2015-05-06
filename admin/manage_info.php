<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/manage_info.php
**** Description: File that allows manager to view the information of the website (mission, coupons, comments, promos, FAQs)
-->

<?php
    
    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }
    $title = 'Manage Info';
    if (isset($_GET['event']))
        $event = $_GET['event'];
    else if (isset($_POST['event']))
        $event = $_POST['event'];
    else if (isset($event)){

    }
    else
        $event = 'all';
    
    $comments2 = get_all_comments();
    $count = $comments2->rowCount();

    $total = 0;
    
    foreach($comments2 as $comment2) {
        $total += $comment2['commentRating'];
    }

    $avg_rating = $total / $count;
    
    include '../view/admin_header.php'; 

?>
<div id="content_container" class="fit9">

    <div id="sub_nav">
        <ul>
            <li><a id="mcomm" href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=comments">Manage Comments</a></li>
            <li><a id="mfaq" href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=faqs">Manage FAQs</a></li>
            <li><a id="mpromo" href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=promos">Manage Promos</a></li>
            <li><a id="mmission" href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=mission">Manage Mission</a></li>
            <li><a id="mcoupon" href="http://localhost/web289/gregsgrub/admin/index.php?action=manage_info&amp;event=coupons">Manage Coupons</a></li>
        </ul>
    </div>

    <script type='text/javascript'>
        $('#minfo').addClass('textColor1');
    </script>
    
<?php if ($event == 'all'){ ?>

    <h1 class="headings1">Manage Info</h1>
    <div id="users_all">
        <h2>Attention!</h2>
        <p>You have reached the Manage Info page. From here you, as a manager, have access to all website information. Any changes made will be permanent. Please make sure spelling and grammer is correct. Check formatting when finished to make sure it still displays correctly.</p>
    </div>

<?php } else if ($event == 'comments'){ 
    $comments = get_every_comment();
?>
    <script type='text/javascript'>
        $('#mcomm').addClass('pageMarker');
    </script>
    <h1 class="headings1">Manage Comments</h1>
    <h3 class="center">Average Rating: <?php echo money($avg_rating); ?> / 5</h3>
    <div id="users_admin">
        <table>
            <tr class="special1">
                <th class="date">Date</th>
                <th class="name">Name</th>
                <th>Comment</th>
                <th>Rating</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
           </tr>
        
        <?php foreach ($comments as $comment) : ?>
        
            <tr>
                <td><?php 
                    $commentDate = strtotime($comment['commentDate']);
                    $commentDate = date('M j, Y - g:i A', $commentDate);
                    echo $commentDate;
                ?></td>
                <td><?php 
                    $name = get_name_info($comment['userIDcomm']);
                    echo $name['lName']; ?>, <?php echo $name['fName']; ?></td>
                <td class="commentText"><?php echo $comment['commentText']; ?></td>
                <td><?php $Rating = $comment['commentRating']; ?>
                    <div id="rating" class="star-rating" style="width: <?php echo htmlspecialchars(80 * ($Rating / 5)) ?>px">
                        Rating: <?php echo htmlspecialchars($Rating) ?>
                    </div></td>
                <td><?php if ($comment['approved'] == 1) { ?><form action="." method="post">
                    <input type="hidden" name="action" value="ban_comment" />
                    <input type="hidden" name="commentID"
                           value="<?php echo $comment['commentID']; ?>" />
                    <input type="submit" value="Ban Comment" class="submit_button">
                </form><?php } else { ?><form action="." method="post">
                    <input type="hidden" name="action" value="unban_comment" />
                    <input type="hidden" name="commentID"
                           value="<?php echo $comment['commentID']; ?>" />
                    <input type="submit" value="Allow" class="submit_button">
                </form><?php } ?></td>
                <td><?php if ($comment['postID'] == 0) { ?><form action="." method="post">
                    <input type="hidden" name="action" value="add_comment" />
                    <input type="hidden" name="commentID"
                           value="<?php echo $comment['commentID']; ?>" />
                    <input type="submit" value="Add Comment" class="submit_button">
                </form><?php } else { ?>&nbsp;<?php } ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <hr>
    </div>
<?php } else if ($event == 'faqs'){ 
    $faqs = get_faqs();
?>
        
    <script type='text/javascript'>
        $('#mfaq').addClass('pageMarker');
    </script>
    <h1 class="headings1">Manage FAQs</h1>
    <div id="users_admin">
        <table>
            <tr class="special1">
                <th class="faqQ">FAQ Question</th>
                <th class="faqA">FAQ Answer</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

       <?php foreach ($faqs as $faq) : ?>
            
            <tr>
                <td><?php echo $faq['infoFAQ']; ?></td>
                <td><?php echo $faq['infoText']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="edit_faq" />
                    <input type="hidden" name="infoID"
                           value="<?php echo $faq['infoID']; ?>" />
                    <input type="submit" value="Edit" class="submit_button">
                </form></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="delete_faq" />
                    <input type="hidden" name="infoID"
                           value="<?php echo $faq['infoID']; ?>" />
                    <input type="submit" value="Delete" class="submit_button">
                </form></td>
            </tr>
            
        <?php endforeach; ?>
        
        </table>
        <hr>
        <a class="buttons" href="index.php?action=add_faq_form">Add FAQ</a><br>
    </div>

<?php } else if ($event == 'promos'){ ?>
    
    <script type='text/javascript'>
        $('#mpromo').addClass('pageMarker');
    </script>
    <h1 class="headings1">Manage Promos</h1>
    <?php $promo = get_promo(); 
        if (isset($msg)) { echo $msg; }
    ?>
    <div id="mission1">
        <form action="index.php" method="post">
            <h2>Current Promo Statement</h2>
            <label><span>Promo Heading: </span><input type="text" name="infoFAQ" value="<?php echo $promo['infoFAQ']; ?>"></label>
            <label><span>Promo Text: </span><textarea name="infoText" rows="4" cols="30" maxlength="300"><?php echo $promo['infoText']; ?></textarea></label>
            <input type="hidden" name="action" value="update_promo">
            <input type="hidden" name="event" value="promos">
            <input type="submit" value="Update" class="submit_button center">
        </form>
    </div>
<?php } else if ($event == 'mission'){ ?>

    <script type='text/javascript'>
        $('#mmission').addClass('pageMarker');
    </script>
    <h1 class="headings1">Manage Mission</h1>
    <?php $mission = get_mission(); 
        if (isset($msg)) { echo $msg; }
    ?>

    <div id="mission1">
        <form action="index.php" method="post">
            <h2>Current Mission Statement</h2>
            <label><span>Mission Heading: </span><input type="text" name="infoFAQ" value="<?php echo $mission['infoFAQ']; ?>"></label>
            <label><span>Mission Text: </span><textarea name="infoText" rows="4" cols="30" maxlength="400"><?php echo $mission['infoText']; ?></textarea></label>
            <input type="hidden" name="action" value="update_mission">
            <input type="hidden" name="event" value="mission">
            <input type="submit" value="Update" class="submit_button center">
        </form>
    </div>
<?php } else if ($event == 'coupons'){ ?>
    <h1 class="headings1">Manage Coupons</h1>
    
    <script type='text/javascript'>
        $('#mcoupon').addClass('pageMarker');
    </script>
    <?php $coupons = get_coupons(); 
        if (isset($msg)) { echo $msg; }
    ?>

    <div id="users_admin">
        <table>
            <tr class="special1">
                <th class="code">Code</th>
                <th class="code">Value</th>
                <th class="desc">Description</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        
        <?php foreach ($coupons as $coupon) : ?>
        
            <tr>
                <td><?php echo $coupon['couponCode']; ?></td>
                <td><?php echo $coupon['couponValue']; ?></td>
                <td><?php echo $coupon['couponDesc']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="edit_coupon" />
                    <input type="hidden" name="couponID"
                           value="<?php echo $coupon['couponID']; ?>" />
                    <input type="submit" value="Edit" class="submit_button">
                </form></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="delete_coupon" />
                    <input type="hidden" name="couponID"
                           value="<?php echo $coupon['couponID']; ?>" />
                    <input type="submit" value="Delete" class="submit_button">
                </form></td>
            </tr>
        
            <?php endforeach; ?>
        
        </table>
        <hr>
        <a class="buttons" href="index.php?action=add_coupon_form">Add Coupon</a><br>
    </div>
<?php } ?>

</div>

<?php include '../view/admin_footer.php'; ?>