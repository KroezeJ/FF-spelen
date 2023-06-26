<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("templates/header.php") ?>
    <title>FF Spelen</title>
</head>

<body>
    <?php include_once("templates/nav.php") ?>
    <?php 
        $game = $_GET['game'];
        $sql = "SELECT * FROM games WHERE url = :game";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":game", $game);
        $stmt->execute();

        $game = $stmt->fetch();
    ?>
    <div class="game">
        <div class="fullscreentoggle"><i class="fa-solid fstoggle fa-maximize"></i></div>
        <?php
        if (stripos($_GET['game'], "https") !== false) {
            $link = $_GET['game'];
        } else {
            $link = "games/unpacked/" . $_GET['game'];
        }
        ?>
        <iframe src="<?= $link ?>" width="100%" height="80%" id="gameframe" frameborder="0"></iframe>
        <div class="details">
        <h2><?php echo $game['name'] ?></h2>
        <p class="desc"><?php echo $game['description'] ?></p>
    </div>
    </div>
    <?php include_once("templates/footer.php") ?>
    <script>
        var gameIframe = document.querySelector('.game iframe');
        var gameDocument = gameIframe.contentDocument || gameIframe.contentWindow.document;

        var overflowElements = gameDocument.querySelector('html');
        overflowElements.style.overflow = 'hidden';

        var fullscreenToggle = document.querySelector('.fstoggle');
        fullscreenToggle.addEventListener('click', function () {
            var game = document.querySelector('.game');

            if (document.fullscreenElement ||
                document.webkitFullscreenElement ||
                document.mozFullScreenElement ||
                document.msFullscreenElement) {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
                game.classList.remove('fullscreen');
                fullscreenToggle.classList.remove('fa-minimize');
                fullscreenToggle.classList.add('fa-maximize');
            } else {
                if (game.requestFullscreen) {
                    game.requestFullscreen();
                } else if (game.webkitRequestFullscreen) {
                    game.webkitRequestFullscreen();
                } else if (game.mozRequestFullScreen) {
                    game.mozRequestFullScreen();
                } else if (game.msRequestFullscreen) {
                    game.msRequestFullscreen();
                }
                game.classList.add('fullscreen');
                fullscreenToggle.classList.add('fa-minimize');
                fullscreenToggle.classList.remove('fa-maximize');
            }

        });

        document.addEventListener('fullscreenchange', function () {
            var game = document.querySelector('.game');
            var fullscreenToggle = document.querySelector('.fstoggle');

            if (!document.fullscreenElement) {
                game.classList.remove('fullscreen');
                fullscreenToggle.classList.remove('fa-minimize');
                fullscreenToggle.classList.add('fa-maximize');
            }
        });

    </script>
</body>

</html>