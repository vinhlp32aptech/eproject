<?php
include_once "../conn/database.php";
include_once "../conn/Pagination.php";
$db = new database();
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="icon" href="../images/globe-asia-solid.svg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Dancing+Script:400,700|Muli:300,400" rel="stylesheet">

    <!--    <link rel="stylesheet" href="../css/bootstrap.min.css">-->
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
    <link href="../css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pagination.css">

</head>
<body class="fixed-nav sticky-footer " id="page-top">

<div class="container">

    <!--         SIDE AREA-->
    <div class="sideArea">
        <div class="avatar">
            <?php
            if(isset($_SESSION['gotoadmin'])):
                $query =  "select user_name, photo_acc from account where user_name = :user_name";
                $param = [
                    "user_name"=>$_SESSION['gotoadmin']
                ];

                $stmt = $db->selectdataparam($query, $param);
            else:
                header('location: signinad.php');
            endif;
            while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

            <img src="../images/<?=$product['photo_acc'];?>" alt="">
            <div class="avatarName">Welcome,<br><?=$product['user_name'];?></div>
        </div>
        <ul class="sideMenu">
            <li><a href="admin.php?product" class="has-submenu"><span class="fa fa-table"></span>PRODUCT</a>
            </li>
            <li><a href="admin.php?invoice"><span class="fa fa-money"></span>INVOICE</a></li>
            <li><a href="admin.php?user"><span class="fa fa-user-o"></span>USER</a></li>
            <li><a href="admin.php?feedback"><span class="fa fa-user-o"></span>FEEDBACK</a></li>

        </ul>
    </div>
    <!--     SIDE AREA -->
    <div class="mainArea">
        <!-- BEGIN NAV -->
        <nav class="navTop row">
            <div class="menuIcon fl"><span class="fa fa-bars"></span></div>
            <div class="account fr">
                <div class="name has-submenu"><?=$product['user_name'];?><span class="fa fa-angle-down"></span></div>
                <ul class="accountLinks submenu">
                    <li><a href="../index.php">View website</a></li>
                    <li><a href="signinad.php?signout">Log out<span class="fa fa-sign-out fr"></span></a></li>
                </ul>
            </div>
        </nav>
        <!-- END NAV -->
        <?php endwhile;?>

        <?php


//create session
        if(isset($_GET['user'])):
            $_SESSION['user'] = 'kkkk';
            unset($_SESSION['invoice']); unset($_SESSION['product']);
        elseif(isset($_GET['invoice'])):
            $_SESSION['invoice'] = $_GET['invoice'];
            unset($_SESSION['user']); unset($_SESSION['product']);
        elseif(isset($_GET['product'])):
            $_SESSION['product'] = $_GET['product'];
            unset($_SESSION['user']); unset($_SESSION['invoice']);
        elseif(isset($_GET['feedback'])):
            $_SESSION['feedback'] = $_GET['feedback'];
            unset($_SESSION['user']); unset($_SESSION['invoice']); unset($_SESSION['product']);
        endif;

        //////-----------------------------------------------insert data
        //insert product-----------
        if(isset($_POST['addpro'])):
            if($_FILES['photo']['name'] != ''):
                move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$_FILES['photo']['name']);
                $photo = $_FILES['photo']['name'];
            else:
                $photo = $_POST['oldphoto'];
            endif;

            $query = "insert into product(photo, name_pro, price_pro, quantity_pro, status_pro, year_pro, code) values(:photo, :name_pro, :price_pro, :quantity_pro,  :status_pro, :year_pro, :code)";
            $param = [
                "photo"             =>$photo,
                "name_pro"          =>$_POST['name_pro'],
                "price_pro"             =>$_POST['price_pro'],
                "quantity_pro"          =>$_POST['quantity_pro'],
                "status_pro"        =>$_POST['status_pro'],
                "year_pro"       =>$_POST['year_pro'],
                "code"       =>$_POST['code'],
            ];
            $db->insertdataparam($query, $param);
            header('location: admin.php?product');
        endif;

        //insert account-----------
        if(isset($_POST['addacc'])):
            if($_FILES['photo_acc']['name'] != ''):
                move_uploaded_file($_FILES['photo_acc']['tmp_name'], '../images/'.$_FILES['photo_acc']['name']);
                $photo = $_FILES['photo_acc']['name'];
            else:
                $photo = $_POST['oldphoto'];
            endif;

            $query = "insert into account( user_name, password, email, phone, fullname , gender,  dob , addr, photo_acc) values ( :user_name,  :password, :email, :phone, :fullname, :gender, :dob, :addr, :photo_acc)";
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $param = [
                "user_name"          =>$_POST['user_name'],
                "password"             =>$hash,
                "email"          =>$_POST['email'],
                "phone"        =>$_POST['phone'],
                "fullname"       =>$_POST['fullname'],
                "gender"       =>$_POST['gender'],
                "dob"       =>$_POST['dob'],
                "addr"       =>$_POST['addr'],
                "photo_acc"             =>$photo,

            ];
            $db->updatedataparam($query, $param);
            header('location: admin.php?user');
        endif;

        //delete data and save it
        //        ----hide product
        if(isset($_GET['hidepro'])):
            $query = "update product set status = 0 where id_pro = :id_pro" ;
            $param = [
                "id_pro" => $_GET['hidepro'],
            ];
            $stmt = $db->updatedataparam($query, $param);
        endif;
