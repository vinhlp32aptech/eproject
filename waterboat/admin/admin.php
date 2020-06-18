<?php

include_once "../conn/database.php";
include_once "../conn/Pagination.php";
$db = new database();


//////
//delete data-do not save
if(isset($_POST['btndeletenow'])):
    $query = "delete  from product where id = " . $_GET['id'];
    $stmt = $db->deletedata($query);
    header('location: '. $_SERVER['REQUEST_URI']);
endif;
//delete data-do not save

//delete data and save it
if(isset($_POST['btndeletehide'])):
    $query = "update product set id_del = 0 where id = :id" ;
    $param = [
        "id" => $_GET['id'],
    ];
    $stmt = $db->updatedataparam($query, $param);
    header('location: '. $_SERVER['REQUEST_URI']);
endif;
//delete data and save it

//////update date
if(isset($_POST['savechange'])):
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


if(isset($_GET['user'])):
    echo "kkkk";
endif;
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

    <!--     SIDE AREA -->
    <div class="sideArea">
        <div class="avatar">
            <img src="../images/Lease2.jpg" alt="">
            <div class="avatarName">Welcome,<br>John Doe</div>
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
                <div class="name has-submenu">John Doe<span class="fa fa-angle-down"></span></div>
                <ul class="accountLinks submenu">
                    <li><a href="../index.php">View website</a></li>
                    <li><a href="LoginWithAdmin/indexAd.php">Log out<span class="fa fa-sign-out fr"></span></a></li>
                </ul>
            </div>
        </nav>
        <!-- END NAV -->
        <!-- CONTAINER  -->
        <?php

        //show data, search and paging
        if(isset($_GET['search1'])):
            $query ="select * from product where status = 1 && concat(status,name_pro,price_pro,year_pro,code) like ? ";
            $param = [
                "%{$_GET['search1']}%"
            ];
            $stmt = $db->selectDataParam($query, $param);
            $total = $stmt->rowCount();
            $config = [
                'current_page'  => isset($_GET['page'])?$_GET['page']: 1, // Trang hiện tại
                'total_record'  => $total, // Tổng số record -> tong so hang
                'limit'         => 10,// limit
                'link_full'     => (trim($_GET['search'])=="")?'admin.php?page={page}':"admin.php?page={page}&search={$_GET['search']}",// Link full có dạng như sau: domain/com/page/{page}
                'link_first'    => (trim($_GET['search'])=="")?'admin.php':"admin.php?search={$_GET['search']}",// Link trang đầu tiên
                'range'         => 5, // Số button trang bạn muốn hiển thị
            ];
            $paging = new Pagination();
            $paging->init($config);
            $query = "select * from product where status = 1 && concat(status,name_pro,price_pro,year_pro,code) like ? " .$paging->get_limit();
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
        ?>

        <div class="mainContent">
            <!-- LIST FORM -->
            <div class="row filterGroup">
                <form action="#" method="get" class="formSearch fl">
                    <input type="text" class="inputSearch" placeholder="Search" name="search1">
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
            <form action="" method="GET" name="listForm" class="form scrollX">
                <div class="formHeader row">
                    <h2 class="text-1 fl">Product List</h2>
                    <div class="fr">
                        <button type="submit" class="btnSave bg-1 text-fff text-bold fr">SAVE</button><a href="admin.php?addpro" class="btnAdd fa fa-plus bg-1 text-fff"></a>
                    </div>
                </div>
                <div class="table">
                    <div class="row bg-1">
                        <div class="cell cell-50 text-center text-fff">ID</div>
                        <div class="cell cell-200 text-center text-fff">PHOTO</div>
                        <div class="cell cell-200 text-center text-fff">NAME</div>
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
                                <div class="cell cell-200 text-center"><a href="admin.php?id_pro=<?=$product['id_pro'];?>"><?=$product['name_pro'];?></a></div>
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
                                <a href="admin.php?id_pro=<?=$product['id_pro'];?>" class="btnEdit fa fa-pencil bg-1 text-fff"></a><a href="" class="btnRemove fa fa-remove bg-1 text-fff" onclick='return confirm("Do you really want to remove it ?")'></a>
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
                        <button type="submit" class="btnSave bg-1 text-fff text-bold fr" name="savechange">SAVE</button><a href="" class="btnAdd fa fa-plus bg-1 text-fff"></a>
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
                <input type="hidden" name="oldphoto" value="<?$product['photo'];?>">
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
                                <button type="submit" class="btnSave bg-1 text-fff text-bold fr" name="savechange">SAVE</button><a href="" class="btnAdd fa fa-plus bg-1 text-fff"></a>
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
    <?php endif;?>

<!--    invoice-->
    <?php

    //show data, search and paging
    if(isset($_GET['search2'])):
        $query ="select * from invoice_details where status = 1 && concat(status,name_pro,price,date_of_purchase,phone, addr) like ? ";
        $param = [
            "%{$_GET['search2']}%"
        ];
        $stmt = $db->selectDataParam($query, $param);
        $total = $stmt->rowCount();
        $config = [
            'current_page'  => isset($_GET['page'])?$_GET['page']: 1, // Trang hiện tại
            'total_record'  => $total, // Tổng số record -> tong so hang
            'limit'         => 10,// limit
            'link_full'     => (trim($_GET['search'])=="")?'admin.php?page={page}':"admin.php?page={page}&search={$_GET['search']}",// Link full có dạng như sau: domain/com/page/{page}
            'link_first'    => (trim($_GET['search'])=="")?'admin.php':"admin.php?search={$_GET['search']}",// Link trang đầu tiên
            'range'         => 5, // Số button trang bạn muốn hiển thị
        ];
        $paging = new Pagination();
        $paging->init($config);
        $query = "select * from invoice_details where status = 1 && concat(status,name_pro,price,date_of_purchase,phone, addr) like ? " .$paging->get_limit();
        $stmt = $db->selectdataparam($query,$param);
