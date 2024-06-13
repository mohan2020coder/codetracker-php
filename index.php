<?php
//require_once 'includes/debugbar.php';
require_once 'includes/debugbar_config.php';
require_once 'includes/config.php';

// Example: Add a message to DebugBar
$debugbar["messages"]->addMessage("Hello inside index!");

?>


<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $debugbarRenderer->renderHead() ?>
    <meta charset="UTF-8">
    <title>Welcome to CodeTracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>

</head>
<body>
    

    <div class="container">
        <h1>Welcome to CodeTracker</h1>
        <p>A simple project and task tracker application.</p>
        <a href="register.php" class="btn">Register</a>
        <a href="login.php" class="btn">Login</a>

        <?php $debugbar["messages"]->addMessage("Hello login check!");?>

        <?php echo $debugbarRenderer->render() ?>
    </div>
</body>
</html>
