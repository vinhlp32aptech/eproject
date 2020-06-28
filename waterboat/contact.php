<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact</title>
    <link rel="icon" href="images/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700|Muli:300,400
" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css
">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css
" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link rel="stylesheet" href="css/hotline.css">
    <link rel="stylesheet" href="">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {

            $("#submit").click(function () {
                var email = document.getElementById('email');
                var filter =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (!filter.test(email.value)) {
                    alert('Email is not valid!.\nExample@gmail.com');
                    email.focus();
                    return false;
                }
                return true;
            });
        });
    </script>


</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

<div class="site-wrap">

    <?php include_once "public/header.php" ?>


</div>


</div>


<div class="intro-section site-blocks-cover innerpage" style="background-image: url('images/VERTIGE-01-e1542791616891.jpg');">
    <div class="container">
        <div class="row align-items-center text-center border">
            <div class="col-lg-12 mt-5" data-aos="fade-up">
                <h1>Get In Touch</h1>
                <p class="text-white text-center">
                    <a href="index.php">Home</a>
                    <span class="mx-2">/</span>
                    <span>Contact Us</span>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div style="text-align:center" class="col-md-5">
        <br><br><br><br>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4237543370045!2d106.68827279879031!3d10.778820881379646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3a9d92c4a7%3A0x6293396afcadc8a5!2zMjEyIE5ndXnhu4VuIMSQw6xuaCBDaGnhu4N1LCBQaMaw4budbmcgNiwgUXXhuq1uIDMsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1591975922656!5m2!1svi!2s
" width="90%" height="70%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe>
    </div>
    <div class="col-md-7">
        <div class="site-section1">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" class="form-control form-control-lg">
                        <label for="email">Email Address</label>
                        <input type="text" id="email" class="form-control form-control-lg">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="subject">Tel. Number</label>
                        <input type="tel" id="subject" class="form-control form-control-lg" maxlength="11"
                               minlength="10">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="body">Message</label>
                        <textarea name="" id="body" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" onclick="sendemail()" id="submit" value="Send Message"
                               class="btn btn-primary rounded-0 px-3 px-5">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js
" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function sendemail() {
            var name = $("#name");
            var email = $("#email");
            var subject = $("#subject");
            var body = $("#body");

            if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {
                $.ajax({
                    url: 'sendEmail.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        name: name.val(),
                        email: email.val(),
                        subject: subject.val(),
                        body: body.val()
                    }, success: function (response) {
                        if (response.status == "success")
                            alert('We will contact you soonest!');
                        else {
                            alert('Please try again!');
                            console.log(response);
                        }
                    }
                });
            }
        }

        function isNotEmpty(caller) {
            if (caller.val() == "") {
                caller.css('border', '1px solid red');
                return false;
            } else
                caller.css('border', '');

            return true;
        }
    </script>
</div>
<div class="section-bg style-1" style="background-image: url('images/VERTIGE-01-e1542791616891.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon flaticon-mortarboard"></span>
                <h3>In the world</h3>
                <p>Azimut Yachts is a classic yacht builder in the boating world. YachtWorld currently has 1,513 Azimut Yachts yachts for sale, including 93 new vessels and 1,420 used yachts, listed by experienced dealerships mainly in the following countries: United States, Italy, Turkey, Spain and France.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon flaticon-school-material"></span>
                <h3>Azimut History</h3>
                <p>Azimut Yachts came about in 1969, when the young university student Paolo Vitelli founded Azimut Srl, and began chartering sailing boats. In 1970 some prestigious yachting brands appointed the company to distribute their boats in Italy.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon flaticon-library"></span>
                <h3>Key of Success</h3>
                <p>The most successful salespeople take as much time as necessary to establish trust with that client. They ask good questions and listen closely to the answers. They seek to understand the customer's situation and needs before they make any attempt to talk about their product or service.</p>
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
