<!-- base_template.php -->


<?php
require_once 'includes/config.php';
require_once 'includes/debugbar_config.php'; 
require_once 'vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $debugbarRenderer->renderHead() ?>
    <meta charset="UTF-8">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Code Tracker'; ?></title>
    <style>
        /* Your custom styles here */
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
            max-width: 700px;
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

        .input {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            border: #007bff solid 1px;
            border-radius: 4px;
            cursor: pointer;
           
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Render DebugBar -->
   

    <div class="container">
        <?php echo isset($content) ? $content : ''; ?>
    </div>



