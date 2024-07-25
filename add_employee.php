<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];
    $hire_date = $_POST['hire_date'];

    // Basic validation
    if (empty($name) || empty($email)) {
        $error = 'Name and Email are required.';
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare('SELECT * FROM employees WHERE email = ?');
        $stmt->execute([$email]);
        $existingEmployee = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingEmployee) {
            $error = 'An employee with this email already exists.';
        } else {
            // Insert new employee
            $stmt = $pdo->prepare('INSERT INTO employees (name, email, position, department, phone, hire_date) VALUES (?, ?, ?, ?, ?, ?)');
            try {
                $stmt->execute([$name, $email, $position, $department, $phone, $hire_date]);
                $success = 'Employee added successfully.';
            } catch (PDOException $e) {
                $error = 'Error: ' . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Add New Employee</h1>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="position">Position:</label>
            <input type="text" id="position" name="position">
            <label for="department">Department:</label>
            <input type="text" id="department" name="department">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone">
            <label for="hire_date">Hire Date:</label>
            <input type="date" id="hire_date" name="hire_date">
            <button type="submit">Add Employee</button>
        </form>
        <?php if (isset($error)) echo '<p>' . $error . '</p>'; ?>
        <?php if (isset($success)) echo '<p>' . $success . '</p>'; ?>
    </div>
</body>
</html>
