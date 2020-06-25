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
            $sql = "INSERT INTO invoice (id_acc, name_pro, date_purchase, total)
  VALUES (:id_acc, :name_pro, :date_purchase, :total)";
            $param = [
                "id_acc"    =>$id_acc,
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
        $sql = "insert into invoice_details(id_inv, id_pro, photo_inv, name_pro, date_purchase, addr, phone, quantity, price, total) values(:id_inv , :id_pro , :photo_inv , :name_pro , :date_purchase , :addr , :phone, :quantity, :price, :total )";
        $param = [
            "id_inv"  =>$result,
            "id_pro"    =>$id_pro,
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
            $last_id = $this->pdo->lastInsertId();
            return $last_id;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

    }
}

