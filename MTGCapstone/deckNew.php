<!DOCTYPE html>
<?php
include 'cardlist/db.php';
include 'cardlist/functions.php';
session_start();
$results = "";
?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body class="body">
        <div class="header">
            <div class="btn">
                <a href="home.php">Home</a>
            </div>
        </div>
        <form method="post" action="#" style="margin:4% 30%;height:700px;width:40%;text-align:center;border:1px solid black;background-color:white;">
            <br/><br/>
            <b><u>Current Formats:</u></b><br/><br/>
            <b>EDH:</b><br/>
            A 100 card, singleton (Single Copy) format with a general leading the deck.<br/><br/>
            <b>Modern:</b><br/>
            A 60 card deck.<br/>
            <div style="margin:1%;"><br/><br/>
                <input type="hidden" value="<?php echo $_SESSION['login']?>" name="creatorID">
                Deck Name</br><input type="text" name="deckName"/><br/><br/>
                Format</br><select type="deckFormat" name="deckFormat">
                    <option value="EDH">EDH</option>
                    <option value="Modern">Modern</option>
                </select><br/><br/>
                <input type="submit" name="submit"><br/><br/>
        </form>
        <?php
        if (isPostRequest()) {
            $db = getDatabase();

            $stmt = $db->prepare("INSERT INTO deck SET creatorID = :creatorID, deckName = :deckName, deckFormat = :deckFormat");

            $creatorID = filter_input(INPUT_POST, 'creatorID');
            $deckName = filter_input(INPUT_POST, 'deckName');
            $deckFormat = filter_input(INPUT_POST, 'deckFormat');

            $binds = array(
                ":creatorID" => $creatorID,
                ":deckName" => $deckName,
                ":deckFormat" => $deckFormat
            );

            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                header("location:home.php");
            }
        }
        ?>
        <?php echo $results ?>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>