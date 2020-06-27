<?php
include_once  "errorPHP.php";
class database
{
    private $host = "mysql:host=192.168.64.2; dbname=Eproject; charset=utf8";
    private $username = "C1908I1";
    private $password = "C1908I1";
    private $pdo;
    private $stmt;

    public function __construct()
    {
        try {
            $this->pdo = new PDO($this->host, $this->username, $this->password);
        } catch (Exception $e) {
            ErrorPHP::showmessage($e->getMessage());
        }
    }

    public function closeconnect()
    {
        $this->pdo = null;
    }

    public function insertdataparam($query, $param)
    {
        try {
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute($param);
            return true;
        } catch (Exception $e) {
            ErrorPHP::showmessage($e->getMessage());
        }
    }

    public function insertdata($query)
    {
        try {
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute();
            return $this->stmt;
        } catch (Exception $e) {
            ErrorPHP::showmessage($e->getMessage());
        }
    }

    public function selectdata($query)
    {
        try {
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute();
            return $this->stmt;
        } catch (Exception $e) {
            ErrorPHP::showmessage($e->getMessage());
        }
    }

    public function updatedata($query)
    {
        try {
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute();
            return $this->stmt;
        } catch (Exception $e) {
            ErrorPHP::showmessage($e->getMessage());
        }
    }

    public function selectdataparam($query, $param)
    {
        try {
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute($param);
            return $this->stmt;
        } catch (Exception $e) {
            ErrorPHP::showmessage($e->getMessage());
        }
    }

    public function updatedataparam($query, $param)
    {
        try {
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute($param);
            return $this->stmt;
        } catch (Exception $e) {
            ErrorPHP::showmessage($e->getMessage());
        }
    }


    public function deletedata($query)
    {
        try {
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute();
            return $this->stmt;
        } catch (Exception $e) {
            ErrorPHP::showmessage($e->getMessage());
        }
    }

    public function closeConn()
    {
        $this->pdo = null;
    }


    public function insertinvoice($id_acc, $name_pro, $date_purchase, $total)
    {
        try {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO invoice (id_acc, invoice_no, name_pro, date_purchase, total)
  VALUES (:id_acc, :invoice_no, :name_pro, :date_purchase, :total)";
            $param = [
                "id_acc"    =>$id_acc,
                "invoice_no"    => 0,
                "name_pro"    =>$name_pro,
                "date_purchase"    =>$date_purchase,
                "total"    =>$total,
            ];
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($param);
            $last_id = $this->pdo->lastInsertId();
            return $last_id;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

    }

    public function insertinvoicedetails($result, $id_pro, $photo_inv, $name_pro, $date_purchase,$addr,$phone,$quantity, $price, $total)
    {
        try {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "insert into invoice_details(id_inv, id_pro, invoice_no,  photo_inv, name_pro, date_purchase, addr, phone, quantity, price, total) values(:id_inv , :id_pro , :invoice_no,  :photo_inv , :name_pro , :date_purchase , :addr , :phone, :quantity, :price, :total )";
        $param = [
            "id_inv"  =>$result,
            "id_pro"    =>$id_pro,
            "invoice_no"      => 0,
            "photo_inv"     =>$photo_inv,
            "name_pro"     =>$name_pro,
            "date_purchase"     =>$date_purchase,
            "addr"     =>$addr,
            "phone"     =>$phone,
            "quantity"     =>$quantity,
            "price"     =>$price,
            "total"     =>$total,
        ];
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($param);
        return $this->stmt;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

    }


    public function counttravel(){
        try{
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "select id_pro from product where code = 'Travel' ";
        $this->stmt = $this->pdo->prepare($query);
        $this->stmt->execute();
        $count = $this->stmt->rowCount();
        return $count;
            } catch (Exception $e) {
        ErrorPHP::showmessage($e->getMessage());
        }
    }

    public function countsport(){
        try{
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "select id_pro from product where code = 'Sport' ";
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute();
            $count = $this->stmt->rowCount();
            return $count;
        } catch (Exception $e) {
            ErrorPHP::showmessage($e->getMessage());
        }
    }

    public function countfish(){
        try{
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "select id_pro from product where code = 'Fishing' ";
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute();
            $count = $this->stmt->rowCount();
            return $count;
        } catch (Exception $e) {
            ErrorPHP::showmessage($e->getMessage());
        }
    }

    public function deletecart(){
        try{
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "delete from shopping_cart ";
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute();
            return true;
        } catch (Exception $e) {
            ErrorPHP::showmessage($e->getMessage());
        }
    }


    public function changequantity($id_pro,$change){
        try{
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "update product set quantity_pro =:quantity_pro where id_pro = " .$id_pro ;
            $param = [
                    "quantity_pro"  => $change,
            ];
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute($param);
            return true;
        } catch (Exception $e) {
            ErrorPHP::showmessage($e->getMessage());
        }
    }


}

