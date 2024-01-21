<?php

class CartProducts {

    private $cart_id, $product_id, $quantita;

    function setCartId($value) {
        $this->cart_id = $value;
    }

    function setProductId($product_id) {
        $this->product_id = $product_id;
    }

    function setQuantita($quantita) {
        $this->quantita = $quantita;
    }

    function getCartId() {
        return $this->cart_id;
    }

    function getProductId() {
        return $this->product_id;
    }

    function getQuantita() {
        return $this->quantita;
    }

    public function getProduct() {
        $conn = CartProducts::connector();
        $productId = $this->getProductId();
        $sql = $conn->prepare("select * from ecommerce5E.products where id=:id");
        $sql->bindParam(":id", $productId);
        $sql->execute();

        return $sql->fetchObject('Product');
    }

    public static function fetchAll($current_user) {
        $user_id = $current_user->getId();
        $conn = CartProducts::connector();
        $sql = $conn->prepare("SELECT cp.cart_id, cp.product_id, cp.quantita FROM ecommerce5E.cart_products cp INNER JOIN ecommerce5E.carts c ON c.id = cp.cart_id WHERE c.user_id = :user_id");
        $sql->bindParam(":user_id", $user_id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public function delete() {
        $cart_id = $this->getCartId();
        $product_id = $this->getProductId();
        $conn = CartProducts::connector();
        $sql = $conn->prepare("delete from ecommerce5E.cart_products where cart_id=:cart_id and product_id = :product_id");
        $sql->bindParam(":cart_id", $cart_id);
        $sql->bindParam(":product_id", $product_id);
        return $sql->execute();
    }

    public function save():void {
        $quantita = $this->getQuantita();
        $cart_id = $this->getCartId();
        $product_id = $this->getProductId();

        $conn = CartProducts::connector();

        $sql = $conn->prepare("update ecommerce5E.cart_products set quantita =:quantita where cart_id = :cart_id and product_id = :product_id");
        $sql->bindParam(':quantita', $quantita, PDO::PARAM_INT);
        $sql->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $sql->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $sql->execute();
    }

    public static function find_by_product($product_id, $user_id) {
        $conn = CartProducts::connector();
        $sql = $conn->prepare("SELECT cp.cart_id, cp.product_id, cp.quantita FROM ecommerce5E.cart_products cp INNER JOIN ecommerce5e.carts c on cp.cart_id = c.id WHERE cp.product_id = :product_id AND c.user_id = :user_id");
        $sql->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $sql->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchObject(__CLASS__);
    }

    public static function add_to_cart_products($cart_id, $productId, $quantita):void{
        $conn = CartProducts::connector();
        $sql = $conn->prepare("insert into ecommerce5E.cart_products (cart_id, product_id, quantita) values (:cart_id, :product_id, :quantita)");
        $sql->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $sql->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $sql->bindParam(':quantita', $quantita, PDO::PARAM_INT);
        $sql->execute();
    }

    private static function connector() {
        $db = new DbManager('localhost', 3306, 'C:\Users\USER\Desktop\E-COMMERCE\file.txt');
        return $db->connect('ecommerce5E');
    }

}