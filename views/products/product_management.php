<html>
<head>
    <title>Gestione prodotti</title>
    <link rel="stylesheet" href="../../CSS/management.css">
</head>
<body>

<?php

require_once '../../dbmanager.php';
require_once '../../dto/User.php';
require_once '../../dto/Product.php';

session_start();

$current_user = $_SESSION['current_user'];

if (!$current_user) {
    header("Location: http://localhost:8000/views/login.php");
    exit();
}

if($current_user->getRoleId() != 2){
    header("Location: http://localhost:8000/views/products/product_managememt");
    exit();
}

?>

<h2>Gestione prodotti</h2>

<form action="../../actions/products_management.php" method="POST">
    <h2>Nuovo prodotto</h2>

    <table class="custom-table">
        <tr>
            <td>
                <label for="nome">Prodotto:</label>
            </td>
            <td>
                <label for="prezzo">Prezzo:</label>
            </td>
            <td>
                <label for="marca">Marca:</label>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="nome" placeholder="Enter the product name">
            </td>
            <td>
                <input type="text" name="prezzo" placeholder="Enter the price">
            </td>
            <td>
                <input type="text" name="marca" placeholder="Enter the brand">
            </td>
        </tr>
    </table>
    <input type="submit" value="Create">
</form>

<h2>Ricerca prodotto</h2>

<form action="../../actions/search_product.php" method="POST">
    <table class="custom-table">
        <tr>
            <td>
                <label for="search_term">Nome:</label>
            </td>
            <td>
                <label for="search_term">Marca:</label>
            </td>
            <td>
                <label for="action">Azione:</label>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="nome" placeholder="Enter the product name">
            </td>
            <td>
                <input type="text" name="marca" placeholder="Enter the brand">
            </td>
            <td>
                <select name="action">
                    <option value="modify">Modifica</option>
                    <option value="delete">Cancella</option>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" name="search" value="Submit">
</form>

<?php
$products = Product::fetchAll();
?>

<table class="styled-table">
    <tr>
        <td><b><label for="nome">Nome</label></b></td>
        <td><b><label for="marca">Marca</label></b></td>
        <td><b><label for="prezzo">Prezzo</label></b></td>
    </tr>
    <?php foreach ($products as $product) { ?>
<tr>
    <td><?php echo $product->getNome() ?></td>
    <td><?php echo $product->getMarca() ?></td>
    <td><?php echo $product->getPrezzo() ?></td>
</tr>
<?php } ?>
</table>

<a href="index.php">Torna indietro</a>

</body>
</html>
