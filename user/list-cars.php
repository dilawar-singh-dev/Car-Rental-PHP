<?php
include('../controllers/userSessionController.php');
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>List - Car Rental</title>

  <style>
    .cursor-pointer {
      cursor: pointer;
    }


    .card .inside-image{
      display: none;
    }

    .card:hover .outside-image{
      display: none;
    }

    .card:hover .inside-image{
      display: block;
    }

  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="list-cars.php">Car Rental</a>
    <div class="ml-auto d-flex align-items-center">
      <form method="GET" action-="" class="form-inline my-2 my-lg-0 ml-auto">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
      <div class="ml-5">
        <a class="text-danger" href="../controllers/logoutController.php">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <div class="col-md-12 mx-auto my-5">

      <div class="container">
        <div class="row">


          <div class="col-md-12 mb-3">
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
          </div>

          <?php
          include('../config/connection.php');

          $sql = "SELECT * FROM car_rental";

          if (isset($_GET['query'])) {
            $query = $_GET['query'];
            $sql = "SELECT * FROM car_rental where name LIKE '%$query%'";
          }

          $result = $dbconn->query($sql);

          $tmpCount = 1;

          if (isset($_GET['query'])) {
            $query = $_GET['query'];
            echo '<div class="col-md-12 mb-3"><h5 class="text-left my-4">Search Results for: <strong>' . $query . '</strong></h5></div>';
          }

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

              if ($row["isBooked"]) {
                $booking = 'Unbook Now';
                $border = 'btn-outline-success';
                $isBooking = 0;
              }

              if (!$row["isBooked"]) {
                $booking = 'Book Now';
                $border = 'btn-outline-primary';
                $isBooking = 1;
              }

              ?>

              <div class="col-md-4 mb-3">
                <div class="card h-100">

                  <img style="height:250px;object-fit:cover" src="<?php echo '../' . $row['outside_image'] ?>"
                    class="outside-image cursor-pointer">

                  <img style="height:250px;object-fit:cover" src="<?php echo '../' . $row['inside_image'] ?>"
                    class="inside-image cursor-pointer">

                  <div class="card-body px-2 pb-2 pt-1">
                    <p class="mb-0">
                      <strong>
                        <?php echo $row['name'] ?>
                      </strong>
                    </p>
                    <p class="mb-1">
                      <small>
                        Model:
                        <?php echo $row['model'] ?>
                      </small>
                    </p>
                    <p class="mb-1">

                      <small>
                        Km Driven:
                        <?php echo $row['km_driven'] ?> Kms
                      </small>
                    </p>

                    <p class="mb-1 cursor-pointer" title="<?php echo ($row['other_info']) ?>">
                      <small>
                        <?php echo substr($row['other_info'], 0, 140) ?>...
                      </small>
                    </p>

                    <div class="d-flex justify-content-between">
                      <div class="col px-0">
                        <form method="POST" action="../controllers/bookingController.php">
                          <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                          <input type="hidden" name="booking" value="<?php echo $isBooking ?>">
                          <button class="btn btn-block <?php echo $border; ?>" name="submit">
                            <?php echo $booking ?>
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
          }
          $dbconn->close();
          ?>

        </div>
      </div>

    </div>

  </div>

</body>

</html>