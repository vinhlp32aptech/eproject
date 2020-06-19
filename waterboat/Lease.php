<?php
include_once "conn/database.php";
include_once "conn/Pagination.php";

$db = new database();

if(isset($_GET['search'])):
    $query = "select * from product where concat(name_pro,price_pro,year_pro,code) like ?  ";

    $param = [
        "%{$_GET['search']}%"
    ];

    $stmt = $db->selectdataparam($query, $param);

    $total = $stmt->rowCount();
    $config = [
        'current_page'  => isset($_GET['page'])?$_GET['page']:1,
        'total_record'  => $total,
        'limit'         => 6,
        'link_full'     => (trim($_GET['search'])=="")?'Lease.php?page={page}':"Lease.php?page={page}&search={$_GET['search']}",
        'link_first'    => (trim($_GET['search'])=="")?'Lease.php':"Lease.php?search={$_GET['search']}",
        'range'         => 5,
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
        'current_page'  => isset($_GET['page'])?$_GET['page']:1,
        'total_record'  => $total,
        'limit'         => 6,
        'link_full'     => 'Lease.php?page={page}',
        'link_first'    => 'Lease.php',// Link trang đầu tiên
        'range'         => 5, // Số button trang bạn muốn hiển thị
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
    <title>Lease</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="css/layout.css" rel="stylesheet" type="text/css" media="all">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Dancing+Script:400,700|Muli:300,400" rel="stylesheet">
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
    <link rel="stylesheet" href="admin/css/pagination.css">

</head>
<body id="top">

<?php include_once "public/header.php"?>

<div class="wrapper row3">
    <main class="hoc container clear">

        <article class="group btmspace-80">
            <div class="two_third first" id="fiximgV"><img class="borderedbox inspace-10" src="images/Lease1.jpg" alt="" height="555" width="555"></div>
            <div class="one_third">
                <h6 class="heading">Per inceptos himenaeos donec lacinia mollis vel</h6>
                <ul class="nospace meta">
                    <li><i class="fa fa-user"></i> <a href="#">Admin</a></li>
                    <li><i class="fa fa-tag"></i> <a href="#">Tag Name</a></li>
                </ul>
                <p>Aliquam mauris morbi tristique orci sit amet sapien tincidunt ut rutrum dui tincidunt.</p>
                <p class="btmspace-30">Cras eget lacinia magna nunc ut est est cras aliquam erat sem at dapibus lorem luctus sed nunc sagittis leo in&hellip;</p>
                <footer class="nospace"><a class="btn" href="#">Full Story &raquo;</a></footer>
            </div>
        </article>

        <hr class="btmspace-80">


        <ul class="nospace group overview">
            <?php
            while($product = $stmt->fetch(PDO::FETCH_ASSOC)):
            ?>
            <li class="one_third">
                <article><a href="Product_detail.php"><img src="images/<?= $product['photo'];?>" alt="" height="100px" width="100px"></a>
                    <h6 class="heading"><?= $product['name_pro'];?></h6>
                    <ul class="nospace meta">
                        <li><i class="fa fa-user"></i> <a href="#">Year:<?= $product['year_pro'];?></a></li>
                        <li><i class="fa fa-tag"></i> <a href="#">Classify:<?= $product['code'];?></a></li>
                    </ul>
                    <p style="font-size: 20px;color: red"><i class="fa fa-dollar"></i><?= $product['price_pro'];?></p>
                    <footer class="nospace"><a class="btn" href="#">Real More &raquo;</a></footer>
                </article>
            </li>
            <?php
            endwhile;
            $db->closeConn();
            ?>
        </ul>

        <br>
        <hr class="btmspace-80">


        <?php
        if(isset($paging)):
            echo $paging->html();
        endif;
        ?>
        <div class="clear"></div>
    </main>
</div>


<?php include_once "public/footer.php"?>


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
