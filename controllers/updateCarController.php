<?php
include('../config/connection.php');

session_start();

if (isset($_POST['submit'])) {

    $id = $_GET["id"];

    $sql = "SELECT * FROM car_rental WHERE id = $id";
    $result = $dbconn->query($sql);

    $row = $result->fetch_assoc();

    $km_driven = mysqli_real_escape_string($dbconn, $_POST['km_driven']);
    $model = mysqli_real_escape_string($dbconn, $_POST['model']);
    $other_info = mysqli_real_escape_string($dbconn, $_POST['other_info']);
    $name = mysqli_real_escape_string($dbconn, $_POST['name']);



    $uploadDirPath = "assets/uploads/";
    
    if (!empty($_FILES['outside_image']['name'])) {
        $outside_file_target_dir = "../assets/uploads/";
        $outside_file_temp = explode(".", $_FILES["outside_image"]["name"]);
        $new_outside_file_name = round(microtime(true)) . '.' . end($outside_file_temp);
        move_uploaded_file($_FILES["outside_image"]["tmp_name"], $outside_file_target_dir . $new_outside_file_name);
        $outside_file_name_path = $uploadDirPath.$new_outside_file_name;
    }

    sleep(1);

    if (!empty($_FILES['inside_image']['name'])) {
        $inside_file_target_dir = "../assets/uploads/";
        $inside_file_temp = explode(".", $_FILES["inside_image"]["name"]);
        $new_inside_file_name = round(microtime(true)) . '.' . end($inside_file_temp);
        move_uploaded_file($_FILES["inside_image"]["tmp_name"], $inside_file_target_dir . $new_inside_file_name);
        $inside_file_name_path = $uploadDirPath.$new_inside_file_name;
    }


    if (empty($_FILES['outside_image']['name'])) {
        $outside_file_name_path = $row['outside_image'];
    }

    if (empty($_FILES['inside_image']['name'])) {
        $inside_file_name_path = $row['inside_image'];
    }

    $sql = "UPDATE car_rental SET name = '$name', km_driven = '$km_driven', model = '$model', outside_image = '$outside_file_name_path', inside_image = '$inside_file_name_path', other_info = '$other_info' WHERE id = $id";

    if (mysqli_query($dbconn, $sql)) {
        $_SESSION['success'] = "Rental car record successfully updated";
        header("Location: ../admin/edit-car.php?id=$id");
    } else {
        $_SESSION['error'] = "Error: " . $sql . "<br>" . mysqli_error($dbconn);
        header("Location: ../admin/edit-car.php?id=$id");
    }

    mysqli_close($dbconn);
}

?>