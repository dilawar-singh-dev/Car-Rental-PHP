<?php
include('../controllers/adminSessionController.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>List - Car Rental</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="list-cars.php">Car Rental</a>
        <div class="ml-auto d-flex align-items-center">
            <div class="ml-5">
                <a class="text-danger" href="../controllers/logoutController.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="col-md-12 mx-auto my-5">

            <?php

            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }

            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>


            <div class="d-flex justify-content-between align-items-center">
                <h2 class="my-4">Cars List</h2>
                <span>
                    <a href="create-car.php" class="btn btn-primary">Add Car</a>
                </span>
            </div>


            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Km Driven</th>
                        <th scope="col">Model</th>
                        <th scope="col">Booked</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../config/connection.php');

                    $sql = "SELECT * FROM car_rental";

                    $result = $dbconn->query($sql);

                    $tmpCount = 1;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            if($row["isBooked"]){
                                $booking = '<span class="text-success">Yes</span>';
                            }

                            if(!$row["isBooked"]){
                                $booking = '<span class="text-danger">No</span>';
                            }

                            echo "<tr>";
                            echo "<td>" . $tmpCount . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["km_driven"] . " km</td>";
                            echo "<td>" . $row["model"] . "</td>";
                            echo "<td>" . $booking . "</td>";
                            echo "<td>"
                                . "<a class='btn btn-warning mx-1' href=" . 'edit-car.php?id=' . $row["id"] . ">Edit</a>"
                                . "<a class='btn btn-danger mx-1' href=" . '../controllers/deleteCarController.php?id=' . $row["id"] . ">Delete</a>"
                                . "</td>";
                            echo "</tr>";
                            $tmpCount++;
                        }
                    }
                    $dbconn->close();
                    ?>

                </tbody>
            </table>


        </div>
    </div>

</body>

</html>