<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();
include_once 'conn.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$table = $_GET['table'];
$id = $_GET['id'];

function deleteDirectory($dir) {
    if (!is_dir($dir)) {
        return;
    }
    
    $files = glob($dir . '/*');
    
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDirectory($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dir);
    if (is_dir($dir)) {
        $arr = explode("/", $dir);
        $temp = array_slice($arr, 0, -1);
        $temp = implode("/", $temp);
        rename($dir, $temp . "/DELETED_" . end($arr));
    }
}

if ($table == "games") {
    $sql = "SELECT * FROM games WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $game = $stmt->fetch(PDO::FETCH_ASSOC);
    $file = $game['url'];
    $file = explode("/", $file);
    $file = $file[0];
    $targetDir = '../games/unpacked';
    $targetDel = $targetDir . '/' . $file;
    deleteDirectory($targetDel);
}

$sql = "DELETE FROM $table WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$table = substr($table, 0, -1);
$_SESSION['action'] = "Deleted $table with id $id";

header("Location: ../adminpanel.php");