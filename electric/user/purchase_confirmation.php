<?php
session_start();
include('../includes/db.php');

$user_email = $_SESSION['user'];
$user_query = $conn->query("SELECT * FROM users WHERE email = '$user_email'");
$user = $user_query->fetch_assoc();
$user_id = $user['id'];

$transactions_query = $conn->query("SELECT transactions.*, items.item_name 
                                    FROM transactions 
                                    JOIN items ON transactions.item_id = items.id 
                                    WHERE transactions.user_id = '$user_id' 
                                    ORDER BY transactions.id DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Confirmation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .confirmation-container {
            width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .text-center {
            margin-bottom: 15px;
        }
        .btn-primary {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h2 class="text-center">Thank You for Your Purchase!</h2>

        <h4>Purchased Items</h4>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_amount = 0;
                while ($transaction = $transactions_query->fetch_assoc()) {
                    $total_amount += $transaction['total_price'];
                    echo "<tr>
                            <td>{$transaction['item_name']}</td>
                            <td>{$transaction['quantity']}</td>
                            <td>₹{$transaction['total_price']}</td>
                          </tr>";
                }
                ?>
                <tr>
                    <td colspan="2" class="text-right"><strong>Total Amount:</strong></td>
                    <td><strong>$<?php echo number_format($total_amount, 2); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <div class="text-center">
            <a href="index.php" class="btn btn-primary">Back to Home</a>
        </div>
    </div>

</body>
</html>
