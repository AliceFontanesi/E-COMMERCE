<?php

require_once '../../dto/Product.php';
require_once '../../dto/User.php';
require_once '../../dbmanager.php';

session_start();

$current_user = $_SESSION['current_user'];

if (!$current_user) {
    header("Location: http://localhost:8000/views/login.php");
    exit();
}

$products = Product::fetchAll();

?>

<html>

<head>
    <title>Catalogo Prodotti</title>
    <link rel="stylesheet" href="../../CSS/products.css">
</head>

<body>

<?php
if ($current_user->getRoleId() === 2) { ?>
    <h2>Gestione prodotti</h2>
    <a href="product_management.php">Gestione prodotti</a>
<?php } ?>

<form action="../../actions/logout.php" method="POST">
    <h2>Logout</h2>
    <input type="submit" value="Logout">
</form>

<h2>Catalogo Prodotti</h2>

<?php foreach ($products as $product) { ?>
    <ul>
        <li><?php echo $product->getNome() ?></li>
        <li><?php echo $product->getMarca() ?></li>
        <li><?php echo $product->getPrezzo() ?></li>
    </ul>

    <form action="../../actions/add_to_cart.php" method="POST">
        <input type="number" name="quantita" placeholder="Quantità">
        <input type="hidden" name="id" value="<?php echo $product->getId(); ?>">
        <input type="submit" value="Aggiungi al carrello">
    </form>

<?php } ?>

<a href="../carts/index.php">Vai al carrello</a>

</body>

</html>
