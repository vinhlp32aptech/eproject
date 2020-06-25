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
    <title>Document</title>
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



if(isset($_GET['user'])):
    $_SESSION['user'] = 'kkkk';
unset($_SESSION['invoice']); unset($_SESSION['product']);
elseif(isset($_GET['invoice'])):
    $_SESSION['invoice'] = $_GET['invoice'];
    unset($_SESSION['user']); unset($_SESSION['product']);
elseif(isset($_GET['product'])):
    $_SESSION['product'] = $_GET['product'];
    unset($_SESSION['user']); unset($_SESSION['invoice']);
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
        //insert invoice-----------

        if(isset($_POST['addinv'])):
            if($_FILES['photo_inv']['name'] != ''):
                move_uploaded_file($_FILES['photo_inv']['tmp_name'], '../images/'.$_FILES['photo_inv']['name']);
                $photo = $_FILES['photo_inv']['name'];
            else:
                $photo = $_POST['oldphoto'];
            endif;

            $query = "insert into invoice_details(id_inv , id_pro  , photo_inv  , name_pro  , date_of_purchase , addr , phone, quantity, price, total ) values(:id_inv, :id_pro, :photo_inv, :name_pro, :date_of_purchase, :addr, :phone, :quantity, :price, :total)";
            $param = [
                "id_inv"       =>$_POST['id_inv'],
                "id_pro"       =>$_POST['id_pro'],
                "photo_inv"             =>$photo,
                "name_pro"          =>$_POST['name_pro'],
                "date_of_purchase"             =>$_POST['date_of_purchase'],
                "addr"          =>$_POST['addr'],
                "phone"        =>$_POST['phone'],
                "quantity"       =>$_POST['quantity'],
                "price"       =>$_POST['price'],
                "total"       =>$_POST['total'],
            ];
            $db->updatedataparam($query, $param);
            header('location: admin.php?invoice');
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
//    header('location: '. $_SERVER['REQUEST_URI']);
endif;
        //        ----hide product
        if(isset($_GET['hideinv'])):
            $query = "update invoice_details set status = 0 where id_inv = :id_inv" ;
            $param = [
                "id_inv" => $_GET['hideinv'],
            ];
            $stmt = $db->updatedataparam($query, $param);
//            header('location: '. $_SERVER['REQUEST_URI']);
        endif;
        //        ----hide product
        if(isset($_GET['hideacc'])):
            $query = "update account set status = 0 where id_acc = :id_acc" ;
            $param = [
                "id_acc" => $_GET['hideacc'],
            ];
            $stmt = $db->updatedataparam($query, $param);
//            header('location: '. $_SERVER['REQUEST_URI']);
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


/////uppdate account
if(isset($_POST['savechangeacc'])):
    if($_FILES['photo_acc']['name'] != ''):
        move_uploaded_file($_FILES['photo_acc']['tmp_name'], '../images/'.$_FILES['photo_acc']['name']);
        $photo = $_FILES['photo_acc']['name'];
    else:
        $photo = $_POST['oldphoto'];
    endif;

    $query = "update account set user_name = :user_name, password = :password, email = :email, phone = :phone, fullname = :fullname, gender = :gender, dob = :dob, addr = :addr, photo_acc = :photo_acc where id_acc= :id_acc";
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
        "id_acc"                =>$_GET['id_acc'],

    ];
    $db->updatedataparam($query, $param);
    header('location: admin.php?id_acc='.$_GET['id_acc']);
endif;

////// update invoice
if(isset($_POST['savechangeinv'])):
    if($_FILES['photo_inv']['name'] != ''):
        move_uploaded_file($_FILES['photo_inv']['tmp_name'], '../images/'.$_FILES['photo_inv']['name']);
        $photo = $_FILES['photo_inv']['name'];
    else:
        $photo = $_POST['oldphoto'];
    endif;

    $query = "update invoice_details set id_inv = :id_inv, id_pro = :id_pro, photo_inv = :photo_inv, name_pro = :name_pro, date_of_purchase = :date_of_purchase, addr = :addr, phone = :phone, quantity = :quantity, price = :price, total = :total where id_inv = :id_inv";
    $param = [
        "id_inv"       =>$_POST['id_inv'],
        "id_pro"       =>$_POST['id_pro'],
        "photo_inv"             =>$photo,
        "name_pro"          =>$_POST['name_pro'],
        "date_of_purchase"             =>$_POST['date_of_purchase'],
        "addr"          =>$_POST['addr'],
        "phone"        =>$_POST['phone'],
        "quantity"       =>$_POST['quantity'],
        "price"       =>$_POST['price'],
        "total"       =>$_POST['total'],
        "id_inv"                =>$_GET['id_inv']
    ];
    $db->updatedataparam($query, $param);
    header('location: admin.php?id_inv='.$_GET['id_inv']);
