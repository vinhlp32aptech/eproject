<?php
session_start();
include_once "conn/Pagination.php";
include_once "conn/database.php";
$db = new database();

if(isset($_GET['about'])):
    $_SESSION['about'] = 'active';
    session_destroy();

elseif(isset($_GET['service'])):
    $_SESSION['service'] = 'active';
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

if (isset($_COOKIE['gotoindex']) || isset($_SESSION['account'])):

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="css/style.css">



</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">



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
                                <span class="icon-location-arrow text-primary"></span>
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
                                <span class="icon-envelope text-primary"></span>
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
                                    <li class="<?= isset($_SESSION['service'])? $_SESSION['service'] : '' ;?>">
                                        <a href="services.php?service" class="nav-link text-left">Services</a>
                                    </li>
                                    <li class="<?= isset($_SESSION['gallery'])? $_SESSION['gallery'] : '' ;?>">
                                        <a href="Gallery.php?gallery" class="nav-link text-left">Gallery</a>
                                    </li>
                                    <li class="<?= isset($_SESSION['contact'])? $_SESSION['contact'] : '' ;?>">
                                        <a href="contact.php?contact" class="nav-link text-left">Contact</a>
                                    </li>
                                    <?php

                                    if(isset($_COOKIE['gotoindex'])):?>
                                        <li class="<?= isset($_SESSION['account'])? $_SESSION['account'] : '' ;?>">
                                            <a href="account.php?account" class="nav-link text-left">Account</a>
                                        </li>
                                        <li>
                                            <a href="signin.php?logout" class="nav-link text-left">Log out</a>
                                        </li>
                                    <?php else:?>
                                        <li>
                                            <a href="signin.php" class="nav-link text-left" id="signinV">Sign-in/</a>
                                            <a href="signup.php" class="nav-link text-left" id="signupV">Sign-up</a>
                                        </li>
                                    <?php endif;?>


                                    <li>
                                        <form action="Lease.php" id="demo-2">
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
        <div class="intro-section" style="background-image: url('images/hero_2.jpg');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
                        <h1>Blog Posts</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, in distinctio nostrum laborum sed quisquam voluptate facilis non.</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-5 mb-lg-5 col-lg-4">
                        <div class="blog-entry">
                            <a href="blog-single.php" class="img-link">
                                <img src="images/hero_1.jpg" alt="Image" class="img-fluid">
                            </a>
                            <div class="blog-entry-contents">
                                <h3><a href="#">Consectetur Adipisicing Elit Expedita Beatea</a></h3>
                                <div class="meta">Posted by <a href="#">Admin</a> In <a href="#">News</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5 mb-lg-5 col-lg-4">
                        <div class="blog-entry">
                            <a href="blog-single.php" class="img-link">
                                <img src="images/hero_1.jpg" alt="Image" class="img-fluid">
                            </a>
                            <div class="blog-entry-contents">
                                <h3><a href="#">Consectetur Adipisicing Elit Expedita Beatea</a></h3>
                                <div class="meta">Posted by <a href="#">Admin</a> In <a href="#">News</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5 mb-lg-5 col-lg-4">
                        <div class="blog-entry">
                            <a href="blog-single.php" class="img-link">
                                <img src="images/hero_1.jpg" alt="Image" class="img-fluid">
                            </a>
                            <div class="blog-entry-contents">
                                <h3><a href="#">Consectetur Adipisicing Elit Expedita Beatea</a></h3>
                                <div class="meta">Posted by <a href="#">Admin</a> In <a href="#">News</a></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-5 mb-lg-5 col-lg-4">
                        <div class="blog-entry">
                            <a href="blog-single.php" class="img-link">
                                <img src="images/hero_1.jpg" alt="Image" class="img-fluid">
                            </a>
                            <div class="blog-entry-contents">
                                <h3><a href="#">Consectetur Adipisicing Elit Expedita Beatea</a></h3>
                                <div class="meta">Posted by <a href="#">Admin</a> In <a href="#">News</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5 mb-lg-5 col-lg-4">
                        <div class="blog-entry">
                            <a href="blog-single.php" class="img-link">
                                <img src="images/hero_1.jpg" alt="Image" class="img-fluid">
                            </a>
                            <div class="blog-entry-contents">
                                <h3><a href="#">Consectetur Adipisicing Elit Expedita Beatea</a></h3>
                                <div class="meta">Posted by <a href="#">Admin</a> In <a href="#">News</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5 mb-lg-5 col-lg-4">
                        <div class="blog-entry">
                            <a href="blog-single.php" class="img-link">
                                <img src="images/hero_1.jpg" alt="Image" class="img-fluid">
                            </a>
                            <div class="blog-entry-contents">
                                <h3><a href="#">Consectetur Adipisicing Elit Expedita Beatea</a></h3>
                                <div class="meta">Posted by <a href="#">Admin</a> In <a href="#">News</a></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row text-center mt-5">
                    <div class="col-12">
                        <a href="#" class="p-3 d-inline-block">1</a>
                        <a href="#" class="p-3 d-inline-block">2</a>
                        <span class="p-3 d-inline-block text-black">3</span>
                        <a href="#" class="p-3 d-inline-block">4</a>
                        <a href="#" class="p-3 d-inline-block">5</a>
                    </div>
                </div>
            </div>
        </div>



        <?php include_once "public/footer.php" ?>


    </div>
    <!-- .site-wrap -->

    <?php else:
        header('location: index.php');
    endif;?>

  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/></svg></div>

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