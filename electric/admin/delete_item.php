<?php 
include('../includes/db.php');

if (isset($_GET['id'])) {
    $item_id = $_GET['id'];
    $conn->query("DELETE FROM items WHERE id='$item_id'");
    echo "Item deleted successfully!";
    header('Location: admin_dashboard.php');
}
?>
