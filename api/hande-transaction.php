<?php
session_start();
include('../components/conn.php');
if (!isset($_SESSION['user_id'])) {
    header('location: ../login.php');
    die();
}
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_id = validate($_POST['car_id']);

    $first_name = validate($_POST['first_name']);

    $last_name = validate($_POST['last_name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $address = validate($_POST['address']);
    $year = validate($_POST['year']);
    $month = validate($_POST['month']);
}


$user_id = $_SESSION['user_id'];

try {
    $query = "INSERT INTO transactions(user_id, car_id, first_name, last_name, year, month, email, phone, address, transaction_date) VALUES (?,?,?,?,?,?,?,?,?,CURDATE())";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, 'iisssssss', $user_id, $car_id, $first_name, $last_name, $year, $month, $email, $phone, $address);

    $result = mysqli_stmt_execute($stmt);
    if (!$result) {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
    header('location: ../car.php?car_id=' . $car_id);
} catch (mysqli_sql_exception $e) {
    var_dump($e);
    exit;
} finally {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
