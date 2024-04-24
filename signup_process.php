<?php
// signup_process.php
require_once 'controllers/UserController.php';

$controller = new UserController();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if the username already exists
    if ($controller->doesUserExist($_POST['username'])) {
        header('Location: signup?error=Username+already+exists');
        exit();
    }

    // check if the username is set
    if (!isset($_POST['username'])) {
        header('Location: signup?error=Username+is+required');
        exit();
    }

    // check if the password is set
    if (!isset($_POST['password'])) {
        header('Location: signup?error=Password+is+required');
        exit();
    }

    // check if the confirm password is set
    if (!isset($_POST['confirm_password'])) {
        header('Location: signup?error=Confirm+password+is+required');
        exit();
    }

    // check if username is too short
    if (strlen($_POST['username']) < 4) {
        header('Location: signup?error=Username+must+be+at+least+4+characters');
        exit();
    }

    // Check if the password and confirm password fields match
    if ($_POST['password'] == $_POST['confirm_password']) {
        $controller->signup();
    } else {
        header('Location: signup?error=Password+and+Confirm+password+must+match');
        exit();
    }
}