<?php
session_start();

if(!isset($_SESSION["user_role"])){
    header("location: ../index.php");
    exit;
}
?>