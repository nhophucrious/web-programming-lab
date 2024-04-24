// models/User.php
<?php
require_once './includes/db.php';

class User {
    private $pdo; // php data object

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function createUser($username, $password) {
        $stmt = $this->pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        return $stmt->execute([$username, $password]);
    }

    public function getUser($username) {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
}