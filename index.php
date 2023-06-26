<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("templates/header.php") ?>
    <title>FF Spelen</title>
</head>

<body> 
<?php include_once("templates/nav.php") ?>
<div class="container content">
        <h1>Welkom op FF Spelen</h1>
        <p class="col-md-12 text-center">Op deze website kan je verschillende spelletjes spelen. <br>
        Je kan kiezen uit verschillende categorieën. <br>
        Veel plezier!</p>
        
        <?php if(isset($_GET['name'])){ echo "<div class='row'><h2>" . ucfirst($_GET['name'])  . " games</h2></div>";} ?>
        <div class="games">
        <?php
        if (isset($_GET['name'])) {
            $sql = "SELECT * FROM games WHERE category = :category ORDER BY created_at DESC";
            $category = $_GET['name'];
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":category", $category);
        } else {
            $sql = "SELECT * FROM games ORDER BY created_at DESC";
            $stmt = $conn->prepare($sql);
        }
        $stmt->execute();
        $games = $stmt->fetchAll();

        foreach ($games as $game) {
            card($game['name'], $game['description'], $game['url'], $game['image']);
        }
        ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <?php include_once("templates/footer.php") ?>
</body>

</html>