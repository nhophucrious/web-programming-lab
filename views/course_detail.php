<?php
require_once 'includes/header.php';
?>

<div class="container" style="min-height: 100vh">
    <div class="row pt-5">
        <a href="/web-programming-lab/" class="my-button mr-2">Go back home</a>
        <a href="/web-programming-lab/course-paginate" class="my-button-filled">Or explore more products</a>
    </div>
    <div class="row pt-5">
        <!-- image on the left -->
        <div class="col-md-6">
            <img src="<?php echo $course['url']; ?>" alt="<?php echo $course['course_name']; ?>" class="img-fluid">
        </div>

        <!-- name, price, description on the right -->
        <div class="col-md-6">
            <h1><?php echo $course['course_name']; ?></h1>
            <hr>
            <p>Price: $<?php echo $course['course_price']; ?></p>
            <p><?php echo $course['description']; ?></p>
        </div>
    </div>
</div>



<?php
require_once 'includes/footer.php';
?>