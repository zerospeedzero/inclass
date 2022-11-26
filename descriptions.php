<?php
    include 'connect.php'
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Image Descriptions</title>
        <link rel="stylesheet" href="styles.css">
    <head>
    <body>
    <header>
            <h1>Image Details</h1>
            <nav>
                <a href="index.php">Images</a></li>
                <a href="upload.php">Upload</a></li>
            </nav>
        </header>
        <main>
            <?php
                // Connect the image data with the database and display the image and info
                $id = $_GET['id'];
                $query = "SELECT 'description', 'file', 'photo' WHERE id=$id";
                $sql = mysqli_query($connect, $query);
                $row = mysqli_fetch_array($sql);

                echo '<img src="'.$row['file'].'"alt="'.$row['description'].'">';
                echo '<h2>'.$row['photo'].'</h2>';
                echo '<p>'.$row['description'].'</p>';
            ?>
        </main>
    </body>
</html>