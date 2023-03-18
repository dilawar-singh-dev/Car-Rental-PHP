<?php
include('../config/connection.php');

session_start();

if (isset($_POST['submit'])) {

    $km_driven = mysqli_real_escape_string($dbconn, $_POST['km_driven']);
    $model = mysqli_real_escape_string($dbconn, $_POST['model']);
    $other_info = mysqli_real_escape_string($dbconn, $_POST['other_info']);
    $name = mysqli_real_escape_string($dbconn, $_POST['name']);


    $outside_file_target_dir = "../assets/uploads/";
    $outside_file_temp = explode(".", $_FILES["outside_image"]["name"]);
    $new_outside_file_name = round(microtime(true)) . '.' . end($outside_file_temp);
    move_uploaded_file($_FILES["outside_image"]["tmp_name"], $outside_file_target_dir . $new_outside_file_name);

    sleep(1);

    $inside_file_target_dir = "../assets/uploads/";
    $inside_file_temp = explode(".", $_FILES["inside_image"]["name"]);
    $new_inside_file_name = round(microtime(true)) . '.' . end($inside_file_temp);
    move_uploaded_file($_FILES["inside_image"]["tmp_name"], $inside_file_target_dir . $new_inside_file_name);

    $uploadDirPath = "assets/uploads/";
    
    $sql = "INSERT INTO car_rental (name, km_driven, model, outside_image, inside_image, other_info)
        VALUES ('$name', '$km_driven', '$model', '$uploadDirPath$new_outside_file_name', '$uploadDirPath$new_inside_file_name', '$other_info')";

    if (mysqli_query($dbconn, $sql)) {
        $_SESSION['success'] = "Rental car record successfully added";
        header("Location: ../admin/create-car.php");
    } else {
        $_SESSION['error'] = "Error: " . $sql . "<br>" . mysqli_error($dbconn);
        header("Location: ../admin/create-car.php");
    }

    mysqli_close($dbconn);
}

?>