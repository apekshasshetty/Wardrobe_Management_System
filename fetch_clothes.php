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

// Get the selected categories from the AJAX request
$categories = isset($_POST['category']) ? $_POST['category'] : '';

// Check if categories are not empty
if (!empty($categories)) {
    // Separate the categories into an array
    $categoryArray = explode(",", $categories);

    // Use implode to create a comma-separated list for the SQL query
    $categoryList = "'" . implode("','", $categoryArray) . "'";

    // Fetch clothes for the user based on the selected categories
    $select_clothes_query = "SELECT * FROM clothes WHERE user_id = '$user_id' AND category IN ($categoryList)";
    $clothes_result = $mysqli->query($select_clothes_query);

    $clothingItems = array();

    if ($clothes_result && $clothes_result->num_rows > 0) {
        while ($row = $clothes_result->fetch_assoc()) {
            $clothingItems[] = array(
                'cloth_name' => $row['cloth_name'],
                'image_path' => $row['image_path'],
                'occasion' => $row['occasion'],
                'color' => $row['color'],
            );
        }
    } else {
        // Dummy data for demonstration if no items are found
        $clothingItems = [
            ['cloth_name' => 'Default Clothing', 'image_path' => 'default-clothing.jpg', 'occasion' => 'Casual', 'color' => 'Black'],
        ];
    }

    // Send the JSON response only if the array is not empty
    if (!empty($clothingItems)) {
        echo json_encode($clothingItems);
    }
} else {
    
}

} else {
    // Handle the case where the user is not found
    echo "Error: User not found.";
    exit();
}
?>
