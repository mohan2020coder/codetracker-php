<?php
require 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (loginUser($email, $password)) {
        $dd = "inside the if";
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Login failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - CodeTracker</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <?php if (isset($dd)) echo "<p>$dd</p>"; ?>
</body> 
</html>
