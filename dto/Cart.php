<?php

class Cart {

    private $id, $user_id;

    function setId($id) {
        $this->id = $id;
    }

    function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->user_id;
    }

    public static function find_user($user_id){
        $conn = Cart::connector();
        $sql = $conn->prepare("SELECT * FROM ecommerce5e.carts WHERE user_id = :user_id");
        $sql->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchObject(__CLASS__);
    }

    /*public static function find_by_product($product_id, $user_id) {
        $conn = Cart::connector();
        $sql = $conn->prepare("SELECT c.id, c.user_id FROM ecommerce5e.carts c INNER JOIN ecommerce5e.cart_products cp on c.id = cp.cart_id WHERE cp.product_id = :product_id AND c.user_id = :user_id");
        $sql->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $sql->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchObject(__CLASS__);
    }

    public function delete() {
        $id = $this->getId();
        $conn = Cart::connector();
        $sql = $conn->prepare("delete from ecommerce5E.carts where id=:id");
        $sql->bindParam(":id", $id);
        return $sql->execute();
    }*/

    public static function add_to_cart($shopperId):void {
        $conn = Cart::connector();
        $sql = $conn->prepare("insert into ecommerce5E.carts (user_id) values (:user_id)");
        $sql->bindParam(':user_id', $shopperId, PDO::PARAM_INT);
        $sql->execute();
    }

    public static function last_record()//sistemare
    {
        $conn = Cart::connector();
        $sql = $conn->prepare("select * from ecommerce5E.carts c order by id desc limit 1");
        if ($sql->execute()) {
            return $sql->fetchObject(__CLASS__)->getId();
        } else {
            throw new PDOException("Errore ricerca ultimo record");
        }
    }

    private static function connector() {
        $db = new DbManager('localhost', 3306, 'C:\Users\USER\Desktop\E-COMMERCE\file.txt');
        return $db->connect('ecommerce5E');
    }

}