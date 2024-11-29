<?php include('../includes/db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item - Electronic Products Store</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin_css.css">
</head>
<body>
    <div class="container">
        <h2>Add New Item</h2>
        <form action="add_item.php" method="POST" enctype="multipart/form-data">
            <label>Item Name</label>
            <input type="text" name="item_name" class="form-control" required>
            
            <label>Category</label>
            <select name="category_id" class="form-control">
                <?php
                $categories = $conn->query("SELECT * FROM categories");
                while($category = $categories->fetch_assoc()) {
                    echo "<option value='{$category['id']}'>{$category['category_name']}</option>";
                }
                ?>
            </select>
            
            <label>Price</label>
            <input type="number" name="price" class="form-control" required>
            
            <label>Image</label>
            <input type="file" name="item_image" class="form-control">
            
            <input type="submit" name="submit" value="Add Item" class="mt-3 btn btn-success">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $item_name = $_POST['item_name'];
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $item_image = $_FILES['item_image']['name'];

            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["item_image"]["name"]);
            move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file);

            $conn->query("INSERT INTO items (item_name, category_id, price, item_image) VALUES ('$item_name', '$category_id', '$price', '$item_image')");
            echo "<div class='message text-success'>Item added successfully!</div>";
        }
        ?>
        <div class="text-center mt-3">
            <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
