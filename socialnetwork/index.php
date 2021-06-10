<?php
require 'functions/functions.php';
session_start();
if (isset($_SESSION['user_id'])) {
    header("location:home.php");
}
session_destroy();
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Social Network</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
    <style>
        .container{
            margin: 40px auto;
            width: 400px;
        }
        .content {
            padding: 30px;
            background-color: white;
            box-shadow: 0 0 5px #4267b2;
        }
    </style>
</head>
<body>
        <form action="index.php" method="post">
<!--===============================================================================================-->
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
        <div class="tab">
            <button class="tablink active" onclick="openTab(event,'signin')" id="link1">Login</button>
            <button class="tablink" onclick="openTab(event,'signup')" id="link2">Sign Up</button>
        </div>
        <div class="content">
		<form class="login100-form validate-form">
				<span class="login100-form-title p-b-37">
					Ideal Match
				</span>
            <div class="tabcontent" id="signin">
                <form method="post" onsubmit="return validateLogin()">
                    <label>Email<span>*</span></label><br>
                    <input type="text" name="useremail" id="loginuseremail">
                    <div class="required"></div>
                    <br>
                    <label>Password<span>*</span></label><br>
                    <input type="password" name="userpass" id="loginuserpass">
                    <div class="required"></div>
                    <br><br>
                    <div class="container-login100-form-btn">

					<button class="login100-form-btn" <input type="submit" value="Login" name="login">
						Sign In
          </button>

				</div>


				<div class="text-center p-t-57 p-b-20">
					<span class="txt1">
						Oppure accedi con
					</span>
				</div>

        <div class="flex-c p-b-112">
          <a href="login FB/index.php" class="login100-social-item">
            <i class="fa fa-facebook-f"></i>
          </a>

					<a href="https://accounts.google.com/o/oauth2/auth/oauthchooseaccount?response_type=code&redirect_uri=http%3A%2F%2Flocalhost%2Flogin-php%2Fgoogle%2Findex.php&client_id=366125309895-2muvk54p55dkj8hluft9301gii9s22r9.apps.googleusercontent.com&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile%20https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&access_type=offline&approval_prompt=force&flowName=GeneralOAuthFlow" class="login100-social-item">
						<img src="images/icons/icon-google.png" alt="GOOGLE">
					</a>
				</div>
                </form>
            </div>
            <div class="tabcontent" id="signup">
                <form method="post" onsubmit="return validateRegister()">
                    <!--Package One-->
                    <h2>Register</h2>
                    <hr>

					<!--cf-->
                    <label>Codice Fiscale<span>*</span></label><br>
                    <input type="text" name="usercf" id="usercf">
                    <div class="required"></div>
                    <br>
                    <!--First Name-->
                    <label>First Name<span>*</span></label><br>
                    <input type="text" name="usernome" id="usernome">
                    <div class="required"></div>
                    <br>
                    <!--Last Name-->
                    <label>Last Name<span>*</span></label><br>
                    <input type="text" name="usercognome" id="usercognome">
                    <div class="required"></div>
                    <br>
                    <!--Nickname-->
                    <label>Nickname</label><br>
                    <input type="text" name="usernickname" id="usernickname">
                    <div class="required"></div>
                    <br>
					<!--Indirizzo-->
                  <label>Indirizzo</label><br>
                  <input type="text" name="userindirizzo" id="userindirizzo">
                  <div class="required"></div>
                  <br>
				 <!--usercartaidentita-->
                <label>Carta di identità</label><br>
                <input type="text" name="usercartaidentita" id="usercartaidentita">
                <div class="required"></div>
                <br>

                <!--usertel-->

                <label>Telefono</label><br>
                <input type="text" name="usertel" id="usertel">
                <div class="required"></div>
                <br>
				<!--Nazionalità-->

                <label>Nazionalità</label><br>
                <input type="text" name="usernazionalita" id="usernazionalita">
                <div class="required"></div>
                <br>


                    <!--eta-->
                    <label>età<span>*</span></label><br>
                    <input type="text" name="usereta" id="usereta">
                    <div class="required"></div>
                    <br>

					<!--Password-->
                    <label>Password<span>*</span></label><br>
                    <input type="password" name="userpass" id="userpass">
                    <div class="required"></div>
                    <br>
                    <!--Confirm Password-->
                    <label>Confirm Password<span>*</span></label><br>
                    <input type="password" name="userpassconfirm" id="userpassconfirm">
                    <div class="required"></div>
                    <br>
                    <!--Email-->
                    <label>Email<span>*</span></label><br>
                    <input type="text" name="useremail" id="useremail">
                    <div class="required"></div>
                    <br>
                    <!--Birth Date-->
                    Birth Date<span>*</span><br>
                    <select name="selectday">
                    <?php
                    for($i=1; $i<=31; $i++){
                        echo '<option value="'. $i .'">'. $i .'</option>';
                    }
                    ?>
                    </select>
                    <select name="selectmonth">
                    <?php
                    echo '<option value="1">Gennaio</option>';
                    echo '<option value="2">Febbraio</option>';
                    echo '<option value="3">Marzo</option>';
                    echo '<option value="4">Aprile</option>';
                    echo '<option value="5">Mayo</option>';
                    echo '<option value="6">Giugno</option>';
                    echo '<option value="7">Luglio</option>';
                    echo '<option value="8">Agosto</option>';
                    echo '<option value="9">Settembre</option>';
                    echo '<option value="10">Ottobre</option>';
                    echo '<option value="11">Novemebre</option>';
                    echo '<option value="12">Dicembre</option>';
                    ?>
                    </select>
                    <select name="selectyear">
                    <?php
                    for($i=2028; $i>=1900; $i--){
                        if($i == 2003){
                            echo '<option value="'. $i .'" selected>'. $i .'</option>';
                        }
                        echo '<option value="'. $i .'">'. $i .'</option>';
                    }
                    ?>
                    </select>
                    <br><br>
                    <!--Gender-->
                    <input type="radio" name="usergender" value="M" id="malegender" class="usergender">
                    <label>Male</label>
                    <input type="radio" name="usergender" value="F" id="femalegender" class="usergender">
                    <label>Female</label>
                    <div class="required"></div>
                    <br>
                    <!--Hometown-->
                    <label>Hometown</label><br>
                    <input type="text" name="userhometown" id="userhometown">
                    <br>
					<!--Tipo-->
                    <input type="radio" name="usertipo" value="C" id="clientegender" class="usertipo">
                    <label>Cliente</label>
                    <input type="radio" name="usertipo" value="L" id="lavoratoregender" class="usertipo">
                    <label>Lavoratore</label>
                    <div class="required"></div>
                    <br>







                    <!--Package Two-->
                    <h2>Si sei un Lavoratore</h2>
                    <hr>
                    <!--Marital Status-->
                    <input type="radio" name="userstatus" value="S" id="singlestatus">
                    <label>Single</label>
                    <input type="radio" name="userstatus" value="E" id="engagedstatus">
                    <label>Engaged</label>
                    <input type="radio" name="userstatus" value="M" id="marriedstatus">
                    <label>Married</label>
                    <br><br>
					 <!--colOcc-->
                  <label>colOcc<span>*</span></label><br>
                  <input type="text" name="usercolocc" id="usercolocc">
                  <div class="required"></div>
                  <br>

				   <!--altezza-->
                  <label>altezza<span>*</span></label><br>
                  <input type="text" name="useraltezza" id="useraltezza">
                  <div class="required"></div>
                  <br>
				  <!--peso-->
                  <label>Peso<span>*</span></label><br>
                  <input type="text" name="userpeso" id="userpeso">
                  <div class="required"></div>
                  <br>
				   <!--tipoCap-->
                  <label>tipoCap<span>*</span></label><br>
                  <input type="text" name="usertipocap" id="usertipocap">
                  <div class="required"></div>
                  <br>
				  <!--colcap-->
                  <label>colCap<span>*</span></label><br>
                  <input type="text" name="usercolcap" id="usercolcap">
                  <div class="required"></div>
                  <br>


                    <!--About Me-->
                    <label>About Me</label><br>
                    <textarea rows="12" name="userabout" id="userabout"></textarea>
                    <br><br>
                    <input type="submit" value="Create Account" name="register">
                </form>
            </div>
        </div>
    </div>
    <script src="resources/js/main.js"></script>
