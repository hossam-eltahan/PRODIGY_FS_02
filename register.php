<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Basic validation
    if (empty($username) || empty($password)) {
        $error = 'Username and Password are required.';
    } else {
        // Check if username already exists
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            $error = 'Username already exists. Please choose a different username.';
        } else {
            // Hash the password before storing
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            try {
                $stmt->execute([$username, $hashed_password]);
                $success = 'Registration successful. You can <a href="login.php">log in</a>.';
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
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Register</button>
        </form>
        <?php if (isset($error)) echo '<p>' . $error . '</p>'; ?>
        <?php if (isset($success)) echo '<p>' . $success . '</p>'; ?>
        <p>Already have an account? <a href="login.php" class="btn">Log in here</a></p>
    </div>
</body>
</html>
