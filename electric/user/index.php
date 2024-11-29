<?php include('../includes/db.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronics Store - Home</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .header {
            background: url("../uploads/back.jpg") no-repeat center center;
            background-size: cover;
            color: white;
            padding: 140px 0;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1.2rem;
        }

        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 0.25rem;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .categories {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 40px 0;
        }

        .category-card {
            margin: 15px;
            flex: 0 0 18rem;
            transition: transform 0.3s;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s forwards;
        }

        .category-card:hover {
            transform: scale(1.05);
        }

        .category-card img {
            height: 150px;
            object-fit: cover;
            border-radius: 0.5rem;
        }

        .category-card .card-title {
            font-size: 1.2rem;
        }

        .category-card .btn {
            background-color: #007bff;
            border-color: #007bff;
        }

        .category-card .btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Welcome to Our Electronics Store</h1>
        <p>Your one-stop shop for the latest gadgets!</p>
        <a href="login.php" class="logout-button">Logout</a> 
    </div>

    <div class="container">
        <h2 class="text-center my-5">Our Categories</h2>
        <div class="categories">
            <?php
           
            $categories = $conn->query("SELECT * FROM categories"); 
            while ($category = $categories->fetch_assoc()) {
                echo "<div class='category-card'>
                        <div class='card shadow-sm'>
                            <img src='../uploads/{$category['category_image']}' class='card-img-top' alt='{$category['category_name']} Image'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$category['category_name']}</h5>
                                <a href='category.php?id={$category['id']}' class='btn btn-primary'>View Items</a>
                            </div>
                        </div>
                      </div>";
            }
            ?>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Electronics Management. All Rights Reserved.</p>
    </footer>
</body>

</html>