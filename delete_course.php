<?php
error_reporting(E_ALL);
require_once 'includes/Database.php';
require_once 'controllers/CourseController.php';

$db = new Database();
$controller = new CourseController($db->pdo);

// delete course
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $controller->deleteCourse($id);
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}