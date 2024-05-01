<?php
error_reporting(E_ALL);
require_once 'includes/Database.php';
require_once 'controllers/CourseController.php';

$db = new Database();
$controller = new CourseController($db->pdo);
$pageNumber = $_GET['page'];
$pageSize = 10;
$courses = $controller->getCoursesByPage($pageNumber, $pageSize);
echo json_encode($courses);