<html>
<head>
    <title>Modifica Prodotto</title>
    <link rel="stylesheet" href="../../CSS/management.css">
</head>
<body>

<?php
require_once '../../dbmanager.php';
require_once '../../dto/Product.php';
require_once '../../dto/User.php';

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

if (isset($_GET['nome'])) {
    $product_name = $_GET['nome'];
    $brand = $_GET['marca'];

    $product = Product::find_by_name($product_name, $brand);

    if ($product) { ?>
        <h2>Modifica Prodotto</h2>

        <form action="../../actions/update_product.php" method="POST">
            <input type="hidden" name="id" value="<?= $product->getId() ?>">

            <label for="nome">Prodotto:</label>
            <input type="text" name="nome" value="<?= $product->getNome() ?>" placeholder="Enter the product name">
            <br>

            <label for="prezzo">Prezzo:</label>
            <input type="text" name="prezzo" value="<?= $product->getPrezzo() ?>" placeholder="Enter the price">
            <br>

            <label for="marca">Marca:</label>
            <input type="text" name="marca" value="<?= $product->getMarca() ?>" placeholder="Enter the brand">
            <br>

            <input type="submit" name="modify" value="Modifica">
        </form>
        <br>
        <a href="product_management.php">Torna indietro</a>

        <?php
    } else {
        echo "Prodotto non trovato.";
    }
} else {
    echo "Nome del prodotto non fornito.";
}
?>

</body>
</html>
