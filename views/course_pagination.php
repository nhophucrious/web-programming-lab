<?php
require_once 'includes/header.php';
?>

<div class="container p-5" style="min-height: 100vh">
    <h1>
        HackCMUT Courses (with pagination)
    </h1>
    <div class="row" id="courses-container">
        <!-- Courses will be loaded here -->
    </div>
    <div class="d-flex justify-content-between mt-4">
        <button id="prev" class="btn btn-primary">Previous</button>
        <button id="next" class="btn btn-primary">Next</button>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>

<script>
$(document).ready(function() {
    var pageNumber = 1;
    var pageSize = 10;
    function loadCourses() {
        $.ajax({
            url: 'get_courses.php',
            type: 'GET',
            data: {
                page: pageNumber,
                size: pageSize
            },
            success: function(data) {
                var courses = JSON.parse(data);
                var html = '';
                for (var i = 0; i < courses.length; i++) {
                    html += '<div class="d-flex align-items-stretch pr-3" style="width: 300px;">'; // Set a fixed width
                    html += '<div class="card mb-4" style="border: 2px solid orangered; width: 100%;">'; // Make the card fill the container
                    html += '<div class="card-body d-flex flex-column">';
                    html += '<h5 class="card-title">' + courses[i].course_name + '</h5>';
                    html += '<p class="card-text">' + courses[i].description + '</p>';
                    html += '<p class="card-text">Price: $' + courses[i].course_price + '</p>';
                    // html += '<a href="course_details.php?id=' + courses[i].courseId + '" class="btn btn-primary mt-auto">View Course</a>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                }
                $('#courses-container').html(html);
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
});
</script>