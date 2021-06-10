<?php
require 'functions/functions.php';
session_start();
// Check whether user is logged on or not
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
}
// Establish Database Connection
$conn = connect();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ideal Match</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
</head>
<body>
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">

  <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
    <div class="container">
        <?php include 'includes/navbar.php'; ?>
        <h1>Rchieste di Amicizia</h1>
        <?php
        // Responding to Request
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['accept'])) {
                $sql = "UPDATE friendship
                        SET friendship.friendship_status = 1
                        WHERE friendship.user1_id = {$_GET['id']} AND friendship.user2_id = {$_SESSION['user_id']}";
                $query = mysqli_query($conn, $sql);
                if($query){
                    echo '<div class="userquery">';
                    echo 'Hai accettato ' . $_GET['name'];
                    echo '<br><br>';
                    echo 'Redirecting in 5 seconds';
                    echo '<br><br>';
                    echo '</div>';
                    echo '<br>';
                    header("refresh:5; url=requests.php" );
                }
                else{
                    echo mysqli_error($conn);
                }
            } else if(isset($_GET['ignore'])) {
                $sql6 = "DELETE FROM friendship
                        WHERE friendship.user1_id = {$_GET['id']} AND friendship.user2_id = {$_SESSION['user_id']}";
                $query6 = mysqli_query($conn, $sql6);
                if($query){
                    echo '<div class="userquery">';
                    echo 'You have Ignored ' . $_GET['name'];
                    echo '<br><br>';
                    echo 'Redirecting in 5 seconds';
                    echo '<br><br>';
                    echo '</div>';
                    echo '<br>';
                    header("refresh:5; url=requests.php" );
                }
            }
        }
        //
        ?>
        <?php
        $sql = "SELECT users.user_gender, users.user_id, users.user_nome, users.user_cognome
                FROM users
                JOIN friendship
                ON friendship.user2_id = {$_SESSION['user_id']} AND friendship.friendship_status = 0 AND friendship.user1_id = users.user_id";
        $query = mysqli_query($conn, $sql);
        $width = '168px';
        $height = '168px';
        if(!$query)
            echo mysqli_error($conn);
        if($query){
            if(mysqli_num_rows($query) == 0){
                echo '<div class="userquery">';
                echo 'Non hai richieste di amicizia in sospeso.';
                echo '<br><br>';
                echo '</div>';
            }
            while($row = mysqli_fetch_assoc($query)){
                echo '<div class="userquery">';
                include 'includes/profile_picture.php';
                echo '<br>';
                echo '<a class="profilelink" href="profile.php?id=' . $row['user_id'] .'">' . $row['user_nome'] . ' ' . $row['user_cognome'] . '<a>';
                echo '<form method="get" action="requests.php">';
                echo '<input type="hidden" name="id" value="' . $row['user_id'] . '">';
                echo '<input type="hidden" name="name" value="' . $row['user_nome'] . '">';
                echo '<input type="submit" value="Accept" name="accept">';
                echo '<br><br>';
                echo '<input type="submit" value="Ignore" name="ignore">';
                echo '<br><br>';
                echo'</form>';
                echo '</div>';
                echo '<br>';
            }
        }
        ?>
    </div>
</body>
</html>
