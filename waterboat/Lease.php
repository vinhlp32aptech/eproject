<?php
include_once "conn/database.php";
include_once "conn/Pagination.php";

$db = new database();

if (isset($_GET['Travel'])):
    $query = "select * from product where status = 1 && code = 'Travel' ";
    $stmt = $db->selectdata($query);
    $total = $stmt->rowCount();
    $config = [
        'current_page' => isset($_GET['page']) ? $_GET['page'] : 1,
        'total_record' => $total,
        'limit' => 6,
        'link_full' => 'Lease.php?Travel&page={page}',
        'link_first' => 'Lease.php',// Link trang đầu tiên
        'range' => 5, // Số button trang bạn muốn hiển thị
    ];
    $paging = new Pagination();
    $paging->init($config);
    $query = "select * from product where status = 1 && code = 'Travel' " . $paging->get_limit();
    $stmt = $db->selectdata($query);
elseif (isset($_GET['Sport'])):
    $query = "select * from product where code = 'Sport' && status = 1 ";
    $stmt = $db->selectdata($query);
    $total = $stmt->rowCount();
    $config = [
        'current_page' => isset($_GET['page']) ? $_GET['page'] : 1,
        'total_record' => $total,
        'limit' => 6,
        'link_full' => 'Lease.php?Sport&page={page}',
        'link_first' => 'Lease.php',// Link trang đầu tiên
        'range' => 5, // Số button trang bạn muốn hiển thị
    ];
    $paging = new Pagination();
    $paging->init($config);
    $query = "select * from product where code = 'Sport' && status = 1  " . $paging->get_limit();
    $stmt = $db->selectdata($query);

elseif (isset($_GET['Fishing'])):
    $query = "select * from product where code = 'Fishing' && status = 1 ";
    $stmt = $db->selectdata($query);
    $total = $stmt->rowCount();
    $config = [
        'current_page' => isset($_GET['page']) ? $_GET['page'] : 1,
        'total_record' => $total,
        'limit' => 6,
        'link_full' => 'Lease.php?Fishing&page={page}',
        'link_first' => 'Lease.php',// Link trang đầu tiên
        'range' => 5, // Số button trang bạn muốn hiển thị
    ];
    $paging = new Pagination();
    $paging->init($config);
    $query = "select * from product where code = 'Fishing' && status = 1 " . $paging->get_limit();
    $stmt = $db->selectdata($query);

else:
    header('location: services.php');
endif;
?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Product</title>
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

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pagination.css">
    <link rel="stylesheet" href="css/hotline.css">
</head>
<body id="top">

<?php include_once "public/header.php" ?>
<h2></h2>
<div class="wrapper row3">
    <main class="hoc container clear">
        <?php if (isset($_GET['Travel'])):
            echo '<h2>Luxury yachts</h2>';
        elseif (isset($_GET['Sport'])):
            echo '<h2>Sport Boat</h2>';
        elseif (isset($_GET['Fishing'])):
            echo '<h2>Fishing boats</h2>';
        endif;
        ?>
        <h2></h2>
        <hr class="btmspace-50">
        <ul class="nospace group overview">
            <?php
            while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):
                ?>
                <li class="one_third">
                    <article><a href="Product_detail.php?services&id_pro=<?= $product['id_pro']; ?>"><img
                                    src="images/<?= $product['photo']; ?>" alt="" height="100px" width="100px"></a>
                        <h6 class="heading"><?= $product['name_pro']; ?></h6>
                        <ul class="nospace meta">
                            <li><i class="fa fa-calendar"></i> <a href="#">Year:<?= $product['year_pro']; ?></a></li>
                            <li><i class="fa fa-tag"></i> <a href="#">Classify:<?= $product['code']; ?></a></li>
                        </ul>
                        <p style="font-size: 20px;color: red"><i class="fa fa-dollar"></i><?= $product['price_pro']; ?>
                        </p>
                        <footer class="nospace"><a class="btn"
                                                   href="Product_detail.php?services&id_pro=<?= $product['id_pro']; ?>">Real
                                More &raquo;</a></footer>
                    </article>
                </li>
            <?php

            endwhile;
            $db->closeConn();
            ?>
        </ul>

        <br>
        <hr class="btmspace-50">


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
