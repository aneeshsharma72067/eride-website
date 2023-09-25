<?php
session_start();
include('../../components/conn.php');
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM cars INNER JOIN favorites ON cars.car_id = favorites.car_id WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query) or die('Query Unsuccessfull');
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($data, $row);
}
echo json_encode($data);
