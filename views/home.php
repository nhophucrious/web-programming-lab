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
    <div class="my-separator mb-5"></div>
    <div class="row">
    </div>
</div>

<div class="container my-5">
    <h2 class="text-center">Fetch text file with AJAX</h2>    
    <div class="my-separator mb-5"></div>
    <p class="text-center">Click the button below to fetch the content of a text file using AJAX</p>
    <div class="row align-items-center justify-content-center">
        <button class="my-button-filled" type="button" onclick="loadDoc()">Change Content</button>
        <br>
        <button class="my-button ml-2" type="button" onclick="unloadDoc()">Clear</button>
    </div>
    <div class="row align-items-center justify-content-center" id="fetch-ajax">
        The content of the text file will be displayed here...
    </div>
</div>

<div class="container my-5">
    <h2 class="text-center">Country list drop-down selection</h2>
    <div class="my-separator"></div>
    <div class=country-select>
        <div class="country-container">
            <select id="countries">
                <option value="">Select a country</option>
            </select>
            <select id="states" style="display: none;">
                <option value="">Select a state (or province, of course)</option>
            </select>
            <select id="cities" style="display: none;">
                <option value="">Select a city</option>
            </select>
        </div>
    <div id="country-panel" style="display:none">     
    </div>

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
                if (courses.length == 0) {
                    html += '<div class="col-md-12 text-center">No courses found</div>';
                } else { 
                    for (var i = 0; i < courses.length; i++) {
                        html += `
                        <div class="col-md-4 d-flex align-items-stretch" style="width: 300px;">
                            <div class="card mb-4" style="border: 3px solid #ff5722; width: 100%; border-radius: 10px !important;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title" style="color: #ff5722 !important">${courses[i].course_name}</h5>
                                    <hr>
                                    <img src="${courses[i].url}" class="card-img-top" alt="${courses[i].course_name}" style="height: 200px; object-fit: cover;" onerror="this.onerror=null; this.src='path/to/default/image.jpg';">
                                    <p class="card-text" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">${courses[i].description}</p>
                                    <hr my-divider>
                                    <div class="mt-auto align-items-center">
                                        <p class="card-text d-inline-block mb-0">Price: $${courses[i].course_price}</p>
                                        <a href="details?id=${courses[i].id}" class="my-button-filled float-right">See Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    }
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
    document.getElementById("fetch-ajax").innerHTML = "The content of the text file will be displayed here...";
}
</script>

<script>
window.onload = function() {
    const countriesSelect = document.getElementById("countries");
    const statesSelect = document.getElementById("states");
    const citiesSelect = document.getElementById("cities");
    const countryPanel = document.getElementById("country-panel");

    fetch("countries_states_cities.json")
        .then((response) => response.json())
        .then((data) => {
            data.forEach((item) => {
                const option = document.createElement("option");
                option.value = item.id;
                option.text = item.name + ' ' + item.emoji;
                countriesSelect.appendChild(option);
            });

            countriesSelect.addEventListener('change', function() {
                if (this.value === "") {
                    statesSelect.style.display = 'none';
                    citiesSelect.style.display = 'none';
                    countryPanel.style.display = 'none';
                } else {
                    statesSelect.style.display = 'block';
                    statesSelect.innerHTML = ''; // clear previous options
                    const statePlaceholder = document.createElement("option");
                    statePlaceholder.value = "";
                    statePlaceholder.text = "Select a state";
                    statesSelect.appendChild(statePlaceholder);
                    const selectedCountry = data.find(country => country.id == this.value);
                    selectedCountry.states.forEach((state) => {
                        const option = document.createElement("option");
                        option.value = state.id;
                        option.text = state.name;
                        statesSelect.appendChild(option);
                    });
                    countryPanel.style.display = 'block';
                    countryPanel.innerHTML = `
                        <h2>${selectedCountry.name} ${selectedCountry.emoji}</h2>
                        <p>Capital: ${selectedCountry.capital}</p>
                        <p>Currency: ${selectedCountry.currency} (${selectedCountry.currency_name}, ${selectedCountry.currency_symbol})</p>
                        <p>Top Level Domain: ${selectedCountry.tld}</p>
                        <p>Native Name: ${selectedCountry.native}</p>
                        <p>Region: ${selectedCountry.region}</p>
                        <p>Subregion: ${selectedCountry.subregion}</p>
                    `;                    
                }
            });

            statesSelect.addEventListener('change', function() {
                if (this.value == "") {
                    citiesSelect.style.display = 'none';
                } else {

                    citiesSelect.style.display = 'block';
                    citiesSelect.innerHTML = ''; // clear previous options
                    const cityPlaceholder = document.createElement("option");
                    cityPlaceholder.value = "";
                    cityPlaceholder.text = "Select a city";
                    citiesSelect.appendChild(cityPlaceholder);
                    const selectedCountry = data.find(country => country.id == countriesSelect.value);
                    const selectedState = selectedCountry.states.find(state => state.id == this.value);
                    selectedState.cities.forEach((city) => {
                        const option = document.createElement("option");
                        option.value = city.id;
                        option.text = city.name;
                        citiesSelect.appendChild(option);
                    });
                }
                
            });
            })
    .catch((error) => console.error(error));
}
</script>