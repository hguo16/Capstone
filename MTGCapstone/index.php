<!DOCTYPE html>
<?php
include 'cardlist/db.php';
include 'cardlist/functions.php';

$db = getDatabase();
$id = filter_input(INPUT_GET, 'id');

$results = "";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body class="body">
        <div class="header" style="text-align: center;">
            <p class="welcome">Welcome to MTG Decklists</p>
            <p class="info">This is a decklist website for the cardgame Magic the Gathering</p>
        </div>

        <form class="center" method="post" action="#">
            <div style="margin:1%;"><br/><br/>
                Name</br><input type="text" name="name"/><br/><br/>
                Email<br/><input type="text" name="username"/><br/><br/>
                Password<br/><input type="password" name="password"/><br/><br/>
                Confirm Password<br/><input type="password" name="cpassword"/><br/><br/>
                <input type="submit" name="submit"><br/><br/>
        </form>
        <?php
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

                        $stmt = $db->prepare("INSERT INTO accounts SET name = :name, username = :username, password = :password");

                        $name = filter_input(INPUT_POST, 'name');
                        $username = filter_input(INPUT_POST, 'username');
                        $password = filter_input(INPUT_POST, 'password');

                        $binds = array(
                            ":name" => $name,
                            ":username" => $username,
                            ":password" => $password
                        );

                        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                            header("location: SignIn.php");
                        }
                    }
                } else {
                    $results = "Passwords do not match";
                }
            }
        }
        ?>

        <?php echo $results; ?><br/><br/>
        Already have an account?<br/>
        <div class="btn">
            <a href="SignIn.php">Sign in</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
