<?php
    require_once 'includes/db.php'; // assuming you have a db.php for database connection

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query the database to find the user
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // If the user exists and the password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Start the session and store the username
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['level'] = $user['lvl'];

            // Redirect to the home page
            header('Location: /web-programming-lab/');
            exit;
        } else {
            // Redirect back to the sign-in page with an error message
            header('Location: /web-programming-lab/signin?error=Invalid+credentials');
            exit;
        }
    }
?>