<?php
require 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (loginUser($email, $password)) {
        
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Login failed!";
    }
}
?>

<?php 

$pageTitle = 'Login - CodeTracker';
$content = '
   <h1>Login</h1>
    <form method="post" action="">
        <input type="email" name="email" placeholder="Email"  class="input" required>
        <input type="password" name="password" placeholder="Password" class="input" required>
        <br/>
        <button type="submit" class="btn">Login</button>

        <p>Create a account  <a href="register.php" class="btn">Register</a></p>
    </form>
';
// Output the base template with defined content
include 'base_template.php';
?>

<?php 

// Add messages to DebugBar if conditions are met
if (isset($error)) {
    $debugbar["messages"]->addMessage("$error");
}

if (isset($dd)) {
    $debugbar["messages"]->addMessage("$dd");
}


?>

<?php
include 'footer.php';
?>


