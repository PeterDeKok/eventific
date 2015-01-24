<?php

if(isset($_GET['path']) && isset($_GET['image'])) {
	if($_GET['path'] == 'event'){
		$path = '../assets/userUploadFiles/events/';
	} else if($_GET['path'] == 'user'){
		$path = '../assets/userUploadFiles/users/';
	} else {
    //header('HTTP/1.0 404 Not Found');
    //die('The file does not exist');
	}

	$img = $_GET['image'];
	$imgName = basename($img);
 
	// Construct the actual image path.
	$imgPath = $path . $imgName;
 
	// Make sure the file exists
	if(!file_exists($imgPath) || !is_file($imgPath)) {
	    header('HTTP/1.0 404 Not Found');
	    die('The file does not exist');
	}
 
	// Make sure the file is an image
	$imgData = getimagesize($imgPath);
	if(!$imgData) {
	    header('HTTP/1.0 403 Forbidden');
	    die('The file you requested is not an image.');
	}
 
	// Set the appropriate content-type
	// and provide the content-length.
	header('Content-type: ' . $imgData['mime']);
	header('Content-length: ' . filesize($imgPath));
 
	// Print the image data
	readfile($imgPath);
}

?>