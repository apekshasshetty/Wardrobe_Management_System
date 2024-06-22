<?php
session_start();

$mysqli = new mysqli('localhost', 'root', 'anvitha@2003', 'wardrobe');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get clothIds and outfitName from the POST request
$clothIds = $_POST['clothIds'];
$outfitName = $_POST['outfitName'];
$user_id = $_SESSION['user_id'];

// Create the outfit and get the outfit_id
$insertOutfitQuery = "INSERT INTO outfit (user_id, name) VALUES ('$user_id', '$outfitName')";
$mysqli->query($insertOutfitQuery);
$outfit_id = $mysqli->insert_id;

// Insert clothing items into outfit_clothing table
foreach ($clothIds as $clothId) {
    $insertOutfitClothingQuery = "INSERT INTO outfit_clothing (outfit_id, cloth_id) VALUES ('$outfit_id', '$clothId')";
    $mysqli->query($insertOutfitClothingQuery);
}

echo json_encode(['success' => true]);
?>
