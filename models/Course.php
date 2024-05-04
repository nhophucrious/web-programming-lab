<?php
// models/Course.php
class Course {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createCourse($courseName, $courseDescription, $coursePrice, $url, $dateAdded) {
        // Prepare an SQL statement
        $stmt = $this->pdo->prepare("INSERT INTO courses (course_name, description, course_price, url, date_added) VALUES (?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bindParam(1, $courseName);
        $stmt->bindParam(2, $courseDescription);
        $stmt->bindParam(3, $coursePrice);
        $stmt->bindParam(4, $url);
        $stmt->bindParam(5, $dateAdded);

        // Execute the statement
        $stmt->execute();
    }

    // get course by id
    public function getCourseById($courseId) {
        // Prepare an SQL statement
        $stmt = $this->pdo->prepare("SELECT * FROM courses WHERE id = ?");

        // Bind parameters
        $stmt->bindParam(1, $courseId);

        // Execute the statement
        $stmt->execute();

        // Fetch the course
        return $stmt->fetch();
    }

    // get course by page
    public function getCoursesByPage($pageNumber, $pageSize) {
        $offset = ($pageNumber - 1) * $pageSize;
    
        $stmt = $this->pdo->prepare("SELECT * FROM courses LIMIT ? OFFSET ?");
        $stmt->bindParam(1, $pageSize, PDO::PARAM_INT);
        $stmt->bindParam(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        $courses = $stmt->fetchAll();
    
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM courses");
        $stmt->execute();
        $total = $stmt->fetchColumn();
    
        return [
            'courses' => $courses,
            'total' => $total
        ];
    }

    public function getAllCourses() {
        // Prepare an SQL statement
        $stmt = $this->pdo->prepare("SELECT * FROM courses");

        // Execute the statement
        $stmt->execute();

        // Fetch all courses
        return $stmt->fetchAll();
    }

    // method to edit a course
    public function editCourse($courseId, $courseName, $courseDescription, $coursePrice, $url) {
        // Prepare an SQL statement
        $stmt = $this->pdo->prepare("UPDATE courses SET course_name = ?, description = ?, course_price = ?, url = ? WHERE id = ?");

        // Bind parameters
        $stmt->bindParam(1, $courseName);
        $stmt->bindParam(2, $courseDescription);
        $stmt->bindParam(3, $coursePrice);
        $stmt->bindParam(4, $url);
        $stmt->bindParam(5, $courseId);

        // Execute the statement
        $stmt->execute();
    }

    // method to delete a course
    public function deleteCourse($courseId) {
        // Prepare an SQL statement
        $stmt = $this->pdo->prepare("DELETE FROM courses WHERE id = ?");

        // Bind parameters
        $stmt->bindParam(1, $courseId);

        // Execute the statement
        $stmt->execute();
    }
}
?>