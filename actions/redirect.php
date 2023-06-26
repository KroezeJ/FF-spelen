<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if (!isset($_SESSION)) {
    session_start();
}
include_once 'conn.php';
$game = $_GET['game'];
$link = $game;

$sql = "SELECT * FROM games WHERE url = :game";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":game", $game);
$stmt->execute();
$game = $stmt->fetch();

$playcount = $game['playcount'] + 1;

$sql = "UPDATE games SET playcount = :playcount WHERE url = :game";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":playcount", $playcount);
$stmt->bindParam(":game", $link);
$stmt->execute();

header("Location: ../game.php?game=$link");