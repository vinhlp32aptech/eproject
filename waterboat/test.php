<?php

include_once "conn/database.php";
$db = new database();

$query = "SELECT id_photo, id_pro, img from photos ";
$stmt = $db->selectData($query);
while($product = $stmt->fetch(PDO::FETCH_ASSOC)):
echo $product['img'];
endwhile;

?>


