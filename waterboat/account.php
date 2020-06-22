<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
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
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="css/hotline.css">



</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

<div class="site-wrap">

    <?php include_once "public/header.php" ?>
    <br><br><br><br><br><br><br><br>
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <div class="profile-img">
                        <img id="imgavatar" src="images/Avatar-leader.png" height="100px" id="photo"><br/>
                    </div>
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="active">
                                <input type="file" name="photo" > <br/><br/>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Modify your Profile</h4>
                            <br>
                        </div>
                    </div>
                    <form>
                        <div class="form-group row">
                            <label for="username" class="col-4 col-form-label">Full Name</label>
                            <div class="col-8">
                                <input id="username" name="username" placeholder="Full Name" class="form-control here"
                                       required="required" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Phone" class="col-4 col-form-label">Phone Number</label>
                            <div class="col-8">
                                <input id="lastname" name="Phone" placeholder="Phone" class="form-control here"
                                       type="number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text" class="col-4 col-form-label">Date of birth</label>
                            <div class="col-8">
                                <input id="text" name="text" placeholder="Date of birth" class="form-control here" required="required"
                                       type="date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-4 col-form-label">Email*</label>
                            <div class="col-8">
                                <input id="email" name="email" placeholder="Email" class="form-control here" required="required"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sex" class="col-4 col-form-label">Sex</label>
                            <div class="col-8">
                                <select name="" id="text" class="form-control here">
                                    <option value="">Male</option>
                                    <option value="">Female</option>
                                    <option value="">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="publicinfo" class="col-4 col-form-label">Address</label>
                            <div class="col-8">
                                <textarea id="publicinfo" name="publicinfo" cols="40" rows="4" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <h5>Change you Password ?</h5>
                    <form>
                        <div class="form-group row">
                            <label for="password" class="col-4 col-form-label">Current Password</label>
                            <div class="col-8">
                                <input  name="password" placeholder="Password" class="form-control here"
                                       required="required" type="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-4 col-form-label">New Password</label>
                            <div class="col-8">
                                <input  name="newpassword" placeholder="New Password" class="form-control here"
                                       required="required" type="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-4 col-form-label">Confirm New Password</label>
                            <div class="col-8">
                                <input  name="confirmpassword" placeholder="Confirm New Password" class="form-control here"
                                       required="required" type="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="submit" type="submit" class="btn btn-danger">Update My Password</button>
                            </div>
                        </div>

                    </form>
                </div>
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