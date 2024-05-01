<?php
// controllers/CourseController.php
require_once 'models/Course.php';

class CourseController {
    private $courseModel;

    public function __construct($pdo) {
        $this->courseModel = new Course($pdo);
    }

    public function getAllCourses() {
        return $this->courseModel->getAllCourses();
    }

    public function createCourse($courseName, $courseDescription, $coursePrice, $dateAdded) {
        $this->courseModel->createCourse($courseName, $courseDescription, $coursePrice, $dateAdded);
    }

    public function editCourse($courseId, $courseName, $courseDescription, $coursePrice) {
        $this->courseModel->editCourse($courseId, $courseName, $courseDescription, $coursePrice);
    }

    public function deleteCourse($courseId) {
        $this->courseModel->deleteCourse($courseId);
    }
}
?>