<?php
// header("Location: http://localhost/Car%20Purchasing%20Website/");
include('../../components/conn.php');
$brand_name = $_GET['brand'];
$query = "SELECT * FROM cars WHERE make = '$brand_name'";
$result = mysqli_query($conn, $query) or die('Query Unsuccessfull');
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($data, $row);
}
echo json_encode($data);
