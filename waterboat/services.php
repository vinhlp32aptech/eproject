<?php
include_once "conn/database.php";
include_once "conn/Pagination.php";

$db = new database();

if (isset($_GET['aaa'])):
    $query = "select * from product where concat(name_pro,price_pro,year_pro,code) like ?  ";

    $param = [
        "%{$_GET['search']}%"
    ];

    $stmt = $db->selectdataparam($query, $param);

    $total = $stmt->rowCount();
    $config = [
        'current_page' => isset($_GET['page']) ? $_GET['page'] : 1,
        'total_record' => $total,
        'limit' => 9,
        'link_full' => (trim($_GET['search']) == "") ? 'services.php?page={page}' : "services.php?page={page}&search={$_GET['search']}",
        'link_first' => (trim($_GET['search']) == "") ? 'services.php' : "services.php?search={$_GET['search']}",
        'range' => 5,
    ];
    $paging = new Pagination();
    $paging->init($config);
    $query = "select * from product  where concat(name_pro,price_pro,year_pro,code) like ?  {$paging->get_limit()}";
    $stmt = $db->selectdataparam($query, $param);

else:
    $query = "select * from product";
    $stmt = $db->selectdata($query);
    $total = $stmt->rowCount();
    $config = [
        'current_page' => isset($_GET['page']) ? $_GET['page'] : 1,
        'total_record' => $total,
        'limit' => 9,
        'link_full' => 'services.php?page={page}',
        'link_first' => 'services.php',// Link trang đầu tiên
        'range' => 5, // Số button trang bạn muốn hiển thị
    ];
    $paging = new Pagination();
    $paging->init($config);
    $query = "select * from product  {$paging->get_limit()}";
    $stmt = $db->selectdata($query);
endif;
?>

<!DOCTYPE html>
<html lang="">
<head>
    <title>Services</title>
    <link rel="icon" href="images/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="css/layout.css" rel="stylesheet" type="text/css" media="all">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">
    <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/services.css">
    <link rel="stylesheet" href="css/pagination.css">
    <link rel="stylesheet" href="css/hotline.css">
</head>
<body id="top">

<?php include_once "public/header.php" ?>
<div id="slider">
    <div class="slides">
        <div class="slider">
            <div class="legend"></div>
            <div class="content">
                <div class="content-txt">
                    <h1>Luxury yacht</h1>
                    <h2>Azimut Yachts is a legendary name in the shipbuilding industry, a leading yacht builder with a
                        length of 12 meters.</h2>
                </div>
            </div>
            <div class="image">
                <img src="images/luxuxyboatslider.jpg">
            </div>
        </div>
        <div class="slider">
            <div class="legend"></div>
            <div class="content">
                <div class="content-txt">
                    <h1>Sport Boat</h1>
                    <h2>Monterey Boats is a famous motor boat brand from the US. The value of each Monterey Boats
                        product brings customers not only the superior technology, high practicality but also creativity
                        and technical solutions.</h2>
                </div>
            </div>
            <div class="image">
                <img src="images/SportBoatSlider.jpg">
            </div>
        </div>
        <div class="slider">
            <div class="legend"></div>
            <div class="content">
                <div class="content-txt">
                    <h1>Fishing Boat</h1>
                    <h2>Nautique (brand from the United States) is a professional boat manufacturer for surfing and
                        windsurfing. Appeared on the market in 1924 and always achieved the best business results and
                        satisfaction index, especially in the wave boat segment.</h2>
                </div>
            </div>
            <div class="image">
                <img src="images/Fishingboatslider.jpg">
            </div>
        </div>
    </div>
    <div class="switch">
        <ul>
            <li>
                <div class="on"></div>
            </li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>


<hr/>
<div class="popular-location ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Section Tittle -->
                <div class="section-tittle text-center mb-80">
                    <h4 class="text-serif text-primary">Products</h4>
                    <h2>Classification of ships</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-location mb-30">
                    <div class="location-img">
                        <a href="Lease.php?services&Travel"><img src="images/Luxury-yachts.jpg" alt="" height="360px"
                                                                 width="286px"></a>
                    </div>

                    <div class="location-details">
                        <p>Luxury yachts</p>
                        <a href="Lease.php?services&Travel" class="location-btn"><?php echo $db->counttravel(); ?> <i
                                    class="ti-plus"></i> Yachts</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-location mb-30">
                    <div class="location-img">
                        <a href="Lease.php?services&Sport"><img src="images/sport-boat.jpg" alt="" height="360px"
                                                                width="286px"><a/>
                    </div>
                    <div class="location-details">
                        <p>Sport Boat</p>
                        <a href="Lease.php?services&Sport" class="location-btn"><?php echo $db->countsport(); ?> <i
                                    class="ti-plus"></i> Boat</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-location mb-30">
                    <div class="location-img">
                        <a href="Lease.php?services&Fishing"><img src="images/fishing.jpg" alt="" height="360px"
                                                                  width="286px"><a/>
                    </div>
                    <div class="location-details">
                        <p>Fishing boats</p>
                        <a href="Lease.php?services&Fishing" class="location-btn"><?php echo $db->countfish(); ?> <i
                                    class="ti-plus"></i> Boat</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- .site-wrap -->
    </div>
    <div class="wrapper row3">
        <main class="hoc container clear servicetop">

            <hr class="btmspace-30">
            <div class="section-tittle text-center mb-80">

                <h2>Featured Boats</h2>
            </div>
            <form action="#">

                <ul class="nospace group overview">
                    <?php
                    while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):
                        ?>
                        <li class="one_third">
                            <article><a href="Product_detail.php?services&id_pro=<?= $product['id_pro']; ?>"><img
                                            src="images/<?= $product['photo']; ?>" alt="" height="100px" width="100px"></a>
                                <h6 class="heading"><?= $product['name_pro']; ?></h6>
                                <ul class="nospace meta">
                                    <li><i class="fa fa-calendar"></i> <a href="#">Year:<?= $product['year_pro']; ?></a>
                                    </li>
                                    <li><i class="fa fa-tag"></i> <a href="#">Classify:<?= $product['code']; ?></a></li>
                                </ul>
                                <p style="font-size: 20px;color: red"><i
                                            class="fa fa-dollar"></i><?= $product['price_pro']; ?></p>
                                <footer class="nospace"><a class="btn" type="submit"
                                                           href="Product_detail.php?services&id_pro=<?= $product['id_pro']; ?>">Real
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
            <hr class="btmspace-80">
            <?php
            if (isset($paging)):
                echo $paging->html();
            endif;
            ?>


            <div class="clear"></div>
        </main>
    </div>


    <?php include_once "public/footer.php" ?>


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
