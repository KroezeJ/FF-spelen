<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("templates/header.php") ?>
    <title>FF Spelen</title>
</head>

<?php
$table = $_GET['table'];
$id = $_GET['id'];

$sql = "SELECT * FROM $table WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();
$entry = $stmt->fetch();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    switch ($table) {
        case 'games':
            $name = $_POST['name'] !== '' ? $_POST['name'] : $entry['name'];
            $description = $_POST['description'] !== '' ? $_POST['description'] : $entry['description'];
            $image = $_POST['image'] !== '' ? $_POST['image'] : $entry['image'];
            $url = $_POST['url'] !== '' ? $_POST['url'] : $entry['url'];
            $category = $_POST['category'];         
            
            $sql = "UPDATE $table SET name = :name, description = :description, image = :image, url = :url, category = :category WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":image", $image);
            $stmt->bindParam(":url", $url);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":category", $category);
            $stmt->execute();
        
            $_SESSION['action'] = "Game updated successfully";
            header("Location: adminpanel.php");
            break;
        case 'admins':
            $name = $_POST['name'] !== '' ? $_POST['name'] : $entry['name'];
            $email = $_POST['email'] !== '' ? $_POST['email'] : $entry['email'];
            $password = $_POST['password'] !== '' ? $_POST['password'] : $entry['password'];
            
            $sql = "UPDATE $table SET name = :name, email = :email, password = :password WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            
            $_SESSION['action'] = "Admin updated successfully";
            header("Location: adminpanel.php");
            break;
    }

}
?>

<body>
    <?php include_once("templates/nav.php") ?>
    <div class="container content">
        <?php
        switch ($table) {
            case 'games':
                $sql = "SELECT * FROM games WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $game = $stmt->fetch();
                ?>
                <form method="post" enctype="multipart/form-data">
                    <?php if (isset($_SESSION['message'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php unset($_SESSION['message']);
                    } ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= $game['name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="Description" class="form-control"><?= $game['description'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image URL</label>
                        <input type="text" name="image" id="image" class="form-control" value="<?= $game['image'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label">URL (.html file in folder)</label>
                        <input type="text" name="url" id="url" class="form-control" value="<?= $game['url'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="category" name="category" class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <option value="Action" <?php if($game['category'] == "Action"){echo "selected";} ?>>Action</option>
                            <option value="Adventure" <?php if($game['category'] == "Adventure"){echo "selected";} ?>>Adventure</option>
                            <option value="Casual" <?php if($game['category'] == "Casual"){echo "selected";} ?>>Casual</option>
                            <option value="Indie" <?php if($game['category'] == "Indie"){echo "selected";} ?>>Indie</option>
                            <option value="Multiplayer" <?php if($game['category'] == "Multiplayer"){echo "selected";} ?>>Multiplayer</option>
                            <option value="Racing" <?php if($game['category'] == "Racing"){echo "selected";} ?>>Racing</option>
                            <option value="RPG" <?php if($game['category'] == "RPG"){echo "selected";} ?>>RPG</option>
                            <option value="Simulation" <?php if($game['category'] == "Simulation"){echo "selected";} ?>>Simulation</option>
                            <option value="Sports" <?php if($game['category'] == "Sports"){echo "selected";} ?>>Sports</option>
                            <option value="Strategy" <?php if($game['category'] == "Strategy"){echo "selected";} ?>>Strategy</option>
                        </select>
                    </div>
                    <?php submitButton("Update") ?>
                </form>
                <?php
                break;
            case 'admins':
                $sql = "SELECT * FROM admins WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $admin = $stmt->fetch();
                ?>
                <form method="post">
                    <?php if (isset($_SESSION['message'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php unset($_SESSION['message']);
                    } ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= $admin['name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" id="email" class="form-control" value="<?= $admin['email'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" name="password" id="password" class="form-control">
                    </div>
                    <?php submitButton("Update") ?>
                </form>
                <?php
                break;
        }
        ?>
    </div>

    <?php include_once("templates/footer.php") ?>
</body>

</html>