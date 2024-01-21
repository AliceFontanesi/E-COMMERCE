<?php

session_start();

if (isset($_SESSION['current_user'])) {
    header("Location: http://localhost:8000/views/products/index.php");
    exit();
}
?>

<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/autentication.css">
</head>
<body>

<form action="../actions/login.php" method="POST">
    <h2>Login</h2>

    <label for="email">Email:</label>
    <input type="text" name="email" placeholder="Enter your email">

    <label for="password">Password:</label>
    <input type="password" name="password" placeholder="Enter your password">

    <a href="signup.php">Sign Up</a>

    <input type="submit" value="Submit">

</form>

</body>
</html>
