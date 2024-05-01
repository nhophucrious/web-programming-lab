<?php
error_reporting(E_ALL);
require_once 'includes/Database.php';
require_once 'controllers/CourseController.php';

$db = new Database();
$controller = new CourseController($db->pdo);

if (isset($_GET['id'])) {
    // If the id parameter is set, return the course with that ID
    $id = $_GET['id'];
    $course = $controller->getCourseById($id);
    echo json_encode($course);
} else {
    // Otherwise, return the courses for the specified page
    $pageNumber = $_GET['page'];
    $pageSize = 10;
    $courses = $controller->getCoursesByPage($pageNumber, $pageSize);
    echo json_encode($courses);
}