<?php

session_start();
include 'cardlist/db.php';
include 'cardlist/functions.php';

$db = getDatabase();

$id = $_SESSION['login'];
$stmt = $db->prepare("DELETE FROM accounts WHERE id = :id");

$binds = array(
    ":id" => $id
);

if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    header("location:logout.php");
}