<?php

require_once '../dbmanager.php';
require_once '../dto/User.php';

$email = strtolower($_POST['email']);
$password = $_POST['password'];
$password_confirmation = $_POST['confirm_password'];

if(empty($email) || empty($password) || empty($password_confirmation)){
    header('Location: http://localhost:8000/views/signup.php');
    exit;
}


if (strcmp($password, $password_confirmation) != 0) {
    header('Location: http://localhost:8000/views/signup.php');
    exit;
}

$db = new DbManager('localhost', 3306, 'C:\Users\USER\Desktop\E-COMMERCE\file.txt');
$ecommerce = $db->connect('ecommerce5E');

/*$sql = $ecommerce->prepare("SELECT id FROM users WHERE email=:email LIMIT 1");

$sql->bindParam(":email", $email);
$sql->execute();

$users = $sql->fetchAll();

if (count($users) > 0) {
    header('Location: http://localhost:8000/views/signup.php');
    exit;
}*/

$sql = $ecommerce->prepare("insert into users (email,password,role_id) values (:email,SHA2(:password, 256),1);");
$sql->bindParam(":email", $email);
$sql->bindParam(":password", $password);

if ($sql->execute()) {
    header('Location: http://localhost:8000/views/login.php');
    exit;
} else {
    header('Location: http://localhost:8000/views/signup.php');
    exit;
}

?>