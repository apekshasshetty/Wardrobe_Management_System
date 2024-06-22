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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve outfit details from the POST data
    $outfitDetails = json_decode($_POST['outfitDetails'], true);


    // Insert into the outfit table
    $insert_outfit_query = "INSERT INTO outfit (user_id, outfit_date) VALUES ('$user_id', NOW())";
    $mysqli->query($insert_outfit_query);

    // Get the ID of the last inserted outfit
    $outfit_id = $mysqli->insert_id;

    // Insert into the outfit_clothing table for each selected clothing item
foreach ($outfitDetails['clothes'] as $cloth) {
    $cloth_name = $cloth['cloth_name'];
    $image_path = $cloth['image_path'];

    // Retrieve cloth_id based on cloth_name and image_path
    $select_cloth_query = "SELECT cloth_id FROM clothes WHERE user_id = '$user_id' AND cloth_name = '$cloth_name' AND image_path = '$image_path'";
    $cloth_result = $mysqli->query($select_cloth_query);

    if ($cloth_result && $cloth_result->num_rows > 0) {
        $cloth_row = $cloth_result->fetch_assoc();
        $cloth_id = $cloth_row['cloth_id'];

        // Insert into the outfit_clothing table
        $insert_outfit_clothing_query = "INSERT INTO outfit_clothing (outfit_id, cloth_id) VALUES ('$outfit_id', '$cloth_id')";
        echo $insert_outfit_clothing_query; // Add this line for debugging
        $mysqli->query($insert_outfit_clothing_query);
        $mysqli->error;
    }
}

    // Respond to the client with success message
    echo json_encode(['status' => 'success', 'message' => 'Outfit details stored successfully']);
} else {
    // Handle invalid requests
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

// Close the database connection
$mysqli->close();
?>
