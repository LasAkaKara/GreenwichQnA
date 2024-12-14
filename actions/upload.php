<?php
//Define target directory
$target_dir = "uploads/" . $upload_type . "/";
$target_file = $target_dir . basename($_FILES["image_path"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//Move uploaded file to target directory
if(move_uploaded_file($_FILES["image_path"]["tmp_name"],  $target_file)) {
    echo "File uploaded successfully";
} else {
    echo "Error uploading file";
    $uploadOk = 0;
}
?>

