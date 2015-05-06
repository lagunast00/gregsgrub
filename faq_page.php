<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: faq_page.php
**** Description: Displays all the FAQs in an accordion
-->

<?php 

    $title = 'FAQ Page';
    include 'view/header.php'; 

?>

<div id="content_container" class="fit2">

    <div id="sub_nav">
        <ul>
            <li><a href="http://localhost/web289/gregsgrub/index.php?action=mission">Our Mission</a></li>
            <li><a href="http://localhost/web289/gregsgrub/index.php?action=directions_page">Directions</a></li>
            <li><a class="pageMarker" href="http://localhost/web289/gregsgrub/index.php?action=faq_page">FAQ</a></li>
        </ul>
    </div>

    <script type='text/javascript'>
        $('#mabout').addClass('textColor1');
    </script>

    <h2 class="headings1">FAQ</h2>

    <div id="main">
        <div id="accordion">

    	<?php foreach($faqs as $faq) : ?>
    
        	<h3><?php echo $faq['infoFAQ']; ?></h3>
    		<div>
    			<?php echo $faq['infoText']; ?>
    		</div>
    
    	<?php endforeach; ?>
        
        </div>
    </div>    
</div>

<?php include 'view/footer.php'; ?>