<?php

include_once "../conn/database.php";
include_once "../conn/Pagination.php";

$db = new database();




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
            <li><a href="javascript:void(0)" class="has-submenu"><span class="fa fa-table"></span>PRODUCT</a>
                <ul class="submenu">
                    <form action="#">
                    <li><button class="propad"><span class="fa fa-list"></span>Product List</button></li>
                    <li><button class="catpad"><span class="fa fa-tags"></span>Category List</button></li>
                    </form>
                </ul>
            </li>
            <form action="#">
            <li><button class="mepad"><span class="fa fa-sitemap"></span>MENU</button></li>
            <li><button class="invpad"><span class="fa fa-money"></span>INVOICE</button></li>
            <li><button class="userpad"><span class="fa fa-user-o"></span>USER</button></li>
            </form>
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
        <div class="mainContent">
            <!-- LIST FORM -->
            <div class="row filterGroup">
                <form action="" method="POST" class="formSearch fl">
                    <input type="text" class="inputSearch" placeholder="Search">
                    <button type="submit" class="btnSearch"><i class="fa fa-search"></i></button>
                </form>
                <div class="areaFilter fr row">
                    <div class="boxSelect fr">
                        <div class="titleSelect">Sort by</div>
                        <ul class="optionSelect">
                            <li sortIndex="0"><a href="">Alphabet</a></li>
                            <li sortIndex="1"><a href="">Price, Ascending</a></li>
                            <li sortIndex="2"><a href="">Price, Descending</a></li>
                            <li sortIndex="3"><a href="">Latest</a></li>
                        </ul>
                    </div>
                    <!--         FILTER -->
                    <div class="btnFilter fr bg-fff"><span class="fa fa-filter"></span>Filter</div>
                    <div class="boxFilter">
                        <div class="btnFilter"><span class="fa fa-close"></span>Close</div>
                        <!--             GROUP -->
                        <div class="groupInput">
                            <select name="">
                                <option value="">Brand</option>
                                <option value="">Brand 01</option>
                                <option value="">Brand 02</option>
                            </select>
                            <select name="">
                                <option value="">Category</option>
                                <option value="">Category 01</option>
                                <option value="">Category 02</option>
                            </select>
                            <select name="">
                                <option value="">Author</option>
                                <option value="">Author 01</option>
                                <option value="">Author 02</option>
                            </select>
                        </div>
                        <!--             END GROUP -->
                        <!--             GROUP -->
                        <div class="groupInput">
                            <p class="titleInput">Price</p>
                            <div id="filterPrice"></div>
                            <div class="areaValue">
                                <p>From</p>
                                <input type="text" class="rangeValue">
                                <p>To</p>
                                <input type="text" class="rangeValue">
                            </div>
                        </div>
                        <!--             END GROUP -->
                    </div>
                </div>
            </div>
            <form action="" method="GET" name="listForm" class="form scrollX">
                <div class="formHeader row">
                    <h2 class="text-1 fl">Product List</h2>
                    <div class="fr">
                        <button type="submit" class="btnSave bg-1 text-fff text-bold fr">SAVE</button><a href="" class="btnAdd fa fa-plus bg-1 text-fff"></a>
                    </div>
                </div>
                <div class="table">
                    <div class="row bg-1">
                        <div class="cell cell-50 text-center text-fff">ID</div>
                        <div class="cell cell-100 text-center text-fff">PHOTO</div>
                        <div class="cell cell-200 text-center text-fff">NAME</div>
                        <div class="cell cell-100 text-center text-fff">PRICE</div>
                        <div class="cell cell-100 text-center text-fff">QUANTITY</div>
                        <div class="cell cell-100 text-center text-fff">STATUS</div>
                        <div class="cell cell-100 text-center text-fff">YEAR</div>
                        <div class="cell cell-100 text-center text-fff">CODE</div>

                        <div class="cell cell-50 text-center text-fff"><input type="checkbox" class="checkbox checkAll" name="statusAll" target=".status"></div>
                        <div class="cell cell-50 text-center text-fff">EDIT</div>
                    </div>
                    <!--   BEGIN LOOP -->
                    <?php
                    $query = "select * from product ";
                    $stmt = $db->selectData($query);
                    while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>

                    <ul>
                        <li class="row">
                            <div class="cell cell-50 text-center"><?=$product['id_pro'];?></div>
                            <div class="cell cell-100 text-center">
                                <a href=""><img src="../images/<?=$product['photo'];?>" alt="" width="50"></a>
                            </div>
                                <div class="cell cell-200 text-center"><a href=""><?=$product['name_pro'];?></a></div>
                                <div class="cell cell-100 "><?=$product['price_pro'];?></div>
                                <div class="cell cell-100 text-center"><?=$product['quantity_pro'];?></div>
                                <div class="cell cell-100 text-center"><?=$product['status_pro'];?></div>
                                <div class="cell cell-100 "><?=$product['year_pro'];?></div>
                                <div class="cell cell-100"><?=$product['code'];?></div>

                            <div class="cell cell-100 text-center">
                                <input type="hidden" class="status" name="status" value="0">
                                <input type="checkbox" class="btnSwitch status" name="status">
                            </div>
                            <div class="cell cell-100 text-center">
                                <a href="" class="btnEdit fa fa-pencil bg-1 text-fff"></a><a href="" class="btnRemove fa fa-remove bg-1 text-fff" onclick='return confirm("Do you really want to remove it ?")'></a>
                            </div>
                        </li>
                    </ul>
                    <?php endwhile; ?>

                    <!--   END LOOP -->
                </div>
            </form>

            <!-- CATE LIST    -->
            <form action="" method="GET" name="listForm" class="form scrollX">
                <div class="formHeader row">
                    <h2 class="text-1 fl">Product List</h2>
                    <div class="fr">
                        <button type="submit" class="btnSave bg-1 text-fff text-bold fr">SAVE</button><a href="" class="btnAdd fa fa-plus bg-1 text-fff"></a>
                    </div>
                </div>
                <div class="table">
                    <div class="row bg-1">
                        <div class="cell cell-50 text-center text-fff">ID</div>
                        <div class="cell cell-100 text-center text-fff">PARENT</div>
                        <div class="cell cell-100p text-fff">NAME</div>
                        <div class="cell cell-50 text-center text-fff">RANK</div>
                        <div class="cell cell-50"><input type="checkbox" class="checkbox caretAll"></div>
                        <div class="cell cell-100 text-center text-fff">EDIT</div>
                    </div>
                    <!--    BEGIN LOOP -->
                    <ul>
                        <li class="row">
                            <div class="cell cell-50 text-center">1</div>
                            <div class="cell cell-100 text-center">0</div>
                            <div class="cell cell-100p"><a href="">CATE 1</a></div>
                            <div class="cell cell-50 text-center"><input type="number" name="rank[]" class="inputNumber"></div>
                            <div class="cell cell-50 text-center"><span class="fa fa-caret-down btnCaret"></span></div>
                            <div class="cell cell-100 text-center">
                                <a href="" class="btnEdit fa fa-pencil bg-1 text-fff"></a><a href="" class="btnRemove fa fa-remove bg-1 text-fff" onclick='return confirm("Do you really want to remove it ?")'></a>
                            </div>
                            <ul class="sublist">
                                <li class="row">
                                    <div class="cell cell-50 text-center">ID</div>
                                    <div class="cell cell-100 text-center">PARENT</div>
                                    <div class="cell cell-100p"><a href="">PRODUCT 2</a></div>
                                    <div class="cell cell-50 text-center"><span class="fa fa-caret-down btnCaret"></span></div>
                                    <div class="cell cell-100 text-center">
                                        <a href="" class="btnEdit fa fa-pencil bg-1 text-fff"></a><a href="" class="btnRemove fa fa-remove bg-1 text-fff" onclick='return confirm("Do you really want to remove it ?")'></a>
                                    </div>
                                    <ul class="sublist">
                                        <li>
                                            <div class="cell cell-50 text-center">ID</div>
                                            <div class="cell cell-100 text-center">PARENT</div>
                                            <div class="cell cell-100p"><a href="">PRODUCT 2</a></div>
                                            <div class="cell cell-50"></div>
                                            <div class="cell cell-100 text-center">
                                                <a href="" class="btnEdit fa fa-pencil bg-1 text-fff"></a><a href="" class="btnRemove fa fa-remove bg-1 text-fff" onclick='return confirm("Do you really want to remove it ?")'></a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!--    END LOOP -->
                </div>
            </form>

            <!-- DETAIL FORM -->
            <form action="" method="POST" enctype="multipart/form-data" class="form">
                <div class="formHeader row">
                    <h2 class="text-1 fl">Product Detail</h2>
                    <div class="fr">
                        <button type="submit" class="btnSave bg-1 text-fff text-bold fr">SAVE</button><a href="" class="btnAdd fa fa-plus bg-1 text-fff"></a>
                    </div>
                </div>
                <div class="formBody row">
                    <div class="column s-6">
                        <label class="inputGroup">
                            <span>Name</span>
                            <span><input type="text" name="name"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Code</span>
                            <span><input type="text" name="code"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Price</span>
                            <span><input type="text" name="price"></span>
                        </label>
                        <label class="inputGroup">
                            <span>Note</span>
                            <span><input type="text" name="note"></span>
                        </label>
                    </div>
                    <div class="column s-6">
                        <label class="inputGroup">
                            <span>Category</span>
                            <span>
                    <select name="cate">
                        <option value="cate01">Category01</option>
                        <option value="cate02">Category02</option>
                    </select>
                    <i class="btnNewInput fa fa-plus bg-1 text-fff"></i>
                </span>
                        </label>
                        <label class="inputGroup hide">
                            <span>Brand</span>
                            <span>
                    <input type="text" name="cate">
                    <select name="brand">
                        <option value="cate01">Brand01</option>
                        <option value="cate02">Brand02</option>
                    </select>
                </span>
                        </label>
                        <label class="inputGroup">
                            <span>Image</span>
                            <input type="hidden" name="img" value="src">
                            <span>
                    <input type="file" name="img" onchange="getImg(this)" multiple>
                    <img src="http://bookstore.crunchpress.com/wp-content/uploads/2013/05/b2.jpg" alt="" width="50">
                </span>

                        </label>
                    </div>
                    <div class="column">
                        <label class="inputGroup">
                            <span>Description</span>
                            <textarea name="description"></textarea>
                        </label>
                    </div>
                </div>
            </form>

            <div id="pagination">
                <ul class="pagination list-inline text-center">
                    <li><a href="?page=1">1</a></li>
                    <li class="is-active"><a href="?page=2">2</a></li>
                    <li><a href="?page=3">3</a></li>
                    <li><a href="?page=4">4</a></li>
                    <li><a href="?page=5">5</a></li>
                </ul>
            </div>
        </div>
        <!-- END CONTAINER  -->
    </div>
</div>



</script>
<script src="js/main.js"></script>
</body>
</html>
