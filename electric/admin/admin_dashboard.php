<?php include('../includes/db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Electronic Products Store</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; 
        }   
        .container {
            margin-top: 50px;
            background-color: #fff; 
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1); 
        }
        h2 {
            color: #343a40;
            margin-bottom: 30px;
        }
        table {
            margin-top: 20px;
        }
        table th, table td {
            text-align: center; 
            vertical-align: middle;
        }
        .btn {
            margin-right: 5px;
        }
       
        table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Admin Panel - Electronic Products Store</h2>
        <div class="row">
            <div class="col-md-12 text-right mb-3">
                <a href="add_item.php" class="btn btn-primary">Add New Item</a>
                <a href="view_report.php" class="btn btn-info">View Sales Reports</a>
            </div>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT items.*, categories.category_name FROM items JOIN categories ON items.category_id = categories.id");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['item_name']}</td>
                            <td>{$row['category_name']}</td>
                            <td>\${$row['price']}</td>
                            <td>
                                <a href='edit_item.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_item.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
