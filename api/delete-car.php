<?php
session_start();
include('../components/conn.php');
if (!isset($_SESSION['admin_id'])) {
    header('location: ../admin-login.php');
    die();
}

$car_id = $_GET['car_id'];

$delete_query = "DELETE FROM cars WHERE car_id = $car_id";

$result = mysqli_query($conn, $delete_query);

if (!$result) {
    header('location: ../admin-panel.php?res=400');
    die();
}

header('location: ../admin-panel.php');

mysqli_close($conn);
