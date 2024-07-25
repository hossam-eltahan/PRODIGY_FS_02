<?php
include 'auth.php';
include 'db.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM employees WHERE id = ?');
$stmt->execute([$id]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Employee</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Employee Details</h1>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($employee['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($employee['email']); ?></p>
        <p><strong>Position:</strong> <?php echo htmlspecialchars($employee['position']); ?></p>
        <p><strong>Department:</strong> <?php echo htmlspecialchars($employee['department']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($employee['phone']); ?></p>
        <p><strong>Hire Date:</strong> <?php echo htmlspecialchars($employee['hire_date']); ?></p>
        <a href="edit_employee.php?id=<?php echo $employee['id']; ?>">Edit</a>
        <a href="index.php">Back to List</a>
    </div>
</body>
</html>