//
        //        ----hide account
        if(isset($_GET['hideacc'])):
            $query = "update account set status = 0 where id_acc = :id_acc" ;
            $param = [
                "id_acc" => $_GET['hideacc'],
            ];
            $stmt = $db->updatedataparam($query, $param);
        endif;
        //        ----hide feedback
        if(isset($_GET['hidefeedback'])):
            $query = "update feedback set status = 0 where id_feedback = :id_feedback" ;
            $param = [
                "id_feedback" => $_GET['hidefeedback'],
            ];
            $stmt = $db->updatedataparam($query, $param);
        endif;
        ////-------------------------update data---------------------------------------------
        //////update product
        if(isset($_POST['savechangepro'])):
            if($_FILES['photo']['name'] != ''):
                move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$_FILES['photo']['name']);
                $photo = $_FILES['photo']['name'];
            else:
                $photo = $_POST['oldphoto'];
            endif;

            $query = "update product set photo = :photo, name_pro = :name_pro, price_pro = :price_pro, quantity_pro = :quantity_pro, status_pro = :status_pro, year_pro = :year_pro, code = :code where id_pro= :id_pro";
            $param = [
                "photo"             =>$photo,
                "name_pro"          =>$_POST['name_pro'],
                "price_pro"             =>$_POST['price_pro'],
                "quantity_pro"          =>$_POST['quantity_pro'],
                "status_pro"        =>$_POST['status_pro'],
                "year_pro"       =>$_POST['year_pro'],
                "code"       =>$_POST['code'],
                "id_pro"                =>$_GET['id_pro']
            ];
            $db->updatedataparam($query, $param);
            header('location: admin.php?id_pro='.$_GET['id_pro']);
        endif;



        /////update data
        if(isset($_SESSION['product']) || isset($_GET['id_pro'])):
        ///////--------------
        //show data, search and paging
        if(isset($_GET['searchpro'])):
            $query ="select * from product where status = 1 && concat(name_pro, price_pro, status_pro, year_pro, code) like ? ";
            $param = [
                "%{$_GET['searchpro']}%"
            ];
            $stmt = $db->selectDataParam($query, $param);
            $total = $stmt->rowCount();
            $config = [
                'current_page'  => isset($_GET['page'])?$_GET['page']: 1,
                'total_record'  => $total,
                'limit'         => 10,// limit
                'link_full'     => (trim($_GET['searchpro'])=="")?'admin.php?page={page}':"admin.php?page={page}&searchpro={$_GET['searchpro']}",
                'link_first'    => (trim($_GET['searchpro'])=="")?'admin.php':"admin.php?searchpro={$_GET['searchpro']}",
                'range'         => 5,
            ];
            if (isset($_GET['page'])):
                $_SESSION['page']  = $_GET['page'];
            endif;
            $paging = new Pagination();
            $paging->init($config);
            $query = "select * from product where status = 1 && concat(name_pro, price_pro, status_pro, year_pro, code) like ? " .$paging->get_limit();
            $stmt = $db->selectdataparam($query,$param);
        else:
            $query = "select * from product where status = 1 ";
            $stmt = $db->selectData($query);
            $total = $stmt->rowCount();
            $config = [
                'current_page'  => isset($_GET['page'])?$_GET['page']: 1,
                'total_record'  => $total,
                'limit'         => 10,// limit
                'link_full'     => 'admin.php?page={page}',
                'link_first'    => 'admin.php',
                'range'         => 5,
            ];
            $paging = new Pagination();
            $paging->init($config);
            $query = "select * from product where status = 1 " .$paging->get_limit();
            $stmt = $db->selectdata($query);
        endif;
        ?>

        <div class="mainContent">
            <!-- LIST FORM -->
            <div class="row filterGroup">
                <form action="#" method="get" class="formSearch fl">
                    <input type="text" class="inputSearch" placeholder="Search" name="searchpro">
                    <button type="submit" class="btnSearch"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <form action="#" method="GET" name="listForm" class="form scrollX">
                <div class="formHeader row">
                    <h2 class="text-1 fl">Product List</h2>
                    <div class="fr">
                        <a href="admin.php?addpro" class="btnAdd fa fa-plus bg-1 text-fff"></a>
                    </div>
                </div>
                <div class="table">
                    <div class="row bg-1">
                        <div class="cell cell-50 text-center text-fff">ID</div>
                        <div class="cell cell-200 text-center text-fff">PHOTO</div>
                        <div class="cell cell-100p text-center text-fff">NAME</div>
                        <div class="cell cell-100 text-center text-fff">PRICE</div>
                        <div class="cell cell-100 text-center text-fff">QUANTITY</div>
                        <div class="cell cell-100 text-center text-fff">STATUS</div>
                        <div class="cell cell-100 text-center text-fff">YEAR</div>
                        <div class="cell cell-100 text-center text-fff">CODE</div>
                        <div class="cell cell-100 text-center text-fff">EDIT</div>
                    </div>
                    <!--   BEGIN LOOP -->
                    <?php
                    while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

                        <ul>
                            <li class="row">
                                <div class="cell cell-50 text-center"><?=$product['id_pro'];?></div>
                                <div class="cell cell-200 text-center">
                                    <a href="admin.php?page=<?= isset($_GET['page'])?$_GET['page']: 1; ?>&id_pro=<?=$product['id_pro'];?>&searchpro=<?= isset($_GET['searchpro'])?$_GET['searchpro']: ''; ?>"><img src="../images/<?=$product['photo'];?>" alt="" width="100"></a>

                                </div>
                                <div class="cell cell-100p text-center"><a href="admin.php?page=<?= isset($_GET['page'])?$_GET['page']: 1; ?>&id_pro=<?=$product['id_pro'];?>&searchpro=<?= isset($_GET['searchpro'])?$_GET['searchpro']: ''; ?>"><?=$product['name_pro'];?></a></div>
                                <div class="cell cell-100 text-center"><?=$product['price_pro'];?></div>
                                <div class="cell cell-100 text-center"><?=$product['quantity_pro'];?></div>
                                <div class="cell cell-100 text-center"><?=$product['status_pro'];?></div>
                                <div class="cell cell-100 text-center"><?=$product['year_pro'];?></div>
                                <div class="cell cell-100 text-center"><?=$product['code'];?></div>
                                <div class="cell cell-100 text-center">
                                    <a href="admin.php?page=<?= isset($_GET['page'])?$_GET['page']: 1; ?>&id_pro=<?=$product['id_pro'];?>&searchpro=<?= isset($_GET['searchpro'])?$_GET['searchpro']: ''; ?>" class="btnEdit fa fa-pencil bg-1 text-fff"></a><a href="admin.php?page=<?= isset($_GET['page'])?$_GET['page']: 1; ?>&hidepro=<?=$product['id_pro'];?>&searchpro=<?= isset($_GET['searchpro'])?$_GET['searchpro']: ''; ?>" class="btnRemove fa fa-remove bg-1 text-fff" onclick='return confirm("Do you really want to remove it ?")'></a>
                                </div>
                            </li>
                        </ul>
                    <?php endwhile; ?>

                    <!--   END LOOP -->
                </div>
            </form>
            <?php if(isset($paging)):
                echo $paging->html();
            endif; ?>

            <!-- DETAIL FORM -->
            <?php
            if(isset($_GET['id_pro'])):
                $query =  "select * from product where id_pro = :id_pro";
                $param = [
                    "id_pro"=>$_GET['id_pro']
                ];

                $stmt = $db->selectdataparam($query, $param);
            endif;
            while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

                <form action="admin.php?id_pro=<?=$product['id_pro'];?>" method="post" enctype="multipart/form-data" class="form">
                    <div class="formHeader row">
                        <h2 class="text-1 fl">Product Detail</h2>
                        <div class="fr">
                            <button type="submit" class="btnSave bg-1 text-fff text-bold fr" name="savechangepro">SAVE</button>
                        </div>
                    </div>

                    <div class="formBody row">
                        <div class="column s-6">
                            <label class="inputGroup">
                                <span>Name</span>
                                <span><input type="text" name="name_pro" value="<?=$product['name_pro'];?>"></span>
                            </label>
                            <label class="inputGroup">
                                <span>Price</span>
                                <span><input type="number" name="price_pro" value="<?=$product['price_pro'];?>"></span>
                            </label>
                            <label class="inputGroup">
                                <span>Quantity</span>
                                <span><input type="number" name="quantity_pro" value="<?=$product['quantity_pro'];?>"></span>
                            </label>
                            <label class="inputGroup">
                                <span>Year</span>
                                <span><input type="number" name="year_pro" maxlength="4" value="<?=$product['year_pro'];?>"></span>
                            </label>
                        </div>
                        <div class="column s-6">
                            <label class="inputGroup">
                                <span>Code</span>
                                <span><input type="text" name="code" value="<?=$product['code'];?>"></span>
                            </label>
                            <label class="inputGroup">
                                <span>Status</span>
                                <span><input type="text" name="status_pro" value="<?=$product['status_pro'];?>"></span>
                            </label>
                            <label class="inputGroup">
                                <span>Image</span>
                                <span>
                <input type="hidden" name="oldphoto" value="<?=$product['photo'];?>">
                <input type="file" name="photo" onchange="getImg(this)" multiple><br/>
                <img src="../images/<?=$product['photo'];?>" height="200px" id="photo"><br/>
                            </span>
                            </label>
                        </div>
                    </div>
                </form>
            <?php endwhile;$db->closeconnect();?>
            <?php if(isset($_GET['addpro'])):?>
                <form action="admin.php?id_pro" method="post" enctype="multipart/form-data" class="form">
                    <div class="formHeader row">
                        <h2 class="text-1 fl">Add Product</h2>
                        <div class="fr">
                            <button type="submit" class="btnSave bg-1 text-fff text-bold fr" name="addpro">SAVE</button>
                        </div>
                    </div>

                    <div class="formBody row">
                        <div class="column s-6">
                            <label class="inputGroup">
                                <span>Name</span>
                                <span><input type="text" name="name_pro" ></span>
                            </label>
                            <label class="inputGroup">
                                <span>Price</span>
                                <span><input type="number" name="price_pro" ></span>
                            </label>
                            <label class="inputGroup">
                                <span>Quantity</span>
                                <span><input type="number" name="quantity_pro" ></span>
                            </label>
                            <label class="inputGroup">
                                <span>Year</span>
                                <span><input type="number" name="year_pro" maxlength="4" ></span>
                            </label>
                        </div>
                        <div class="column s-6">
                            <label class="inputGroup">
                                <span>Code</span>
                                <span><input type="text" name="code"></span>
                            </label>
                            <label class="inputGroup">
                                <span>Status</span>
                                <span><input type="text" name="status_pro"></span>
                            </label>
                            <label class="inputGroup">
                                <span>Image</span>
                                <span>
                <input type="hidden" name="oldphoto" >
                <input type="file" name="photo" onchange="getImg(this)" multiple><br/>
                <img src="" height="200px" id="photo"><br/>
                            </span>
                            </label>
                        </div>
                    </div>
                </form>
            <?php endif;?>
        </div>
        <!-- END CONTAINER  -->
    </div>
