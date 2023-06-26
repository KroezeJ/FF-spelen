<head>
    <?php include_once("templates/header.php") ?>
    <title>FF Spelen</title>
</head>
<?php 

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<?php

$sql = "SELECT * FROM games";
$stmt = $conn->prepare($sql);
$stmt->execute();
$games = $stmt->fetchAll();

$sql = "SELECT * FROM messages";
$stmt = $conn->prepare($sql);
$stmt->execute();
$messages = $stmt->fetchAll();

$sql = "SELECT * FROM admins";
$stmt = $conn->prepare($sql);
$stmt->execute();
$admins = $stmt->fetchAll();
?>

<body>
    <?php include_once("templates/nav.php") ?>
    <div class="container content tables">
        <?php if(isset($_SESSION['action'])){ ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['action']; ?>
            </div>
        <?php unset($_SESSION['action']); } ?>
        <table class="table-responsive table-striped table">
            <h1>Games <a href="add.php?type=game"><i class="fa-solid fa-circle-plus"></i></a></h1>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>URL</th>
                    <th>Category</th>
                    <th>Playcount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($games as $game){
                    echo "<tr>";
                    echo "<td>" . $game['name'] . "</td>";
                    echo "<td>" . $game['description'] . "</td>";
                    echo "<td><a href='" . htmlspecialchars($game['image']) . "'>" . substr($game['image'], 0, 25) . "..." . "</a></td>";
                    echo "<td><a href='" . htmlspecialchars($game['url']) . "'>" . substr($game['url'], 0, 25) . "..." . "</a></td>";                    
                    echo "<td>" . $game['category'] . "</td>";
                    echo "<td>" . $game['playcount'] . "</td>";
                    echo "<td><a href='edit.php?table=games&id=" . $game['id'] . "'><i class='fa-regular no-dec fa-pen-to-square'></i></a> <a href='actions/delete.php?table=games&id=" . $game['id'] . "'><i class='fa-solid no-dec fa-trash'></a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <table class="table-responsive table-striped table">
            <h1>Admins <a href="add.php?type=admin"><i class="fa-solid fa-circle-plus"></i></a></h1>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($admins as $admin){
                    echo "<tr>";
                    echo "<td>" . $admin['name'] . "</td>";
                    echo "<td>" . $admin['email'] . "</td>";
                    echo "<td>********</td>";
                    echo "<td>" . $admin['created_at'] . "</td>";
                    echo "<td><a href='edit.php?table=admins&id=" . $admin['id'] . "'><i class='fa-regular no-dec fa-pen-to-square'></i></a><a href='actions/delete.php?table=admins&id=" . $admin['id'] . "'><i class='fa-solid no-dec fa-trash'></i></a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <table class="table-responsive table-striped table">
            <h1>Messages</h1>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Submitted at</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($messages as $message){
                    if($message['status'] == 0){
                        $status = "Open";
                    } else {
                        $status = "Done";
                    }
                    echo "<tr>";
                    echo "<td>" . $message['name'] . "</td>";
                    echo "<td>" . $message['email'] . "</td>";
                    echo "<td>" . $message['message'] . "</td>";
                    echo "<td>" . $message['created_at'] . "</td>";
                    echo "<td>" . $status . "</td>";
                    echo "<td><a href='actions/setdone.php?id=" . $message['id'] . "'><i class='fa-solid no-dec fa-square-check'></i></a><a href='actions/delete.php?table=messages&id=" . $message['id'] . "'><i class='fa-solid no-dec fa-trash'></i></a></td>";

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include_once("templates/footer.php") ?>
</body>

</html>