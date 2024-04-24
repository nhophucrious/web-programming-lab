<?php
// index.php

// Autoload classes
spl_autoload_register(function ($class_name) {
    if (file_exists('./controllers/' . $class_name . '.php')) {
        require_once './controllers/' . $class_name . '.php';
    } else if (file_exists('./models/' . $class_name . '.php')) {
        require_once './models/' . $class_name . '.php';
    }
});

// Create a new instance of the main controller
$controller = new Controller();

// Get the current URI
$request = str_replace('/web-programming-lab', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
// Handle the request based on the URI
switch ($request) {
    case '/' :
    case '/index' :
        $controller->home();
        break;
    case '/about' :
        $controller->about();
        break;
    case '/signup' :
        $controller->signup();
        break;
    case '/signin' :
        $controller->signin();
        break;
    case '/signout' :
        $userController = new UserController();
        $userController->signout();
    default:
        // http_response_code(404);
        // echo "Page not found";
        $controller->page_not_found();
        break;
}