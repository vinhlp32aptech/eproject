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
    if(isset($_COOKIE['gotoindex'])):
        $query = "select * from account where id_acc = " . $_COOKIE['gotoindex'];
        $stmt = $db->selectdata($query);
        while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):
            $_SESSION['addr'] = $product['addr'];
            $_SESSION['phone'] = $product['phone'];
        endwhile;
    endif;

    if(isset($_POST['savequantity'])):

        $query = "update shopping_cart set quantity_shop = :quantity_shop where id_pro = " .$_POST['id_pro'];
        $param = [
            "quantity_shop"  => $_POST['quantity_shop'],
        ];
        $stmt = $db->updatedataparam($query,$param);
    endif;
    if(isset($_POST['delshop'])):

        $query = "delete from shopping_cart  where id_pro = " .$_POST['id_pro'];

        $stmt = $db->deletedata($query);
    endif;

//    ------
    if(isset($_GET['buypro'])):
        $date_purchase = date('Y-m-d H:i:s');
        $id_acc = $_COOKIE['gotoindex'];

    $query = "select * from shopping_cart where id_acc = " .$_COOKIE['gotoindex'];
    $stmt = $db->selectdata($query);

    while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):
        $checkquan = "select quantity_pro from product where id_pro = " .$product['id_pro'];
        $num = $db->selectdata($checkquan);
       while ($aa = $num->fetch(PDO::FETCH_ASSOC)):
            if($aa['quantity_pro'] > 0):
        $name_pro = $product['name_shop'];
        $id_pro = $product['id_pro'];
            $photo_inv = $product['photo_shop'];
           $quantity = $product['quantity_shop'];
            $price = $product['price_shop'];
           $phone = $_SESSION['phone'];
           $addr = $_SESSION['addr'];
          $total = $product['quantity_shop'] * $product['price_shop'];
        $result =  $db->insertinvoice($id_acc, $name_pro, $date_purchase, $total);

        $db->insertinvoicedetails($result, $id_pro, $photo_inv, $name_pro, $date_purchase,$addr,$phone,$quantity, $price, $total);
        $a = "select quantity_pro from product where id_pro = " .$id_pro;
        $b = $db->selectdata($a);
        while ($c=$b->fetch(PDO::FETCH_ASSOC)):

            if ($c['quantity_pro'] > 0):
                $change = $c['quantity_pro'] - $quantity;
                $db->changequantity($id_pro,$change);
            endif;
        endwhile;
        else:
            echo "<script>alert('Out of stock!');</script>";
        endif;
        endwhile;
        $db->deletecart();
    endwhile;
        if( isset($result)):
            $invoice_no = $_COOKIE['gotoindex'] + $result;

            $upinvoice = "update invoice  set invoice_no=:invoice_no where invoice_no = 0 ";
            $dateinvoice =[
                    "invoice_no"        => $invoice_no,
            ];
            $db->updatedataparam($upinvoice,$dateinvoice);

            $updetail = "update invoice_details set invoice_no=:invoice_no where invoice_no = 0 ";
            $datedetail =[
                "invoice_no"        => $invoice_no,
            ];
            $db->updatedataparam($updetail,$datedetail);
            endif;
    endif;
    ?>


    <div class="container-fluid">
        <div class="container">
            <div class="col-md-12 paddingbottom">
                <br><br><br><br><br><br>
                <h3 class="text-center">Your Cart</h3><br>

                <div class="table-responsive table-responsive-data2" >
                    <?php
                    $query = "select * from shopping_cart where id_acc = " .$_COOKIE['gotoindex'];
                    $stmt = $db->selectdata($query);
                    $total = 0;
                        ?>
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
                                <?php
                                while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):
                                $total    = $product['quantity_shop'] * $product['price_shop'] + $total;

                                ?>
                                <form action="#" method="post">

                                <tbody>

                                <tr class="spacer"></tr>
                                <tr class="tr-shadow">
                                    <td>
                                        <img src="images/<?=$product['photo_shop'];?>" width="100px" height="100px" alt="">
                                    </td>
                                    <td><?=$product['name_shop'];?></td>
                                    <td>
                                        <span class="">$<?php echo number_format($product['price_shop']);?></span>
                                    </td>
                                    <td>
                                        <input type="hidden" name="id_pro" value="<?=$product['id_pro'];?>">
                                        <input class="badge-light" type="number" name="quantity_shop" value="<?=$product['quantity_shop'];?>" style="width: 50px" min="1" max="999" maxlength="3">
                                        <button class="btn-warning" type="submit" name="savequantity">Save</button>
                                    </td>

                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" type="submit" name="delshop" data-toggle="tooltip" data-placement="top" title="" data-original-title="Send">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer">
                                </tr>
                                </tbody>
                                </form>
                                <?php endwhile;?>

                            </table>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <div class="btn"><h4>Total: $<?php echo number_format($total);?></h4></div>
                            <br>
                            <br>
                            <form action="#">
                                <button type="submit"  name="buypro" class="btn btn-info btn ">CONFIRM CART</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div><br>
        </div>
    </div>
</div>
<br><br><br><br>
<?php
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