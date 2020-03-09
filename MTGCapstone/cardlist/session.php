<!--help from https://www.tutorialspoint.com/php/php_mysql_login.htm -->
<?php
   include('db.php');
   session_start();
   
   $user_check = $_SESSION['login'];
   
   $ses_sql = mysqli_query($db,"select username from accounts where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:SignIn.php");
      die();
   }
?>