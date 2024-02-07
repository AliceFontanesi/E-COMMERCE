<?php

require_once '../dbmanager.php';
require_once '../dto/Product.php';
require_once '../dto/User.php';

session_start();

if (isset($_POST['nome']) && isset($_POST['prezzo']) && isset($_POST['marca'])) {
    if (!is_numeric($_POST['prezzo']) || $_POST['prezzo'] == 0) {
        echo "Errore: Il prezzo deve essere un numero decimale diverso da 0.";
        exit;
    }

    $params = array(
        'nome' => $_POST['nome'],
        'prezzo' => $_POST['prezzo'],
        'marca' => $_POST['marca']
    );

    $product = Product::find($_POST['id']);
    $product->update($params);

    header('Location: http://localhost:8000/views/products/product_management.php');
    exit;
} else {
    echo "Errore: Compila tutti i campi per inserire un nuovo prodotto.";
}
?>
