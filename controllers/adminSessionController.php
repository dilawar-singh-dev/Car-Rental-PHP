<?php
session_start();

if(!isset($_SESSION["admin_role"])){
    header("location: ../index.php");
    exit;
}
?>