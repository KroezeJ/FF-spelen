<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("templates/header.php") ?>
    <title>FF Spelen</title>
</head>
<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM admins WHERE name = :username";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
    
    if ($user && $password == $user['password']) {
        $_SESSION['user'] = $user;
        header("Location: adminpanel.php");
    } else {
        $_SESSION["error"] = "Username or password incorrect";
    }
}
?>

<body>
    <?php include_once("templates/nav.php") ?>
    <div class="container">
        <form method="post" class="login">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <?php if(isset($_SESSION['error'])){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error']; ?>
                </div>
            <?php unset($_SESSION['error']); } ?>
            <?php submitButton("Login") ?>
        </form>
    </div>
    <?php include_once("templates/footer.php") ?>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>
