<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: admin/edit_image.php
**** Description: Form that allows manager to edit his/her profile picture
-->

<?php


    if (!isset($_SESSION["userID"]) || $_SESSION['userLevel'] != 'A') {
        header('Location: //localhost/web289/gregsgrub/index.php?action=login_page');
    }

    $title = 'Edit Profile Image';

    $admin = get_admin_all($_SESSION['userID']);
    
    include '../view/admin_header.php'; 

?>

<div id="content_container">
	<h1 class="headings1">Edit Profile Image</h1>

	<div id="edit_image">

    <script type='text/javascript'>
        $('#muser').addClass('textColor1');
    </script>
		<h3>Choose a photo:</h3>

		<form action="index.php" method="POST" enctype="multipart/form-data">
			<img id="blah" src="../<?php echo $admin['thumbnailURL']; ?>" alt="No Image">
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
		
			<div class="buttons">
				<span>Browse</span>
				<input type="file" name="thumbnailURL" class="upload" onchange="$('#blah')[0].src = window.URL.createObjectURL(this.files[0])" required><br />
			</div>
		
			<input type="hidden" name="action" value="add_image_profile">
            <input type="submit" name="submit" value="Upload Image" class="submit_button"/>
		</form>
	</div>
</div>

<?php include '../view/admin_footer.php'; ?>
