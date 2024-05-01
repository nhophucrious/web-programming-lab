<?php
require_once 'includes/Database.php';

$query = $_GET['q'];

$db = new Database();

// Execute the search query
$results = $db->query("SELECT * FROM courses WHERE course_name LIKE ? LIMIT 5", ["%$query%"]);

// Return the results in JSON format
header('Content-Type: application/json');
echo json_encode($results);
