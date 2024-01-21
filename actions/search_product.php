<?php
require_once '../dbmanager.php';
require_once '../dto/Product.php';
require_once '../dto/Cart_Products.php';
require_once '../dto/Cart.php';
require_once '../dto/User.php';

session_start();

if (!empty($_POST['nome']) && !empty($_POST['action']) && !empty($_POST['marca'])) {
    $product_name = $_POST['nome'];
    $brand = $_POST['marca'];
    $action = $_POST['action'];

    if ($action === 'modify') {
        header("Location: http://localhost:8000/views/products/modify_product.php?nome=$product_name&marca=$brand");
        exit();
    } elseif ($action === 'delete') {
        $product = Product::find_by_name($product_name, $brand);
        if ($product) {
            $product->deleteProduct();
        }else{
            echo "Prodotto non trovato";
            exit;
        }
    }
    header("Location: http://localhost:8000/views/products/product_management.php");
    exit();
}else
    echo "Errore: Compilare tutti i campi.";
?>
