<?php
require 'connect.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $contact = $_POST["contact"];
    $locality = $_POST["locality"];
    $problem = $_POST["problem"];
    
    if ($_FILES["image"]["error"] == 4) {
        echo "<script> alert('Image does not exist'); </script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $filesize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        
        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script> alert('Invalid image extension'); </script>";
        } else if ($filesize > 1000000) {
            echo "<script> alert('Image is too large'); </script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;

            move_uploaded_file($tmpName, 'img/' . $newImageName);
            $query = "INSERT INTO image_upload (name,image,contact,Locality,Problem) VALUES ('$name','$newImageName','$contact','$locality','$problem')";
            mysqli_query($conn, $query);

            echo 
            "<script>
                alert('Successfully added');
                document.location.href = 'data.php';
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <style>
        body{
            background-image:url("GWMS.JPG");
            background-repeat: no-repeat;
            background-attachment:fixed;
            background-size:100% 100%;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image File</title>
</head>
<body>

    <center>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required value=""> <br>

        <label for="contact">Contact:</label>
        <input type="text" name="contact" id="contact" required value=""> <br>

        <label for="locality">Locality:</label>
        <input type="text" name="locality" id="locality" required value=""> <br>

        <label for="problem">Problem:</label>
        <input type="text" name="problem" id="problem" required value=""> <br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png"> <br> <br>
        

        <button type="submit" name="submit">Submit</button>
    </form>
    </center>
</body>
</html>
