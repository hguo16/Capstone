<?php
session_start();
include 'cardlist/db.php';
include 'cardlist/functions.php';

$db = getDatabase();

$id = filter_input(INPUT_GET, 'id');

$stmt = $db->prepare("DELETE FROM deck WHERE id = :id");

$binds = array(
    ":id" => $id
);

if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    header("location:home.php");
}
?>