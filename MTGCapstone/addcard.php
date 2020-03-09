<?php
session_start();
include 'cardlist/db.php';
include 'cardlist/functions.php';

$db = getDatabase();
$deckID = $_SESSION['deck'];
$cardID = filter_input(INPUT_GET, 'card');
$results = "Card Not Added.";

$stmt = $db->prepare("INSERT INTO decklist SET deckID = :deckID, cardID = :cardID");

$binds = array(
    ":deckID" => $deckID,
    ":cardID" => $cardID
);

if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    header("location:deckEdit.php?id=$deckID");
}
?>