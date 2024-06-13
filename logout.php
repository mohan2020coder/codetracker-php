<?php
require 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}else{
    logoutUser();
}
?>