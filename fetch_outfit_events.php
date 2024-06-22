<?php
session_start();

// Connect to the MySQL database (replace with your own database credentials)
$mysqli = new mysqli('localhost', 'root', 'anvitha@2003', 'wardrobe');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (!isset($_SESSION['username'])) {
    header("Location: login.html"); // Redirect to the login page if the user is not logged in
    exit();
}

// Fetch user_id based on username
$username = $_SESSION['username'];
$select_user_query = "SELECT user_id FROM users WHERE username = '$username'";
$result = $mysqli->query($select_user_query);

if ($result && $result->num_rows > 0) {
    // Fetch the user_id from the result
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];
}

// Fetch outfit events from outfit_calendar table
$query = "SELECT cl.image_path, o.outfit_date, oc.outfit_id FROM outfit_clothing oc
          JOIN clothes cl ON oc.cloth_id = cl.cloth_id
          JOIN outfit o ON o.outfit_id = oc.outfit_id
          WHERE cl.user_id = $user_id 
          ORDER BY o.outfit_date";

$result = mysqli_query($mysqli, $query);

if ($result) {
    $outfits = array();

    while ($row = mysqli_fetch_assoc($result)) {
        // Add each outfit as an event to the array
        $outfit = array(
            'title' => 'Outfit',
            'start' => $row['outfit_date'],
            'image' => $row['image_path'],
            'outfit_id' => $row['outfit_id'],
        );
        $outfits[] = $outfit;
    }

    // Return the outfit data as JSON
    header('Content-Type: application/json');
    echo json_encode($outfits);
} else {
    // Handle the case where the query fails
    echo json_encode(array('error' => 'Failed to fetch outfits'));
}

// Close the database connection
mysqli_close($mysqli);