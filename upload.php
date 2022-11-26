<?php
include "connect.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $file = $_FILES["upload"]["tmp_name"];
    $file_name = $_FILES["upload"]["name"];
    $photo_name = $_POST["image"];
    $description = $_POST["description"];
    
    // Renaming the original file name to whatever I be putting into the Image Name thing in my form
    $tmp_name = explode(".", $_FILES["upload"]["name"]);
    $newname = str_replace(' ', '_', $photo_name) .'.'.end($tmp_name);
    // These variables are renaming the files? I hope. I've never made comments before, this is OP.
    $full_size_path = "images/";
    $thumbnail_path = "thumbnails/";
    $full_size_rename = $full_size_path.$newname;
    $thumbnail_rename = $thumbnail_path.$newname;
    //
    $image_format = pathinfo($full_size_rename, PATHINFO_EXTENSION);

    // This is limiting file types to jpeg format
    if(isset($_POST["submit"]) && !empty($_FILES["upload"])){
        $img_format = array('jpg', 'jpg');
    }
        if(in_array($image_format, $img_format) && !file_exists($full_size_rename)){
            if(move_uploaded_file($_FILES["upload"]["tmp_name"], $full_size_rename)){
                if($image_format == 'jpg'){
                    $jpg = imagecreatefromjpeg($full_size_rename);
                    // Resize the image to be thumbnail sized
                    $thumbnail = imagescale($jpg, 250);
                    imagejpeg($thumbnail, $thumbnail_rename);
                    move_uploaded_file($full_size_rename, $thumbnail_rename);
                    // Connecting to the Database and sending image data
                    $insert = $connect->query("INSERT into gallery (description, file, thumbnail, photo) VALUES ('" . $description . "','" . $full_size_rename . "','" . $thumbnail_rename . "','" . $photo_name . "')");
                }
            }
        }
                    // Echoing to the user if the upload requirements were met or not
                    if($insert){
                        $msg = "Upload Complete!";
                    }
                    else {
                        $msg = "Critical Failure Uploading Your Image, lol!";
                    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Image Upload</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <header>
            <h1>Choose an Image to Upload</h1>
            <nav>
                <a href="index.php">Images</a></li>
                <a href="upload.php">Upload</a></li>
            </nav>
        </header>
        <main>
            <?php
            if (isset($msg)) echo $msg;
            ?>
            <form method="post" enctype="multipart/form-data">
                <label for="upload">Upload Image</label>
                <input type="file" name="upload" id="upload" required>
                <label for="image">Name of Image</label>
                <input type="text" name="image" id="image" required>
                <label for="description">Description of Image</label>
                <textarea name="description" id="description" rows="5" cols="75"></textarea>
                <input type="submit" name="submit" value="Upload">
            </form>
        </main>
    </body>
</html>