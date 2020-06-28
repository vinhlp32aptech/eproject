<?php
include_once "conn/database.php";
include_once "conn/Pagination.php";

$db = new database();

$query = "select * from product where status = 1 order by quantity_pro limit 9 ";
$stmt = $db->selectdata($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="icon" href="images/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/aos.css">
    <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/hotline.css">
    <link rel="stylesheet" href="css/layout.css">


</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

<div class="site-wrap">

    <?php include_once "public/header.php" ?>

    <div class="hero-slide owl-carousel site-blocks-cover">
        <div class="intro-section" style="background-image: url('images/yacht1.jpeg');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 ml-auto text-right" data-aos="fade-up">
                        <h1>Business principles</h1>
                        <p>The value behind Azimut Yachts' success is the formula that values ​​the value of every
                            Azimut yacht buyer. Azimut's business principles have been recorded and published in books
                            so that future generations can gain encouragement and thus guide the company in the
                            future.</p>

                    </div>
                </div>
            </div>
        </div>

        <div class="intro-section" style="background-image: url('images/yacht2.jpg');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
                        <h1>Azimut Benetti Group</h1>
                        <p>The group includes major brands such as Azimut Yachts, Azimut Grande, Atlantis and Benetti
                            Yachts, Yachtique, Fraser Yachts, Lusben, Marina di Varazze and Royal Yacht club Moscow,
                            giving customers a range of products spread from Atlantis 30 feet of sport with superyachts
                            built on 70 meters from Benetti.</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="intro-section" style="background-image: url('images/yacht3.jpg');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
                        <h1>Our history</h1>
                        <p>Azimut Yachts is a success story from 1969, and like many other success stories, it is the
                            story of a symbol, a symbol of Paolo Vitelli.</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="intro-section" style="background-image: url('images/yacht4.jpg');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
                        <h1>In The World</h1>
                        <p>Azimut Benetti has a wide sales network throughout the yacht industry worldwide. With more
                            than 138 agents in 68 countries, creating close relationships with yacht owners around the
                            world is the standard of our customer service.</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="intro-section" style="background-image: url('images/yacht5.jpg');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
                        <h1>Azimut and the environment</h1>
                        <p>Azimut Yachts has received ISO 14001 certification for its tireless efforts to reduce the
                            environmental impact of manufacturing operations.</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END slider -->


    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="service-29283">
              <span class="wrap-icon-39293">
                <span class="flaticon-yacht"></span>
              </span>
                        <h3>Luxuries Yacht</h3>
                        <p>Our domestic network extends the trading - procedures - operation & maintenance of the yacht
                            and the international network of inspection - sales (Europe & Asia) to experts from European
                            carriers. Europe like Italy, France, Poland ... Will help you a complete solution for you to
                            enjoy the waves. </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-29283">
              <span class="wrap-icon-39293">
                <span class="flaticon-shield"></span>
              </span>
                        <h3>30 Years of Experience</h3>
                        <p>Our team - who have negotiated take on the big yachts in the world - will help you journey
                            into the world of yachts starting with knowledge - advice and finally remove the concerns
                            for you to own your own yacht.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-29283">
              <span class="wrap-icon-39293">
                <span class="flaticon-captain"></span>
              </span>
                        <h3>Good Captain</h3>
                        <p>We have a team of experienced captains, have more than 30 years ' experience in driving. Will
                            provide you with the satisfaction</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-image overlay" style="background-image: url('images/yacht1.jpeg');">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="counter-39392">
                        <h3>349</h3>
                        <span>Number of Yacht</span>
                    </div>
                </div>
                <div class="col">
                    <div class="counter-39392">
                        <h3>7000+</h3>
                        <span>Customers Satisfied</span>
                    </div>
                </div>
                <div class="col">
                    <div class="counter-39392">
                        <h3>120</h3>
                        <span>Number of Staffs</span>
                    </div>
                </div>
                <div class="col">
                    <div class="counter-39392">
                        <h3>20</h3>
                        <span>Available in 20 countries</span>
                    </div>
                </div>
                <div class="col">
                    <div class="counter-39392">
                        <h3>230</h3>
                        <span>Professional Sailors</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="wrapper row3">
        <main class="hoc container clear servicetop">

            <hr class="btmspace-30">
            <div style="text-align: center">
                <img src="images/bestsellerbanner4.png" id="img-seller">
            </div>
            <br>
            <br>
            <form action="#">
                <ul class="nospace group overview">
                    <?php
                    while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):
                        ?>
                        <li class="one_third">
                            <article>
                                <a href="Product_detail.php?services&id_pro=<?= $product['id_pro']; ?>"> <img
                                            style="position: absolute;height:100px; width:100px ;"
                                            src="images/bestseller1.png">
                                    <img src="images/<?= $product['photo']; ?>" height="100px" width="100px">
                                </a>
                                <h6 class="heading"><?= $product['name_pro']; ?></h6>
                                <ul class="nospace meta">
                                    <li><i class="fa fa-calendar"></i> <a href="#">Year:<?= $product['year_pro']; ?></a>
                                    </li>
                                    <li><i class="fa fa-tag"></i> <a href="#">Classify:<?= $product['code']; ?></a></li>
                                </ul>
                                <p style="font-size: 20px;color: red"><i
                                            class="fa fa-dollar"></i><?= $product['price_pro']; ?></p>
                                <footer class="nospace"><a class="btn" type="submit"
                                                           href="Product_detail.php?servies&id_pro=<?= $product['id_pro']; ?>">Real
                                        More &raquo;</a></footer>
                            </article>
                        </li>
                    <?php
                    endwhile;
                    $db->closeConn();
                    ?>
                </ul>
            </form>
            <br>
            <hr class="btmspace-30">


            <div class="clear"></div>
        </main>
    </div>


    <div class="site-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center">
                    <h4 class="text-serif text-primary">World Cruise Magazines</h4>
                    <h1 class="heading-92913 text-black text-center">News </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service-39381">
                        <a href="https://www.boatinternational.com/yachts/news/bering-145-yacht--43805">
                            <img src="images/news1.gif" alt="Image" class="img-fluid"></a>
                        <div class="p-4">
                            <h3><a href="https://www.boatinternational.com/yachts/news/bering-145-yacht--43805">

                                    FIRST BERING 145 FLAGSHIP YACHT UNDER CONSTRUCTION
                                </a>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service-39381">
                        <a href="https://www.boatinternational.com/yachts/news/boat-online-design-competition-challenge-designer--43803"><img
                                    src="images/news2.jpg" alt="Image" class="img-fluid"></a>

                        <div class="p-4">
                            <h3>
                                <a href="https://www.boatinternational.com/yachts/news/boat-online-design-competition-challenge-designer--43803">
                                    ONLINE DESIGN COMPETITION: CHALLENGE A SUPERYACHT DESIGNER</a></h3>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service-39381">
                        <a href="https://www.boatinternational.com/yachts/news/gulf-craft-coronavirus--43799"><img
                                    src="images/news3.gif" alt="Image" class="img-fluid"></a>
                        <div class="p-4">
                            <h3><a href="https://www.boatinternational.com/yachts/news/gulf-craft-coronavirus--43799">GULF
                                    CRAFT ISSUES CORONAVIRUS COMPANY UPDATE</a></h3>

                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service-39381">
                        <a href="https://www.boatinternational.com/yachts/news/project-florentia-rossinavi-yacht--35201"><img
                                    src="images/news4.gif" alt="Image" class="img-fluid"></a>
                        <div class="p-4">
                            <h3>
                                <a href="https://www.boatinternational.com/yachts/news/project-florentia-rossinavi-yacht--35201">
                                    ROSSINAVI LAUNCHES 52 METRE YACHT FLORENTIA</a></h3>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service-39381">
                        <a href="https://www.boatinternational.com/yachts/news/escalade-trimonoran-yacht-concept--43797"><img
                                    src="images/news5.gif" alt="Image" class="img-fluid"></a>
                        <div class="p-4">
                            <h3>
                                <a href="https://www.boatinternational.com/yachts/news/escalade-trimonoran-yacht-concept--43797">
                                    INSIDE THE 25 METRE TRIMONORAN YACHT CONCEPT ESCALADE</a></h3>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service-39381">
                        <a href="https://www.boatinternational.com/charter/luxury-yacht-charter-advice/coronavirus-advice-superyacht-charter--42949"><img
                                    src="images/news6.jpg" alt="Image" class="img-fluid"></a>
                        <div class="p-4">
                            <h3>
                                <a href="https://www.boatinternational.com/charter/luxury-yacht-charter-advice/coronavirus-advice-superyacht-charter--42949">
                                    EVERYTHING YOU NEED TO KNOW ABOUT CHARTERING A YACHT POST COVID-19 </a></h3>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="site-section bg-image overlay" style="background-image: url('images/hero_2.jpg');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="text-white">Get In Touch With Us</h2>
                    <p class="lead text-white">We are committed to Marina Fleet as a pioneering cruise in providing the
                        most valuable experience for travelers without any comparable tour.</p>
                    <p class="mb-0"><a href="contact.php" class="btn btn-warning py-3 px-5 text-white">Contact Us</a>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <?php include_once "public/footer.php" ?>

</div>
<!-- .site-wrap -->


<!-- loader -->
<div id="loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#ff5e15"/>
    </svg>
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