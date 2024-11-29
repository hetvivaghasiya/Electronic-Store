<?php include('../includes/db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Items</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; 
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center; 
            margin: 20px 0; 
        }
        .item-card {
            margin: 15px; 
            border: 1px solid #ddd; 
            border-radius: 0.5rem; 
            transition: box-shadow 0.3s; 
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        .item-card:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
        }
        .item-card img {
            height: 200px; 
            object-fit: cover; 
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem; 
            width: 100%;
        }
        .item-card h3 {
            font-size: 1.25rem; 
            margin: 10px 0; 
            height: 50px; 
            overflow: hidden; 
        }
        .item-card p {
            font-size: 1.2rem; 
            color: #28a745; 
        }
        .add-to-cart {
            background-color: #007bff;
            color: white; 
            border: none;
            padding: 10px 15px; 
            border-radius: 0.25rem; 
            text-decoration: none;
            text-align: center;
        }
        .add-to-cart:hover {
            background-color: #0056b3; 
            color: white;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Items in Category</h1>
        <a href="index.php" class="btn btn-secondary mt-3">Back to Home</a> 
    </div>
    
    <div class="container">
        <div class="row">
            <?php
            $category_id = $_GET['id'];
            $items = $conn->query("SELECT * FROM items WHERE category_id = '$category_id'");
            while($item = $items->fetch_assoc()) {
                echo "<div class='col-md-3 d-flex'>
                        <div class='item-card'>
                            <img src='../uploads/{$item['item_image']}' class='card-img-top' alt='{$item['item_name']}'>
                            <div class='card-body'>
                                <h3 class='card-title'>{$item['item_name']}</h3>
                                <p>Price: {$item['price']}</p>
                                <a href='cart.php?add={$item['id']}' class='add-to-cart'>Add to Cart</a>
                            </div>
                        </div>
                      </div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
