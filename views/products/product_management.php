<html>
<head>
    <title>Gestione prodotti</title>
    <link rel="stylesheet" href="../../CSS/management.css">
</head>
<body>

<?php

/*require_once '../../dbmanager.php';
require_once '../../dto/User.php';*/

session_start();

$current_user = $_SESSION['current_user'];

if (!$current_user) {
    header("Location: http://localhost:8000/views/login.php");
    exit();
}

/*if($current_user->getRoleId() != 2){
    header("Location: http://localhost:8000/views/products/product_managememt");
    exit();
}*/

?>

<h2>Gestine prodotti</h2>

<form action="../../actions/products_management.php" method="POST">
    <h2>Nuovo prodotto</h2>

    <label for="nome">Prodotto:</label>
    <input type="text" name="nome" placeholder="Enter the product name">
    <br>

    <label for="prezzo">Prezzo:</label>
    <input type="text" name="prezzo" placeholder="Enter the price">
    <br>

    <label for="marca">Marca:</label>
    <input type="text" name="marca" placeholder="Enter the brand">
    <br>

    <input type="submit" value="Submit">
</form>

<h2>Ricerca prodotto</h2>

<form action="../../actions/search_product.php" method="POST">
    <label for="search_term">Nome:</label>
    <input type="text" name="nome" placeholder="Enter the product name">
    <br>

    <label for="search_term">Marca:</label>
    <input type="text" name="marca" placeholder="Enter the brand">
    <br>

    <label for="action">Azione:</label>
    <select name="action">
        <option value="modify">Modifica</option>
        <option value="delete">Cancella</option>
    </select>
    <br><br>

    <input type="submit" name="search" value="Submit">
</form>

<a href="index.php">Torna indietro</a>

</body>
</html>
