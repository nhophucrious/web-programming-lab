<!-- views/home.php -->

<?php 
    require_once 'includes/header.php';
?>



<div class="hero py-5 container-fluid text-center d-flex flex-column justify-content-center align-items-center">
    <div class="hero-content container py-5" style="width: 100% !important">
        
        <h1 class="mb-2">Welcome to HackCMUT!</h1>        
        <p>Buy programming courses easily!</p>
        
        <div class="row pt-3 justify-content-center">
            <a href="course-paginate" class="my-button mr-2">Browse Courses</a>
            <a href="#explore" class="my-button-filled">Explore</a>
        </div>

        <?php
            require_once 'includes/search_bar.php';
        ?>
    </div>
</div>

<div id="explore" class="container my-5">
    <h2 class="text-center">Latest Courses</h2>
    <div class="row">
    </div>
</div>

<div class="container my-5">
    <h2 class="text-center">Fetch text file with AJAX</h2>
    <button class="my-button-filled" type="button" onclick="loadDoc()">Change Content</button>
    <button class="my-button" type="button" onclick="unloadDoc()">Clear</button>
    <div class="row" id="fetch-ajax">
    </div>
</div>

<?php
    require_once 'includes/footer.php';
?>

<script>
    $(document).ready(function() {
        $.ajax({
            url: 'get_courses.php',
            type: 'GET',
            data: {
                page: 1,
                size: 6
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
                $('#explore .row').html(html);
            }
        });
    });
</script>
<script>
function loadDoc() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
    document.getElementById("fetch-ajax").innerHTML = this.responseText;
    }
    xhttp.open("GET", "ajax.txt", true);
    xhttp.send();
}
function unloadDoc() {
    document.getElementById("fetch-ajax").innerHTML = "";
}
</script>