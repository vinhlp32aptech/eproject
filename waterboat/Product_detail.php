<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product-details</title>
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

    <link rel="stylesheet" href="css/hotline.css">
    <link rel="stylesheet" href="css/productdetail.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>


<?php
if (isset($_GET['id_pro'])):
    include_once "public/header.php";
else:
    header('location: services.php');
endif;
if (isset($_COOKIE['gotoindex'])):
    $query = "select * from account where id_acc = " . $_COOKIE['gotoindex'];
    $stmt = $db->selectdata($query);
    while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):
        $_SESSION['addr'] = $product['addr'];
        $_SESSION['phone'] = $product['phone'];
    endwhile;
endif;

//insert shopping cart-----------
if (isset($_POST['addcart'])):
    if (isset($_COOKIE['gotoindex'])):
        $query = "select id_pro, quantity_shop from shopping_cart where id_acc = " . $_COOKIE['gotoindex'];
        $stmt = $db->selectdata($query);
        $total = $stmt->rowCount();
        if ($total > 0):
            while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):
                $newquantity = $product['quantity_shop'] + $_POST['quantity_shop'];
                if ($product['id_pro'] === $_GET['id_pro']):
                    $query = "update shopping_cart set quantity_shop=:quantity_shop where id_pro = " . $_GET['id_pro'];
                    $param = [
                        "quantity_shop" => $newquantity,
                    ];
                    $db->updatedataparam($query, $param);
                else:
                    $query = "insert into shopping_cart(id_acc, id_pro, name_shop, price_shop, quantity_shop, photo_shop) values(:id_acc, :id_pro, :name_shop, :price_shop, :quantity_shop, :photo_shop)";
                    $param = [
                        "id_acc" => $_COOKIE['gotoindex'],
                        "id_pro" => $_GET['id_pro'],
                        "name_shop" => $_POST['name_shop'],
                        "price_shop" => $_POST['price_shop'],
                        "quantity_shop" => $_POST['quantity_shop'],
                        "photo_shop" => $_POST['photo_shop'],
                    ];
                    $db->insertdataparam($query, $param);
                endif;
            endwhile;
        else:
            $query = "insert into shopping_cart(id_acc, id_pro, name_shop, price_shop, quantity_shop, photo_shop) values(:id_acc, :id_pro, :name_shop, :price_shop, :quantity_shop, :photo_shop)";
            $param = [
                "id_acc" => $_COOKIE['gotoindex'],
                "id_pro" => $_GET['id_pro'],
                "name_shop" => $_POST['name_shop'],
                "price_shop" => $_POST['price_shop'],
                "quantity_shop" => $_POST['quantity_shop'],
                "photo_shop" => $_POST['photo_shop'],
            ];
            $db->insertdataparam($query, $param);
        endif;
    else:
        echo "<script>alert('Please Sign in or Sign up to continue!');</script>";
    endif;
endif;

//----------insert invoice
if (isset($_POST['buynow'])):
    if (isset($_COOKIE['gotoindex'])):
        $total = $_POST['price_shop'] * $_POST['quantity_shop'];
        $id_acc = $_COOKIE['gotoindex'];
        $name_pro = $_POST['name_shop'];
        $date_purchase = date('Y-m-d H:i:s');
        $id_pro = $_GET['id_pro'];
        $photo_inv = $_POST['photo_shop'];
        $quantity = $_POST['quantity_shop'];
        $price = $_POST['price_shop'];
        $phone = $_SESSION['phone'];
        $addr = $_SESSION['addr'];

        $result = $db->insertinvoice($id_acc, $name_pro, $date_purchase, $total);

        $db->insertinvoicedetails($result, $id_pro, $photo_inv, $name_pro, $date_purchase, $addr, $phone, $quantity, $price, $total);

        $query = "select quantity_pro from product where id_pro = " . $id_pro;
        $stmt = $db->selectdata($query);
        while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):
            if ($product['quantity_pro'] > 0):
                $change = $product['quantity_pro'] - $quantity;
                $db->changequantity($id_pro, $change);
                echo "<script>alert('Thanks for shopping at Marina Fleet!');</script>";

            else:
                echo "<script>alert('Out of stock!');</script>";

            endif;
        endwhile;
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
    else:
        echo "<script>alert('Please Sign in or Sign up to continue!');</script>";
    endif;
