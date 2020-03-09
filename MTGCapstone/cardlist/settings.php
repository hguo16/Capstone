<!DOCTYPE html>
<?php
session_start();
include 'cardlist/db.php';
include 'cardlist/functions.php';

$db = getDatabase();
$id = $_SESSION['login'];
$results = "";

if ($_POST) {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $cpassword = filter_input(INPUT_POST, 'cpassword');
    $submit = filter_input(INPUT_POST, 'submit');

    if ($submit) {
        if (empty($username) || empty($password)) {
            $results = "Please fill in all fields!";
        } else {
            if ($password == $cpassword) {
                if (isPostRequest()) {
                    $db = getDatabase();

                    $stmt = $db->prepare("UPDATE accounts SET name = :name, username = :username, password = :password WHERE id = :id");

                    $name = filter_input(INPUT_POST, 'name');
                    $username = filter_input(INPUT_POST, 'username');
                    $password = filter_input(INPUT_POST, 'password');

                    $binds = array(
                        ":name" => $name,
                        ":username" => $username,
                        ":password" => $password
                    );

                    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                        header("location: home.php");
                    }
                }
            } else {
                $results = "Passwords do not match";
            }
        }
    }
} else {
    $stmt = $db->prepare("SELECT * FROM accounts WHERE id = $id");

    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body class="body">
        <form class="center" method="post" action="#">
            <div style="margin:1%;"><br/><br/>
                Name</br><input type="text" name="name"/><br/><br/>
                Email<br/><input type="text" name="username"/><br/><br/>
                New Password<br/><input type="password" name="password"/><br/><br/>
                Confirm Password<br/><input type="password" name="cpassword"/><br/><br/>
                <input type="submit" name="submit"><br/><br/>
        </form>
        <?php echo $results; ?>
        <input 

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
