<?php
session_start();
include_once "conn/Pagination.php";
include_once "conn/database.php";
$db = new database();

if(isset($_GET['about'])):
    $_SESSION['about'] = 'active';
    session_destroy();

elseif(isset($_GET['services'])):
    $_SESSION['services'] = 'active';
    session_destroy();

elseif(isset($_GET['gallery'])):
    $_SESSION['gallery'] = 'active';
    session_destroy();

elseif(isset($_GET['contact'])):
    $_SESSION['contact'] = 'active';
    session_destroy();

elseif(isset($_GET['account'])):
    $_SESSION['account'] = 'active';
    session_destroy();
else:
    $_SESSION['index'] = 'active';
    session_destroy();
endif;

?>


<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>
<div class="header-top bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 col-lg-3">
                <a href="index.php">
                    <img src="images/logo.png" alt="Image" class="img-fluid">
                    <!-- <strong>Water</strong>Boat -->
                </a>
            </div>
            <div class="col-lg-3 d-none d-lg-block">

                <div class="quick-contact-icons d-flex">
                    <div class="icon align-self-start">
                        <a href="https://goo.gl/maps/tuMx4DfevqNAwpDa7"><span class="icon-location-arrow text-primary"></span></a>
                    </div>
                    <div class="text">
                        <span class="h4 d-block">Viet Nam</span>
                        <span class="caption-text"> District 3, HCM City</span>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 d-none d-lg-block">
                <div class="quick-contact-icons d-flex">
                    <div class="icon align-self-start">
                        <span class="icon-phone text-primary"></span>
                    </div>
                    <div class="text">
                        <span class="h4 d-block">0912345678</span>
                        <span class="caption-text">Toll free</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 d-none d-lg-block">
                <div class="quick-contact-icons d-flex">
                    <div class="icon align-self-start">
                        <a href="contact.php"> <span class="icon-envelope text-primary"></span></a>
                    </div>
                    <div class="text">
                        <span class="h4 d-block">marinafleet@gmail.com</span>
                        <span class="caption-text">Our mail</span>
                    </div>
                </div>
            </div>

            <div class="col-6 d-block d-lg-none text-right">
                <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                        class="icon-menu h3"></span></a>
            </div>
        </div>
    </div>


    <div class="site-navbar js-sticky-header site-navbar-target d-none pl-0 d-lg-block" role="banner">

        <div class="container">
            <div class="d-flex align-items-center">

                <div class="mx-auto">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu main-menu js-clone-nav mr-auto d-none pl-0 d-lg-block">
                            <li class="<?= isset($_SESSION['index'])? $_SESSION['index'] : '' ;?>">
                                <a href="index.php?index" class="nav-link text-left">Home</a>
                            </li>
                            <li class="<?= isset($_SESSION['about'])? $_SESSION['about'] : '' ;?>">
                                <a href="about.php?about" class="nav-link text-left">About Us</a>
                            </li>
                            <li class="<?= isset($_SESSION['services'])? $_SESSION['services'] : '' ;?>">
                                <a href="services.php?services" class="nav-link text-left">Services</a>
                            </li>
                            <li class="<?= isset($_SESSION['gallery'])? $_SESSION['gallery'] : '' ;?>">
                                <a href="Gallery.php?gallery" class="nav-link text-left">Gallery</a>
                            </li>
                            <li class="<?= isset($_SESSION['contact'])? $_SESSION['contact'] : '' ;?>">
                                <a href="contact.php?contact" class="nav-link text-left">Contact</a>
                            </li>
                            <?php

                            if(isset($_COOKIE['gotoindex'])):?>
                                <li class="<?= isset($_SESSION['account'])? $_SESSION['account'] : '' ;?> nav-item dropdown" >
                                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Account</a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="nav-link text-left" style="color:black" href="account.php?account">Profile</a><br>
                                        <a class="nav-link text-left" style="color:black"href="cart.php?account">Cart</a><br>
                                        <a class="nav-link text-left" style="color:black"href="purchase.php?account">
                                            Purchase history</a><br>
                                        <a href="signin.php?logout" class="nav-link text-left" style="color:black">Log out</a>
                                    </div>

                                </li>

                            <?php else:?>
                            <li>
                                <a href="signin.php" class="nav-link text-left" id="signinV">Sign-in/</a>
                                <a href="signup.php" class="nav-link text-left" id="signupV">Sign-up</a>
                            </li>
                            <?php endif;?>


                            <li>
                                <form action="showproduct.php" id="demo-2">
                                    <input type="search" name="search" placeholder="Search">
                                </form>
                            </li>

                        </ul>
                    </nav>

                </div>

            </div>
        </div>

    </div>

</div>


<div class=" to-top-btn hidden-xs hidden-sm">
</div>