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
    <title>Update - Car Rental</title>
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
                <h2 class="my-4">Edit Car</h2>
                <span>
                    <a href="list-cars.php" class="btn btn-primary">View Cars</a>
                </span>
            </div>

            <?php

            include('../config/connection.php');

            $id = $_GET["id"];

            $sql = "SELECT * FROM car_rental WHERE id = $id";
            $result = $dbconn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                ?>

                <form method="POST" action="../controllers/updateCarController.php?id=<?php echo $row["id"] ?>"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row["name"] ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="kmDriven">KM Driven</label>
                        <input type="number" class="form-control" id="kmDriven" name="km_driven"
                            value="<?php echo $row["km_driven"] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" id="model" name="model" value="<?php echo $row["model"] ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="outsideImage">Outside Image</label>
                        <input type="file" class="form-control-file" id="outsideImage" name="outside_image"
                            accept="image/*">

                        <img class="img-fluid col-md-4 px-0 my-3" src="<?php echo "../" . $row["outside_image"] ?>" />
                    </div>
                    <div class="form-group">
                        <label for="insideImage">Inside Image</label>
                        <input type="file" class="form-control-file" id="insideImage" name="inside_image" accept="image/*">

                        <img class="img-fluid col-md-4 px-0 my-3" src="<?php echo "../" . $row["inside_image"] ?>" />
                    </div>
                    <div class="form-group">
                        <label for="otherInfo">Other Info</label>
                        <textarea class="form-control" id="otherInfo" name="other_info"
                            rows="3"><?php echo $row["other_info"] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="submit">Update</button>
                </form>

                <?php
            }
            $dbconn->close();
            ?>

        </div>
    </div>

</body>

</html>