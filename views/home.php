<!-- views/home.php -->

<?php 
    require_once 'includes/header.php';
?>

<div class="hero py-5 container-fluid text-center d-flex flex-column justify-content-center align-items-center">
    <div class="hero-content container py-5" style="width: 100% !important">
        <h1 class="mb-2">Welcome to HackCMUT!</h1>        
        <p>Buy programming courses easily!</p>
        
        <div class="row pt-3 justify-content-center">
            <a href="" class="my-button mr-2">Browse Courses</a>
            <a href="" class="my-button-filled">Explore</a>
        </div>
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