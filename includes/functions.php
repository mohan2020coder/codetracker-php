<?php
require 'config.php';


// Start session
session_start();

function registerUser($email, $password) {
    global $db;
    $users = $db->users;
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $result = $users->insertOne([
        'email' => $email,
        'password' => $hashedPassword
    ]);
    return $result->getInsertedCount() == 1;
}

function loginUser($email, $password) {
    global $db;
    $users = $db->users;

    
    $user = $users->findOne(['email' => $email]);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = (string) $user['_id'];
        return true;
    }
    return false;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function logoutUser() {
    session_destroy();
}
?>
