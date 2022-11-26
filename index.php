<?php
    include 'connect.php'
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Image Gallery</title>
        <link rel="stylesheet" href="styles.css">
    <head>
    <body>
        <header>
            <h1>Uploaded Images</h1>
            <nav>
                <a href="index.php">Images</a></li>
                <a href="upload.php">Upload</a></li>
            </nav>
        </header>
        <main>
            <?php
                $query = "SELECT 'ID', 'description', 'file', 'thumbnail', 'photo' FROM gallery";
                $sql = mysqli_query($connect, $query);
                while($row = mysqli_fetch_array($sql)){
                    echo '<a href="descriptions.php?id='.$row['id'].'"><img src="'.$row['thumbnail'].'" alt="'.$row['description'].'"></a>';
                    echo '<h2>'.$row['photo'].'</h2>';
                }
            ?>
        </main>
    </body>
</html>