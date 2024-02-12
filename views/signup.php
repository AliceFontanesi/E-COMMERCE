<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../CSS/autentication.css">
</head>
<body>

<form action="../actions/signup.php" method="POST">
    <h2>Sign Up</h2>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" placeholder="Enter your email">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter your password">

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password">

    <a href="login.php">Login</a>

    <input type="submit" value="Submit">

</form>

</body>
</html>
