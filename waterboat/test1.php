<?php

include_once "conn/database.php";
include_once "conn/Pagination.php";
$db = new database();


if(isset($_GET['id_inv'])):
echo "kk;";
    else:
    $query =  "select * from invoice_details where id_inv = 1";


    $stmt = $db->selectdata($query);
endif;
while($product = $stmt->fetch(PDO::FETCH_ASSOC)):?>
    <input type="text" name="" id="" value="<?=date("d-m-Y h:i", strtotime($product['date_of_purchase']));?>">
<?php endwhile; $db->closeConn();?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="#" method="get">
    <label for="browser">sex:</label>
    <input list="browsers" name="browser" id="browser">
    <datalist id="browsers">
        <option value="male">
        <option value="female">
        <option value="others">
    </datalist>
    <input type="submit">
</form></body>
</html>
