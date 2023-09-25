<?php
// header("Location: http://localhost/Car%20Purchasing%20Website/");
include('../../components/conn.php');
$query = 'SELECT * FROM cars';
$result = mysqli_query($conn, $query) or die('Query Unsuccessfull');
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($data, $row);
}
echo json_encode($data);
