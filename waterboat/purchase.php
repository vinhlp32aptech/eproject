<!DOCTYPE html>
<html lang="en">

<head>
    <title>Purchase history</title>
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
    <link rel="stylesheet" href="css/theme.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">


</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

<div class="site-wrap">

    <?php
    if (isset($_COOKIE['gotoindex'])):
        include_once "public/header.php";

        $query = "select invoice_details.invoice_no, invoice_details.photo_inv, invoice_details.name_pro, invoice_details.date_purchase, invoice_details.quantity, invoice_details.price, invoice_details.total from invoice right join invoice_details on invoice.id_inv = invoice_details.id_inv where id_acc = " . $_COOKIE['gotoindex'];
        $stmt = $db->selectdata($query);
        ?>

        <div class="container-fluid">
            <div class="container">
                <div class="col-md-12 paddingbottom">
                    <br><br><br><br><br><br>
                    <h3 class="text-center">Purchase history</h3><br>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <?php while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):
                                ?>
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="tr-shadow">
                                    <td><?= $product['invoice_no']; ?></td>
                                    <td>
                                        <img src="images/<?= $product['photo_inv']; ?>" width="100px" height="100px"
                                             alt="">
                                    </td>
                                    <td><?= $product['name_pro']; ?></td>
                                    <td>
                                        <span class="">$<?= $product['price']; ?></span>
                                    </td>
                                    <td><i class="far fa-calendar-alt"></i>&nbsp;&nbsp;<?= $product['date_purchase'] ?>
                                    </td>
                                    <td><?= $product['quantity']; ?></td>
                                    <td>$<?php echo number_format($product['total']); ?></td>

                                </tr>
                                <tr class="spacer"></tr>


                                </tbody>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br>

        <?php include_once "public/footer.php" ?>
    <?php
    else:
        header('location: index.php');
    endif;
    ?>

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
