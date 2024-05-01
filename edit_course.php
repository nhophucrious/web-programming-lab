<?php
error_reporting(E_ALL);
require_once 'includes/Database.php';
require_once 'controllers/CourseController.php';

$db = new Database();
$controller = new CourseController($db->pdo);

var_dump($_POST);

$courseId = $_POST['courseId'];
$courseName = $_POST['courseName'];
$courseDescription = $_POST['courseDescription'];
$coursePrice = $_POST['coursePrice'];

$controller->editCourse($courseId, $courseName, $courseDescription, $coursePrice);
