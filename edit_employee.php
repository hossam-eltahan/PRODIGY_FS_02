<?php
include 'auth.php';
include 'db.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];
    $hire_date = $_POST['hire_date'];

    $stmt = $pdo->prepare('UPDATE employees SET name = ?, email = ?, position = ?, department = ?, phone = ?, hire_date = ? WHERE id = ?');
    $stmt->execute([$name, $email, $position, $department, $phone, $hire_date, $id]);

    header('Location: index.php');
    exit();
}

$stmt = $pdo->prepare('SELECT * FROM employees WHERE id = ?');
$stmt->execute([$id]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit Employee</h1>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($employee['name']); ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($employee['email']); ?>" required>
            <label for="position">Position:</label>
            <input type="text" id="position" name="position" value="<?php echo htmlspecialchars($employee['position']); ?>">
            <label for="department">Department:</label>
            <input type="text" id="department" name="department" value="<?php echo htmlspecialchars($employee['department']); ?>">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($employee['phone']); ?>">
            <label for="hire_date">Hire Date:</label>
            <input type="date" id="hire_date" name="hire_date" value="<?php echo htmlspecialchars($employee['hire_date']); ?>">
            <button type="submit">Update Employee</button>
        </form>
    </div>
</body>
</html>

