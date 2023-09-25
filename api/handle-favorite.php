<?php
session_start();
include('../components/conn.php');
if (!isset($_SESSION['user_id'])) {
    echo "error";
    exit();
}
if (isset($_POST['carId']) && isset($_POST['handle'])) {
    $carId = $_POST['carId'];
    $handle = $_POST['handle'];
    $userId = $_SESSION['user_id'];

    if ($handle == 'add') {
        $query = "INSERT INTO favorites (user_id, car_id) VALUES (?, ?)";
    } else if ($handle == 'remove') {
        $query = "DELETE FROM favorites WHERE user_id = ? AND car_id = ?";
    }

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $userId, $carId);
    header('Content-Type: application/json');
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode("success");
    } else {
        echo json_encode("error");
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "error";
}
