<?php
require 'functions/functions.php';
session_start();
ob_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
}

$conn = connect();
?>

<?php
if(isset($_GET['id']) && $_GET['id'] != $_SESSION['user_id']) {
    $current_id = $_GET['id'];
    $flag = 1;
} else {
    $current_id = $_SESSION['user_id'];
    $flag = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ideal Match</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
    <style>
    .post{
        margin-right: 100px;
        float: right;
        margin-bottom: 18px;
    }
    .profile{
        margin-left: 50px;
        background-color: white;
        box-shadow: 0 0 5px #4267b2;
        width: 220px;
        padding: 20px;
    }
    input[type="file"]{
        display: none;
    }
    label.upload{
        cursor: pointer;
        color: white;
        background-color: #4267b2;
        padding: 8px 12px;
        display: inline-block;
        max-width: 80px;
        overflow: auto;
    }
    label.upload:hover{
        background-color: #23385f;
    }
    .changeprofile{
        color: #23385f;
        font-family: Fontin SmallCaps;
    }
    </style>
</head>
<body>

<!--===============================================================================================-->

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
        <h1>Profilo</h1>
        <div class="createpost">
            <form method="post" action="" onsubmit="return validatePost()" enctype="multipart/form-data">
                <h2>Make Post</h2>
                <hr>
                <span style="float:right; color:black">
                <input type="checkbox" id="public" name="public">
                <label for="public">Public</label>
                </span>
                Caption <span class="required" style="display:none;"> *You can't Leave the Caption Empty.</span><br>
                <textarea rows="6" name="caption"></textarea>
                <center><img src="" id="preview" style="max-width:580px; display:none;"></center>
                <div class="createpostbuttons">
                    <!--<form action="" method="post" enctype="multipart/form-data" id="imageform">-->

                    <input type="submit" value="Post" name="post">
                    <!--</form>-->
                </div>
            </form>
        </div>

        <?php
        $postsql;
        if($flag == 0) {
            $postsql = "SELECT posts.post_caption, posts.post_time, users.user_nome, users.user_cognome,
                                posts.post_public, users.user_id, users.user_gender, users.user_nickname,
                                users.user_birthdate, users.user_hometown, users.user_status, users.user_about,
                                posts.post_id
                        FROM posts
                        JOIN users
                        ON users.user_id = posts.post_by
                        WHERE posts.post_by = $current_id
                        ORDER BY posts.post_time DESC";
            $profilesql = "SELECT users.user_id, users.user_gender, users.user_hometown, users.user_status, users.user_birthdate,
                                 users.user_nome, users.user_cognome
                          FROM users
                          WHERE users.user_id = $current_id";
            $profilequery = mysqli_query($conn, $profilesql);
        } else {
            $profilesql = "SELECT users.user_id, users.user_gender, users.user_hometown, users.user_status, users.user_birthdate,
                                    users.user_nome, users.user_cognome, userfriends.friendship_status
                            FROM users
                            LEFT JOIN (
                                SELECT friendship.user1_id AS user_id, friendship.friendship_status
                                FROM friendship
                                WHERE friendship.user1_id = $current_id AND friendship.user2_id = {$_SESSION['user_id']}
                                UNION
                                SELECT friendship.user2_id AS user_id, friendship.friendship_status
                                FROM friendship
                                WHERE friendship.user1_id = {$_SESSION['user_id']} AND friendship.user2_id = $current_id
                            ) userfriends
                            ON userfriends.user_id = users.user_id
                            WHERE users.user_id = $current_id";
            $profilequery = mysqli_query($conn, $profilesql);
            $row = mysqli_fetch_assoc($profilequery);
            mysqli_data_seek($profilequery,0);
            if(isset($row['friendship_status'])){
                if($row['friendship_status'] == 1){
                    $postsql = "SELECT posts.post_caption, posts.post_time, users.user_nome, users.user_cognome,
                                        posts.post_public, users.user_id, users.user_gender, users.user_nickname,
                                        users.user_birthdate, users.user_hometown, users.user_status, users.user_about,
                                        posts.post_id
                                FROM posts
                                JOIN users
                                ON users.user_id = posts.post_by
                                WHERE posts.post_by = $current_id
                                ORDER BY posts.post_time DESC";
                }
                else if($row['friendship_status'] == 0){
                    $postsql = "SELECT posts.post_caption, posts.post_time, users.user_nome, users.user_cognome,
                                        posts.post_public, users.user_id, users.user_gender, users.user_nickname,
                                        users.user_birthdate, users.user_hometown, users.user_status, users.user_about,
                                        posts.post_id
                                FROM posts
                                JOIN users
                                ON users.user_id = posts.post_by
                                WHERE posts.post_by = $current_id AND posts.post_public = 'Y'
                                ORDER BY posts.post_time DESC";
                }
            } else {
                $postsql = "SELECT posts.post_caption, posts.post_time, users.user_nome, users.user_cognome,
                                    posts.post_public, users.user_id, users.user_gender, users.user_nickname,
                                    users.user_birthdate, users.user_hometown, users.user_status, users.user_about,
                                    posts.post_id
                            FROM posts
                            JOIN users
                            ON users.user_id = posts.post_by
                            WHERE posts.post_by = $current_id AND posts.post_public = 'Y'
                            ORDER BY posts.post_time DESC";
            }
        }
        $postquery = mysqli_query($conn, $postsql);
        if($postquery){


            $width = '40px';
            $height = '40px';
            if(mysqli_num_rows($postquery) == 0){
                if($flag == 0){
                    echo '<div class="post">';
                    echo 'Non hai ancora nessun post';
                    echo '</div>';
                } else {
                    echo '<div class="post">';
                    echo 'There is no public posts to show.';
                    echo '</div>';
                }
                include 'includes/profile.php';
            } else {
                while($row = mysqli_fetch_assoc($postquery)){
                    include 'includes/post.php';
                }
                include 'includes/profile.php';
                ?>
                <br>
                <?php if($flag == 0){?>
                <div class="profile">
                    <center class="changeprofile">Cambia immagine del profilo</center>
                    <br>
                    <form action="" method="post" enctype="multipart/form-data">
                        <center>
                            <label class="upload" onchange="showPath()">
                                <span id="path" style="color: white;">... Browse</span>
                                <input type="file" name="fileUpload" id="selectedFile">
                            </label>
                        </center>
                        <br>
                        <input type="submit" value="Carica" name="profile">
                    </form>
                </div>
                <br>
                <div class="profile">
                    <center class="changeprofile">Aggiungi Numero</center>
                    <br>
                    <form method="post" onsubmit="return validateNumber()">
                        <center>
                            <input type="text" name="number" id="phonenum">
                            <div class="required"></div>
                            <br>
                            <input type="submit" value="Submit" name="phone">
                        </center>
                    </form>
                </div>
                <br>
                <?php } ?>
                <?php
            }
        }
        ?>
    </div>
</body>
<script>
function showPath(){
    var path = document.getElementById("selectedFile").value;
    path = path.replace(/^.*\\/, "");
    document.getElementById("path").innerHTML = path;
}
function validateNumber(){
    var number = document.getElementById("phonenum").value;
    var required = document.getElementsByClassName("required");
    if(number == ""){
        required[0].innerHTML = "You must type Your Number.";
        return false;
    } else if(isNaN(number)){
        required[0].innerHTML = "Phone Number must contain digits only."
        return false;
    }
    return true;
}
</script>
</html>
<?php include 'functions/upload.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['request'])) {
        $sql3 = "INSERT INTO friendship(user1_id, user2_id, friendship_status)
                 VALUES ({$_SESSION['user_id']}, $current_id, 0)";
        $query3 = mysqli_query($conn, $sql3);
        if(!$query3){
            echo mysqli_error($conn);
        }
    } else if(isset($_POST['remove'])) {
        $sql3 = "DELETE FROM friendship
                 WHERE ((friendship.user1_id = $current_id AND friendship.user2_id = {$_SESSION['user_id']})
                 OR (friendship.user1_id = {$_SESSION['user_id']} AND friendship.user2_id = $current_id))
                 AND friendship.friendship_status = 1";
        $query3 = mysqli_query($conn, $sql3);
        if(!$query3){
            echo mysqli_error($conn);
        }
    } else if(isset($_POST['phone'])) {
        $sql3 = "INSERT INTO user_phone(user_id, user_phone) VALUES ({$_SESSION['user_id']},{$_POST['number']})";
        $query3 = mysqli_query($conn, $sql3);
        if(!$query3){
            echo mysqli_error($conn);
        }
    }
    sleep(4);
}
?>


<br><br><br>
</div>
<script src="resources/js/jquery.js"></script>
<script>
$(document).ready(function(){
    $('#imagefile').change(function(){
        preview(this);
    });
});
function preview(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (event){
            $('#preview').attr('src', event.target.result);
            $('#preview').css('display', 'initial');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
// Form Validation
function validatePost(){
    var required = document.getElementsByClassName("required");
    var caption = document.getElementsByTagName("textarea")[0].value;
    required[0].style.display = "none";
    if(caption == ""){
        required[0].style.display = "initial";
        return false;
    }
    return true;
}
</script>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {

$caption = $_POST['caption'];
if(isset($_POST['public'])) {
$public = "Y";
} else {
$public = "N";
}
$poster = $_SESSION['user_id'];

$sql = "INSERT INTO posts (post_caption, post_public, post_time, post_by)
    VALUES ('$caption', '$public', NOW(), $poster)";
$query = mysqli_query($conn, $sql);

if($query){

header("location: home.php");
}
}
?>
