<?php
require_once('connect.php');
session_start();

$id = $_GET['id'];
$del_id = $_SESSION['id'];
$del_name = $_SESSION['first_name'];
$sql = "UPDATE orders SET status_delivery = 'Delivering', delivery_name = '$del_name', delivery_id = $del_id WHERE Id=$id";

if ($connection->query($sql) === TRUE) {
    echo "Order is taken successfully";
    header('Location: allordersdelivery.php');
} else {
    echo "Error deleting record: " . mysqli_error($connection);
}

$connection->close();






?>