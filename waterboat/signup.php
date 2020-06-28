<?php
session_start();

include_once "conn/database.php";
$db = new database();
//insert data


if (isset($_POST['signup'])):


$username = trim($_POST['user_name']);
$password = trim($_POST['password']);

$query = "select user_name from account where user_name=:user_name ";
$param = [
        "user_name"     =>$username,
];
$stmt = $db->selectdataparam($query,$param);
$countacc = $stmt->rowCount();
    if ($countacc > 0):
        echo "<script> alert('Account already exists!')</script>";

    else:
        $query = "insert into account( user_name, password, email, phone) values(:user_name, :password, :email, :phone)";
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $param = [
            "user_name" => $_POST['user_name'],
            "password" => $hash,
            "email" => $_POST['email'],
            "phone" => $_POST['phone']
        ];
        $stmt = $db->insertdataparam($query, $param);
        echo "<script> alert('Sign up Successful. Please Sign in!')</script>";

    endif;
    endif;
//insert data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign up</title>
    <link rel="icon" href="images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords"
          content="Glassy Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>

    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/login.css" type="text/css" media="all"/>

    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Dancing+Script:400,700|Muli:300,400"
          rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">
    <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#signup").click(function () {
                var password = $("#password").val();
                var confirmPassword = $("#confirmpass").val();
                if (password != confirmPassword) {
                    alert("Passwords do not match!");
                    return false;
                }
                return true;
            });
            $("#signup").click(function () {
                var email = document.getElementById('email');
                var filter =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (!filter.test(email.value)) {
                    alert('Email is not valid!.\nExample@gmail.com');
                    email.focus();
                    return false;
                }
                return true;
            });
        });
    </script>

</head>
<body>

<div class="header-w3l">
</div>

<div class="main-w3layouts-agileinfo">

    <div class="wthree-form">
        <br>
        <h2> Create an account </h2>


        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-sub-w3">
                <input type="text" name="user_name" placeholder="Username" required=""/>
                <div class="icon-w3">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
            </div>
            <div class="form-sub-w3">
                <input required type="password" name="password" id="password" placeholder="Password" required=""/>

                <div class="icon-w3">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                </div>
            </div>

            <div class="form-sub-w3">
                <input required type="password" id="confirmpass" placeholder="Confirm password" required=""/>

                <div class="icon-w3">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                </div>
            </div>

            <div class="clear"></div>
            <div class="form-sub-w3">
                <input id="email" name="email" placeholder="Email" class="form-control here" required="required"
                       type="text">
                <div class="icon-w3">
                    <i class="fas fa-envelope-square" aria-hidden="true"></i>
                </div>
            </div>
            <div class="form-sub-w3">
                <input type="text" name="phone" placeholder="Phone Number" maxlength="11" required=""/>
                <div class="icon-w3">
                    <i class="fas fa-phone-square" aria-hidden="true"></i>
                </div>
            </div>
            <div class="clear"></div>
            <div class="submit-agileits">
                <input type="submit" name="signup" id="signup" value="Sign Up">
            </div>
        </form>
        <div class="submit-agileits " id="link_signin" style="color: white;">
            Do you already have an account?
            <a href="Signin.php">Signin now ! </a>
        </div>

    </div>

</div>

</div>


<script src="js/editimage.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/jquery.mb.YTPlayer.min.js"></script>


<script src="js/main.js"></script>
</body>
</html>
