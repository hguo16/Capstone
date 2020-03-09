<?php
session_start();
include 'cardlist/db.php';
include 'cardlist/functions.php';

$db = getDatabase();

$id = filter_input(INPUT_GET, 'id');
$deck = $_SESSION['deck'];

$stmt = $db->prepare("DELETE FROM decklist WHERE id = :id");

$binds = array(
    ":id" => $id
);

if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    header("location:deckEdit.php?id=$deck");
}
?>