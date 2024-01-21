<?php

require_once '../dbmanager.php';
require_once '../dto/Product.php';
require_once '../dto/User.php';

session_start();

if (!empty($_POST['nome']) && !empty($_POST['prezzo']) && !empty($_POST['marca'])) {
    if (!is_numeric($_POST['prezzo']) || $_POST['prezzo'] == 0) {
        echo "Errore: Il prezzo deve essere un numero decimale diverso da 0.";
        exit;
    }

    $params = array(
        'nome' => $_POST['nome'],
        'prezzo' => $_POST['prezzo'],
        'marca' => $_POST['marca']
    );

    Product::create($params);

    header('Location: http://localhost:8000/views/products/index.php');
    exit;
} else {
    echo "Errore: Compila tutti i campi per inserire un nuovo prodotto.";
}
?>
