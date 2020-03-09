<!DOCTYPE HTML>
<?php
session_start();
include "cardlist/db.php";
$id = $_SESSION['login'];
$name = $_SESSION['name'];
$stmt = $db->prepare("SELECT * FROM deck WHERE creatorID = $id");

$results = array();
if ($stmt->execute() && $stmt->rowCount() > 0) {
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body class="body2">
        <div class="header">
            <div class="btn">
                <a href="deckNew.php">New Deck</a>
            </div>
            <div class="btn">
                <a href="settings.php">Settings</a>
            </div>
            <div class="btn">
                <a href="logout.php">Log Out</a>
            </div>
            
        <h1>Welcome back <?php echo $name ?></h1>
        </div>
        <!--<h1><?php echo $id ?></h1>-->
        <table>
            <tr>
                <th>Deck Name</th>
                <th>Format</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($results as $row): ?> <!--Start foreach-->
                <tr>
                    <td><a href="deckEdit.php?id=<?php echo $row['id']; ?>"><!-- <- That is the edit link--><?php echo $row['deckName']; ?><!-- <- this is pulling the deck's name--></a></td>
                    <td><?php echo $row['deckFormat'] ?></td> <!--Format of the deck-->
                    <td><a href="deckDelete.php?id=<?php echo $row['id']; ?>">Delete</a></td> <!--Delete Deck-->
                </tr>
            <?php endforeach; ?> <!--End foreach-->
        </table>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>