<?php
session_start(); // Start the session if not started already

// Connect to the MySQL database (replace with your own database credentials)
$mysqli = new mysqli('localhost', 'root', 'anvitha@2003', 'wardrobe');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username']; // Retrieve username from the session

    // Handle image upload
    $upload_dir = "uploads/";
    $image_path = $upload_dir . basename($_FILES["image_path"]["name"]);

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true); // Create the 'uploads' directory if it doesn't exist
    }

    if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $image_path)) {
        // The file has been successfully uploaded
    } else {
        echo "Error uploading file.";
        exit(); // Terminate the script if there's an error with the file upload
    }

    $color = $mysqli->real_escape_string($_POST["color"]); // Prevent SQL injection
    $occasion = $mysqli->real_escape_string($_POST["occasion"]);
    $cloth_name = $mysqli->real_escape_string($_POST["cloth_name"]);
    $category = $mysqli->real_escape_string($_POST["category"]);


    // Insert data into the 'CLOTHES' table
    $select_user_query = "SELECT user_id FROM users WHERE username = '$username'";
    $result = $mysqli->query($select_user_query);
    
    if ($result && $result->num_rows > 0) {
        // Fetch the user_id from the result
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
    }
    
        // Insert data into the 'CLOTHES' table
        $query = "INSERT INTO CLOTHES (user_id, cloth_name, image_path, color, occasion, category) VALUES ('$user_id', '$cloth_name', '$image_path', '$color', '$occasion', '$category')";
    

        if ($mysqli->query($query) === TRUE) {
            
            $_SESSION['upload_success'] = 'Item uploaded successfully!';
            header("Location: add_items.html");
        } else {
            // Handle the case where the query fails
            echo "Error: " . $query . "<br>" . $mysqli->error;
        }
    
}
?>