</body>
</html>

<?php
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // A form is posted
    if (isset($_POST['login'])) { // Login process
        $useremail = $_POST['useremail'];
        $userpass = md5($_POST['userpass']);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE user_email = '$useremail' AND user_password = '$userpass'");
        if($query){
            if(mysqli_num_rows($query) == 1) {
                $row = mysqli_fetch_assoc($query);
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_nome'] . " " . $row['user_cognome'];
                header("location:home.php");
            }
            else {
                ?> <script>
                    document.getElementsByClassName("required")[0].innerHTML = "Invalid Login Credentials.";
                    document.getElementsByClassName("required")[1].innerHTML = "Invalid Login Credentials.";
                </script> <?php
            }
        } else{
            echo mysqli_error($conn);
        }
    }
    if (isset($_POST['register'])) { // Register process
        // Retrieve Data
		$usercf = $_POST['usercf'];
        $usernome = $_POST['usernome'];
        $usercognome = $_POST['usercognome'];
		$userindirizzo = $_POST['userindirizzo'];
		$usercartaidentita = $_POST['usercartaidentita'];
		$usernazionalita = $_POST['usernazionalita'];


        $usertel = $_POST['usertel'];
		$usereta = $_POST['usereta'];
        $usernickname = $_POST['usernickname'];
        $userpassword = md5($_POST['userpass']);
        $useremail = $_POST['useremail'];
        $userbirthdate = $_POST['selectyear'] . '-' . $_POST['selectmonth'] . '-' . $_POST['selectday'];
        $usergender = $_POST['usergender'];
        $userhometown = $_POST['userhometown'];
		$usertipo = $_POST['usertipo'];
		$usercolcap = $_POST['usercolcap'];
		$usercolocc = $_POST['usercolocc'];
		$useraltezza = $_POST['useraltezza'];
		$userpeso = $_POST['userpeso'];
		$usertipocap = $_POST['usertipocap'];
        $userabout = $_POST['userabout'];
        if (isset($_POST['userstatus'])){
            $userstatus = $_POST['userstatus'];
        }
        else{
            $userstatus = NULL;
        }
        // Check for Some Unique Constraints
        $query = mysqli_query($conn, "SELECT user_nickname, user_email FROM users WHERE user_nickname = '$usernickname' OR user_email = '$useremail'");
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            if($usernickname == $row['user_nickname'] && !empty($usernickname)){
                ?> <script>
                document.getElementsByClassName("required")[4].innerHTML = "This Nickname already exists.";
                </script> <?php
            }
            if($useremail == $row['user_email']){
                ?> <script>
                document.getElementsByClassName("required")[7].innerHTML = "This Email already exists.";
                </script> <?php
            }
        }
        // Insert Data
        $sql = "INSERT INTO users(user_cf,user_nome, user_cognome,user_indirizzo,user_cartaidentita,user_nazionalita,user_tel,user_eta, user_nickname, user_password, user_email, user_gender, user_birthdate, user_status, user_about, user_hometown, user_tipo,user_colcap, user_colocc, user_altezza,user_peso,user_tipocap)
                VALUES ('$usercf','$usernome', '$usercognome','$userindirizzo','$usercartaidentita','$usernazionalita','$usertel','$usereta', '$usernickname', '$userpassword', '$useremail', '$usergender', '$userbirthdate', '$userstatus', '$userabout', '$userhometown', '$usertipo', '$usercolcap','$usercolocc','$useraltezza','$userpeso','$usertipocap' )";
        $query = mysqli_query($conn, $sql);
        if($query){
            $query = mysqli_query($conn, "SELECT user_id FROM users WHERE user_email = '$useremail'");
            $row = mysqli_fetch_assoc($query);
            $_SESSION['user_id'] = $row['user_id'];
            header("location:home.php");
        }
    }
}
?>
