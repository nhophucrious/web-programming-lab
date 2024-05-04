<?php
require_once 'includes/header.php';
require_once 'includes/Database.php';
require_once 'controllers/CourseController.php';
// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['level'] != 0) {
    header('Location: /web-programming-lab/');
    exit;
}
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
                    <!-- url -->
                    <div class="form-group">
                        <label for="url">Image URL:</label>
                        <input type="text" class="form-control" id="url" name="url" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Course</button>
                </form>
                <div id="add-course-status"></div>
            </div>
            <div id="manage-course" class="tab-pane fade">
                <h3>Manage courses</h3>
                <div class="p-2">
                    <!-- button to go back and forth -->
                    <button id="prev" class="btn btn-primary">Previous</button>
                    <button id="next" class="btn btn-primary">Next</button>
                </div>
                
                <!-- table showing all course, with action button to delete or edit. edit via modal -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Course Description</th>
                            <th>Course Price</th>
                            <th>URL</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="course-table">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Edit Course Modal -->
<div class="modal fade" id="edit-course-modal" tabindex="-1" role="dialog" aria-labelledby="editCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-course-form">
                    <div class="form-group">
                        <label for="edit-courseName">Course Name:</label>
                        <input type="text" class="form-control" id="edit-courseName" name="edit-courseName" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-courseDescription">Course Description:</label>
                        <textarea class="form-control" id="edit-courseDescription" name="edit-courseDescription" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-coursePrice">Course Price:</label>
                        <input type="number" class="form-control" id="edit-coursePrice" name="edit-coursePrice" required>
                    </div>
                    <!-- url -->
                    <div class="form-group">
                        <label for="edit-url">Image URL:</label>
                        <input type="text" class="form-control" id="edit-url" name="edit-url" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-edit-course">Save changes</button>
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
                // load the courses
                loadCourses();
            },
            error: function() {
                jQuery("#add-course-status").html("<div class='alert alert-danger'>There was an error adding the course.</div>");
            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    var pageNumber = 1;
    var pageSize = 10;
    function loadCourses() {
        $.ajax({
            url: 'get_courses.php',
            type: 'GET',
            data: {
                page: pageNumber
            },
            success: function(data) {
                data = JSON.parse(data);
                var courses = data.courses;
                // Clear the table
                $('#course-table').empty();
                // Loop through the courses and append a new row for each one
                $.each(courses, function(index, course) {
                    var row = '<tr>' +
                        '<td>' + course.course_name + '</td>' +
                        '<td>' + course.description + '</td>' +
                        '<td>' + course.course_price + '</td>' +
                        '<td>' + course.url + '</td>' +
                        '<td>' +
                        "<button class='btn btn-primary edit-button' data-id='" + course.id + "'>Edit</button>" +
                        "<button class='btn btn-danger delete-button' data-id='" + course.id + "'>Delete</button>" +
                        '</td>' +
                        '</tr>';
                    $('#course-table').append(row);
                });
            }
        });
    }
    loadCourses(); // Load the first page of courses
    // Add an event listener to the 'next' button
    $('#next').click(function() {
        pageNumber++;
        loadCourses();
    });
    // Add an event listener to the 'previous' button
    $('#prev').click(function() {
        if (pageNumber > 1) {
            pageNumber--;
            loadCourses();
        }
    });
    var courseId; // Declare courseId outside the event handlers

    $(document).on('click', '.edit-button', function() {
        courseId = $(this).data('id'); // Assign the value to the outer courseId variable
        $.ajax({
            url: 'get_courses.php',
            type: 'GET',
            data: {
                id: courseId
            },
            success: function(data) {
                var course = JSON.parse(data);
                // courseId = course.id; // This line might not be necessary since you're already setting it above
                $('#edit-courseName').val(course.course_name);
                $('#edit-courseDescription').val(course.description);
                $('#edit-coursePrice').val(course.course_price);
                $('#edit-url').val(course.url);
                // Open the modal
                $('#edit-course-modal').modal('show');
            }
        });
    });

    // Add click event listener to the save button in the edit modal
    $('#save-edit-course').click(function() {
        setTimeout(function() {
            $.ajax({
                url: 'edit_course.php',
                type: 'POST',
                data: {
                    courseId: courseId,
                    courseName: $('#edit-courseName').val(),
                    courseDescription: $('#edit-courseDescription').val(),
                    coursePrice: $('#edit-coursePrice').val(),
                    url: $('#edit-url').val()
                },
                success: function() {
                    // Close the modal and reload the courses
                    $('#edit-course-modal').modal('hide');
                    loadCourses();
                }
            });
        }, 100); // Delay the AJAX request by 100 milliseconds
    });

    // Add click event listener to the delete button
    $(document).on('click', '.delete-button', function() {
        var id = $(this).data('id');
        var userConfirmation = confirm('Are you sure you want to delete this course?'); // Ask for confirmation
        if (userConfirmation) { // If the user clicked "OK"
            $.ajax({
                url: 'delete_course.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function() {
                    loadCourses();
                }
            });
        }
    });

});
</script>