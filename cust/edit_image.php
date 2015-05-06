<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: cust/edit_image.php
**** Description: Form that allows customer to edit his/her profile picture
-->

<?php

    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'C'){
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = 'Edit Profile Image';
    $customer = get_all_customer_info($_SESSION['userID']);
	
	include '../view/cust_header.php'; 

?>

<div id="content_container">
	<h1 class="headings1">Edit Profile Image</h1>

	<div id="edit_image">
		<h3>Choose a photo:</h3>

		<form action="index.php" method="POST" enctype="multipart/form-data">
			<img id="blah" src="../<?php echo $customer['thumbnailURL']; ?>" alt="No Image">
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
		
			<div class="buttons">
				<span>Browse</span>
				<input type="file" name="thumbnailURL" class="upload" onchange="$('#blah')[0].src = window.URL.createObjectURL(this.files[0])" required><br />
			</div>
		
			<input type="hidden" name="action" value="add_image">
            <input type="submit" name="submit" value="Upload file" class="submit_button"/>
		</form>
	</div>
</div>

<?php include '../view/footer.php'; ?>
