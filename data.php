<?php require 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
</head>
<body>
    <table border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Image</td>
        </tr>
        <?php
        $i = 1; // Initialize $i
        $rows = mysqli_query($conn, "SELECT * FROM IMAGE_UPLOAD ORDER BY id DESC");
        ?>
        <?php foreach($rows as $row): ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><img src="img/<?php echo $row['image']; ?>" width="200" title="<?php echo $row['image']; ?>"></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="../uploadimagefile">upload Image File</a>
    </br>
</body>
</html>
