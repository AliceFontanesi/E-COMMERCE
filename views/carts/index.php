<?php

require_once '../../dbmanager.php';
require_once '../../dto/Cart_Products.php';
require_once '../../dto/Product.php';
require_once '../../dto/User.php';

session_start();

$current_user = $_SESSION['current_user'];

if (!$current_user) {
    header("Location: http://localhost:8000/views/login.php");
    exit();
}

$line_items = CartProducts::fetchAll($current_user);

?>

<html>
<head>
    <title>Carrello</title>
    <link rel="stylesheet" href="../../CSS/cart.css">
</head>

<body>

<h2>Carrello</h2>
<?php $totale = 0;?>
<?php foreach ($line_items as $line) { ?>
    <form action="../../actions/edit_cart.php" method="POST">
        <ul>
            <li><?php echo $line->getProduct()->getNome(); ?></li>
            <li>
                <input type="number" name="quantita" value="<?php echo $line->getQuantita(); ?>" placeholder="Quantità">
            </li>
            <li><?php echo $totPrezzo = floatval($line->getProduct()->getPrezzo()) * $line->getQuantita(); ?></li>
            <?php $totale += $totPrezzo ?>
        </ul>
        <input type="hidden" name="id" value="<?php echo $line->getProduct()->getId(); ?>">
        <input type="submit" value="Aggiorna Quantità">
    </form>
<?php } ?>

<p>Totale carrello: <?php echo $totale; ?></p>

<a href="../products/index.php">Vai al catalogo prodotti</a>

</body>

</html>
