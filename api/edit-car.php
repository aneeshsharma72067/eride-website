<?php
session_start();
include('../components/conn.php');
if (!isset($_SESSION['admin_id'])) {
    header('location: ../admin-login.php');
    die();
}

$car_id = $_POST['car_id'];
$make = $_POST['make'];
$model = $_POST['model'];
$price = $_POST['price'];
$max_price = $_POST['max-price'];
$year = $_POST['year'];
$month = explode('-', $_POST['month'])[1];
$mileage = $_POST['mileage'];
$type = $_POST['type'];
$image_url = $_POST['image-url'];
$description = $_POST['description'];
$main_review = $_POST['main-review'];

if (trim($type) == "") {
    header('location: ../edit-car-form.php?car_id=' . $car_id . '&res=401');
    die();
}

try {
    // Use prepared statements to update the database
    $edit_query = "UPDATE cars SET make=?, model=?, year=?, month=?, price=?, max_price=?, mileage=?, description=?, type=?, image_url=?, main_review=? WHERE car_id=?";

    $stmt = mysqli_prepare($conn, $edit_query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssisdddssssi", $make, $model, $year, $month, $price, $max_price, $mileage, $description, $type, $image_url, $main_review, $car_id);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        header('location: ../edit-car-form.php?car_id=' . $car_id . '&res=400');
    }

    header('location: ../admin-panel.php');
} catch (mysqli_sql_exception $e) {
    echo $e;
    exit;
} finally {
    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

if (!$result) {
    header('location: ../edit-car-form.php?car_id=' . $car_id . '&res=400');
}

header('location: ../admin-panel.php');
mysqli_close($conn);
