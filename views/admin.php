<?php
require_once 'includes/header.php';
// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['level'] != 0) {
    header('Location: /web-programming-lab/');
    exit;
}
?>

<div class="container" style="min-height: 100vh">
    <h1>
        Admin Page
    </h1>
</div>

<?php
require_once 'includes/footer.php';
?>