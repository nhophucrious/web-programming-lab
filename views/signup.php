<?php
    require_once 'includes/header.php';
    
    if (isset($_GET['success'])) {
        $successMessage = htmlspecialchars($_GET['success']);
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
        <form action="signup_process.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password">Confirm password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" class="my-button-filled">Sign Up</button>
        </form>
        <!-- already have an account? -->
        <hr>
        <p>Already have an account? <a href="signin">Sign in</a></p>
    
    </div>
</div>

<?php
    require_once 'includes/footer.php';
?>