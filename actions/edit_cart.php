<?php

require_once '../dbmanager.php';
require_once '../dto/Cart.php';
require_once '../dto/Cart_Products.php';
require_once '../dto/Product.php';
require_once '../dto/User.php';

session_start();

$user = $_SESSION['current_user'];
$quantita = $_POST['quantita'];

$lineitem = CartProducts::find_by_product($_POST['id'], $user->getId());

if ($quantita > 0) {
    $lineitem->setQuantita($quantita);
    $lineitem->save();
} else
    $lineitem->delete();

header('Location: http://localhost:8000/views/carts/index.php');
exit;