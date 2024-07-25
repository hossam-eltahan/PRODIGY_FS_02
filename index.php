<?php
include 'auth.php';
include 'db.php';

check_login();

$statement = $pdo->query('SELECT * FROM employees');
$employees = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Management</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Employee Management System</h1>
        <a href="add_employee.php">Add New Employee</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Phone</th>
                    <th>Hire Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo htmlspecialchars($employee['id']); ?></td>
                    <td><?php echo htmlspecialchars($employee['name']); ?></td>
                    <td><?php echo htmlspecialchars($employee['email']); ?></td>
                    <td><?php echo htmlspecialchars($employee['position']); ?></td>
                    <td><?php echo htmlspecialchars($employee['department']); ?></td>
                    <td><?php echo htmlspecialchars($employee['phone']); ?></td>
                    <td><?php echo htmlspecialchars($employee['hire_date']); ?></td>
                    <td>
                        <a href="edit_employee.php?id=<?php echo $employee['id']; ?>">Edit</a>
                        <a href="delete_employee.php?id=<?php echo $employee['id']; ?>">Delete</a>
                        <a href="view_employee.php?id=<?php echo $employee['id']; ?>">View</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
