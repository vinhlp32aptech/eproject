<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cart</title>
    <link rel="icon" href="images/logo.png">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/aos.css">
    <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/hotline.css">
    <link rel="stylesheet" href="css/theme.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >


</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

<div class="site-wrap">

    <?php
    if (isset($_COOKIE['gotoindex'])):
    include_once "public/header.php";
        if(isset($_GET['cart'])):?>
            <div class="container-fluid">
                <div class="container">
                <div class="col-md-12 paddingbottom">
                    <br><br><br><br><br><br>
                    <h3 class="text-center">Your Cart</h3><br>
                    <div class="table-responsive table-responsive-data2" >
                        <table class="table table-data2">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="spacer"></tr>
                            <tr class="tr-shadow">
                                <td>
                                    <img src="images/news6.jpg" width="100px" height="100px" alt="">
                                </td>
                                <td>Azimut Magellano 43 HT</td>
                                <td>
                                    <span class="">$ 517 907</span>
                                </td>
                                <td>
                                    <input class="badge-light" type="number" style="width: 40px">
                                    <button class="btn-danger" type="submit">Save</button>
                                </td>

                                <td>
                                    <div class="table-data-feature">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Send">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer">
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <div class="btn">Total: 1 454 000$</div>
                                    <br>
                                    <br><button type="submit"  class="btn btn-danger btn ">CONFIRM CART</button>
                                </div>

                            </div>
                    </div>
                </div><br>
                </div>
                </div>
            </div>
<br><br><br><br>
    <?php else:?>
    <div class="container-fluid">
        <div class="container">
        <div class="col-md-12 paddingbottom">
            <br><br><br><br><br><br>
            <h3 class="text-center">Purchase history</h3><br>
            <div class="table-responsive table-responsive-data2" >
                <table class="table table-data2">
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
                        <td>1</td>
                        <td>
                            <img src="images/news6.jpg" width="100px" height="100px" alt="">
                        </td>
                        <td>Azimut Magellano 43 HT</td>
                        <td>
                            <span class="">$ 517 907</span>
                        </td>
                        <td><i class="far fa-calendar-alt"></i>17/1/2020</td>
                        <td>3</td>
                        <td>$ 1 012 000</td>

                    </tr>
                    <tr class="spacer"></tr>



                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
    <?php endif;
        include_once "public/footer.php";
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
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/>
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
