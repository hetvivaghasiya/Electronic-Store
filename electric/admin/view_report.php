<?php 
include('../includes/db.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin_css.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Sales Report</h2>
        
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Transaction ID</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Transaction Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT transactions.id as transaction_id, items.item_name, transactions.quantity, transactions.total_price, transactions.transaction_date FROM transactions JOIN items ON transactions.item_id = items.id");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['transaction_id']}</td>
                            <td>{$row['item_name']}</td>
                            <td>{$row['quantity']}</td>
                            <td>₹{$row['total_price']}</td>
                            <td>{$row['transaction_date']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="text-center mt-3">
            <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
