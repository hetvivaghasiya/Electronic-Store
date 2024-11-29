<?php
session_start();
include('../includes/db.php');

if (isset($_GET['add'])) {
    $item_id = $_GET['add'];
    $_SESSION['cart'][] = $item_id;
}

$cart_items = array_count_values($_SESSION['cart']);
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Your Cart</h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($cart_items as $item_id => $quantity) {
                    $result = $conn->query("SELECT * FROM items WHERE id = '$item_id'");
                    if ($result && $item = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$item['item_name']}</td>
                                <td>$quantity</td>
                                <td>₹{$item['price']}</td>
                              </tr>";
                        $total += $item['price'] * $quantity;
                    } else {
                        echo "<tr>
                                <td colspan='3'>Item not found</td>
                              </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <h3>Total: ₹<?php echo $total; ?></h3>
        <a href="purchase.php" class="btn btn-success">Proceed to Checkout</a>
    </div>
</body>
</html>
