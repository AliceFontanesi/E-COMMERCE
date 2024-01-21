<?php

require_once '../dbmanager.php';
require_once '../dto/Cart.php';
require_once '../dto/Cart_Products.php';
require_once '../dto/Product.php';
require_once '../dto/User.php';

session_start();

$product = Product::find($_POST['id']);

$user = $_SESSION['current_user'];

$lineitem = CartProducts::find_by_product($_POST['id'], $user->getId());
if (!$lineitem) {
    $cart =  Cart::find_user($user->getId());
    if($cart)
        $cart_id = $cart->getId();
    else{
        Cart::add_to_cart($user->getId());
        $cart_id = Cart::last_record();
    }
    CartProducts::add_to_cart_products($cart_id, $product->getId(), $_POST['quantita']);
} else {
    $quantita = $lineitem->getQuantita() + intval($_POST['quantita']);
    $lineitem->setQuantita($quantita);
    $lineitem->save();
}


header('Location: http://localhost:8000/views/products/index.php');
exit;
?>