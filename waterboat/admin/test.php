<?php
session_start();
$_SESSION['a'] = 'kkk';

if(isset($_SESSION['product'])):
    echo $_SESSION['product'];
endif;