</div>

<!--//////----------------user--------------------------------------------->
<?php
elseif (isset($_SESSION['user'])):
    //show data, search and paging
    if(isset($_GET['searchacc'])):
        $query ="select * from account where status = 1 && concat(user_name, email, phone, fullname, dob, addr) like ? ";
        $param = [
            "%{$_GET['searchacc']}%"
        ];
        $stmt = $db->selectDataParam($query, $param);
        $total = $stmt->rowCount();
        $config = [
            'current_page'  => isset($_GET['page'])?$_GET['page']: 1,
            'total_record'  => $total,
            'limit'         => 10,// limit
            'link_full'     => (trim($_GET['searchacc'])=="")?'admin.php?page={page}':"admin.php?page={page}&searchacc={$_GET['searchacc']}",
            'link_first'    => (trim($_GET['searchacc'])=="")?'admin.php':"admin.php?searchacc={$_GET['searchacc']}",
            'range'         => 5,
        ];
        $paging = new Pagination();
        $paging->init($config);
        $query = "select * from account where status = 1 && concat(user_name, email, phone, fullname, dob, addr) like ? " .$paging->get_limit();
        $stmt = $db->selectdataparam($query,$param);
    else:

        $query = "select * from account where status = 1 ";
        $stmt = $db->selectData($query);
        $total = $stmt->rowCount();
        $config = [
            'current_page'  => isset($_GET['page'])?$_GET['page']: 1,
            'total_record'  => $total,
            'limit'         => 10,// limit
            'link_full'     => 'admin.php?page={page}',
            'link_first'    => 'admin.php',
            'range'         => 5,
        ];
        $paging = new Pagination();
        $paging->init($config);
        $query = "select * from account where status = 1 " .$paging->get_limit();
        $stmt = $db->selectdata($query);
    endif;
    ?>

    <div class="mainContent">
        <!-- LIST FORM -->
        <div class="row filterGroup">
            <form action="#" method="get" class="formSearch fl">
                <input type="text" class="inputSearch" placeholder="Search" name="searchacc">
                <button type="submit" class="btnSearch"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <form action="#" method="GET" name="listForm" class="form scrollX">
            <div class="formHeader row">
                <h2 class="text-1 fl">User List</h2>

            </div>
            <div class="table">
                <div class="row bg-1">
                    <div class="cell cell-50 text-center text-fff">ID</div>
                    <div class="cell cell-200 text-center text-fff">PHOTO</div>
                    <div class="cell cell-200 text-center text-fff">USER_NAME</div>
                    <div class="cell cell-200 text-center text-fff">EMAIL</div>
                    <div class="cell cell-100p text-center text-fff">FULLNAME</div>

                    <div class="cell cell-100 text-center text-fff">DOB</div>

                    <div class="cell cell-100 text-center text-fff">PHONE</div>
                    <div class="cell cell-100 text-center text-fff">EDIT</div>
                </div>
                <!--   BEGIN LOOP -->
                <?php
                while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>
                    <ul>
                        <li class="row">
                            <div class="cell cell-50 text-center"><?=$product['id_acc'];?></div>
                            <div class="cell cell-200 text-center">
                                <a href="admin.php?page=<?= isset($_GET['page'])?$_GET['page']: 1; ?>&id_acc=<?=$product['id_acc'];?>&searchacc=<?= isset($_GET['searchacc'])?$_GET['searchacc']: ''; ?>"><img src="../images/<?=$product['photo_acc'];?>" alt="" width="100"></a>
                            </div>
                            <div class="cell cell-200 text-center"><a href="admin.php?page=<?= isset($_GET['page'])?$_GET['page']: 1; ?>&id_acc=<?=$product['id_acc'];?>&searchacc=<?= isset($_GET['searchacc'])?$_GET['searchacc']: ''; ?>"><?=$product['user_name'];?></a></div>
                            <div class="cell cell-200 text-center"><?=$product['email'];?></div>
                            <div class="cell cell-100p text-center"><?=$product['fullname'];?></div>

                            <div class="cell cell-100 text-center"><?=$product['dob'];?></div>

                            <div class="cell cell-100 text-center"><?=$product['phone'];?></div>

                            <div class="cell cell-100 text-center"> <a href="admin.php?page=<?= isset($_GET['page'])?$_GET['page']: 1; ?>&hideacc=<?=$product['id_acc'];?>&searchpro=<?= isset($_GET['searchpro'])?$_GET['searchpro']: ''; ?>" class="btnRemove fa fa-remove bg-1 text-fff" onclick='return confirm("Do you really want to remove it ?")'></a>
                            </div>
                        </li>
                    </ul>
                <?php endwhile; ?>

                <!--   END LOOP -->
            </div>

        </form>
        <?php if(isset($paging)):
            echo $paging->html();
        endif; ?>

        <!-- DETAIL FORM -->
        <?php
        if(isset($_GET['id_acc'])):
            $query =  "select * from account where id_acc = :id_acc";
            $param = [
                "id_acc"=>$_GET['id_acc']
            ];

            $stmt = $db->selectdataparam($query, $param);
        endif;
        while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

            <form action="admin.php?id_acc=<?=$product['id_acc'];?>" method="post" enctype="multipart/form-data" class="form">
                <div class="formHeader row">
                    <h2 class="text-1 fl">Account Detail</h2>
                </div>

                <div class="formBody row">
                    <div class="column s-6">
                        <label class="inputGroup">
                            <span>User name</span>
                            <span><input type="text" name="user_name" value="<?=$product['user_name'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Email</span>
                            <span><input type="email" name="email" value="<?=$product['email'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Full name</span>
                            <span><input type="text" name="fullname" value="<?=$product['fullname'];?>"></span>
                        </label>
                        <label class="inputGroup" for="gender">
                            <span>Gender</span>
                            <span>
                                  <input list="genders" name="gender" id="gender">
                                  <datalist id="genders">
                                    <option value="Male">
                                    <option value="Female">
                                    <option value="Other">
                                  </datalist>
                            </span>

                        </label>
                    </div>
                    <div class="column s-6">
                        <label class="inputGroup">
                            <span>Date of birth</span>
                            <span><input type="text" name="dob" value="<?=$product['dob'];?>" maxlength="11"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Phone</span>
                            <span><input type="number" name="phone" value="<?=$product['phone'];?>" maxlength="11"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Address</span>
                            <span><input type="text" name="addr" value="<?=$product['addr'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Image</span>
                            <span>
                <input type="hidden" name="oldphoto" value="<?=$product['photo_acc'];?>">
                <img src="../images/<?=$product['photo_acc'];?>" height="200px" id="photo_acc"><br/>
                            </span>
                        </label>
                    </div>
                </div>
            </form>
        <?php endwhile;$db->closeconnect();?>
    </div>
    <!-- END CONTAINER  -->
    </div>
    </div>

