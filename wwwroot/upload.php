<?php
$target_dir = '/assets/img';
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST['submit'])) {
    $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
    if($check !== false) {
			echo "<script> alert('Upload successful!');</script>";
			header("Refresh: 0; url=profile.php");        
			$uploadOk = 1;
    } else {
		echo "<script> alert('File is not an image!');</script>";
		header("Refresh: 0; url=profile.php");        
        $uploadOk = 0;
    }
}
?>
