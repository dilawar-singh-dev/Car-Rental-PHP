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
    <title>Create - Car Rental</title>
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
        <div class="col-md-8 mx-auto my-5">

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
                <h2 class="my-4">Add Car</h2>
                <span>
                    <a href="list-cars.php" class="btn btn-primary">View Cars</a>
                </span>
            </div>


            <form method="POST" action="../controllers/createCarController.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="kmDriven">KM Driven</label>
                    <input type="number" class="form-control" id="kmDriven" name="km_driven" required>
                </div>
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" name="model" required>
                </div>
                <div class="form-group">
                    <label for="outsideImage">Outside Image</label>
                    <input type="file" class="form-control-file" id="outsideImage" name="outside_image" accept="image/*"
                        required>
                </div>
                <div class="form-group">
                    <label for="insideImage">Inside Image</label>
                    <input type="file" class="form-control-file" id="insideImage" name="inside_image" accept="image/*"
                        required>
                </div>
                <div class="form-group">
                    <label for="otherInfo">Other Info</label>
                    <textarea class="form-control" id="otherInfo" name="other_info" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="submit">Create</button>
            </form>
        </div>
    </div>


</body>

</html>