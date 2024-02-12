<?php

require_once '../dbmanager.php';
require_once '../dto/User.php';
require_once '../dto/Session.php';

$email = $_POST['email'];
$password = $_POST["password"];

$db = new DbManager('localhost', 3306, 'C:\Users\USER\Desktop\E-COMMERCE\file.txt');
$ecommerce = $db->connect('ecommerce5E');

$sql = $ecommerce->prepare("SELECT id, email, role_id FROM users WHERE password=SHA2(:password, 256) AND email=:email LIMIT 1");

$sql->bindParam(":email", $email);
$sql->bindParam(":password", $password);
$sql->execute();

$current_user = $sql->fetchObject("User");

if ($current_user) {
    session_start();
    $params=array("ip" => $_SERVER["REMOTE_ADDR"], "user_id" => $current_user->getId());
    $_SESSION['current_session_id'] = Session::create($params);
    $_SESSION['current_user'] = $current_user;
    header('Location: http://localhost:8000/views/products/index.php');
    exit;
} else {
    header('Location: http://localhost:8000/views/login.php');
    exit;
}

?>



