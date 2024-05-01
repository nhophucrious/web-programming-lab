<?php
require_once 'includes/header.php';
?>

<div class="container p-5" style="min-height: 100vh">
    <h1>
        HackCMUT Courses (with lazy loading)
    </h1>
    <p>Keep scrolling to load more courses...</p>

    <div id="courses-container" class="row"></div> <!-- Container for the courses -->

    <div id="load-more" class="text-center my-5"> <!-- Element to trigger the loading of more courses -->
        <button class="btn btn-primary">Load more</button>
    </div>
</div>


<?php
require_once 'includes/footer.php';
?>


<script>
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
            data = JSON.parse(data);
            var courses = data.courses;
            var html = '';
            for (var i = 0; i < courses.length; i++) {
                html += '<div class="col-md-4 d-flex align-items-stretch" style="width: 300px;">';
                html += '<div class="card mb-4" style="border: 3px solid #ff5722; width: 100%; border-radius: 10px !important;">';
                html += '<div class="card-body d-flex flex-column">';
                html += '<h5 class="card-title" style="color: #ff5722 !important">' + courses[i].course_name + '</h5>';
                html += '<hr>'
                html += '<p class="card-text" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">' + courses[i].description + '</p>';
                html += '<hr my-divider>'; // Add this line
                html += '<div class="mt-auto align-items-center">';
                html += '<p class="card-text d-inline-block mb-0">Price: $' + courses[i].course_price + '</p>';
                html += '<a href="details.php?id=' + courses[i].id + '" class="my-button-filled float-right">See Details</a>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
            }
            $('#courses-container').append(html);
            pageNumber++;
        }
    });
}

$(document).ready(function() {
    loadCourses(); // Load the first page of courses

    var observer = new IntersectionObserver(function(entries) {
        if (entries[0].isIntersecting) {
            loadCourses(); // Load the next page of courses when the #load-more element is in the viewport
        }
    }, { threshold: 1 });

    observer.observe(document.querySelector('#load-more'));
});
</script>