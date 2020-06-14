

<!DOCTYPE html>
<html lang="en">

<head>
    <title> Product information </title>
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


    <link rel="stylesheet" href="css/productdetail.css">

</head>

<body>

<?php include_once "public/header.php" ?>

<div class="site-wrap">
    <div class="hero-slide owl-carousel site-blocks-cover">
        <?php
            $query = "select img from photos ";
            $stmt = $db->selectData($query);
        while($product = $stmt->fetch(PDO::FETCH_ASSOC)): echo $product['img'];?>

        <div class="intro-section" style="background-image: url('images/<?= $product['img'];?>');">
        </div>
        <?php endwhile; ?>

    </div>
</div>
<!-- END slider -->


   <div class="container">


       <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
           <li class="nav-item" role="presentation">
               <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Info</a>
           </li>
           <li class="nav-item" role="presentation">
               <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Images</a>
           </li>
       </ul>
       <div class="tab-content" id="pills-tabContent">
           <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
               <div class="row">
                   <?php
                   $query = "select info, featured, advanced, additional from desc_pro ";
                   $stmt = $db->selectData($query);
                   while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

                   <aside class="col-md-8"><h2>Azimut Magellano 43, 2014, Croatia</h2> <n/>
                        <?= $product['info'];?>
                       <h2>Featured Features</h2><n/>
                       <ul>
                           <?= $product['featured'];?>
                       </ul>
                       <br/>
                       <h2>Installed devices</h2><n/>
                       <h5>ADVANCED PACKAGE</h5>
                       <ul>
                           <?= $product['advanced'];?>
                       </ul>
                       <br/>
                       <h5>ADDITIONAL PAGES </h5>
                       <ul>
                           <?= $product['additional'];?>
                       </ul>
                       <?php endwhile; ?>
                   </aside>
                   <aside class="col-4">
                       <div class="container">
                           <div class="backgruod">
                               <div class="style">
                                   <table class=" table-hover">
                                       <tbody>
                                       <tr>
                                           <th class="col-2"><h1>Price:</h1></th>

                                           <td class="col-2"><h1> <font color="#F00000">$416.668</font> </h1></td>
                                       </tr>
                                       </tbody>
                                   </table>
                               </div>
                               <table class="table table-condensed">
                                   <thead>
                                   <tr>
                                       <th>Length</th>
                                       <th>Cabin</th>
                                       <th>Year</th>

                                   </tr>
                                   </thead>
                                   <tbody>
                                   <tr>
                                       <td>13.63</td>
                                       <td>2</td>
                                       <td>2014</td>
                                   </tr>
                                   <tbody/>

                               </table>

                           </div>
                           <p><h2>Specification</h2></p>
                           <br/>

                           <table class="table table-striped">
                               <tbody>

                               <?php
                               $query = "select model, built_refit, builder, length, beam, draft, gross_tonnage, hull, stabilisers, engines, generators, cruising_maxspeed, cruise_range, economical_range, exterior_designer, interior_designer, classification, flag, stateroom, status from configuration ";
                               $stmt = $db->selectData($query);
                               while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

                               <tr>
                                   <th>Model</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Year</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Engine hours</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Total length</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Hull length</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Horizontally</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Draft max</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Turn water intake</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Fuel tank</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Water tank</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Black Water tank</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Grey Water tank</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Speed of fuel economy</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Max speed, nautical knots</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Motor</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Production materials</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Exterior design</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Interior Design</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Cabin</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Sleeping Place</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Locations</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Flag</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>VAT paid or not, which country</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
                               <tr>
                                   <th>Shipbuilding</th>
                                   <td><?= $product['model'];?></td>
                               </tr>
<?php endwhile;?>
                               </tbody>

                           </table>
                       </div>
               </div>
           </div>
           <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
               <img src="images/3.jpeg" alt="">
           </div>
       </div>
       <div id="loader" class="show fullscreen">
           <svg class="circular" width="48px" height="48px" >
               <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
               <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/>
           </svg>
       </div>
       <!-- loader -->




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
