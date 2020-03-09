<!DOCTYPE HTML>
<?php
session_start();
include 'cardlist/db.php';
include 'cardlist/functions.php';

$db = getDatabase();

$id = filter_input(INPUT_GET, 'id');
$_SESSION['deck'] = $id;

$stmt = $db->prepare("SELECT decklist.deckID, magiccards.magicName, decklist.cardID, magiccards.magicImageUrl, decklist.id FROM decklist INNER JOIN magiccards on decklist.cardID=magiccards.magicId WHERE decklist.deckID = $id");

$results = array();
if ($stmt->execute() && $stmt->rowCount() > 0) {
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="sweetalert2.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body class="body2">
        <div class="header">
            <div class="btn">
                <a href="home.php">Home</a>
            </div>
            <div class="btn">
                <a href="cardList.php?id=<?php echo $id ?>">Add Card</a>
            </div>
        </div>
        <table>
            <tr>
                <th>Card Name</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($results as $row): ?> <!--Start foreach-->
                <tr>
                    <td><a href="#" data-image="<?php echo $row['magicImageUrl'] ?>" data-name="<?php echo $row['magicName'] ?>" class="pic"><?php echo $row['magicName'] ?></a></td>
                    <td><a href="cardDelete.php?id=<?php echo $row['id'] ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?> <!--End foreach-->
        </table>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script>$('.pic').click((e) => {
                e.preventDefault();
                var imageURL = e.target.dataset.image;
                var name = e.target.dataset.name;
                console.log(imageURL);
                Swal.fire({
                    title: name,
                    imageUrl: imageURL,
                    imageWidth: 223,
                    imageHeight: 310,
                    imageAlt: 'Custom image'
                });
            });</script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>