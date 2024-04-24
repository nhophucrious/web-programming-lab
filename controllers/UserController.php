// controllers/UserController.php
<?php
require_once './models/User.php';

class UserController {

    private $model;

    public function __construct() {
        $this->model = new User();
    }

    public function signup() {
        // get the form data
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        // hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // store the user in the database
        $result = $this->model->createUser($username, $hashedPassword);
    
        if ($result) {
            // redirect to the sign-in page
            header('Location: signin?success=signup-success');
        } else {
            // redirect back to the sign-up page with an error message
            header('Location: signup?error=Error+creating+user');
        }
    }

    public function signin() {
        // get the form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // get the user from the database
        $user = $this->model->getUser($username);

        // check if the user exists
        if ($user) {
            // check if the password is correct
            if ($user && password_verify($password, $user['password'])) {
                // start the session and set the username
                session_start();
                $_SESSION['username'] = $username;
    
                // redirect to the home page
                header('Location: index.php');
            } else {
                // redirect back to the sign-in page
                header('Location: signin.php');
            }
        } else {
            echo 'User not found';
        }
    }

    public function signout() {
        // destroy the session
        session_start();
        unset($_SESSION['username']);
        session_destroy();
    
        // redirect to the sign-in page
        header('Location: signin');
    
    }

    public function doesUserExist($username) {
        $user = $this->model->getUser($username);
        return $user !== false && !empty($user);
    }
}