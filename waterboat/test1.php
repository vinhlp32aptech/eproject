<?php
include_once "conn/database.php";
$db = new database();
$tim = date('Y-m-d H:i');


$query = " select date_purchase from invoice ";
$stmt = $db->selectdata($query);
while ($product = $stmt->fetch(PDO::FETCH_ASSOC)):
//$date = new DateTime($product['date_purchase']);
//$aaa = $date->format('Y-m-d H:i');
//echo $aaa;
echo $product['date_purchase'];

    $time = strtotime($tim);
    $newformat = date('Y-m-d H:i',$time);

    $query = "select id_inv from invoice where date_purchase == " . $tim;
    $stmt = $db->selectdata($query);
echo $stmt->rowCount();
    ?>

<!--    <input type="text" name="asd" value="--><?//=$product['date_purchase']?><!--" id="">-->


<?php
if ($product['date_purchase'] === $newformat):
echo "vlll";
endif;
endwhile;
?>
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
<form action="#">
    <input type="datetime-local" name="dat" id="">
    <input type="submit" value="submit" name="submit">
</form>
</body>
</html>
