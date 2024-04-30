<?php
// models/Course.php
class Course {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createCourse($courseName, $courseDescription, $coursePrice, $dateAdded) {
        // Prepare an SQL statement
        $stmt = $this->pdo->prepare("INSERT INTO courses (course_name, description, course_price, date_added) VALUES (?, ?, ?, ?)");

        // Bind parameters
        $stmt->bindParam(1, $courseName);
        $stmt->bindParam(2, $courseDescription);
        $stmt->bindParam(3, $coursePrice);
        $stmt->bindParam(4, $dateAdded);

        // Execute the statement
        $stmt->execute();
    }
}
?>