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
                    html += '<h5 class="card-title">' + courses[i].course_name + '</h5>';
                    html += '<p class="card-text">' + courses[i].description + '</p>';
                    html += '<p class="card-text">Price: $' + courses[i].course_price + '</p>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                }
                $('#explore .row').html(html);
            }
        });
    });
</script>