endif;

/////update data


if(isset($_SESSION['product'])):
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
        'current_page'  => isset($_GET['page'])?$_GET['page']: 1, // Trang hiện tại
        'total_record'  => $total, // Tổng số record -> tong so hang
        'limit'         => 10,// limit
        'link_full'     => (trim($_GET['searchpro'])=="")?'admin.php?page={page}':"admin.php?page={page}&searchpro={$_GET['searchpro']}",// Link full có dạng như sau: domain/com/page/{page}
        'link_first'    => (trim($_GET['searchpro'])=="")?'admin.php':"admin.php?searchpro={$_GET['searchpro']}",// Link trang đầu tiên
        'range'         => 5, // Số button trang bạn muốn hiển thị
    ];
    $paging = new Pagination();
    $paging->init($config);
    $query = "select * from product where status = 1 && concat(name_pro, price_pro, status_pro, year_pro, code) like ? " .$paging->get_limit();
    $stmt = $db->selectdataparam($query,$param);
else:
$query = "select * from product where status = 1 ";
$stmt = $db->selectData($query);
$total = $stmt->rowCount();
$config = [
    'current_page'  => isset($_GET['page'])?$_GET['page']: 1, // Trang hiện tại
    'total_record'  => $total, // Tổng số record -> tong so hang
    'limit'         => 10,// limit
    'link_full'     => 'admin.php?page={page}',// Link full có dạng như sau: domain/com/page/{page}
    'link_first'    => 'admin.php',// Link trang đầu tiên
    'range'         => 5, // Số button trang bạn muốn hiển thị
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
                <!--                <div class="areaFilter fr row">-->
                <!--                    <div class="boxSelect fr">-->
                <!--                        <div class="titleSelect">Sort by</div>-->
                <!--                        <ul class="optionSelect">-->
                <!--                            <li sortIndex="0"><a href="">Alphabet</a></li>-->
                <!--                            <li sortIndex="1"><a href="">Price, Ascending</a></li>-->
                <!--                            <li sortIndex="2"><a href="">Price, Descending</a></li>-->
                <!--                            <li sortIndex="3"><a href="">Latest</a></li>-->
                <!--                        </ul>-->
                <!--                    </div>-->
                <!--                    <!-      FILTER -->
                <!--                    <div class="btnFilter fr bg-fff"><span class="fa fa-filter"></span>Filter</div>-->
                <!--                    <div class="boxFilter">-->
                <!--                        <div class="btnFilter"><span class="fa fa-close"></span>Close</div>-->
                <!--                        <!-          GROUP -->
                <!--                        <div class="groupInput">-->
                <!--                            <select name="">-->
                <!--                                <option value="">Brand</option>-->
                <!--                                <option value="">Brand 01</option>-->
                <!--                                <option value="">Brand 02</option>-->
                <!--                            </select>-->
                <!--                            <select name="">-->
                <!--                                <option value="">Category</option>-->
                <!--                                <option value="">Category 01</option>-->
                <!--                                <option value="">Category 02</option>-->
                <!--                            </select>-->
                <!--                            <select name="">-->
                <!--                                <option value="">Author</option>-->
                <!--                                <option value="">Author 01</option>-->
                <!--                                <option value="">Author 02</option>-->
                <!--                            </select>-->
                <!--                        </div>-->
                <!--                                END GROUP -->
                <!--                        <!-           GROUP -->
                <!--                        <div class="groupInput">-->
                <!--                            <p class="titleInput">Price</p>-->
                <!--                            <div id="filterPrice"></div>-->
                <!--                            <div class="areaValue">-->
                <!--                                <p>From</p>-->
                <!--                                <input type="text" class="rangeValue">-->
                <!--                                <p>To</p>-->
                <!--                                <input type="text" class="rangeValue">-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                                END GROUP -->
                <!--                    </div>-->
                <!--                </div>-->
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

                        <div class="cell cell-100 text-center text-fff"><input type="checkbox" class="checkbox checkAll" name="statusAll" target=".status"></div>
                        <div class="cell cell-100 text-center text-fff">EDIT</div>
                    </div>
                    <!--   BEGIN LOOP -->
                    <?php
                    while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

                        <ul>
                            <li class="row">
                                <div class="cell cell-50 text-center"><?=$product['id_pro'];?></div>
                                <div class="cell cell-200 text-center">
                                    <a href="admin.php?id_pro=<?=$product['id_pro'];?>"><img src="../images/<?=$product['photo'];?>" alt="" width="100"></a>
                                </div>
                                <div class="cell cell-100p text-center"><a href="admin.php?id_pro=<?=$product['id_pro'];?>"><?=$product['name_pro'];?></a></div>
                                <div class="cell cell-100 text-center"><?=$product['price_pro'];?></div>
                                <div class="cell cell-100 text-center"><?=$product['quantity_pro'];?></div>
                                <div class="cell cell-100 text-center"><?=$product['status_pro'];?></div>
                                <div class="cell cell-100 text-center"><?=$product['year_pro'];?></div>
                                <div class="cell cell-100 text-center"><?=$product['code'];?></div>

                                <div class="cell cell-100 text-center">
                                    <input type="hidden" class="status" name="status" value="0">
                                    <input type="checkbox" class="btnSwitch status" name="status">
                                </div>
                                <div class="cell cell-100 text-center">
                                    <a href="admin.php?id_pro=<?=$product['id_pro'];?>" class="btnEdit fa fa-pencil bg-1 text-fff"></a><a href="admin.php?hidepro=<?=$product['id_pro'];?>" class="btnRemove fa fa-remove bg-1 text-fff" onclick='return confirm("Do you really want to remove it ?")'></a>
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
                                <!--                            <input type="hidden" name="img" value="src">-->
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
                                <!--                            <input type="hidden" name="img" value="src">-->
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
    elseif (isset($_SESSION['user'])):?>

<body class="fixed-nav sticky-footer " id="page-top">

<div class="container">

    <!-- CONTAINER  -->
    <?php

    //show data, search and paging
    if(isset($_GET['searchuser'])):
        $query ="select * from account where status = 1 && concat(user_name, email, phone, fullname, dob, addr) like ? ";
        $param = [
            "%{$_GET['searchuser']}%"
        ];
        $stmt = $db->selectDataParam($query, $param);
        $total = $stmt->rowCount();
        $config = [
            'current_page'  => isset($_GET['page'])?$_GET['page']: 1, // Trang hiện tại
            'total_record'  => $total, // Tổng số record -> tong so hang
            'limit'         => 10,// limit
            'link_full'     => (trim($_GET['searchuser'])=="")?'admin.php?page={page}':"admin.php?page={page}&searchuser={$_GET['searchuser']}",// Link full có dạng như sau: domain/com/page/{page}
            'link_first'    => (trim($_GET['searchuser'])=="")?'admin.php':"admin.php?searchuser={$_GET['searchuser']}",// Link trang đầu tiên
            'range'         => 5, // Số button trang bạn muốn hiển thị
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
        'current_page'  => isset($_GET['page'])?$_GET['page']: 1, // Trang hiện tại
        'total_record'  => $total, // Tổng số record -> tong so hang
        'limit'         => 10,// limit
        'link_full'     => 'admin.php?page={page}',// Link full có dạng như sau: domain/com/page/{page}
        'link_first'    => 'admin.php',// Link trang đầu tiên
        'range'         => 5, // Số button trang bạn muốn hiển thị
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
                <input type="text" class="inputSearch" placeholder="Search" name="searchuser">
                <button type="submit" class="btnSearch"><i class="fa fa-search"></i></button>
            </form>
            <!--                <div class="areaFilter fr row">-->
            <!--                    <div class="boxSelect fr">-->
            <!--                        <div class="titleSelect">Sort by</div>-->
            <!--                        <ul class="optionSelect">-->
            <!--                            <li sortIndex="0"><a href="">Alphabet</a></li>-->
            <!--                            <li sortIndex="1"><a href="">Price, Ascending</a></li>-->
            <!--                            <li sortIndex="2"><a href="">Price, Descending</a></li>-->
            <!--                            <li sortIndex="3"><a href="">Latest</a></li>-->
            <!--                        </ul>-->
            <!--                    </div>-->
            <!--                    <!-      FILTER -->
            <!--                    <div class="btnFilter fr bg-fff"><span class="fa fa-filter"></span>Filter</div>-->
            <!--                    <div class="boxFilter">-->
            <!--                        <div class="btnFilter"><span class="fa fa-close"></span>Close</div>-->
            <!--                        <!-          GROUP -->
            <!--                        <div class="groupInput">-->
            <!--                            <select name="">-->
            <!--                                <option value="">Brand</option>-->
            <!--                                <option value="">Brand 01</option>-->
            <!--                                <option value="">Brand 02</option>-->
            <!--                            </select>-->
            <!--                            <select name="">-->
            <!--                                <option value="">Category</option>-->
            <!--                                <option value="">Category 01</option>-->
            <!--                                <option value="">Category 02</option>-->
            <!--                            </select>-->
            <!--                            <select name="">-->
            <!--                                <option value="">Author</option>-->
            <!--                                <option value="">Author 01</option>-->
            <!--                                <option value="">Author 02</option>-->
            <!--                            </select>-->
            <!--                        </div>-->
            <!--                                END GROUP -->
            <!--                        <!-           GROUP -->
            <!--                        <div class="groupInput">-->
            <!--                            <p class="titleInput">Price</p>-->
            <!--                            <div id="filterPrice"></div>-->
            <!--                            <div class="areaValue">-->
            <!--                                <p>From</p>-->
            <!--                                <input type="text" class="rangeValue">-->
            <!--                                <p>To</p>-->
            <!--                                <input type="text" class="rangeValue">-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                                END GROUP -->
            <!--                    </div>-->
            <!--                </div>-->
        </div>
        <form action="#" method="GET" name="listForm" class="form scrollX">
            <div class="formHeader row">
                <h2 class="text-1 fl">User List</h2>
                <div class="fr">
                    <a href="admin.php?addacc" class="btnAdd fa fa-plus bg-1 text-fff"></a>
                </div>
            </div>
            <div class="table">
                <div class="row bg-1">
                    <div class="cell cell-50 text-center text-fff">ID</div>
                    <div class="cell cell-200 text-center text-fff">PHOTO</div>
                    <div class="cell cell-100p text-center text-fff">USER_NAME</div>
                    <div class="cell cell-200 text-center text-fff">EMAIL</div>
                    <div class="cell cell-200 text-center text-fff">FULLNAME</div>
                    <div class="cell cell-100 text-center text-fff">DOB</div>
                    <div class="cell cell-150 text-center text-fff">PHONE</div>
                    <div class="cell cell-100 text-center text-fff"><input type="checkbox" class="checkbox checkAll" name="statusAll" target=".status"></div>
                    <div class="cell cell-100 text-center text-fff">EDIT</div>
                </div>
                <!--   BEGIN LOOP -->
                <?php
                while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>
                    <ul>
                        <li class="row">
                            <div class="cell cell-50 text-center"><a href="admin.php?id_acc=<?=$product['id_acc'];?>"><?=$product['id_acc'];?></a></div>
                            <div class="cell cell-200 text-center">
                                <a href="admin.php?id_acc=<?=$product['id_acc'];?>"><img src="../images/<?=$product['photo_acc'];?>" alt="" width="100"></a>
                            </div>
                            <div class="cell cell-100p text-center"><a href="admin.php?id_acc=<?=$product['id_acc'];?>"><?=$product['user_name'];?></a></div>

                            <div class="cell cell-200 text-center"><?=$product['email'];?></div>
                            <div class="cell cell-200 text-center"><?=$product['fullname'];?></div>
                            <div class="cell cell-100 text-center"><?=$product['dob'];?></div>
                            <div class="cell cell-150 text-center"><?=$product['phone'];?></div>

                            <div class="cell cell-100 text-center">
                                <input type="hidden" class="status" name="status" value="0">
                                <input type="checkbox" class="btnSwitch status" name="status">
                            </div>
                            <div class="cell cell-100 text-center">
                                <a href="admin.php?id_acc=<?=$product['id_acc'];?>" class="btnEdit fa fa-pencil bg-1 text-fff"></a><a href="admin.php?hideacc=<?=$product['id_acc'];?>" class="btnRemove fa fa-remove bg-1 text-fff" onclick='return confirm("Do you really want to remove it ?")'></a>
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
                    <div class="fr">
                        <button type="submit" class="btnSave bg-1 text-fff text-bold fr" name="savechangeacc">SAVE</button>
                    </div>
                </div>

                <div class="formBody row">
                    <div class="column s-6">
                        <label class="inputGroup">
                            <span>User name</span>
                            <span><input type="text" name="user_name" value="<?=$product['user_name'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Password</span>
                            <span><input type="password" name="password" value=""></span>
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
                            <span><input type="date" name="dob" value="<?=$product['dob'];?>" maxlength="11"></span>
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
                <input type="file" name="photo_acc" onchange="getImg(this)" multiple><br/>
                <img src="../images/<?=$product['photo_acc'];?>" height="200px" id="photo_acc"><br/>
                            </span>
                        </label>
                    </div>
                </div>
            </form>
        <?php endwhile;$db->closeconnect();?>
        <?php if(isset($_GET['addacc'])):?>
            <form action="admin.php?user" method="post" enctype="multipart/form-data" class="form">
                <div class="formHeader row">
                    <h2 class="text-1 fl">Add Account</h2>
                    <div class="fr">
                        <button type="submit" class="btnSave bg-1 text-fff text-bold fr" name="addacc">ADD</button><a href="" class="btnAdd fa fa-plus bg-1 text-fff"></a>
                    </div>
                </div>

                <div class="formBody row">
                    <div class="column s-6">
                        <label class="inputGroup">
                            <span>User name</span>
                            <span><input type="text" name="user_name" ></span>
                        </label>
                        <label class="inputGroup">
                            <span>Password</span>
                            <span><input type="password" name="password" ></span>
                        </label>
                        <label class="inputGroup">
                            <span>Email</span>
                            <span><input type="email" name="email" ></span>
                        </label>
                        <label class="inputGroup">
                            <span>Full name</span>
                            <span><input type="text" name="fullname" ></span>
                        </label>
                        <label class="inputGroup" for="gender">
                            <span>Gender</span>
                            <span>
                                  <input list="genders" name="gender" id="gender" class="p2">
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
                            <span><input type="date" name="dob"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Phone</span>
                            <span><input type="number" name="phone" maxlength="11"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Address</span>
                            <span><input type="text" name="addr"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Image</span>
                            <span>
                <input type="file" name="photo_acc" onchange="getImg(this)" multiple><br/>
                <img src="" height="200px" id="photo_acc"><br/>
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
<?php
    else:
//show data, search and paging
if(isset($_GET['searchinv'])):
    $query ="select * from invoice_details where status = 1 && concat(name_pro,price,date_purchase,addr,phone,total) like ? ";
    $param = [
        "%{$_GET['searchinv']}%"
    ];
    $stmt = $db->selectDataParam($query, $param);
    $total = $stmt->rowCount();
    $config = [
        'current_page'  => isset($_GET['page'])?$_GET['page']: 1, // Trang hiện tại
        'total_record'  => $total, // Tổng số record -> tong so hang
        'limit'         => 10,// limit
        'link_full'     => (trim($_GET['searchinv'])=="")?'admin.php?page={page}':"admin.php?page={page}&searchinv={$_GET['searchinv']}",// Link full có dạng như sau: domain/com/page/{page}
        'link_first'    => (trim($_GET['searchinv'])=="")?'admin.php':"admin.php?searchinv={$_GET['searchinv']}",// Link trang đầu tiên
        'range'         => 5, // Số button trang bạn muốn hiển thị
    ];
    $paging = new Pagination();
    $paging->init($config);
    $query = "select * from invoice_details where status = 1 && concat(name_pro,price,date_of_purchase,addr,phone,total) like ? " .$paging->get_limit();
    $stmt = $db->selectdataparam($query,$param);
else:

$query = "select * from invoice_details where status = 1 ";
$stmt = $db->selectData($query);
$total = $stmt->rowCount();
$config = [
    'current_page'  => isset($_GET['page'])?$_GET['page']: 1, // Trang hiện tại
    'total_record'  => $total, // Tổng số record -> tong so hang
    'limit'         => 10,// limit
    'link_full'     => 'admin.php?page={page}',// Link full có dạng như sau: domain/com/page/{page}
    'link_first'    => 'admin.php',// Link trang đầu tiên
    'range'         => 5, // Số button trang bạn muốn hiển thị
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
            <!--                <div class="areaFilter fr row">-->
            <!--                    <div class="boxSelect fr">-->
            <!--                        <div class="titleSelect">Sort by</div>-->
            <!--                        <ul class="optionSelect">-->
            <!--                            <li sortIndex="0"><a href="">Alphabet</a></li>-->
            <!--                            <li sortIndex="1"><a href="">Price, Ascending</a></li>-->
            <!--                            <li sortIndex="2"><a href="">Price, Descending</a></li>-->
            <!--                            <li sortIndex="3"><a href="">Latest</a></li>-->
            <!--                        </ul>-->
            <!--                    </div>-->
            <!--                    <!-      FILTER -->
            <!--                    <div class="btnFilter fr bg-fff"><span class="fa fa-filter"></span>Filter</div>-->
            <!--                    <div class="boxFilter">-->
            <!--                        <div class="btnFilter"><span class="fa fa-close"></span>Close</div>-->
            <!--                        <!-          GROUP -->
            <!--                        <div class="groupInput">-->
            <!--                            <select name="">-->
            <!--                                <option value="">Brand</option>-->
            <!--                                <option value="">Brand 01</option>-->
            <!--                                <option value="">Brand 02</option>-->
            <!--                            </select>-->
            <!--                            <select name="">-->
            <!--                                <option value="">Category</option>-->
            <!--                                <option value="">Category 01</option>-->
            <!--                                <option value="">Category 02</option>-->
            <!--                            </select>-->
            <!--                            <select name="">-->
            <!--                                <option value="">Author</option>-->
            <!--                                <option value="">Author 01</option>-->
            <!--                                <option value="">Author 02</option>-->
            <!--                            </select>-->
            <!--                        </div>-->
            <!--                                END GROUP -->
            <!--                        <!-           GROUP -->
            <!--                        <div class="groupInput">-->
            <!--                            <p class="titleInput">Price</p>-->
            <!--                            <div id="filterPrice"></div>-->
            <!--                            <div class="areaValue">-->
            <!--                                <p>From</p>-->
            <!--                                <input type="text" class="rangeValue">-->
            <!--                                <p>To</p>-->
            <!--                                <input type="text" class="rangeValue">-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                                END GROUP -->
            <!--                    </div>-->
            <!--                </div>-->
        </div>
        <form action="#" method="GET" name="listForm" class="form scrollX">
            <div class="formHeader row">
                <h2 class="text-1 fl">Invoice List</h2>
                <div class="fr">
                    <a href="admin.php?addinv" class="btnAdd fa fa-plus bg-1 text-fff"></a>
                </div>
            </div>
            <div class="table">
                <div class="row bg-1">
                    <div class="cell cell-50 text-center text-fff">ID</div>
                    <div class="cell cell-100 text-center text-fff">PHOTO</div>
                    <div class="cell cell-100p text-center text-fff">NAME</div>
                    <div class="cell cell-100 text-center text-fff">PRICE</div>
                    <div class="cell cell-100 text-center text-fff">QUANTITY</div>
                    <div class="cell cell-150 text-center text-fff">DATE_PURCHASE</div>
                    <div class="cell cell-100 text-center text-fff">PHONE</div>
                    <div class="cell cell-200 text-center text-fff">TOTAL</div>
                    <div class="cell cell-100 text-center text-fff"><input type="checkbox" class="checkbox checkAll" name="statusAll" target=".status"></div>
                    <div class="cell cell-100 text-center text-fff">EDIT</div>
                </div>
                <!--   BEGIN LOOP -->
                <?php
                while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

                    <ul>
                        <li class="row">
                            <div class="cell cell-50 text-center"><?=$product['id_inv'];?></div>
                            <div class="cell cell-100 text-center">
                                <a href="admin.php?id_inv=<?=$product['id_inv'];?>"><img src="../images/<?=$product['photo_inv'];?>" alt="" width="100"></a>
                            </div>
                            <div class="cell cell-100p text-center"><a href="admin.php?id_inv=<?=$product['id_inv'];?>"><?=$product['name_pro'];?></a></div>
                            <div class="cell cell-100 text-center"><?=$product['price'];?></div>
                            <div class="cell cell-100 text-center"><?=$product['quantity'];?></div>
                            <div class="cell cell-150 text-center"><?=date("m-d-Y h:i", strtotime($product['date_purchase']));?></div>
                            <div class="cell cell-100 text-center"><?=$product['phone'];?></div>
                            <div class="cell cell-200 text-center"><?=$product['total'];?></div>
                            <div class="cell cell-100 text-center">
                                <input type="hidden" class="status" name="status" value="0">
                                <input type="checkbox" class="btnSwitch status" name="status">
                            </div>
                            <div class="cell cell-100 text-center">
                                <a href="admin.php?id_inv=<?=$product['id_inv'];?>" class="btnEdit fa fa-pencil bg-1 text-fff"></a><a href="admin.php?hideinv=<?=$product['id_inv'];?>" class="btnRemove fa fa-remove bg-1 text-fff" onclick='return confirm("Do you really want to remove it ?")'></a>
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
        if(isset($_GET['id_inv'])):
            $query =  "select * from invoice_details where id_inv = :id_inv";
            $param = [
                "id_inv"=>$_GET['id_inv']
            ];

            $stmt = $db->selectdataparam($query, $param);
        endif;
        while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

            <form action="admin.php?id_inv=<?=$product['id_inv'];?>" method="post" enctype="multipart/form-data" class="form">
                <div class="formHeader row">
                    <h2 class="text-1 fl">Invoice Detail</h2>
                    <div class="fr">
                        <button type="submit" class="btnSave bg-1 text-fff text-bold fr" name="savechangeinv">SAVE</button>
                    </div>
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
                            <span><input type="datetime-local" name="date_of_purchase" value="<?=date("m-d-Y h:i", strtotime($product['date_of_purchase']));?>"></span>
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
                            <!--                            <input type="hidden" name="img" value="src">-->
                            <span>
                <input type="hidden" name="oldphoto" value="<?=$product['photo_inv'];?>">
                <input type="file" name="photo_inv" onchange="getImg(this)" multiple><br/>
                <img src="../images/<?=$product['photo_inv'];?>" height="200px" id="photo_inv"><br/>
                            </span>
                        </label>
                    </div>
                </div>
            </form>
        <?php endwhile;$db->closeconnect();?>
        <?php if(isset($_GET['addinv'])):?>
            <form action="admin.php?invoice" method="post" enctype="multipart/form-data" class="form">
                <div class="formHeader row">
                    <h2 class="text-1 fl">Add Invoice</h2>
                    <div class="fr">
                        <button type="submit" class="btnSave bg-1 text-fff text-bold fr" name="addinv">SAVE</button>
                    </div>
                </div>

                <div class="formBody row">
                    <div class="column s-6">
                        <label class="inputGroup">
                            <span>ID invoice</span>
                            <span><input type="number" name="id_inv" ></span>
                        </label>
                        <label class="inputGroup">
                            <span>ID product</span>
                            <span><input type="number" name="id_pro" ></span>
                        </label>
                        <label class="inputGroup">
                            <span>Name</span>
                            <span><input type="text" name="name_pro" ></span>
                        </label>
                        <label class="inputGroup">
                            <span>Price</span>
                            <span><input type="number" name="price" ></span>
                        </label>
                        <label class="inputGroup">
                            <span>Quantity</span>
                            <span><input type="number" name="quantity" ></span>
                        </label>

                    </div>
                    <div class="column s-6">
                        <label class="inputGroup">
                            <span>Date of purchase</span>
                            <span><input type="datetime-local" name="date_of_purchase" maxlength="4" ></span>
                        </label>
                        <label class="inputGroup">
                            <span>Phone</span>
                            <span><input type="text" name="phone"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Address</span>
                            <span><input type="text" name="addr"></span>
                        </label>
                        <label class="inputGroup">
                            <span>TOTAL</span>
                            <span><input type="text" name="total"></span>
                        </label>
                        <label class="inputGroup">
                            <input type="file" name="photo_inv" onchange="getImg(this)" multiple><br/>
                            <img src="" height="200px" id="photo_inv"><br/>
                            </span>
                        </label>
                    </div>
                </div>
            </form>
        <?php endif;?>
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
