
<?php 

$pageTitle = 'Welcome to CodeTracker';
$content = '
    <h1>Welcome to CodeTracker</h1>
        <p>A simple project and task tracker application.</p>
        <a href="register.php" class="btn">Register</a>
        <a href="login.php" class="btn">Login</a>
';

// Output the base template with defined content
include 'base_template.php';
?>



<?php 
//add for messages display the message for debugbar
$debugbar["messages"]->addMessage("Hello login check!");
?>

<?php
include 'footer.php';
?>

