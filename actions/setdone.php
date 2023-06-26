<?php 

include_once 'conn.php';

$id = $_GET['id'];

$sql = "SELECT * FROM messages WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();
$entry = $stmt->fetch();

if($entry['status'] == 0){
    $status = 1;
} else {
    $status = 0;
}



$sql = "UPDATE messages SET status = :status WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->bindParam(":status", $status);
$stmt->execute();

header("Location: ../adminpanel.php");