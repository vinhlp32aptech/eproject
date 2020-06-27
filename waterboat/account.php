<?php
if(isset($_COOKIE['gotoindex'])):
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profie</title>
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#updatepass").click(function () {
                var password = $("#password").val();
                var confirmPassword = $("#confirmpassword").val();
                if (password != confirmPassword) {
                    alert("Passwords do not match.");
                    return false;
                }
                return true;
            });

            $("#update").click(function () {
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




   <?php
   include_once "public/header.php";
   /////uppdate account
   if(isset($_POST['update'])):
       if($_FILES['photo_acc']['name'] != ''):
           move_uploaded_file($_FILES['photo_acc']['tmp_name'], 'images/'.$_FILES['photo_acc']['name']);
           $photo = $_FILES['photo_acc']['name'];
       else:
           $photo = $_POST['oldphoto'];
       endif;

       $query = "update account set  user_name=:user_name, email = :email, phone = :phone, fullname = :fullname, gender = :gender, dob = :dob, addr = :addr, photo_acc = :photo_acc where id_acc = :id_acc ";
       $param = [
           "user_name"          =>$_POST['user_name'],
           "email"          =>$_POST['email'],
           "phone"        =>$_POST['phone'],
           "fullname"       =>$_POST['fullname'],
           "gender"       =>$_POST['gender'],
           "dob"       =>$_POST['dob'],
           "addr"       =>$_POST['addr'],
           "photo_acc"          =>$photo,
           "id_acc"                =>$_COOKIE['gotoindex']

       ];
       $db->updatedataparam($query, $param);
//       header('location: admin.php?id_acc='.$_GET['id_acc']);
   endif;

//   --- update password
   /////uppdate account
   if(isset($_POST['updatepass'])):

           $id_acc = trim($_COOKIE['gotoindex']);
           $password = trim($_POST['oldpassword']);

           $query = "select password from account where id_acc = " .$id_acc;
           $stmt = $db->selectdata($query);
           $account = $stmt->fetch(PDO::FETCH_ASSOC);
           if($account > 0):
               if(password_verify($password, $account['password'])):
                   $query = "update account set  password=:password where id_acc = :id_acc ";
                   $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                   $param = [
                       "password"          =>$hash,
                       "id_acc"                =>$_COOKIE['gotoindex']
                   ];
                   $db->updatedataparam($query, $param);
                   echo "<script>alert('Password changed successfully!')</script>";
               else:
                   echo "<script>alert('Your password is wrong!')</script>";
                   endif;
           endif;
//
   endif;

   $query = "select * from account where id_acc = " . $_COOKIE['gotoindex'];
   $stmt = $db->selectdata($query);
   while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>
    <div class=" to-top-btn hidden-xs hidden-sm">
    </div>    <br><br><br><br>
    <div class="container">
        <form action="#" method="post" enctype="multipart/form-data">
        <div class="row profile">
            <div class="col-md-3 top30">
                <div class="profile-sidebar">
                    <div class="profile-img">
                        <input type="hidden" name="user_name" value="<?=$product['user_name'];?>">
                        <input type="hidden" name="oldphoto" value="<?= isset($product['photo_acc'])?"images/{$product['photo_acc']}":"images/100x100.png" ?>">
                        <img src="<?= isset($product['photo_acc'])?"images/{$product['photo_acc']}":"images/100x100.png" ?>"  id="photo_acc">                        <input type="file" name="photo_acc" onchange="changepicture();" multiple>
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
                        <div class="form-group row">
                            <label for="fullname" class="col-4 col-form-label">Full Name</label>
                            <div class="col-8">
                                <input id="fullname" name="fullname" placeholder="Full Name" class="form-control here"
                                       required="required" type="text" value="<?=$product['fullname']?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-4 col-form-label">Phone Number</label>
                            <div class="col-8">
                                <input id="phone" name="phone" placeholder="Phone" class="form-control here"
                                       type="number" value="<?=$product['phone']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dob" class="col-4 col-form-label">Date of birth</label>
                            <div class="col-8">
                                <input id="dob" name="dob" placeholder="Date of birth" class="form-control here"  type="date" value="<?=$product['dob']?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-4 col-form-label">Email*</label>
                            <div class="col-8">
                                <input id="email" name="email" placeholder="Email" class="form-control here" required="required" type="text" value="<?=$product['email']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-4 col-form-label">Gender</label>
                            <div class="col-8">
                                <select name="gender" id="gender" class="form-control here">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="addr" class="col-4 col-form-label">Address</label>
                            <div class="col-8">
                                <textarea id="addr" name="addr" cols="40" rows="4" class="form-control"><?=$product['addr']?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="update" type="submit" id="update" class="btn btn-primary">Update My Profile</button>
                            </div>
                        </div>
        </form>
                    <?php endwhile;?>
                    <hr>
                    <h5>Change your Password ?</h5>
                    <form action="#" method="post">
                        <div class="form-group row">
                            <label for="password" class="col-4 col-form-label">Current Password</label>
                            <div class="col-8">
                                <input  name="oldpassword" placeholder="Password" class="form-control here"
                                       required="required" type="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-4 col-form-label">New Password</label>
                            <div class="col-8">
                                <input  name="password" id="password" placeholder="New Password" class="form-control here"
                                       required="required" type="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-4 col-form-label">Confirm New Password</label>
                            <div class="col-8">
                                <input  name="confirmpassword" id="confirmpassword" placeholder="Confirm New Password" class="form-control here"
                                       required="required" type="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="updatepass" id="updatepass" type="submit" class="btn btn-danger">Update My Password</button>
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

<?php else:
header('location: index.php');
endif;
?>
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