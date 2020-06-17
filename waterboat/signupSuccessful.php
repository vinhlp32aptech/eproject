<?php
$connect = mysqli_connect('localhost','C1908I1','C1908I1','eproject');
mysqli_set_charset($connect,"utf8");
session_start();
?>
<?php
if(isset($_POST['dangky'])){
    $user_name = $_POST["user_name"];
    $pass1 = $_POST["pass1"];
    $pass2 = $_POST["pass2"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];



    if($pass1!=$pass2){
        header("location:signup.php?page=dangky");

    }
    else{
        $pass = md5($pass1);
        mysqli_query($connect,"
                                        insert into account (user_name,password,email,phone)
                                        values ('$user_name','$pass','$email','$phone')
                                    ");

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Sign Up</title>

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

</head>
<body>

		<div class="header-w3l">
			<h1>Welcome to the yacht world</h1>
		</div>

		<div class="main-w3layouts-agileinfo" id="link_signin">

						<div class="wthree-form">
							<h2> Sign Up Successful.  <a href="signin.php"  >Back to Sign In</a></h2>
							</div>
                    	</div>






</body>
</html>

