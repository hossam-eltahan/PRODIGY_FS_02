<?php
include 'auth.php';
include 'db.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare('DELETE FROM employees WHERE id = ?');
$stmt->execute([$id]);

header('Location: index.php');
exit();
?>
