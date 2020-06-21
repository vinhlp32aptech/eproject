<?php
session_start();

if(isset($_SESSION['a'])):
    echo $_SESSION['a'];
endif;