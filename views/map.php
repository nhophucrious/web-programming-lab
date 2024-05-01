<?php
require_once 'includes/header.php';
?>

<div class="container p-4 m-4" style="min-height:100vh">
    <div class="container-fluid">
        <ul class="nav nav-tabs">
            <li class="active pr-2"><a data-toggle="tab" href="#map-address">Show map with address</a></li>
            <li><a data-toggle="tab" href="#map-coord">Show map with coordinates</a></li>
        </ul>

        <div class="tab-content pt-2">
            <div id="map-address" class="tab-pane active">
                <h3>Enter your address</h3>
                <form id="address-form">
                    <div class="form-group">
                        <input type="text" id="address" class="form-control" placeholder="Address">
                    </div>
                    <input type="submit" class="my-button-filled" value="Show Map">
                </form>
                <div id="map-address-region" class="mt-3"></div>
            </div>
            <div id="map-coord" class="tab-pane">
                <h3>Enter your coordinates</h3>
                <form id="coordinates-form">
                    <div class="form-group">
                        <input type="text" id="latitude" class="form-control" placeholder="Latitude">
                    </div>
                    <div class="form-group">
                        <input type="text" id="longitude" class="form-control" placeholder="Longitude">
                    </div>
                    <input type="submit" class="my-button-filled" value="Show Map">
                </form>
                <div id="map-coord-region" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>

<script>
document.getElementById('address-form').addEventListener('submit', function(e) {
    e.preventDefault();
    var address = document.getElementById('address').value;
    address = address.replace(' ', '+');
    document.getElementById('map-address-region').innerHTML = '<iframe width="100%" height="500" src="https://maps.google.com/maps?q=' + address + '&output=embed"></iframe>';
});

document.getElementById('coordinates-form').addEventListener('submit', function(e) {
    e.preventDefault();
    var latitude = document.getElementById('latitude').value;
    var longitude = document.getElementById('longitude').value;
    document.getElementById('map-coord-region').innerHTML = '<iframe width="100%" height="500" src="https://maps.google.com/maps?q=' + latitude + ',' + longitude + '&output=embed"></iframe>';
});
</script>