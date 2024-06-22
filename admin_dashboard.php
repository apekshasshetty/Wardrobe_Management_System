<?php
session_start();

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    // Redirect to unauthorized access page or login page
    header("Location: unauthorized_access.php");
    exit();
}

// Handle the form submission to add a new admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_admin'])) {
    $new_admin_username = $_POST['new_admin_username'];
    $new_admin_password = $_POST['new_admin_password'];

    // Validate and sanitize input (add more validation as needed)
    $new_admin_username = htmlspecialchars($new_admin_username);
    // Hash the password for storage
    $hashed_password = password_hash($new_admin_password, PASSWORD_DEFAULT);

    // Connect to the MySQL database 
    $mysqli = new mysqli("localhost", "root", "anvitha@2003", "wardrobe");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Check if the new admin username already exists
    $check_query = "SELECT * FROM users WHERE username = '$new_admin_username'";
    $result = $mysqli->query($check_query);

    if ($result->num_rows > 0) {
        echo "Username already exists. Choose a different username.";
    } else {
        // Add the new admin to the database
        $insert_query = "INSERT INTO users (username, passwd, is_admin) VALUES ('$new_admin_username', '$hashed_password', 1)";
        if ($mysqli->query($insert_query)) {
            echo "New admin added successfully.";
        } else {
            echo "Error adding new admin: " . $mysqli->error;
        }
    }

    // Close the database connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="admin_dashboard.css">

</head>
<body>

    <h1>Welcome, Admin <?php echo $_SESSION['username']; ?></h1>

    <h2>Add a New Admin</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="new_admin_username">Username:</label>
        <input type="text" name="new_admin_username" required>

        <label for="new_admin_password">Password:</label>
        <input type="password" name="new_admin_password" required>

        <button type="submit" name="add_admin">Add Admin</button>
    </form>

    <!-- Add your admin-specific content here -->

    <!-- Add your JavaScript links or scripts here -->
</body>
</html>
