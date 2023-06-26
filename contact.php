<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("templates/header.php") ?>
    <title>FF Spelen</title>
</head>

<body>
    <?php include_once("templates/nav.php") ?>

    <?php

    if (!isset($_SESSION)) {
        session_start();
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $sql = "INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'message' => $message]);

        $_SESSION['error'] = "Bericht verstuurd!";
    }
    ?>
    <div class="container content">
        <form class="contact" method="post">
        <?php if(isset($_SESSION['error'])){ ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['error']; ?>
                </div>
            <?php unset($_SESSION['error']); } ?>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" id="message" class="form-control" required></textarea>
            </div>
            <?php submitButton("Send") ?>
        </form>
    </div>

    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>   
    <?php include_once("templates/footer.php") ?>
</body>

</html>