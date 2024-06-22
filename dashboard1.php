<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="dashboard.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My Profile</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="dashboard1.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="add_items.html">Add Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="outfit_gen1.php">Outfit Generator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="outfit_cal.php">Outfit Calendar</a> <!-- Add this line -->
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="login.html">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="register.html">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <?php include('dashboard.php'); ?>
    <div class="container">
        <h2><br> Welcome <?php echo $_SESSION['username']; ?> !!<br></h2>
        <?php
    // Display user's items
    $currentCategory = null;

    while ($item = $items_result->fetch_assoc()) {
        if ($currentCategory !== $item['category']) {
            // Start a new section for the current category
            if ($currentCategory !== null) {
                echo '</div>'; // Close the previous section
            }
            
            $currentCategory = $item['category'];
            
            echo '<h3>' . ucfirst($currentCategory) . '</h3>'; // Display the category heading
            echo '<div class="row">';
        }

        echo '<div class="col-md-4">';
        echo '<main>';
        echo '<div class="card">';
        echo '<img src="' . $item['image_path'] . '" alt="Clothing Item" class="card-img">';
        echo '<div class="card-content">';
        echo '<h2>' . $item['cloth_name'] . '</h2>';
        echo '<p>';
        echo 'Occasion: ' . $item['occasion'] . '<br>';
        echo 'Color: ' . $item['color'];
        echo '</p>';
        echo '</div>';
        echo '</div>';
        echo '</main>';
        echo '</div>';
    }

    // Close the last section
    echo '</div>';
    ?>
</div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>