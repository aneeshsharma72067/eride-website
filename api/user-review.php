<?php
session_start();
include('../components/conn.php');

if (!isset($_SESSION['user_id'])) {
    echo json_encode('no user');
    exit();
}


$user_id = $_SESSION['user_id'];

if (!isset($_POST['carId']) || !isset($_POST['review'])) {
    echo json_encode('error');
    exit();
}

// echo json_encode("success");
// exit();

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$carId = validate($_POST['carId']);
$review = validate($_POST['review']);

$query = "INSERT INTO user_reviews (user_id, car_id, review, submitted_time) VALUES ('$user_id','$carId','$review',now())";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode('error');
    exit();
}

echo json_encode('success');
mysqli_close($conn);
exit();
