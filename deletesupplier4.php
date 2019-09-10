<?php
require_once('connect.php');
$id = $_GET['id'];

$sql = "DELETE FROM supplier4 WHERE Id=$id";

if ($connection->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header('Location: newmenusuppliers.php');
} else {
    echo "Error deleting record: " . mysqli_error($connection);
}

$connection->close();






?>