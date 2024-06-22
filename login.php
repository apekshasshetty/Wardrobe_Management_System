<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    // Connect to the MySQL database 
    $mysqli = new mysqli("localhost", "root", "anvitha@2003", "wardrobe");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Check if the username exists
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $result = $mysqli->query($check_query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if ($password === $user['passwd']) {
            session_start(); // Start a PHP session
            $_SESSION['username'] = $username; // Store the username in the session

            // Check if the user is an admin
            if ($user['is_admin'] == 1) {
                $_SESSION['is_admin'] = true; // Set the admin flag in the session
                header("Location: admin_dashboard.php"); // Redirect to the admin dashboard
            } else {
                header("Location: dashboard1.php"); // Redirect to the regular user dashboard
            }

            exit(); // Terminate the script
        } else {
            echo "Incorrect password. Please try again !!";
        }
    } else {
        echo "Username not found.";
    }
}

?>
