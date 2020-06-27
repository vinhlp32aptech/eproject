<?php
session_start();
include_once "../conn/database.php";
$db = new database();

if (isset($_GET['signout'])):
    session_destroy();
endif;

if (isset($_POST['login'])):

    $username = trim($_POST['user_name']);
    $password = trim($_POST['password']);

    $query = "select user_name,password from account where user_name = :user_name && admin = 1 ";
    $param = [
        "user_name" => $username,
    ];

    $stmt = $db->selectdataparam($query, $param);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($account > 0):
        $_SESSION['gotoadmin'] = $account['user_name'];
        if ($username === $account['user_name'] && $password === $account['password']):
            header('location: admin.php?product');
        else:
            if ($password === $account['password']):

                header('location: admin.php?product');

            else:
                $_SESSION['passwordwrong'] = "password is wrong";
                session_destroy();
            endif;
        endif;
    elseif ($_POST['user_name'] === '' || $_POST['user_name'] === ''):
        $_SESSION['usernameorpasswordwrong'] = "Please fill in fields";
        session_destroy();

    else:
        $_SESSION['usernamewrong'] = "Username is wrong";
        session_destroy();
    endif;
endif;

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
        <form action="signinad.php" method="post" enctype="multipart/form-data">
            <span><?= isset($_SESSION['usernameorpasswordwrong']) ? $_SESSION['usernameorpasswordwrong'] : ""; ?></span><br/><br/>

            <input type="text" name="user_name" value="" placeholder="Username" required=""/>
            <span><?= isset($_SESSION['usernamewrong']) ? $_SESSION['usernamewrong'] : ""; ?></span><br/><br/>

            <input type="password" name="password" value="" placeholder="Password" required=""/>
            <span><?= isset($_SESSION['passwordwrong']) ? $_SESSION['passwordwrong'] : ""; ?></span><br/><br/>

            <button type="submit" name="login">Signin</button>
        </form>
    </div>
</div>
<script src="../js/signinwithad.js"></script>
</body>
</html>