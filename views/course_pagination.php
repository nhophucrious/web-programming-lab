<?php
require_once 'includes/header.php';
?>

<style>
.active-pagination-link {
    background-color: orangered !important;
    color: white !important;
    border: 1px solid orangered !important;
}
</style>


<div class="container p-5" style="min-height: 100vh">
    <h1>
        HackCMUT Courses (with pagination)
    </h1>
    <p id="course-info"></p>
    <div class="row" id="courses-container">
        <!-- Courses will be loaded here -->
    </div>
    <div id="pagination" class="mt-4 d-flex flex-horizontal">
        <!-- Pagination links will be loaded here -->
    </div>
    <!-- <div class="d-flex justify-content-between mt-4">
        <button id="prev" class="btn btn-primary">Previous</button>
        <button id="next" class="btn btn-primary">Next</button>
    </div> -->
</div>

<?php
require_once 'includes/footer.php';
?>

<script>
$(document).ready(function() {
    var pageNumber = 1;
    var pageSize = 10;
    var totalCourses = 0;
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
                totalCourses = data.total;
                var html = '';
                for (var i = 0; i < courses.length; i++) {
                    html += '<div class="col-md-4 d-flex align-items-stretch" style="width: 300px;">';
                    html += '<div class="card mb-4" style="border: 3px solid #ff5722; width: 100%; border-radius: 10px !important;">';
                    html += '<div class="card-body d-flex flex-column">';
                    html += '<h5 class="card-title">' + courses[i].course_name + '</h5>';
                    html += '<p class="card-text">' + courses[i].description + '</p>';
                    html += '<p class="card-text">Price: $' + courses[i].course_price + '</p>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                }
                $('#courses-container').html(html);
                // Generate the pagination links
                var totalPages = Math.ceil(totalCourses / pageSize);
                var paginationHtml = '';

                // Show the first page
                if (pageNumber > 1) {
                    paginationHtml += '<button class="page-link" data-page="1">1</button> ';
                }

                // Show an ellipsis if the current page is more than 3
                if (pageNumber > 3) {
                    paginationHtml += '<span>...</span> ';
                }

                // Show the two pages before the current page
                for (var i = pageNumber - 2; i < pageNumber; i++) {
                    if (i > 1) {
                        paginationHtml += '<button class="page-link" data-page="' + i + '">' + i + '</button> ';
                    }
                }

                // Show the current page
                paginationHtml += '<button class="page-link active active-pagination-link" data-page="' + pageNumber + '">' + pageNumber + '</button> ';

                // Show the two pages after the current page
                for (var i = pageNumber + 1; i <= pageNumber + 2; i++) {
                    if (i < totalPages) {
                        paginationHtml += '<button class="page-link mr-1" data-page="' + i + '">' + i + '</button> ';
                    }
                }

                // Show an ellipsis if the current page is more than 3 less than the total pages
                if (pageNumber < totalPages - 2) {
                    paginationHtml += '<span class="mx-1">...</span> ';
                }

                // Show the last page
                if (pageNumber < totalPages) {
                    paginationHtml += '<button class="page-link" data-page="' + totalPages + '">' + totalPages + '</button> ';
                }

                $('#pagination').html(paginationHtml);
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

    // Add an event listener to the pagination links
    $('#pagination').on('click', '.page-link', function() {
        pageNumber = $(this).data('page');
        loadCourses();
    });
});
</script>