<?php

 $emailErr = $textErr = "";
 $email = $text = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["username"])) {
        $usernameErr = "Please enter you username :(";
    } else {
        $username = test_input($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Please enter  password :(";
    } else {
        $password = test_input($_POST["password"]);
    }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/signinwithad.css">
    <title>Signin With Admin</title>
</head>
<body>
<div class="login-page">
  <div class="form">
    <form  action="SigninwithAd2.php" method="post">
      <input type="text" name="username" value="<?php if(isset($username)) echo $username ;?>" placeholder="Username"/>
      <input type="password" name="password" value="<?php if(isset($password)) echo $password ;?>" placeholder="Password"/>
      <button type="submit" name="login" >Signin</button>
    </form>
  </div>
</div>
<script src="../js/signinwithad.js"></script>
</body>
</html>