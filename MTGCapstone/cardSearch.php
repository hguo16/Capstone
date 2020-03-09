<?php
include 'cardlist/db.php';
include 'cardlist/functions.php';

$db = getDatabase();

$stmt = $db->prepare("SELECT * FROM magiccards");

$results = array();
if ($stmt->execute() && $stmt->rowCount() > 0) {
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<html>
    <head></head>
    <body>
        <table>
            <tr>
                <th>Card name</th>
                <th>Mana Cost</th>
                <th>Type</th>
                <th>Text</th>
            </tr>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td>
                        <?php echo '<a href="';?>
                        <?php echo $row['magicImageUrl'];?>
                        <?php echo '">';?>
                        <?php echo $row['magicName']; ?>
                        <?php echo '</a>';?>
                    </td>
                    <td><?php echo $row['magicManaCost'];?></td>
                    <td><?php echo $row['magicType'];?></td>
                    <td><?php echo $row['magicText'];?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>