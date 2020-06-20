
<!DOCTYPE html>
<html lang="en">

<head>
  <title>WaterBoat &mdash; Website Template by Colorlib</title>
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
    <link rel="stylesheet" href="css/services.css">



</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<?php include_once "public/header.php" ?>

  <div class="site-wrap">

      <div class="">
          <!-- Slider -->
          <div id="slider">
              <div class="slides">
                  <div class="slider">
                      <div class="legend"></div>
                      <div class="content">
                          <div class="content-txt">
                              <h1>Azimut and the environment</h1>
                              <h2>Azimut Benetti has a wide sales network throughout the yacht industry worldwide. With more than 138 agents in 68 countries, creating close relationships with yacht owners around the world is the standard of our customer service.</h2>
                          </div>
                      </div>
                      <div class="image">
                          <img src="images/Yacht-services.jpg">
                      </div>
                  </div>
                  <div class="slider">
                      <div class="legend"></div>
                      <div class="content">
                          <div class="content-txt">
                              <h1>Azimut Benetti Group</h1>
                              <h2>The group includes major brands such as Azimut Yachts, Azimut Grande, Atlantis and Benetti Yachts, Yachtique, Fraser Yachts, Lusben, Marina di Varazze and Royal Yacht club Moscow, giving customers a range of products spread from Atlantis 30 feet of sport with superyachts built on 70 meters from Benetti.</h2>
                          </div>
                      </div>
                      <div class="image">
                          <img src="images/Yacht-services1.jpg">
                      </div>
                  </div>
                  <div class="slider">
                      <div class="legend"></div>
                      <div class="content">
                          <div class="content-txt">
                              <h1>Our history</h1>
                              <h2>Azimut Yachts is a success story from 1969, and like many other success stories, it is the story of a symbol, a symbol of Paolo Vitelli.</h2>
                          </div>
                      </div>
                      <div class="image">
                          <img src="images/Yacht-services2.jpg">
                      </div>
                  </div>
                  <div class="slider">
                      <div class="legend"></div>
                      <div class="content">
                          <div class="content-txt">
                              <h1>Business principles</h1>
                              <h2>The value behind Azimut Yachts' success is the formula that values ​​the value of every Azimut yacht buyer. Azimut's business principles have been recorded and published in books so that future generations can gain encouragement and thus guide the company in the future.</h2>
                          </div>
                      </div>
                      <div class="image">
                          <img src="images/Yacht-services3.jpg">
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
                      <li></li>
                  </ul>
              </div>
          </div>

      </div>
      <hr/>
      <div class="popular-location ">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <!-- Section Tittle -->
                      <div class="section-tittle text-center mb-80">
                          <span>Most visited places</span>
                          <h2>Popular Locations</h2>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="single-location mb-30">
                          <div class="location-img">
                              <a href="Lease.php" ><img src="images/Luxury-yachts.jpg" alt="" height="360px" width="286px"></a>
                          </div>

                          <div class="location-details">
                              <p>Luxury yachts</p>
                              <a href="Lease.php" class="location-btn">
                                  <?php
                                  $query = "select count(code) from product where code = 'Travel'";
                                  $stmt = $db->selectData($query);
                                  echo $query;
                                  ?>

                                  <i class="ti-plus"></i> Location</a>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="single-location mb-30">
                          <div class="location-img">
                              <a href="Lease.php" ><img src="images/sport-boat.jpg" alt="" height="360px" width="286px"><a/>
                          </div>
                          <div class="location-details">
                              <p>Sport Boat</p>
                              <a href="Lease.php" class="location-btn">60 <i class="ti-plus"></i> Location</a>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="single-location mb-30">
                          <div class="location-img">
                              <a href="Lease.php" ><img src="images/wakesurf-boat.jpg" alt="" height="360px" width="286px"><a/>
                          </div>
                          <div class="location-details">
                              <p>Wakesurf & Wakeboard</p>
                              <a href="Lease.php" class="location-btn">50 <i class="ti-plus"></i> Location</a>
                          </div>
                      </div>
                  </div>



              </div>
                  <!-- .site-wrap -->
</div>
      <?php include_once "public/footer.php"?>

  </div>
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
          <script src="js/sevices.js"></script>

</body>

</html>