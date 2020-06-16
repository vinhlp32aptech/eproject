<?php
session_start();


$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
    if ($username == 'admin' && $password == '123') {
        $_SESSION['user'] = $username;

        header('location: indexAd.php');
    } else {
        echo "<p>Incorrect username and password </P> ";
        require "SigninwithAd.php";
    }

?>
