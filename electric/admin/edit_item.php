<?php  
include('../includes/db.php');   


if (isset($_GET['id'])) { 
    $item_id = $_GET['id']; 
    $item = $conn->query("SELECT * FROM items WHERE id = '$item_id'")->fetch_assoc(); 
}  

if (isset($_POST['submit'])) { 
    $item_name = $_POST['item_name']; 
    $category_id = $_POST['category_id']; 
    $price = $_POST['price']; 
    $item_image = $_FILES['item_image']['name'];  

    if (!empty($item_image)) { 
        $target_dir = "../uploads/"; 
        $target_file = $target_dir . basename($_FILES["item_image"]["name"]); 
        move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file);  

        $conn->query("UPDATE items SET item_name='$item_name', category_id='$category_id', price='$price', item_image='$item_image' WHERE id='$item_id'"); 
    } else { 
        $conn->query("UPDATE items SET item_name='$item_name', category_id='$category_id', price='$price' WHERE id='$item_id'"); 
    } 
    $success_message = "<div class='alert alert-success'>Item updated successfully!</div>";
} 
?>  

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Edit Item</title> 
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="../assets/css/admin_css.css"> 
</head> 
<body> 
    <div class="container mt-5"> 
        <h2>Edit Item</h2> 
        <form action="edit_item.php?id=<?php echo $item_id; ?>" method="POST" enctype="multipart/form-data"> 
            <div class="form-group"> 
                <label for="item_name">Item Name</label> 
                <input type="text" id="item_name" name="item_name" class="form-control" value="<?php echo $item['item_name']; ?>" required> 
            </div>  

            <div class="form-group"> 
                <label for="category_id">Category</label> 
                <select id="category_id" name="category_id" class="form-control"> 
                    <?php 
                    $categories = $conn->query("SELECT * FROM categories"); 
                    while($category = $categories->fetch_assoc()) { 
                        $selected = $category['id'] == $item['category_id'] ? 'selected' : ''; 
                        echo "<option value='{$category['id']}' $selected>{$category['category_name']}</option>"; 
                    } 
                    ?> 
                </select> 
            </div>  

            <div class="form-group"> 
                <label for="price">Price</label> 
                <input type="number" id="price" name="price" class="form-control" value="<?php echo $item['price']; ?>" required> 
            </div>  

            <div class="form-group"> 
                <label for="item_image">Image</label> 
                <input type="file" id="item_image" name="item_image" class="form-control-file"> 
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small> 
            </div>  

            <button type="submit" name="submit" class="btn btn-success">Update Item</button> 
        </form>  

        <div class="text-center mt-3"> 
            <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a> 
        </div> 

        <?php if (isset($success_message)) { echo $success_message; } ?> 
    </div>  
</body> 
</html>
