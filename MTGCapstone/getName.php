<!DOCTYPE HTML>
<?php
session_start();
include "cardlist/db.php";
$id = $_SESSION['login'];
$name = "";
$stmt = $db->prepare("SELECT name FROM accounts WHERE id = $id");

$results = array();
if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $name = implode("", array_column($results, 'name'));
    $_SESSION['name'] = $name;
    header("location: home.php");
}