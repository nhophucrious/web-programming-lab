<!-- includes/search_bar.php -->
<style>
#search-suggestions {
    position: relative; 
    z-index: 9999;
}
</style>

<div class="container-fluid my-2">
    <form action="" method="get">
        <div class="input-group input-group">
            <input type="text" class="form-control rounded mr-2" placeholder="Search for courses" name="q" id="search-input">
            <div class="input-group-append">
                <!-- submit button in a tag and style hiredcmut-button -->
                <button type="submit" class="my-button">Search</button>
            </div>
        </div>
        <div id="search-suggestions" class="dropdown-menu" aria-labelledby="search-input">
            <!-- Search suggestions will be loaded here -->
        </div>
    </form>
</div>

<?php
require_once 'includes/footer.php';
?>

<script>
$(document).ready(function() {
    $('#search-input').on('input', function() {
        var query = $(this).val();
        if (query.length > 0) {
            $.ajax({
                url: 'get_search_suggestions.php',
                type: 'GET',
                data: {
                    q: query
                },
                success: function(suggestions) {
                    // Generate the HTML for the search suggestions
                    var suggestionsHtml = '';
                    if (suggestions.length == 0) {
                        suggestionsHtml = '<a class="dropdown-item">Nothing found</a>';
                    } else {
                        for (var i = 0; i < suggestions.length; i++) {
                            suggestionsHtml += '<a class="dropdown-item" href="course.php?id=' + suggestions[i].id + '">' + suggestions[i].course_name + '</a>';
                        }
                    }
                    $('#search-suggestions').html(suggestionsHtml);
                    $('#search-suggestions').show();
                }
            });
        } else {
            $('#search-suggestions').hide();
        }
    });
});
</script>