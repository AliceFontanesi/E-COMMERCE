<?php

require_once '../dbmanager.php';
require_once '../dto/User.php';
require_once '../dto/Session.php';

session_start();

$current_user = $_SESSION['current_user'];
$current_session_id = $_SESSION['current_session_id'];

$sessione = Session::find($current_session_id);

$sessione->delete();

$_SESSION['current_user'] = null;

header("Location: http://localhost:8000/views/login.php");
?>
