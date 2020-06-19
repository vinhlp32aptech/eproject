<?php
include_once "../conn/database.php";
$db = new database();
//////update date
if (isset($_POST['savechangeacc'])):
        $query = "update account set  user_name = :user_name, password= :password,  email = :email, phone = :phone, fullname = :fullname, dob = :dob, addr = :addr, photo_acc = :photo_acc  where user_name = :user_name";
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $param = [
        "user_name" => $_POST['user_name'],
        "password" => $hash,
        "email" => $_POST['email'],
        "phone" => $_POST['phone'],
        "fullname" => $_POST['fullname'],
        "dob" => $_POST['dob'],
        "addr" => $_POST['addr'],
        "photo_acc" => $photo,
        "user_name" => $_POST['user_name'],

    ];
    $db->updatedataparam($query, $param);
//    header('location: admin.php?user');
endif;
/////update data


?>