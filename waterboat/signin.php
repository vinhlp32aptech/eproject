<?php
session_start();
?>

<?php

include_once "conn/database.php";
$db = new database();

if(isset($_GET['logout'])):
    setcookie('gotoindex','',time()-86400);
endif;

if(isset($_POST['signin'])):

    $username = trim($_POST['user_name']);
    $password = trim($_POST['password']);

    $query = "select user_name,password from account where user_name = :user_name";
    $param=[
        "user_name" => $username,
    ];

    $stmt = $db->selectdataparam($query, $param);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    if($account > 0):
        setcookie('gotoindex',$account['user_name'],time()+86400);
        if($username === $account['user_name'] && password_verify($password, $account['password'])):
            header('location: index.php');
        else:
            if(password_verify($password, $account['password'])):

                header('location: index.php');

            else:
                $_SESSION['passwordwrong']  = "Password is wrong";
                session_destroy();
            endif;
        endif;
    else:
        $_SESSION['usernamewrong']  = "Username is wrong";
        session_destroy();
    endif;
endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sign in</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glassy Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>

<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/login.css" type="text/css" media="all" />

<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <!-- <link rel="shortcut icon" type="image/jpg" href="images/supercar.jpg" /> -->
 <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Dancing+Script:400,700|Muli:300,400" rel="stylesheet">
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
</head>
<body>
    
		<div class="header-w3l">
		</div>

		<div class="main-w3layouts-agileinfo">

						<div class="wthree-form">
                        <br>
							<h2> Sign in to your account </h2>
							<form action="#" method="post">
                                <div class="form-sub-w3">
									<input type="text" name="user_name"  placeholder="Username " required="" />
                                    <span class="signinwhite"><?= isset($_SESSION['usernamewrong'])?$_SESSION['usernamewrong']: "";?></span>
								<div class="icon-w3">
									<i class="fa fa-user" aria-hidden="true"></i>
								</div>
								</div>
								<div class="form-sub-w3">
									<input type="password" name="password"  placeholder="Password" required="" />
                                    <span class="signinwhite"><?= isset($_SESSION['passwordwrong'])?$_SESSION['passwordwrong']: "";?></span>
								<div class="icon-w3">
									<i class="fa fa-unlock-alt" aria-hidden="true"></i>
								</div>
								</div>
								<label class="anim">
								<input type="checkbox" class="checkbox">
									<span>Remember Me</span> 
									<a href="ForgotPassword.php">Forgot Password</a><br>
                                    
								</label> 
								<div class="clear"></div>
								<div class="submit-agileits">
									<input type="submit" value="Sign in" name="signin">
								</div>

							</form>
                                <div class="submit-agileits">
                                <h5><a style="color:#00c6d7;" href="signup.php">Sign up</a></h5>
                                </div>
		
						</div>
                    </div>

	
			
       

		

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
