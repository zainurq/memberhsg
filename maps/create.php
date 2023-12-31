<?php
include 'layouts/config.php';

// Fetch store data from the surveyor_dtl table
$query = "SELECT * FROM surveyor_dtl WHERE latitude IS NOT NULL AND longitude IS NOT NULL";
$result = mysqli_query($linked, $query);

// Check if the query was successful
if (!$result) {
    die("ERROR: Could not execute $query. " . mysqli_error($linked));
}

$locations = array();
while ($row = mysqli_fetch_assoc($result)) {
    $locations[] = $row;
}

// Close the database connection
mysqli_close($linked);

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($locations);
?>