<?php
elseif(isset($_SESSION['invoice'])):
//show data, search and paging
    if(isset($_GET['searchinv'])):
        $query ="select * from invoice_details where status = 1 && concat(name_pro,price,date_purchase,addr,phone,total) like ? ";
        $param = [
            "%{$_GET['searchinv']}%"
        ];
        $stmt = $db->selectDataParam($query, $param);
        $total = $stmt->rowCount();
        $config = [
            'current_page'  => isset($_GET['page'])?$_GET['page']: 1,
            'total_record'  => $total,
            'limit'         => 10,// limit
            'link_full'     => (trim($_GET['searchinv'])=="")?'admin.php?page={page}':"admin.php?page={page}&searchinv={$_GET['searchinv']}",
            'link_first'    => (trim($_GET['searchinv'])=="")?'admin.php':"admin.php?searchinv={$_GET['searchinv']}",
            'range'         => 5,
        ];
        $paging = new Pagination();
        $paging->init($config);
        $query = "select * from invoice_details where status = 1 && concat(name_pro,price,date_purchase,addr,phone,total) like ? " .$paging->get_limit();
        $stmt = $db->selectdataparam($query,$param);
    else:

        $query = "select * from invoice_details where status = 1 ";
        $stmt = $db->selectData($query);
        $total = $stmt->rowCount();
        $config = [
            'current_page'  => isset($_GET['page'])?$_GET['page']: 1,
            'total_record'  => $total,
            'limit'         => 10,// limit
            'link_full'     => 'admin.php?page={page}',
            'link_first'    => 'admin.php',
            'range'         => 5,
        ];
        $paging = new Pagination();
        $paging->init($config);
        $query = "select * from invoice_details where status = 1 " .$paging->get_limit();
        $stmt = $db->selectdata($query);
    endif;
    ?>

    <div class="mainContent">
        <!-- LIST FORM -->
        <div class="row filterGroup">
            <form action="#" method="get" class="formSearch fl">
                <input type="text" class="inputSearch" placeholder="Search" name="searchinv">
                <button type="submit" class="btnSearch"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <form action="#" method="GET" name="listForm" class="form scrollX">
            <div class="formHeader row">
                <h2 class="text-1 fl">Invoice List</h2>

            </div>
            <div class="table">
                <div class="row bg-1">
                    <div class="cell cell-50 text-center text-fff">ID</div>
                    <div class="cell cell-100 text-center text-fff">INVOICE_NO</div>
                    <div class="cell cell-100 text-center text-fff">PHOTO</div>
                    <div class="cell cell-100p text-center text-fff">NAME</div>
                    <div class="cell cell-100 text-center text-fff">PRICE</div>
                    <div class="cell cell-100 text-center text-fff">QUANTITY</div>
                    <div class="cell cell-150 text-center text-fff">DATE_PURCHASE</div>
                    <div class="cell cell-100 text-center text-fff">PHONE</div>
                    <div class="cell cell-200 text-center text-fff">TOTAL</div>
                </div>
                <!--   BEGIN LOOP -->
                <?php
                while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

                    <ul>
                        <li class="row">
                            <div class="cell cell-50 text-center"><?=$product['id_inv'];?></div>
                            <div class="cell cell-100 text-center"><?=$product['invoice_no'];?></div>
                            <div class="cell cell-100 text-center">
                                <a href="admin.php?page=<?= isset($_GET['page'])?$_GET['page']: 1; ?>&id_inv=<?=$product['id_inv'];?>&searchinv=<?= isset($_GET['searchinv'])?$_GET['searchinv']: ''; ?>"><img src="../images/<?=$product['photo_inv'];?>" alt="" width="100"></a>
                            </div>
                            <div class="cell cell-100p text-center"><a href="admin.php?page=<?= isset($_GET['page'])?$_GET['page']: 1; ?>&id_inv=<?=$product['id_inv'];?>&searchinv=<?= isset($_GET['searchinv'])?$_GET['searchinv']: ''; ?>"><?=$product['name_pro'];?></a></div>
                            <div class="cell cell-100 text-center"><?=$product['price'];?></div>
                            <div class="cell cell-100 text-center"><?=$product['quantity'];?></div>
                            <div class="cell cell-150 text-center"><?=date("m-d-Y h:i:s", strtotime($product['date_purchase']));?></div>
                            <div class="cell cell-100 text-center"><?=$product['phone'];?></div>
                            <div class="cell cell-200 text-center"><?=$product['total'];?></div>
                        </li>
                    </ul>
                <?php endwhile; ?>

                <!--   END LOOP -->
            </div>
        </form>
        <?php if(isset($paging)):
            echo $paging->html();
        endif; ?>

        <!-- DETAIL FORM -->
        <?php
        if(isset($_GET['id_inv'])):
            $query =  "select * from invoice_details where id_inv = :id_inv";
            $param = [
                "id_inv"=>$_GET['id_inv']
            ];

            $stmt = $db->selectdataparam($query, $param);
        endif;
        while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

            <form action="#" method="post" enctype="multipart/form-data" class="form">
                <div class="formHeader row">
                    <h2 class="text-1 fl">Invoice Detail</h2>

                </div>

                <div class="formBody row">
                    <div class="column s-6">
                        <label class="inputGroup">
                            <span>ID invoice</span>
                            <span><input type="number" name="id_inv" value="<?=$product['id_inv'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>ID product</span>
                            <span><input type="number" name="id_pro" value="<?=$product['id_pro'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Invoice_no</span>
                            <span><input type="number" name="invoice_no" value="<?=$product['invoice_no'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Name</span>
                            <span><input type="text" name="name_pro" value="<?=$product['name_pro'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Price</span>
                            <span><input type="number" name="price" value="<?=$product['price'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Quantity</span>
                            <span><input type="number" name="quantity" value="<?=$product['quantity'];?>"></span>
                        </label>

                    </div>
                    <div class="column s-6">
                        <label class="inputGroup">
                            <span>Date of purchase</span>
                            <span><input type="text" name="date_of_purchase" value="<?=date("m-d-Y h:i:s", strtotime($product['date_purchase']));?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Phone</span>
                            <span><input type="tel" name="phone" value="<?=$product['phone'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Address</span>
                            <span><input type="text" name="addr" value="<?=$product['addr'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>TOTAL</span>
                            <span><input type="number" name="total" value="<?=$product['total'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Image</span>
                            <span>
                <input type="hidden" name="oldphoto" value="<?=$product['photo_inv'];?>">
                <img src="../images/<?=$product['photo_inv'];?>" height="200px" id="photo_inv"><br/>
                            </span>
                        </label>
                    </div>
                </div>
            </form>
        <?php endwhile;$db->closeconnect();?>
    </div>
    <!-- END CONTAINER  -->
    </div>
