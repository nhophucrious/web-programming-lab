<!DOCTYPE html>
<?php
    session_start();
    $isLoggedIn = isset($_SESSION['username']);
    $level = isset($_SESSION['level']) ? $_SESSION['level'] : 1; // default level is 1, admin is 0
    // get the current URI for highlighting the active link
    $uri = $_SERVER['REQUEST_URI'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        // determine the page title based on the current URI
        $pageTitle = 'HackCMUT';
        if ($uri === '/web-programming-lab/') {
            $pageTitle .= ' | Home';
        } elseif ($uri === '/web-programming-lab/signup') {
            $pageTitle .= ' | Sign Up';
        } elseif ($uri === '/web-programming-lab/signin') {
            $pageTitle .= ' | Sign In';
        } elseif ($uri === '/web-programming-lab/course-paginate') {
            $pageTitle .= ' | Courses';
        } elseif ($uri === '/web-programming-lab/course-lazy') {
            $pageTitle .= ' | Courses';
        } elseif ($uri === '/web-programming-lab/admin') {
            $pageTitle .= ' | Admin';
        } else {
            $pageTitle .= ' | Page Not Found';
        }
    ?>
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="/web-programming-lab/static/css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .navbar.navbar-expand-lg {
            background-color: #000 !important; /* Black background */
        }

        .navbar.navbar-expand-lg .navbar-nav .nav-link {
            color: #fff !important; /* White text */
        }

        .navbar.navbar-expand-lg .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important; /* White color for toggler icon */
        }

        .navbar.navbar-expand-lg .navbar-brand {
            color: #fff !important; /* White color for brand text */
        }

        .navbar.navbar-expand-lg .form-inline {
            background-color: #000 !important; /* Black background for form */
            color: #fff !important; /* White text for form */
        }

        .navbar.navbar-expand-lg .form-inline .form-control {
            background-color: #000 !important; /* Black background for input */
            color: #fff !important; /* White text for input */
        }

        .navbar.navbar-expand-lg .form-inline .btn {
            color: #000 !important; /* Black text for button */
            border-color: #fff !important; /* White border for button */
        }

        .navbar.navbar-expand-lg .navbar-nav .active .nav-link {
            color: orangered !important; /* Orange text for active link */
            border-radius: 10px !important; /* Circular border */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark text-white sticky-top">
        <a class="navbar-brand" href="/web-programming-lab/">HackCMUT</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= $uri === '/web-programming-lab/' ? 'active' : '' ?>">
                    <a class="nav-link" href="/web-programming-lab/">Home</a>
                </li>
                <li class="nav-item <?= $uri === '/web-programming-lab/course-paginate' ? 'active' : '' ?>">
                    <a class="nav-link" href="/web-programming-lab/course-paginate">Courses (pagination)</a>
                </li>
                <li class="nav-item <?= $uri === '/web-programming-lab/course-lazy' ? 'active' : '' ?>">
                    <a class="nav-link" href="/web-programming-lab/course-lazy">Courses (lazy loading)</a>
                </li>
                <?php if ($isLoggedIn): ?>
                    <li class="nav-item">
                        <span class="nav-link"><?= $_SESSION['username'] ?></span>
                    </li>
                    <?php if ($level == 0): ?>
                        <li class="nav-item <?= $uri === '/web-programming-lab/admin' ? 'active' : '' ?>">
                            <a class="nav-link" href="/web-programming-lab/admin">Admin</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/web-programming-lab/signout">Sign Out</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item <?= $uri === '/web-programming-lab/signup' ? 'active' : '' ?>">
                        <a class="nav-link" href="/web-programming-lab/signup">Sign Up</a>
                    </li>
                    <li class="nav-item <?= $uri === '/web-programming-lab/signin' ? 'active' : '' ?>">
                        <a class="nav-link" href="/web-programming-lab/signin">Sign In</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>