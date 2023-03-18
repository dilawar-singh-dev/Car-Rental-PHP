<?php
include('../config/connection.php');

session_start();

if (isset($_POST['submit'])) {

    $id = mysqli_real_escape_string($dbconn, $_POST['id']);
    $booking = mysqli_real_escape_string($dbconn, $_POST['booking']);

    $sql = "UPDATE car_rental SET isBooked = '$booking' WHERE id = $id";

    if (mysqli_query($dbconn, $sql)) {

        if ($booking) {
            $_SESSION['success'] = "Booking successfully";
        }

        if (!$booking) {
            $_SESSION['success'] = "Unbooking successfully";
        }

    } else {
        $_SESSION['error'] = "Error: " . $sql . "<br>" . mysqli_error($dbconn);
    }

    header("Location: ../user/list-cars.php");

    mysqli_close($dbconn);
}

?>