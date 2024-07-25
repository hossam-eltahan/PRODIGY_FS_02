<?php
session_start();
include 'db.php';

function login($username, $password) {
    global $pdo;

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        return true;
    }
    return false;
}

function check_login() {
    if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
        header('Location: login.php');
        exit();
    }
}
?>
