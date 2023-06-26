<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("templates/header.php") ?>
    <title>FF Spelen - Add <?php echo $_GET['type'] ?></title>
</head>
<?php

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
$type = $_GET['type'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($type) {
        case 'game':
            $targetDir = 'games/';
            $targetFile = $targetDir . basename($_FILES['zipFile']['name']);

            if (move_uploaded_file($_FILES['zipFile']['tmp_name'], $targetFile)) {
                $zip = new ZipArchive;
                if ($zip->open($targetFile) === TRUE) {
                    $zip->extractTo('games/unpacked/');
                    $zip->close();
                    unlink($targetFile);
                } else {
                    echo 'Failed to open the zip file.';
                }
            }

            $name = $_POST['name'];
            $description = $_POST['description'];
            $image = $_POST['image'];
            $url = $_POST['url'];
            $category = $_POST['category'];

            $sql = "INSERT INTO games (name, description, image, url, category) VALUES (:name, :description, :image, :url, :category)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":image", $image);
            $stmt->bindParam(":url", $url);
            $stmt->bindParam(":category", $category);
            $stmt->execute();
            $_SESSION['message'] = "Game added";
            break;
        case 'admin':
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
            $_SESSION['message'] = "Admin added";
            break;
    }
}
?>

<body>
    <?php include_once("templates/nav.php") ?>
    <div class="container content">
        <?php
        switch ($type) {
            case 'game':
                include_once("templates/addgame.php");
                break;
            case 'admin':
                include_once("templates/addadmin.php");
                break;
            default:
                echo "<h1>404</h1>";
                break;
        }
        ?>
    </div>
    <?php include_once("templates/footer.php") ?>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>