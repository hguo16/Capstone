<!DOCTYPE HTML>
<?php
session_start();
include "cardlist/db.php";
$id = $_SESSION['login'];
$name = $_SESSION['newName'];
$username = $_SESSION['newUsername'];
$password = $_SESSION['newPassword'];
$stmt = $db->prepare("UPDATE accounts SET name = :name, username = :username, password = :password WHERE id = :id");

$binds = array(
    ":id" => $id,
    ":name" => $name,
    ":username" => $username,
    ":password" => $password
);

if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    header("location: logout.php");
}