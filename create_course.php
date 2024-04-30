<?php
// Assuming this file is create_course.php
require_once 'controllers/CourseController.php';
require_once 'includes/Database.php';

$db = new Database();
$controller = new CourseController($db->pdo);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are set
    if (!isset($_POST['courseName']) || !isset($_POST['courseDescription']) || !isset($_POST['coursePrice'])) {
        http_response_code(400);
        echo json_encode(['error' => 'All fields are required']);
        exit();
    }

    // Create the course
    // dateAdded is the current date
    $dateAdded = date('Y-m-d H:i:s');
    $controller->createCourse($_POST['courseName'], $_POST['courseDescription'], $_POST['coursePrice'], $dateAdded);

    // Respond with a success message
    http_response_code(200);
    echo json_encode(['success' => 'Course created successfully']);
    exit();
}