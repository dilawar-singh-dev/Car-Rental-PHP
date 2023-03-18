<?php 
include('../config/connection.php');

session_start();

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $user_role = $_POST['user_role'];

  if (empty($email) || empty($password)) {
    $_SESSION['error'] = "Please enter both your email and password.";
    header("Location: ../index.php");
    exit();
  } else {

    $sql = "SELECT * FROM users WHERE email= '$email' AND user_role= '$user_role';";

      $result = mysqli_query($dbconn, $sql);

      if ($row = mysqli_fetch_assoc($result)) {
        $password_check = password_verify($password, $row['password']);

        if ($password_check == false) {
          $_SESSION['error'] = "Invalid password";
          header("Location: ../index.php");
          exit();
        } elseif ($password_check == true) {
          session_unset();
          $_SESSION['user_id'] = $row['id'];
          $_SESSION['user_email'] = $row['email'];
          

          if($row['user_role'] === 'admin'){
            $_SESSION['admin_role'] = $row['user_role'];
            header("Location: ../admin/list-cars.php");
          }

          if($row['user_role'] === 'user'){
            $_SESSION['user_role'] = $row['user_role'];
            header("Location: ../user/list-cars.php");
          }
          
          exit();
        }
      } else {
        $_SESSION['error'] = "Invalid email, password or user role";
        header("Location: ../index.php");
        exit();
      }

    mysqli_close($dbconn);
  }
}


?>