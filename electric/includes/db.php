<?php
$servername = "localhost";
$username = "root";
$password = "code_hetvi003";
$dbname = "electric_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
