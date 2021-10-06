<?php

require_once("includes/config.php");
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/VideoProcessor.php");




$videoUploadData = new VideoUploadData(
    $_FILES["fileInput"],
    $_POST["titleInput"],
    $_POST["descriptionInput"],
    $_POST["privacyInput"],
    $_POST["categoryInput"],
    "test"
);

// 2) Process video data (upload)
$videoProcessor = new VideoProcessor($con);
$wasSuccessful = $videoProcessor->upload($videoUploadData);

// 3) Check if upload was successful
if($wasSuccessful) {
    echo "Upload Successful";
}