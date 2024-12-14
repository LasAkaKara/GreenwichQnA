<?php
// Set the target directory
$target_dir = "uploads/" . $upload_type . "/";
// Set the target file
$target_file = $target_dir . basename($_FILES["image_path"]["name"]);
// Set the upload status
$uploadOk = 1;
// Set the image file type
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//Move file to the target directory
if(move_uploaded_file($_FILES["image_path"]["tmp_name"],  $target_file)) {
    echo "File uploaded successfully";
} else {
    echo "Error uploading file";
    $uploadOk = 0;
}
?>

