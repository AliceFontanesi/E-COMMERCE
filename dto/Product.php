<?php

class Product {

    private $id, $nome, $prezzo, $marca;

    function getId() {
        return $this->id;
    }

    function getMarca() {
        return $this->marca;
    }

    function getNome() {
        return $this->nome;
    }

    function getPrezzo() {
        return $this->prezzo;
    }

    function setMarca($value) {
        $this->marca = $value;
    }

    function setNome($value) {
        $this->nome = $value;
    }

    function setPrezzo($value) {
        $this->prezzo = $value;
    }

    public static function fetchAll() {

        $conn = Product::connector();
        $sql = "select * from ecommerce5E.products";
        return $conn->query($sql)->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public static function find($id)
    {
        $conn = Product::connector();

        $query = "select * from ecommerce5E.products where id = :id";
        try
        {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $record = $stmt->fetchObject(__CLASS__);
            if ($record)
                return $record;
        }
        catch(PDOException $e)
        {
            die("\nErrore nella ricerca dell'elemento: " . $e->getMessage());
        }
    }


    public function deleteProduct() {
        $product_id = $this->getId();
        $conn = Product::connector();
        try {
            $conn->beginTransaction();

            $deleteCartProductsStmt = $conn->prepare("DELETE FROM ecommerce5E.cart_products WHERE product_id = :product_id");
            $deleteCartProductsStmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $deleteCartProductsStmt->execute();


            $deleteProductStmt = $conn->prepare("DELETE FROM ecommerce5E.products WHERE id = :product_id");
            $deleteProductStmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $deleteProductStmt->execute();

            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            echo "Errore durante l'eliminazione del prodotto: " . $e->getMessage();
        }
    }

    public function delete() {
        $id = $this->getId();
        $conn = Product::connector();
        $sql = $conn->prepare("delete from ecommerce5E.products where id=:id");
        $sql->bindParam(":id", $id, PDO::PARAM_INT);
        $sql->execute();
    }


    public static function find_by_name($nome, $marca)
    {
        $conn = Product::connector();

        $query = "select * from ecommerce5E.products where nome = :nome and marca = :marca";
        try
        {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
            $stmt->execute();
            $record = $stmt->fetchObject(__CLASS__);
            if ($record)
                return $record;
        }
        catch(PDOException $e)
        {
            die("\nErrore nella ricerca dell'elemento: " . $e->getMessage());
        }
    }

    public static function create($params)
    {
        $conn = Product::connector();
        $query = "INSERT INTO products (nome, prezzo, marca) VALUES (:nome, :prezzo, :marca)";

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nome', $params['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':prezzo', $params['prezzo'], PDO::PARAM_STR);
            $stmt->bindParam(':marca', $params['marca'], PDO::PARAM_STR);

            $stmt->execute();
        } catch (PDOException $e) {
            die("\nErrore nell'inserimento dei dati: " . $e->getMessage());
        }
    }

    public function update($params){
        $id = $this->getId();
        $conn = Product::connector();
        $query = "UPDATE ecommerce5e.products SET nome = :nome, prezzo = :prezzo, marca = :marca WHERE id = :id";

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $params['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':prezzo', $params['prezzo'], PDO::PARAM_STR);
            $stmt->bindParam(':marca', $params['marca'], PDO::PARAM_STR);

            $stmt->execute();
        } catch (PDOException $e) {
            die("\nErrore nell'inserimento dei dati: " . $e->getMessage());
        }
    }

    private static function connector() {
        $db = new DbManager('localhost', 3306, 'C:\Users\USER\Desktop\E-COMMERCE\file.txt');
        return $db->connect('ecommerce5E');
    }
}

?>