<?php else:
    if(isset($_GET['searchfeedback'])):
    $query ="select * from feedback where status = 1 && concat(id_acc,id_pro,user_name) like ? ";
    $param = [
    "%{$_GET['searchfeedback']}%"
    ];
    $stmt = $db->selectDataParam($query, $param);
    $total = $stmt->rowCount();
    $config = [
    'current_page'  => isset($_GET['page'])?$_GET['page']: 1,
    'total_record'  => $total,
    'limit'         => 10,// limit
    'link_full'     => (trim($_GET['searchfeedback'])=="")?'admin.php?page={page}':"admin.php?page={page}&searchfeedback={$_GET['searchfeedback']}",
    'link_first'    => (trim($_GET['searchfeedback'])=="")?'admin.php':"admin.php?searchfeedback={$_GET['searchfeedback']}",
    'range'         => 5,
    ];
    $paging = new Pagination();
    $paging->init($config);
    $query = "select * from feedback where status = 1 && concat(id_acc,id_pro,user_name) like ? " .$paging->get_limit();
    $stmt = $db->selectdataparam($query,$param);
    else:

    $query = "select * from feedback where status = 1 ";
    $stmt = $db->selectData($query);
    $total = $stmt->rowCount();
    $config = [
    'current_page'  => isset($_GET['page'])?$_GET['page']: 1,
    'total_record'  => $total,
    'limit'         => 10,// limit
    'link_full'     => 'admin.php?page={page}',
    'link_first'    => 'admin.php',
    'range'         => 5,
    ];
    $paging = new Pagination();
    $paging->init($config);
    $query = "select * from feedback where status = 1 " .$paging->get_limit();
    $stmt = $db->selectdata($query);
    endif;
    ?>

    <div class="mainContent">
        <!-- LIST FORM -->
        <div class="row filterGroup">
            <form action="#" method="get" class="formSearch fl">
                <input type="text" class="inputSearch" placeholder="Search" name="searchfeedback">
                <button type="submit" class="btnSearch"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <form action="#" method="GET" name="listForm" class="form scrollX">
            <div class="formHeader row">
                <h2 class="text-1 fl">Feedback List</h2>

            </div>
            <div class="table">
                <div class="row bg-1">
                    <div class="cell cell-100 text-center text-fff">ID FEEDBACK</div>
                    <div class="cell cell-100 text-center text-fff">ID PRODUCT</div>
                    <div class="cell cell-100 text-center text-fff">ID ACCOUNT</div>
                    <div class="cell cell-200 text-center text-fff">USER_NAME</div>
                    <div class="cell cell-100p text-center text-fff">CONTENT</div>
                    <div class="cell cell-100 text-center text-fff">EDIT</div>
                </div>
                <!--   BEGIN LOOP -->
                <?php
                while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

                    <ul>
                        <li class="row">
                            <div class="cell cell-100 text-center"><?=$product['id_feedback'];?></div>
                            <div class="cell cell-100 text-center"><?=$product['id_pro'];?></div>
                            <div class="cell cell-100 text-center"><?=$product['id_acc'];?></div>
                            <div class="cell cell-200 text-center"><a href="admin.php?page=<?= isset($_GET['page'])?$_GET['page']: 1; ?>&id_feedback=<?=$product['id_feedback'];?>&searchfeedback=<?= isset($_GET['searchfeedback'])?$_GET['searchfeedback']: ''; ?>"><?=$product['user_name'];?></a></div>
                            <div class="cell cell-100p text-center"><?=$product['content'];?></div>
                            <div class="cell cell-100 text-center"><a href="admin.php?page=<?= isset($_GET['page'])?$_GET['page']: 1; ?>&hidefeedback=<?=$product['id_feedback'];?>&searchfeedback=<?= isset($_GET['searchfeedback'])?$_GET['searchfeedback']: ''; ?>" class="btnRemove fa fa-remove bg-1 text-fff" onclick='return confirm("Do you really want to remove it ?")'></a>
                            </div>
                        </li>
                    </ul>
                <?php endwhile; ?>

                <!--   END LOOP -->
            </div>
        </form>
        <?php if(isset($paging)):
            echo $paging->html();
        endif; ?>

        <!-- DETAIL FORM -->
        <?php
        if(isset($_GET['id_feedback'])):
            $query =  "select * from feedback where id_feedback = :id_feedback";
            $param = [
                "id_feedback"=>$_GET['id_feedback']
            ];

            $stmt = $db->selectdataparam($query, $param);
        endif;
        while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

            <form action="admin.php?id_feedback=<?=$product['id_feedback'];?>" method="post" enctype="multipart/form-data" class="form">
                <div class="formHeader row">
                    <h2 class="text-1 fl">Feedback Detail</h2>

                </div>

                <div class="formBody row">
                    <div class="column s-4">
                        <label class="inputGroup">
                            <span>ID feedback</span>
                            <span><input type="number" name="id_feedback" value="<?=$product['id_feedback'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>ID Product</span>
                            <span><input type="number" name="id_pro" value="<?=$product['id_pro'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>ID Account</span>
                            <span><input type="number" name="id_acc" value="<?=$product['id_acc'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>User name</span>
                            <span><input type="text" name="name_pro" value="<?=$product['user_name'];?>"></span>
                        </label>
                    </div>
                    <div class="column s-8">

                        <label class="inputGroup">
                            <span>Content</span>
                            <span>  <textarea id="addr" name="addr" cols="80" rows="4" class="form-control"><?=$product['content']?></textarea></span>
                        </label>
                    </div>
                </div>
            </form>
        <?php endwhile;$db->closeconnect();?>
    </div>
    <!-- END CONTAINER  -->
    </div>
<?php endif;?>
</div>
</div>
</script>
<script src="js/main.js"></script>
<script src="js/editiamge.js"></script>

</body>
</html>
