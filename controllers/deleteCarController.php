<?php
include('../config/connection.php');

session_start();

$id = $_GET["id"];

$sql = "DELETE FROM car_rental WHERE id = ?";

$stmt = mysqli_prepare($dbconn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    $_SESSION['success'] = "Car deleted successfully";
    
} else {
    $_SESSION['error'] = "Error in deleting: " . mysqli_error($conn);
}

header("Location: ../admin/list-cars.php");