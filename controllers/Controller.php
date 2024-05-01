<?php
// controllers/Controller.php

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