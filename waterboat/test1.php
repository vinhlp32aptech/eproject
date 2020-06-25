
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
                    <div class="cell cell-200 text-center text-fff">USER_NAME</div>
                    <div class="cell cell-100p text-center text-fff">EMAIL</div>
                    <div class="cell cell-200 text-center text-fff">FULLNAME</div>

                    <div class="cell cell-150 text-center text-fff">DOB</div>

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
                                <a href="admin.php?id_acc=<?=$product['photo_acc'];?>"><img src="../images/<?=$product['photo_acc'];?>" alt="" width="100"></a>
                            </div>
                            <div class="cell cell-200 text-center"><a href="admin.php?id_pro=<?=$product['user_name'];?>"><?=$product['user_name'];?></a></div>
                            <div class="cell cell-100p text-center"><?=$product['email'];?></div>
                            <div class="cell cell-200 text-center"><?=$product['fullname'];?></div>

                            <div class="cell cell-150 text-center"><?=$product['dob'];?></div>

                            <div class="cell cell-100 text-center"><?=$product['phone'];?></div>

                            <div class="cell cell-100 text-center"> <a href="admin.php?id_acc=<?=$product['id_acc'];?>" class="btnEdit fa fa-pencil bg-1 text-fff"></a><a href="admin.php?hideacc=<?=$product['id_acc'];?>" class="btnRemove fa fa-remove bg-1 text-fff" onclick='return confirm("Do you really want to remove it ?")'></a>
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