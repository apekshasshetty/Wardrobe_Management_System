<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outfit Generator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="outfit_gen.css">

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

    <?php include('fetch_clothes.php'); ?>
    
    <div class="container left">
        <h2><br> Welcome <?php echo $_SESSION['username']; ?> !!<br></h2>

        <label for="clothing-category">Select Clothing Category:</label>
        <select id="clothing-category" class="form-control" name="clothing-category">
            <option value="tops,bottoms">Top and Bottom</option>
            <option value="dresses">Dress</option>
        </select>

        <div id="clothing-container" class="clothing-container"></div>
    </div>

    <div class="container right">
    <h2>Selected Clothes</h2>
    <div id="selected-clothes-container" class="clothing-container"></div>
    <button id="wear-outfit-btn" class="btn btn-primary">Wear Outfit</button>

    </div>

    <!-- Clearfix to handle container overflow -->
    <div class="clearfix"></div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="outfit_gen.js"></script>
</body>
</html>