endif;

if (isset($_POST['feedback'])):
    if (isset($_COOKIE['gotoindex'])):
        $query = "insert into feedback(id_pro, id_acc , user_name, content) values(:id_pro, :id_acc, :user_name, :content)";
        $param = [
            "id_pro" => $_GET['id_pro'],
            "id_acc" => $_COOKIE['gotoindex'],
            "user_name" => $_POST['user_name'],
            "content" => $_POST['content'],
        ];
        $db->insertdataparam($query, $param);
    else:
        echo "<script>alert('Please Sign in or Sign up to continue!');</script>";
    endif;
endif;
?>


<div class="site-wrap">
    <div class="hero-slide owl-carousel site-blocks-cover">
        <?php
        if (isset($_GET['id_pro'])):
            $query = "select img from photos where id_pro=:id_pro limit 5";
            $param = [
                "id_pro" => $_GET['id_pro']
            ];
            $stmt = $db->selectdataparam($query, $param);
        endif;
        while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>
            <div class="intro-section" style="background-image: url('images/<?= $product['img']; ?>');">
            </div>
        <?php endwhile; ?>
    </div>
</div>
<!-- END slider -->


<div class="container ">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
               aria-controls="nav-home" aria-selected="true">INFO</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
               aria-controls="nav-profile" aria-selected="false">IMAGES</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="row">
                <?php
                if (isset($_GET['id_pro'])):
                    $query = "select info, featured, advanced, additional from desc_pro where id_pro =:id_pro  ";
                    $param = [
                        "id_pro" => $_GET['id_pro']
                    ];
                    $stmt = $db->selectdataparam($query, $param);
                endif;
                while ($product = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

                <aside class="col-md-8">
                    <n/>
                    <?= $product['info']; ?>
                    <h2>Featured Features</h2>
                    <n/>
                    <ul>
                        <?= $product['featured']; ?>
                    </ul>
                    <br/>
                    <h2>Installed devices</h2>
                    <n/>
                    <h5>ADVANCED PACKAGE</h5>
                    <ul>
                        <?= $product['advanced']; ?>
                    </ul>
                    <br/>
                    <h5>ADDITIONAL PAGES </h5>
                    <ul>
                        <?= $product['additional']; ?>
                    </ul>
                    <?php endwhile; ?>
                </aside>
                <aside class="col-4">
                    <div class="container">
                        <?php
                        if (isset($_GET['id_pro'])):
                            $query = "select * from product where id_pro=:id_pro limit 1";
                            $param = [
                                "id_pro" => $_GET['id_pro']
                            ];
                            $stmt = $db->selectdataparam($query, $param);
                        endif;
                        while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):
                            ?>
                            <table class="table">
                                <thead>
                                <tr class="table-active">
                                    <th colspan="2"><h3><?= $product['name_pro']; ?></h3></th>
                                </tr>
                                <tr class="table-active">
                                    <th scope="col"><h3>Price:</h3></th>
                                    <td scope="col" id="pricepro"><h4 class="text-danger">
                                            $<?= $product['price_pro']; ?></h4></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="table-active">
                                    <th><h5>Year:</h5></th>
                                    <td id="pricepro"><h6><?= $product['year_pro']; ?></h6></td>
                                </tr>
                                </tbody>
                            </table>

                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-md-3 quantity">
                                        <input type="hidden" name="name_shop" value="<?= $product['name_pro']; ?>">
                                        <input type="hidden" name="price_shop" value="<?= $product['price_pro']; ?>">
                                        <input type="hidden" name="photo_shop" value="<?= $product['photo']; ?>">
                                        <input type="number" name="quantity_shop" id="" class="quantitypro" min="1"
                                               max="100" value="1">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" name="buynow" class="btn btn-info" data-toggle="modal"
                                                data-target=".bd-example-modal-lg">Buy Now
                                        </button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-success" name="addcart">ADD Cart</button>
                                    </div>
                                </div>
                            </form>
                        <?php
                        endwhile; ?>
                        <p>
                        <h2>Specification</h2></p>
                        <br/>

                        <table class="table table-striped">
                            <tbody>

                            <?php
                            $query = "select model, length_overall, beam, draft_max, draft_min, bridge_clearance, deadrise, dry_weight, fuel_tanks, water_tanks, Production_materials, Exterior_design, Interior_Design, passenger_capacity, cabins, manufacturer from configuration  where id_pro = " . $_GET['id_pro'];
                            $stmt = $db->selectData($query);
                            while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

                                <tr>
                                    <th>Model</th>
                                    <td><?= $product['model']; ?></td>
                                </tr>
                                <tr>
                                    <th>Year</th>
                                    <td><?= $product['length_overall']; ?></td>
                                </tr>
                                <tr>
                                    <th>Engine hours</th>
                                    <td><?= $product['beam']; ?></td>
                                </tr>
                                <tr>
                                    <th>Total length</th>
                                    <td><?= $product['draft_max']; ?></td>
                                </tr>
                                <tr>
                                    <th>Hull length</th>
                                    <td><?= $product['draft_min']; ?></td>
                                </tr>
                                <tr>
                                    <th>Horizontally</th>
                                    <td><?= $product['bridge_clearance']; ?></td>
                                </tr>
                                <tr>
                                    <th>Draft max</th>
                                    <td><?= $product['deadrise']; ?></td>
                                </tr>
                                <tr>
                                    <th>Turn water intake</th>
                                    <td><?= $product['dry_weight']; ?></td>
                                </tr>
                                <tr>
                                    <th>Fuel tank</th>
                                    <td><?= $product['fuel_tanks']; ?></td>
                                </tr>
                                <tr>
                                    <th>Water tank</th>
                                    <td><?= $product['water_tanks']; ?></td>
                                </tr>
                                <tr>
                                    <th>Black Water tank</th>
                                    <td><?= $product['Production_materials']; ?></td>
                                </tr>
                                <tr>
                                    <th>Grey Water tank</th>
                                    <td><?= $product['Exterior_design']; ?></td>
                                </tr>
                                <tr>
                                    <th>Speed of fuel economy</th>
                                    <td><?= $product['Interior_Design']; ?></td>
                                </tr>
                                <tr>
                                    <th>Max speed, nautical knots</th>
                                    <td><?= $product['passenger_capacity']; ?></td>
                                </tr>
                                <tr>
                                    <th>Motor</th>
                                    <td><?= $product['cabins']; ?></td>
                                </tr>
                                <tr>
                                    <th>Production materials</th>
                                    <td><?= $product['manufacturer']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>

                        </table>
                    </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <table>
                <?php
                $query = "select img from photos where id_pro = " . $_GET['id_pro'];
                $stmt = $db->selectdata($query);
                while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                    <tr><img src="images/<?= $product['img']; ?>" alt="" width=100%">
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <!---->
    <div id="loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                    stroke="#ff5e15"/>
        </svg>
    </div>
    <!-- loader -->
    <hr>

    <form action="#" method="post">
        <legend> Send your feedback about this product.</legend>
        <br>
        <table>
            <tr>
                <td><input type="text" placeholder="Enter your name" name="user_name"><br></td>
            </tr>
            <tr>
                <td>
                    <textarea name="content" PLACEHOLDER="Your comment" style="width: 600px; height: 150px"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="btn-secondary" type="reset" value="Reset">
                    <input class="btn-primary" type="submit" value="Submit" name="feedback">
                </td>
            </tr>
        </table>
    </form>
    <br><br>

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
