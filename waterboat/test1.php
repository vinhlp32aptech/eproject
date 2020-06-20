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