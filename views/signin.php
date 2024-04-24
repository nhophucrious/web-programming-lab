<?php
    require_once 'includes/header.php';
    
    if (isset($_GET['success'])) {
        $successMessage = htmlspecialchars($_GET['success']);
        if ($successMessage == 'signup-success') {
            $successMessage = 'Sign up successful! Please sign in.';
        }
        echo "<div class='alert alert-success' role='alert'>{$successMessage}</div>";
    }
    if (isset($_GET['error'])) {
        $errorMessage = htmlspecialchars($_GET['error']);
        echo "<div class='alert alert-danger' role='alert'>{$errorMessage}</div>";
    }
?>

<div class="container p-5" style="min-height: 100vh;">
    <div class="column align-items-center">
        <h3 style="font-weight: bold;">Welcome to HackCMUT!</h3>
        <hr>
        <form action="signin_process.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="my-button-filled">Sign In</button>
        </form>
        <!-- already have an account? -->
        <hr>
        <p>Do not have an account yet? <a href="signup">Sign up</a></p>
    </div>
</div>

<?php
    require_once 'includes/footer.php';
?>