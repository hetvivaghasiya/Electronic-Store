<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user_email = $_SESSION['user'];
$user_query = $conn->query("SELECT * FROM users WHERE email = '$user_email'");
$user = $user_query->fetch_assoc();
$user_id = $user['id'];

$cart_items = array_count_values($_SESSION['cart'] ?? []);
$total_amount = 0;

if (isset($_POST['purchase'])) {
    if (!empty($cart_items)) {
        foreach ($cart_items as $item_id => $quantity) {
            $item_query = $conn->query("SELECT * FROM items WHERE id = '$item_id'");
            
            if ($item_query && $item = $item_query->fetch_assoc()) {
                $item_price = $item['price'];
                $total_price = $item_price * $quantity;

                $conn->query("INSERT INTO transactions (user_id, item_id, quantity, total_price) 
                VALUES ('$user_id', '$item_id', '$quantity', '$total_price')");
            } else {
                echo "<p>Item with ID $item_id not found!</p>";
            }
        }

        unset($_SESSION['cart']);

        header("Location: purchase_confirmation.php");
        exit();
    } else {
        echo "<p>Your cart is empty!</p>";
    }
}
$cart_items_data = [];
foreach ($cart_items as $item_id => $quantity) {
    $item_query = $conn->query("SELECT * FROM items WHERE id = '$item_id'");
    
    if ($item_query && $item = $item_query->fetch_assoc()) {
        $cart_items_data[] = [
            'item_name' => $item['item_name'],
            'quantity' => $quantity,
            'price' => $item['price'],
            'total' => $item['price'] * $quantity
        ];
        $total_amount += $item['price'] * $quantity;
    } else {
        echo "<p>Item with ID $item_id not found!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase - Online Electronic products Store</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Your Cart</h1>

        <?php if (!empty($cart_items_data)) { ?>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items_data as $cart_item) { ?>
                        <tr>
                            <td><?php echo $cart_item['item_name']; ?></td>
                            <td><?php echo $cart_item['quantity']; ?></td>
                            <td>$<?php echo number_format($cart_item['price'], 2); ?></td>
                            <td>$<?php echo number_format($cart_item['total'], 2); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total Amount:</strong></td>
                        <td><strong>₹<?php echo number_format($total_amount, 2); ?></strong></td>
                    </tr>
                </tbody>
            </table>

            <form method="POST" action="purchase.php">
                <div class="text-right">
                    <button type="submit" name="purchase" class="btn btn-success">Confirm Purchase</button>
                </div>
            </form>
        <?php } else { ?>
            <p>Your cart is empty!</p>
        <?php } ?>

        <div class="text-right mt-3">
            <a href="cart.php" class="btn btn-warning">Go Back to Cart</a>
        </div>
    </div>
</body>
</html>
