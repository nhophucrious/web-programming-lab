<?php
// controllers/Controller.php
require_once __DIR__ . '/../includes/Database.php';
require_once __DIR__ . '/CourseController.php';

class Controller {
    public function home() {
        $this->showHomePage();
    }

    public function course_paginate() {
        $this->showCoursePaginate();
    }

    public function course_lazy() {
        $this->showCourseLazy();
    }

    public function map() {
        $this->showMap();
    }

    public function details() {
        // get course id from query string
        $courseId = $_GET['id'];
        $db = new Database();
        $courseController = new CourseController($db->pdo);
        // get course details from database
        $course = $courseController->getCourseById($courseId);
        // if course not found, show error page
        if (!$course) {
            $this->showPageNotFound();
        } else {
            // show course detail page
            $this->showDetailPage($course);
        }
    }

    public function admin() {
        $this->showAdminPage();
    }

    public function signup() {
        $this->showSignupPage();
    }

    public function signin() {
        $this->showSigninPage();
    }

    public function page_not_found() {
        $this->showPageNotFound();
    }

    private function showHomePage() {
        include 'views/home.php';
    }

    private function showCoursePaginate() {
        include 'views/course_pagination.php';
    }

    private function showCourseLazy() {
        include 'views/course_lazy.php';
    }
    
    private function showMap() {
        include 'views/map.php';
    }

    private function showDetailPage($course) {
        include 'views/course_detail.php';
    }

    private function showAdminPage() {
        include 'views/admin.php';
    }

    private function showSignupPage() {
        include 'views/signup.php';
    }

    private function showSigninPage() {
        include 'views/signin.php';
    }

    public function showPageNotFound() {
        include 'views/error.php';
    }
    

    private function showError($title, $message) {
        include 'views/error.php';
    }
}