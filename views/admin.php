<?php
require_once 'includes/header.php';
require_once 'includes/Database.php';
require_once 'controllers/CourseController.php';
// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['level'] != 0) {
    header('Location: /web-programming-lab/');
    exit;
}

$db = new Database();
$controller = new CourseController($db->pdo);
?>

<div class="container p-2" style="min-height: 100vh">
    <div>
        <h1>Admin Panel</h1>
        <p>Welcome, <?= $_SESSION['username'] ?>!</p>
    </div>
    
    <div class="container-fluid">
        <ul class="nav nav-tabs">
            <li class="active pr-2"><a data-toggle="tab" href="#add-course">Add course</a></li>
            <li><a data-toggle="tab" href="#manage-course">Manage course</a></li>
        </ul>

        <div class="tab-content pt-2">
            <div id="add-course" class="tab-pane fade in active">
                <h3>Add course</h3>
                <form id="add-course-form">
                    <div class="form-group">
                        <label for="courseName">Course Name:</label>
                        <input type="text" class="form-control" id="courseName" name="courseName" required>
                    </div>
                    <div class="form-group">
                        <label for="courseDescription">Course Description:</label>
                        <textarea class="form-control" id="courseDescription" name="courseDescription" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="coursePrice">Course Price:</label>
                        <input type="number" class="form-control" id="coursePrice" name="coursePrice" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Course</button>
                </form>
                <div id="add-course-status"></div>
            </div>
            <div id="manage-course" class="tab-pane fade">
                <h3>Manage courses</h3>
                <!-- table showing all course, with action button to delete or edit. edit via modal -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Course Description</th>
                            <th>Course Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch all courses from the database
                        $courses = $controller->getAllCourses();

                        // Loop through the courses and create a table row for each one
                        foreach ($courses as $course) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($course['course_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($course['description']) . "</td>";
                            echo "<td>" . htmlspecialchars($course['course_price']) . "</td>";
                            echo "<td>";
                            echo "<button class='btn btn-primary edit-button' data-id='" . htmlspecialchars($course['id']) . "'>Edit</button>";
                            echo "<button class='btn btn-danger delete-button' data-id='" . htmlspecialchars($course['id']) . "'>Delete</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>


<?php
require_once 'includes/footer.php';
?>

<script>
jQuery(document).ready(function(){
    jQuery("#add-course-form").on("submit", function(e) {
        e.preventDefault();
        jQuery.ajax({
            url: "create_course.php",
            type: "POST",
            data: jQuery(this).serialize(),
            success: function(response) {
                jQuery("#add-course-status").html("<div class='alert alert-success'>Course added successfully!</div>");
            },
            error: function() {
                jQuery("#add-course-status").html("<div class='alert alert-danger'>There was an error adding the course.</div>");
            }
        });
    });
});
</script>