//    else:
//        if(isset($_GET['invoice'])):
//            $query = "select * from invoice_details where status = 1 ";
//            $stmt = $db->selectData($query);
//            $total = $stmt->rowCount();
//            $config = [
//                'current_page'  => isset($_GET['page'])?$_GET['page']: 1, // Trang hiện tại
//                'total_record'  => $total, // Tổng số record -> tong so hang
//                'limit'         => 10,// limit
//                'link_full'     => 'admin.php?page={page}',// Link full có dạng như sau: domain/com/page/{page}
//                'link_first'    => 'admin.php',// Link trang đầu tiên
//                'range'         => 5, // Số button trang bạn muốn hiển thị
//            ];
//            $paging = new Pagination();
//            $paging->init($config);
//            $query = "select * from invoice_details where status = 1 " .$paging->get_limit();
//            $stmt = $db->selectdata($query);
//            endif;
    ?>

    <div class="mainContent">
        <!-- LIST FORM -->
        <div class="row filterGroup">
            <form action="#" method="get" class="formSearch fl">
                <input type="text" class="inputSearch" placeholder="Search" name="search2">
                <button type="submit" class="btnSearch"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <form action="" method="GET" name="listForm" class="form scrollX">
            <div class="formHeader row">
                <h2 class="text-1 fl">Invoice List</h2>
                <div class="fr">
                    <button type="submit" class="btnSave bg-1 text-fff text-bold fr">SAVE</button><a href="admin.php?addpro" class="btnAdd fa fa-plus bg-1 text-fff"></a>
                </div>
            </div>
            <div class="table">
                <div class="row bg-1">
                    <div class="cell cell-50 text-center text-fff">ID_INVOICE</div>
                    <div class="cell cell-50 text-center text-fff">ID_PORDUCT</div>
                    <div class="cell cell-200 text-center text-fff">NAME</div>
                    <div class="cell cell-100 text-center text-fff">PRICE</div>
                    <div class="cell cell-100 text-center text-fff">QUANTITY</div>
                    <div class="cell cell-100 text-center text-fff">DATE_OF_PURCHASE</div>
                    <div class="cell cell-100 text-center text-fff">ADDRESS</div>
                    <div class="cell cell-100 text-center text-fff">TOTAL</div>
                    <div class="cell cell-100 text-center text-fff"><input type="checkbox" class="checkbox checkAll" name="statusAll" target=".status"></div>
                    <div class="cell cell-100 text-center text-fff">EDIT</div>
                </div>
                <!--   BEGIN LOOP -->
                <?php
                while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

                    <ul>
                        <li class="row">
                            <div class="cell cell-50 text-center"><?=$product['id_inv'];?></div>
                            <div class="cell cell-50 text-center"><?=$product['id_pro'];?></div>
                            <div class="cell cell-200 text-center"><a href="admin.php?id_pro=<?=$product['id_pro'];?>"><?=$product['name_pro'];?></a></div>
                            <div class="cell cell-100 text-center"><?=$product['price'];?></div>
                            <div class="cell cell-100 text-center"><?=$product['quantity'];?></div>
                            <div class="cell cell-100 text-center"><?=$product['date_of_purchase'];?></div>
                            <div class="cell cell-100 text-center"><?=$product['addr'];?></div>
                            <div class="cell cell-100 text-center"><?=$product['total'];?></div>

                            <div class="cell cell-100 text-center">
                                <input type="hidden" class="status" name="status" value="0">
                                <input type="checkbox" class="btnSwitch status" name="status">
                            </div>
                            <div class="cell cell-100 text-center">
                                <a href="admin.php?id_pro=<?=$product['id_pro'];?>" class="btnEdit fa fa-pencil bg-1 text-fff"></a><a href="" class="btnRemove fa fa-remove bg-1 text-fff" onclick='return confirm("Do you really want to remove it ?")'></a>
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
                    <h2 class="text-1 fl">Invoice Detail</h2>
                    <div class="fr">
                        <button type="submit" class="btnSave bg-1 text-fff text-bold fr" name="savechange">SAVE</button><a href="" class="btnAdd fa fa-plus bg-1 text-fff"></a>
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
                            <span><input type="number" name="price_pro" value="<?=$product['price'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Quantity</span>
                            <span><input type="number" name="quantity_pro" value="<?=$product['quantity'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Date of Purchase</span>
                            <span><input type="date" name="data_of_purchase" value="<?=$product['data_of_purchase'];?>"></span>
                        </label>
                    </div>
                    <div class="column s-6">
                        <label class="inputGroup">
                            <span>Address</span>
                            <span><input type="text" name="code" value="<?=$product['addr'];?>"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Total</span>
                            <span><input type="text" name="status_pro" value="<?=$product['total'];?>"></span>
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



</script>
<script src="js/main.js"></script>
<script src="js/editiamge.js"></script>

</body>
</html>
