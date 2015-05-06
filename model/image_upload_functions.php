<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: model/image_upload_functions.php
**** Description: Image upload functions
-->

<?php

$max_file_size = 2097152; // 1 MB expressed in bytes

if ( $_SESSION['userLevel'] == 'A' && $_SESSION['editAdmin'] == 'No')
	$upload_path = "../images/products";
else 
	$upload_path = "../images/profiles";
/*
**** Name: file_upload_error
**** Arguements: error_integer
**** Return Data: upload_errors
**** Description: returns any errors encountered while uploading image
*/
function file_upload_error($error_integer) {
	$upload_errors = array(
		// http://php.net/manual/en/features.file-upload.errors.php
		UPLOAD_ERR_OK 				=> "No errors.",
		UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
	  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
	  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
	  UPLOAD_ERR_NO_FILE 		=> "No file.",
	  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
	  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
	  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
	);
	return $upload_errors[$error_integer];
}
/*
**** Name: sanitize_file_name()
**** Arguements: filename
**** Return Data: filename
**** Description: sanitaizes filename
*/
function sanitize_file_name($filename) {
	$filename = preg_replace("/([^A-Za-z0-9_\-\.]|[\.]{2})/", "", $filename);
	$filename = basename($filename);
	return $filename;
}
/*
**** Name: file_permissions()
**** Arguements: file
**** Return Data: $octal_perms
**** Description: returns any file permissions added to file
*/
function file_permissions($file) {
	$numeric_perms = fileperms($file);
	$octal_perms = sprintf('%o', $numeric_perms);
	return substr($octal_perms, -4);
}
/*
**** Name: upload_file()
**** Arguements: field_name
**** Return Data: none
**** Description: uploads file to destination if no errors are encountered
*/
function upload_file($field_name) {
	global $upload_path, $max_file_size;
	if(isset($_FILES[$field_name])) {
		$file_name = sanitize_file_name($_FILES[$field_name]['name']);
		$file_type = $_FILES[$field_name]['type'];
		$tmp_file = $_FILES[$field_name]['tmp_name'];
		$error = $_FILES[$field_name]['error'];
		$file_size = $_FILES[$field_name]['size'];
		$file_path = $upload_path . '/' . $file_name;

		if ($_SESSION['userLevel'] == 'C' || $_SESSION['userLevel'] == 'E' || $_SESSION['editAdmin'] == 'Yes'){
			$temp = explode(".", $_FILES[$field_name]["name"]);
		  	$ext = end($temp);
		  	if ($_SESSION['userLevel'] == 'C')
				$file_path = $upload_path . '/' . "c" . $_SESSION['userID'].".". $ext;			
			else if ($_SESSION['userLevel'] == 'E')
				$file_path = $upload_path . '/' . "e" . $_SESSION['userID'].".". $ext;			
			else
				$file_path = $upload_path . '/' . "a" . $_SESSION['userID'].".". $ext;			
		}

		if($error > 0) {
			$msg = "Error: " . file_upload_error($error);
		
		} elseif(!is_uploaded_file($tmp_file)) {
			$msg ="Error: Does not reference a recently uploaded file.<br />";	

		} elseif($file_size > $max_file_size) {
			$msg ="Error: File size is too big.<br />";

		} elseif(file_exists($file_path)) {
			$msg = "Error: A file with that name already exists in target location.<br />";
		} 
		if(move_uploaded_file($tmp_file, $file_path)) {
			$msg = "File moved to: {$file_path}<br />";

			if(chmod($file_path, 0644)) {
				$file_permissions = file_permissions($file_path);
			} 

		}
		
	
	}

}

?>
