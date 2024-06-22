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

    // Fetch items for the user from the CLOTHES table
    $select_items_query = "SELECT * FROM CLOTHES WHERE user_id = '$user_id' ORDER BY category";
    $items_result = $mysqli->query($select_items_query);
} else {
    // Handle the case where the user is not found
    echo "Error: User not found.";
    exit();
}

?>


